<?php

session_start();
include_once("../bdd/connectBDD.php");
include_once("../bdd/getUneFormation.php");
include_once("../includes/inc-liste-erreurs.php");
include_once("../bdd/insertInscription.php");
include_once("../bdd/getPlaceOccupe.php");
include_once("../bdd/getNBFoisInscrits.php");
if (isset($_SESSION['login']) == false) {
    header("Location:connexion/pageConnexion.php");
    exit;
}
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (is_null($id) || $id === false) {
    header("Location:../accueil/index.php"); // bad request
    exit;
}

if (count($_POST) == 0) {
    $LaFormationCible = getUneFormation($id);
    if ($LaFormationCible === false) {
        header("Location:../inscriptions/inscription.php"); //not found
        exit;
    }
}
$intitule = $LaFormationCible->intitule;
$duree = $LaFormationCible->duree;
$dateDebut = $LaFormationCible->date_debut;
$lieu = $LaFormationCible->lieu;
$places = $LaFormationCible->nombre_places;
$organisateur = $LaFormationCible->nomOrganisateur;
$libelleFormation = $LaFormationCible->libelleTypeFormation;
$secteur = $LaFormationCible->secteurFormation;
$id_formation = $LaFormationCible->id;
$date_inscription = date("Y/m/d");
$statut  = "en attente";
$nb = getPlaceOccupe($id);
$nbOccupe = $nb->nbOccupe;
$placeRestants = $places - $nbOccupe;


$idVisiteur = " ";
$pdo = connectBDD();
$leLogin = $_SESSION['login'];
$sql = "select matricule
from utilisateur
where login ='$leLogin'";
$stmt = $pdo->query($sql);
$utilisateur = $stmt->fetch();
$idVisiteur = $utilisateur->matricule;

$estInscript = getNBFoisInscrits($id, $idVisiteur);
$nbDeFoisInscrits = $estInscript->nbFoisParticipation;



if (count($_POST) > 0) {
    include_once("../includes/inc-valid-inscription-saisir.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/fontawesome-5.10.2-free/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Inscription à une formation</title>
</head>
<header id="header-small">
    <?php include_once("../includes/inc-header.php"); ?>
</header>

<body>
    <h1 class="text-center mt-3"><?php print $intitule ?></h1>


    <p id="infosFomrations" class="text-center mt-3"><?php print $duree ?> jours à partir du <?php print $dateDebut ?></p>
    <p id="infosFomrations" class="text-center mt-3">Lieu de la formation : <?php print $lieu ?></p>
    <p id="infosFomrations" class="text-center mt-3">Organisateur : <?php print $organisateur ?></p>
    <p id="infosFomrations" class="text-center mt-3">Type de formation : <?php print $libelleFormation ?></p>
    <p id="infosFomrations" class="text-center mt-3">Secteur de formation : <?php print $secteur ?></p>
    <p id="infosFomrations" class="text-center mt-3">Nombre de places restantes : <?php print $placeRestants ?></p>



    <form id="boutonFormation" class="text-center" action="../includes/inc-valid-inscription-saisir.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="idVisiteur" value="<?php echo $idVisiteur; ?>">
        <input type="hidden" name="statut" value="<?php echo $statut; ?>">
        <input type="hidden" name="date_inscription" value="<?php echo $date_inscription; ?>">

        <?php
        if ($nbDeFoisInscrits > 0) {
            echo '        <p id="infosFomrations"class="text-danger text-center mt-3">Vous êtes déjà inscrit à cette formation</p>';
        } else {
            if ($placeRestants > 0) {
                echo "        <button type='submit' class='btn btn-primary btn-lg mt-3'>S'inscrire</button>";
            } else {
                echo '        <p id="infosFomrations"class="text-danger text-center mt-3">Plus de places disponibles</p>';
            }
        }

        ?>
    </form>

    <?php include_once("../includes/inc-footer.html"); ?>

</body>
<script src="../vendor/jquery-3.5.1/jquery-3.5.1.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

</html>