<?php
session_start();
if (isset($_SESSION['login']) == false) {
    header("Location:connexion/pageConnexion.php");
    exit;
}
include_once("../bdd/connectBDD.php");
include_once("../bdd/getDemandesInscriptionsVisiteur.php");

$idVisiteur = " ";
$pdo = connectBDD();
$leLogin = $_SESSION['login'];
$sql = "select matricule
from utilisateur
where login ='$leLogin'";
$stmt = $pdo->query($sql);
$utilisateur = $stmt->fetch();
$idVisiteur = $utilisateur->matricule;

$lesDemandes = getDemandesInscriptionsVisiteur($idVisiteur);



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
    <title>Demande d'annulation</title>
</head>
<header id="header-small">
    <?php include_once("../includes/inc-header.php"); ?>
</header>

<body>
    <main class="container py-5">
        <h1 class="text-center mt-3">Vos formations</h1>

        <div>
            <table class="table table-hover m-5">
                <thead>
                    <tr>
                        <th>Intitule</th>
                        <th>Date de début</th>
                        <th>Durée</th>
                        <th>Lieu</th>
                        <th>Statut de l'inscription</th>
                        <th>Date de l'inscription</th>
                        <th>Annuler </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($lesDemandes as $demande) {
                        echo "<tr>";
                        echo '<td>' . htmlspecialchars($demande->intitule) . '</td>';
                        echo '<td>' . htmlspecialchars($demande->date_debut) . '</td>';
                        echo '<td>' . htmlspecialchars($demande->duree) . '</td>';
                        echo '<td>' . htmlspecialchars($demande->lieu) . '</td>';
                        echo '<td>' . htmlspecialchars($demande->statut) . '</td>';
                        echo '<td>' . htmlspecialchars($demande->date_inscription) . '</td>';
                        //echo '<td> annuler </td>';
                        $leStatut = $demande->statut;
                        if ($leStatut == "annulation demandée" || $leStatut == "annulation acceptée" || $leStatut == "annulation refusée") {
                            echo '<td>annulation demandée</td>';
                        } else {
                            echo '<td><a href="#" data-id="' . $demande->id_formation . '" class="openDialog" data-toggle="modal"
                            data-target="#AnnulationFormationModal" title="Annuler"><i class="far fa-times-circle"></i></a></td>';
                        }

                        //echo '<td>' . htmlspecialchars($demande->id_formation) . '</td>';
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <div class="modal fade" id="AnnulationFormationModal" role="dialog" aria-labelledby="AnnulationFormationModaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AnnulationFormationModaLabel">Voulez vous demander une annulation de votre inscription à cette formation</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"> Votre motif d'annulation </div>
                <form id="form-demande" action='../includes/inc-valid-modifier-annulation-formations.php' method='post' novalidate>
                    <div class="form-group mx-3">
                        <label for="motif"></label>
                        <input type="motif" class="form-control" id="motif" name="motif" value="<?php if (isset($motif)) {
                                                                                                    echo htmlspecialchars($motif);
                                                                                                } ?>" required>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" name="idVisiteur" value="<?php echo $idVisiteur; ?>">
                        <button class="btn btn-light" type="button" data-dismiss="modal">Annuler</button>
                        <!-- A T T E N T I O N   N E C E S S I T E   J A V A S C R I P T   S U R   B O U T O N   S U B M I T -->
                        <button class="btn btn-primary" type="button" onclick="document.getElementById('form-demande').submit();" data-dismiss="modal">Confirmer</button>
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
            var idFormation = $(this).data('id');
            $('#id').val(idFormation);
            $("#idFormation").empty().html(idFormation);
        });
    });
</script>

</html>