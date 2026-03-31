<?php
require_once "../Model/pdo.php";


if(!isset($_GET['id'])) {
    echo "Aucun id recu";
    exit();
}

$id = $_GET['id'];

if(
    isset($_POST['nom']) && !empty($_POST['nom']) &&
    isset($_POST['prenom']) && !empty($_POST['prenom']) &&
    isset($_POST['id_classe']) && !empty($_POST['id_classe'])
) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $idClasse = $_POST['id_classe'];

    $resultat = $dbPDO->prepare("
        UPDATE etudiant
        SET nom = :nom, prenom = :prenom, id_classe = :id_classe
        WHERE id_etudiant = :id
    ");

    $resultat->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'id_classe' => $idClasse,
        'id' => $id
    ]);

    echo "Modification reussie <br>";
}

$resultat = $dbPDO->prepare("
    SELECT id_etudiant, nom, prenom, id_classe
    FROM etudiant
    WHERE id_etudiant = :id
");
$resultat->execute([
    'id' => $id
]);

$etudiant = $resultat->fetch(PDO::FETCH_OBJ);

if(!$etudiant) {
    echo "Etudiant introuvable";
    exit();
}

$resultat = $dbPDO->prepare("
    SELECT id_classe, nom_classe
    FROM classes
");
$resultat->execute();

$classes = $resultat->fetchAll(PDO::FETCH_OBJ);

echo "<form action='modif_etudiant.php?id=" . $etudiant->id_etudiant . "' method='post'>

    <label for='nom'>Nom :</label>
    <input name='nom' id='nom' type='text' value='" . $etudiant->nom . "'>

    <label for='prenom'>Prenom :</label>
    <input name='prenom' id='prenom' type='text' value='" . $etudiant->prenom . "'>

    <label for='id_classe'>Classe :</label>
    <select name='id_classe' id='id_classe'>";

foreach($classes as $classe) {
    if($classe->id_classe == $etudiant->id_classe) {
        echo "<option value='" . $classe->id_classe . "' selected>" . $classe->nom_classe . "</option>";
    } else {
        echo "<option value='" . $classe->id_classe . "'>" . $classe->nom_classe . "</option>";
    }
}

echo "</select>

    <button type='submit'>Modifier</button>

</form>";

echo "<br><a href='../index.php'>Retour</a>";
?>