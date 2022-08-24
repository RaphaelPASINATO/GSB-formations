<!-- Sidebar -->
<ul class="sidebar navbar-nav bg-primary p-2">
    <li class="nav-item active">
        <a class="nav-link active" href="../formations/liste-formations.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Liste formations</span></a>
    </li>
    <li class="nav-item active">
        <a class="nav-link active" href="../formations/formations-saisir.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Ajout d'une formation </span></a>
    </li>
    <?php if ($_SESSION['profil'] == 'administrateur' ) { ?>
        <li class="nav-item">
        <a class="nav-link" href="../utilisateurs/index.php">
            <i class="fas fa-users-cog"></i>
            <span>Gestion utilisateurs</span></a>
        </li>
    <?php } ?>
</ul>