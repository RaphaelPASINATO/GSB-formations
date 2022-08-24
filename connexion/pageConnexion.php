<?php
include_once("../includes/inc-liste-erreurs.php");
include_once("../bdd/connectBDD.php");
include_once("../bdd/getInfosUtilsateur.php");
include_once("../includes/inc-valid-connexion.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/fontawesome-5.10.2-free/css/all.min.css">
    <link rel="stylesheet" href="../css/styleConnexionInscription.css">
    <title>Page de connexion</title>
</head>

<body id="couleurFond">
    <main class="container py-5">
        <h1 class="text-light text-center p-3">Bienvenue sur GSB Formations ! </h1>
        <h3 class="text-light text-center p-4">Pour accéder à vos fonctionnalités, merci de vous connecter.</h3>
        <h1 id="titreCo" class="text-light text-center p-2">Connexion</h1>
        <b class="text-light">
            <?php
            if (count($_POST) > 0) {
                if (count($erreurs) != 0) {
                    echo getListeErreurs($erreurs);
                } else {
                    if (empty($info) == false) {
                        echo $info;
                    }
                }
            }
            ?>
        </b>

        <form id="couleutext" class="text-center" action="" method="post" autocomplete="off" novalidate>
            <label><b class="text-light">Nom d'utilisateur</b></label>
            <input type="text" placeholder="Entrer le nom d'utilisateur" name="login" required>

            <label><b class="text-light">Mot de passe</b></label>
            <input type="password" placeholder="Entrer le mot de passe" name="password" required>
            <br>
            <button type="submit" class="btn btn-primary btn-lg mt-3">Se connecter</button>
            <!--<input type="submit" id='submit' value='LOGIN'>-->
        </form>
    </main>
    <?php include_once("../includes/inc-footer.html"); ?>

</body>
<script src="../vendor/jquery-3.5.1/jquery-3.5.1.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

</html>