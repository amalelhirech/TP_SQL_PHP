<?php
require_once "Model/pdo.php";



$resultat = $dbPDO->prepare("SELECT nom, prenom FROM etudiant"); 
$resultat->execute();

$etudiants = $resultat->fetchAll(PDO::FETCH_CLASS);

echo "<br> Liste des etudiants : ";

foreach($etudiants as $etudiant)
    echo  "<li> " .$etudiant->nom. " et " .$etudiant->prenom."</li>";



$res = $dbPDO->prepare("SELECT nom_classe FROM classes"); 
$res->execute();

$classes = $res->fetchAll(PDO::FETCH_OBJ); 

echo "<br>Liste de toutes les classes:<ul>";

foreach($classes as $classe) {
    echo "<li>" . $classe->nom_classe . "</li>";
}


echo "</ul>";


$res = $dbPDO->prepare("SELECT nom , prenom FROM prof"); 
$res->execute();

$profs = $res->fetchAll(PDO::FETCH_OBJ); 

echo "<br>Liste de toutes les profs :<ul>";

foreach($profs as $prof) {
    echo "<li>" . $prof->nom . " " . $prof->prenom . "</li>";
}


echo "</ul>";


$resultat = $dbPDO->prepare("
    SELECT 
        p.nom AS nom_prof,
        p.prenom AS prenom_prof,
        m.nom_matiere AS nom_matiere,
        c.nom_classe AS nom_classe
    FROM prof p
    INNER JOIN matiere m ON p.id_prof = m.id_prof
    INNER JOIN classes c ON p.id_classe = c.id_classe
");
$resultat->execute();

$profs_infos = $resultat->fetchAll(PDO::FETCH_OBJ);

echo "<br>Liste des professeurs avec leur matière et leur classe :<ul>";

foreach($profs_infos as $prof) {
    echo "<li>" 
        . $prof->nom_prof . " " . $prof->prenom_prof
        . " - Matière : " . $prof->nom_matiere
        . " - Classe : " . $prof->nom_classe
        . "</li>";
}

echo "</ul>";

// PARTIE 3 

/* $resultat = $dbPDO->prepare("INSERT INTO matiere(nom_matiere, id_prof) VALUES (:nom_matiere, :id_prof)");
$resultat->execute([
    'nom_matiere' => "Sport",
    'id_prof' => 1
]);

echo "Matiere ajoutee"; */

$res = $dbPDO->prepare("SELECT id_prof, nom, prenom FROM prof");
$res->execute();

$liste_profs = $res->fetchAll(PDO::FETCH_OBJ);

// Formulaire

echo "<br>Ajouter une matiere :";

echo "<form action='Views/nouvelle_matiere.php' method='post'>

    <label for='nom_matiere'>Libelle :</label>
    <input name='nom_matiere' id='nom_matiere' type='text'>

    <label for='id_prof'>Prof :</label>
    <select name='id_prof' id='id_prof'>";
    
foreach($liste_profs as $prof) {
    echo "<option value='" . $prof->id_prof . "'>"
        . $prof->nom . " " . $prof->prenom .
        "</option>";
}

echo "</select>

    <button type='submit'>Valider</button>

</form>";
?>




