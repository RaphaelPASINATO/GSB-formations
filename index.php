<?php
  session_start();
  if (isset($_SESSION['login']) == false) {
    header("Location:connexion/pageConnexion.php");
exit;
}
  header('Location: accueil/index.php');
  exit();
?>