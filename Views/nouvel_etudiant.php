<?php
require_once "../Model/pdo.php";

if(
    isset($_POST['nom']) && !empty($_POST['nom']) &&
    isset($_POST['prenom']) && !empty($_POST['prenom']) &&
    isset($_POST['id_classe']) && !empty($_POST['id_classe'])
) {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $idClasse = $_POST['id_classe'];

    $resultat = $dbPDO->prepare("
        INSERT INTO etudiant(nom, prenom, id_classe)
        VALUES (:nom, :prenom, :id_classe)
    ");

    $resultat->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'id_classe' => $idClasse
    ]);

    header("Location: ../index.php");
    exit();
} else {
    echo "Champs manquants";
    echo "<br><a href='../index.php'>Retour</a>";
}
?>