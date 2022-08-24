<?php
session_start();
if (isset($_SESSION['login']) == false) {
    header("Location:connexion/pageConnexion.php");
    exit;
}
include_once("../bdd/connectBDD.php");
include_once("../bdd/getLesFormations.php");
include_once("../bdd/getMoyenneFormationSuivi.php");
include_once("../bdd/getNombreInscrition.php");
$lesFormations = getLesFormations();
$Moyenne = geMoyenneFormationSuivi();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/fontawesome-5.10.2-free/css/all.min.css">
    <link rel="stylesheet" href="../css/formations.php">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Liste formations</title>
</head>
<header id="header-small">
    <?php include_once("../includes/inc-header.php"); ?>
</header>

<body>
    <script src="../vendor/jquery-3.5.1/jquery-3.5.1.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <div id="wrapper">
        <?php include_once("../includes/inc-sidebar.php"); ?>
        
        <div id="content-wrapper">

            <div class="container-fluid">

                <h2 class="text-center p-3"> <strong>Liste des formations</strong></h2>
                <h3 class="m-5">Nombre moyen de jours de formation suivi par les visiteurs depuis le début de de l'année : <?php echo $Moyenne->moyennejoursFormation; ?></h3>
                <div class="table-responsive my-5">
                    <table class="table table-hover m-5">
                        <thead>
                            <tr>
                                <th scope="col">N°</th>
                                <th>Intitulé</th>
                                <th>Date début</th>
                                <th>Durée</th>
                                <th>Lieu</th>
                                <th>Nombre places</th>
                                <th>Nombre d'inscriptions</th>
                                <th>Organisateur</th>
                                <th>Type</th>
                                <th>Secteur</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach ($lesFormations as $formation){
                                echo "<tr>";
                                echo "<td>$formation->id</td>";
                                echo '<td>' . htmlspecialchars($formation->intitule) . '</td>';
                                echo '<td>' . htmlspecialchars($formation->date_debut) . '</td>';
                                
                                echo"<td>$formation->duree</td>";
                                echo '<td>' . htmlspecialchars($formation->lieu) . '</td>';
                                echo"<td>$formation->nombre_places</td>";
                                $nbinscrits = getNombreInscription($formation->id);
                                echo '<td>' . htmlspecialchars($nbinscrits->nbInscrit) . '</td>';
                                echo '<td>' . htmlspecialchars($formation->nomOrganisateur) . '</td>';
                                echo '<td>' . htmlspecialchars($formation->libelleTypeFormation) . '</td>';
                                echo '<td>' . htmlspecialchars($formation->secteurFormation) . '</td>';                               
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php include_once("../includes/inc-footer.html"); ?>

</body>



</html>