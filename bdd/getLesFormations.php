<?php

/**
 * getLesFormations
 * Retourne sous forme d'un tableau d'objets  formations
 *
 * @return array tableau d'objets
 */
function getLesFormations()
{
    $pdo = connectBDD();
    $lesFormations = [];
    $sql = "SELECT formation.*, organisateur.nom  as nomOrganisateur, typeformation.libelle as libelleTypeFormation, secteurformation.libelle as secteurFormation
    FROM formation
    JOIN organisateur on organisateur.id = formation.id_organisateur
    JOIN typeformation on typeformation.id = formation.id_type_formation
    JOIN secteurformation on secteurformation.id = formation.id_secteur_formation";
    try {
        $stmt = $pdo->query($sql);
        $lesFormations = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        header('Content-Type: text/html; charset=latin-1');
        die("Erreur getLesFormations : " . $e->getMessage() .
            " - Ligne " . $e->getLine());
    }
    unset($pdo);
    return $lesFormations;
}
