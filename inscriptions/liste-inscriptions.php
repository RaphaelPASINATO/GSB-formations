<?php
session_start();
if (isset($_SESSION['login']) == false) {
    header("Location:connexion/pageConnexion.php");
    exit;
}
include_once("../bdd/connectBDD.php");
include_once("../bdd/getLesOrganisateurs.php");
include_once("../bdd/getLesFormations.php");
$lesOrganisateurs = getLesOrganisateurs();
$lesFormations = getLesFormations();
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

    <title>Liste des inscriptions</title>
    <header id="header-small">
        <?php include_once("../includes/inc-header.php"); ?>
    </header>
</head>

<body>
    <h1 class="text-center mt-3">Liste des inscriptions pour les formations</h1>


    <div id="filtre-cours">
        <div class="mb-4 text-center">
            <a class="btn btn-primary" data-toggle="collapse" href="#criteres" role="button" aria-expanded="false" aria-controls="criteres">Filtrer</a>
        </div>
        <div id="criteres" class="collapse">
            <form action="" method="post">
                <div class="row">
                    <div class="col">
                        <label for="filtre-date-fin">Matricule visiteur</label>
                        <input type="input" class="form-control" id="filtre-matricule" name="filtreMatricule">
                    </div>
                    <div class="col">
                        <label for="filtre-categorie">Statut</label>
                        <select class="form-control" id="filtre-statut" name="idStatut">
                            <option value=''>--- Choisir ----</option>
                            <option value='1'>acceptée</option>
                            <option value='2'>en attente</option>
                            <option value='3'>annulation demandée</option>
                            <option value='4'>annulation acceptée</option>
                            <option value='5'>annulation refusée</option>


                        </select>
                    </div>
                    <div class="col">
                        <label for="filtre-categorie">Organisateur</label>
                        <select class="form-control" id="filtre-organisateur" name="idOrganisateur">
                            <option value=''>--- Choisir ----</option>
                            <?php
                            foreach ($lesOrganisateurs as $organisateur) {
                                if (isset($idOrganisateur) && $idOrganisateur == $organisateur->id) {
                                    echo "<option value='$organisateur->id'>" . htmlspecialchars($organisateur->nom) . "</option>";
                                } else {
                                    echo "<option value='$organisateur->id'>" . htmlspecialchars($organisateur->nom) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="filtre-categorie">Formation</label>
                        <select class="form-control" id="filtre-formation" name="idFormation">
                            <option value=''>--- Choisir ----</option>
                            <?php
                            foreach ($lesFormations as $formation) {
                                if (isset($idFormation) && $idFormation == $formation->id) {
                                    echo "<option value='$formation->id'>" . htmlspecialchars($formation->intitule) . "</option>";
                                } else {
                                    echo "<option value='$formation->id'>" . htmlspecialchars($formation->intitule) . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

            </form>

        </div>
    </div>
    <div id="liste-inscriptions">
        
    </div>



    <?php include_once("../includes/inc-footer.html"); ?>

</body>
<script src="../vendor/jquery-3.5.1/jquery-3.5.1.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../js/liste-inscriptions.js"></script>


</html>