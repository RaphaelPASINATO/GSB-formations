<?php
session_start();
if (isset($_SESSION['login']) == false) {
    header("Location:connexion/pageConnexion.php");
    exit;
}
include_once("../bdd/connectBDD.php");
include_once("../bdd/getLesAnnulations.php");
include_once("../bdd/getNombreAnnulationRefus.php");
include_once("../bdd/getNombreAnnulationValid.php");
$lesAnnulations = getLesAnnulations();
$lesAnnulationsRefuses = getNombreAnnulationRefus();
$lesAnnulationsValides = getNombreAnnulationValid();

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
    <title>Gérer les annulations</title>
</head>
<header id="header-small">
    <?php include_once("../includes/inc-header.php"); ?>
</header>

<body>
    <main class="container py-5">
        <h1 class="text-center mt-3">Gérer les annulations en attente</h1>
        <h3 class="m-5">Nombre d'annulations refusées depuis le début de l'année : <?php echo $lesAnnulationsRefuses->nbRefus; ?><br>
        Nombre d'annulations acceptées depuis le début de l'année : <?php echo $lesAnnulationsValides->nbvalid; ?></h3>


        <div>
            <table class="table table-hover m-5">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Matricule</th>
                        <th>Intitule</th>
                        <th>Date de formation</th>
                        <th>Date d'annulation</th>
                        <th>Objet d'annulation</th>
                        <th>Statut</th>
                        <th>Gérer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $idAnnulation = 1;
                    foreach ($lesAnnulations as $annulation) {
                        echo "<tr>";
                        echo '<td>' . $idAnnulation . '</td>';
                        $idRefuser = $idAnnulation;
                        echo '<td>' . htmlspecialchars($annulation->matricule_visiteur) . '</td>';
                        echo '<td>' . htmlspecialchars($annulation->intitule) . '</td>';
                        echo '<td>' . htmlspecialchars($annulation->date_debut) . '</td>';
                        echo '<td>' . htmlspecialchars($annulation->date_annulation) . '</td>';
                        echo '<td>' . htmlspecialchars($annulation->objet_annulation) . '</td>';
                        echo '<td>' . htmlspecialchars($annulation->statut) . '</td>';
                        echo '<td><a href="#" data-id="' . $idAnnulation .
                            '" class="openDialog" data-toggle="modal"
                            data-target="#ValiderAnnulationModal" title="Gérer"><i class="fas fa-check"></i></a></td>';
                        echo "</tr>";

                        $idAnnulation++;
                    }
                    ?>

                </tbody>

            </table>
        </div>
    </main>
    <div class="modal fade" id="ValiderAnnulationModal" role="dialog" aria-labelledby="ValiderAnnulationModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ValiderAnnulationModal">Vous gérer la demande d'annulation N°<span id="idAnnulation"></span></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"> Etes-vous certain de gérer cette annulation ? </div>
                <form id="form-gerer" action='../includes/inc-valid-modifier-gerer-annulation.php' method='post' novalidate>
                    <div class="form-group my-4">
                        <label for="Valider" class="mr-2">Valider</label>
                        <input type="radio" id="StatutValide" name="StatutValide" value="4" required checked>
                        <label for="Refuser" class="ml-3 mr-2">Refuser </label>
                        <input type="radio" id="StatutRefuse" name="StatutValide" value="5" required>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" name="idVisiteur" value="<?php $idAnnulation; ?>">
                        <button class="btn btn-light" type="button" data-dismiss="modal">Annuler</button>
                        <!-- A T T E N T I O N   N E C E S S I T E   J A V A S C R I P T   S U R   B O U T O N   S U B M I T -->
                        <button class="btn btn-primary" type="button" onclick="document.getElementById('form-gerer').submit();" data-dismiss="modal">Confirmer</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    <?php include_once("../includes/inc-footer.html"); ?>


</body>
<script src="../vendor/jquery-3.5.1/jquery-3.5.1.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script>
    $(function() {
        $(".openDialog").click(function() {
            var idAnnulation = $(this).data('id');
            $('#id').val(idAnnulation);
            $("#idAnnulation").empty().html(idAnnulation);
        });
    });
</script>

</html>