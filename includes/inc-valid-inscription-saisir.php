<?Php
include_once("../bdd/connectBDD.php");
include_once("../bdd/insertInscription.php");

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$idVisiteur = filter_input(INPUT_POST, 'idVisiteur', FILTER_DEFAULT);
$statut = filter_input(INPUT_POST, 'statut', FILTER_DEFAULT);
$date_inscription = filter_input(INPUT_POST, 'date_inscription', FILTER_DEFAULT);
$idFormationInscrit = insertInscription($id,$idVisiteur,$statut,$date_inscription);
header("Location:../inscriptions/inscription.php");
?>