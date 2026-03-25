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

?>


