
<?php
include_once("../bdd/connectBDD.php");
include_once("../bdd/getInfosUtilsateur.php");
$idRole=3;
$pdo = connectBDD();
$leLogin=$_SESSION['login'];
$sql="select id_role
from utilisateur
where login ='$leLogin'";
$stmt = $pdo->query($sql);
$utilisateur = $stmt->fetch();
$idRole = $utilisateur->id_role;
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#"><img class="w-25" alt="logogsb" src="../images/logo GSB.jpg"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
            <a class="nav-link" href="../index.php"><i class="fas fa-home"></i> Accueil</a>
        </li>
        <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="far fa-calendar-alt	"></i> Formations</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Gérer</a>
              
              <?php
              if ($idRole == 2) {
                
                echo ('<a class="dropdown-item" href="../inscriptions/inscription.php">Inscription</a>');
                echo ('<a class="dropdown-item" href="#">Mes formations</a>');
                echo ('<a class="dropdown-item" href="../annulations/demande-annulations.php">Demande annulation</a>');
              }
              ?>
              <?php
              if ($idRole== 1) {
                echo('<a class="dropdown-item" href="#">Ajouter</a>');
                echo('<a class="dropdown-item" href="../inscriptions/liste-inscriptions.php">Liste des inscriptions</a>');
                echo('<a class="dropdown-item" href="../annulations/gerer-annulations.php">Gérer annulations</a>');
              }
              ?>

              <!--<div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Separated link</a>-->
            </div>
        </li>
        <li class="nav-item dropdown active">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><i class="fas fa-chalkboard-teacher	"></i> Organisateur</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Ajouter</a>
              <a class="dropdown-item" href="#">Gérer</a>
              <!--<div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Separated link</a>-->
            </div>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="../connexion/deconnexion.php"><i class="fas fa-door-open	"></i> Déconnexion</a>
            
          </li>
      </ul>
    </div>
  </nav>