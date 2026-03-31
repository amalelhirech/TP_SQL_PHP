<?php
require_once "../Model/pdo.php";

if(
    isset($_POST['nom_matiere']) && !empty($_POST['nom_matiere']) &&
    isset($_POST['id_prof']) && !empty($_POST['id_prof'])
) {
    $nom = $_POST['nom_matiere'];
    $idProf = $_POST['id_prof'];

    $resultat = $dbPDO->prepare("
        INSERT INTO matiere(nom_matiere, id_prof) 
        VALUES (:nom_matiere, :id_prof)
    ");

    $resultat->execute([
        'nom_matiere' => $nom,
        'id_prof' => $idProf
    ]);

    header("Location: ../index.php");
    exit();
} else {
    echo "Champs manquants";
    echo "<br><a href='../index.php'>Retour</a>";
}
?>