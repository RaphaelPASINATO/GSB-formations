<?php
session_start();
if (isset($_SESSION['login']) == false) {
    header("Location:connexion/pageConnexion.php");
    exit;
}
include_once("../bdd/connectBDD.php");
include_once("../bdd/updateDemandeAnnulationConfirmation.php");

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$StatutValide = filter_input(INPUT_POST, 'StatutValide', FILTER_VALIDATE_INT);

include_once("../bdd/getLesAnnulations.php");
$lesAnnulations = getLesAnnulations();
$idVerif =1;
$idVisiteur="";
$idFormation="";
foreach ($lesAnnulations as $annulation) {
    if ($id == $idVerif || $idRe == $idVerif){
        $idVisiteur = $annulation->matricule_visiteur;
        $idFormation = $annulation->id_formation;

    }
    $idVerif++;
}
$allo =updateDemandeAnnulationConfirmation($idFormation, $StatutValide, $idVisiteur);
header("Location:../inscriptions/inscription.php");
?>
