<?php

session_start();
if (isset($_SESSION['login']) == false) {
  header("Location:connexion/pageConnexion.php");
  exit;
}
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
  <title>ACCUEIL</title>
</head>
<header id="header-small">
  <?php include_once("../includes/inc-header.php"); ?>
</header>

<body>
  <h1 class="text-center">test</h1>

  <?php include_once("../includes/inc-footer.html"); ?>

</body>
<script src="../vendor/jquery-3.5.1/jquery-3.5.1.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>


</html>