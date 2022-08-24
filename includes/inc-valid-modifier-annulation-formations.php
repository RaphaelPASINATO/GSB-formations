<?php
session_start();
if (isset($_SESSION['login']) == false) {
    header("Location:connexion/pageConnexion.php");
    exit;
}
include_once("../bdd/connectBDD.php");
include_once("../bdd/updateDemandeInscription.php");

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$idVisiteur = filter_input(INPUT_POST, 'idVisiteur', FILTER_DEFAULT);
$motif = filter_input(INPUT_POST, 'motif', FILTER_DEFAULT);
$date = date("Y-m-d");


$allo =updateDemandeInscription($id,3,$idVisiteur,$date,$motif);
header("Location:../inscriptions/inscription.php");
?>
