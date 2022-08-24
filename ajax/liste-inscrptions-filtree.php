<?php
include_once(__DIR__ . "/../vendor/phpmarkdown-1.9.0/MarkdownInterface.php");
include_once(__DIR__ . "/../vendor/phpmarkdown-1.9.0/Markdown.php");
include_once(__DIR__ . "/../bdd/connectBDD.php");
include_once(__DIR__ . "/../bdd/getLesInscriptionsAvecCriteres.php");

$filtreMatricule = filter_input(INPUT_POST, 'filtreMatricule', FILTER_DEFAULT);
$idStatut = filter_input(INPUT_POST, 'idStatut', FILTER_VALIDATE_INT);
$idOrganisateur = filter_input(INPUT_POST, 'idOrganisateur', FILTER_VALIDATE_INT);
$idFormation = filter_input(INPUT_POST, 'idFormation', FILTER_VALIDATE_INT);

$lesInscrpitions = getLesInscriptionsAvecCriteres(
    $idStatut,
    $filtreMatricule,
    $idOrganisateur,
    $idFormation
);
?>
<div class="container py-5">
    <table class="table table-hover m-5">
        <thead>
            <tr>
                <th>Matricule</th>
                <th>date d'inscription</th>
                <th>statut demande</th>
                <th>formation</th>
                <th>organisateur</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($lesInscrpitions as $inscription) {
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($inscription->matricule_visiteur); ?></td>
                    <td><?php echo htmlspecialchars($inscription->date_inscription); ?></td>
                    <td><?php echo htmlspecialchars($inscription->statut); ?></td>
                    <td><?php echo htmlspecialchars($inscription->nomFormation); ?></td>
                    <td><?php echo htmlspecialchars($inscription->nomOrganisateur); ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>

    </table>
</div>