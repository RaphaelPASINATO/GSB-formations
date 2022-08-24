<?php
session_start();
if (isset($_SESSION['login']) == false) {
    header("Location:connexion/pageConnexion.php");
    exit;
}
include_once("../bdd/connectBDD.php");
include_once("../bdd/getLesFormations.php");
$lesFormations = getLesFormations();
include_once("../bdd/getPlaceOccupe.php");
include_once("../includes/inc-date-francais.php");

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/fontawesome-5.10.2-free/css/all.min.css">
    <link rel="stylesheet" href="../css/styles.css">

    <title>Inscription à une formation</title>
    <header id="header-small">
        <?php include_once("../includes/inc-header.php"); ?>
    </header>

</head>

<body>
    <main class="container py-5">
        <h1 class="text-primary text-center">Bienvenue ! </h1>
        <div>
            <table class="table table-hover m-5">
                <thead>
                    <tr>
                        <th scope="col">N°</th>
                        <th>Intitule</th>
                        <th>Date de début</th>
                        <th>Durée</th>
                        <th>Lieu</th>
                        <th>Nombre de places disponibles</th>
                        <th>Organisateur</th>
                        <th>Type de formation</th>
                        <th>Secteur de formation</th>
                        <th>s'inscrire</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lesFormations as $formation) {
                        echo "<tr>";
                        echo "<td>$formation->id</td>";
                        echo '<td>' . htmlspecialchars($formation->intitule) . '</td>';
                        $dateDebut =dateAnglaisVersFrancais($formation->date_debut);
                        echo '<td>' . htmlspecialchars($dateDebut) . '</td>';

                        echo "<td>$formation->duree</td>";
                        echo '<td>' . htmlspecialchars($formation->lieu) . '</td>';
                        $nb = getPlaceOccupe($formation->id);
                        $nbOccupe = $nb->nbOccupe;
                        $nbDispo = $formation->nombre_places;
                        $placeRestants = $nbDispo - $nbOccupe;
                        echo "<td>$placeRestants</td>";
                        echo '<td>' . htmlspecialchars($formation->nomOrganisateur) . '</td>';
                        echo '<td>' . htmlspecialchars($formation->libelleTypeFormation) . '</td>';
                        echo '<td>' . htmlspecialchars($formation->secteurFormation) . '</td>';
                        //echo '<td class="text-center"> <i id="valideInscription"class="fa fa-check"></i> </td>';
                        echo'<td > <a class="nav-link" href="inscription-saisir.php?id='. $formation->id .'"';
                        echo'"><i id="valideInscription" class="fa fa-check"></i></a></td>';
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>


    </main>


    <?php include_once("../includes/inc-footer.html"); ?>

</body>
<script src="../vendor/jquery-3.5.1/jquery-3.5.1.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

</html>