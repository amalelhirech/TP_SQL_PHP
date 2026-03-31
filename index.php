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
        m.libelle AS nom_matiere,
        c.nom_classe AS nom_classe
    FROM prof p
    INNER JOIN matiere m ON p.id_matiere = m.id
    INNER JOIN classes c ON p.id_classe = c.id
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


?>


