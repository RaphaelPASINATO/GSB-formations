<?php

/**
 * getLesAnnulations
 * Retourne sous forme d'un tableau d'objets  les annulations
 *
 * @return array tableau d'objets
 */
function getLesAnnulations()
{
    $pdo = connectBDD();
    $lesFormations = [];
    $sql = "SELECT inscription.*, formation.intitule, formation.date_debut, formation.duree, formation.lieu
    FROM inscription
    JOIN formation on formation.id = inscription.id_formation
    JOIN secteurformation on secteurformation.id = formation.id_secteur_formation
    WHERE statut = 3";
    try {
        $stmt = $pdo->query($sql);
        $lesFormations = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        header('Content-Type: text/html; charset=latin-1');
        die("Erreur getLesAnnulations : " . $e->getMessage() .
            " - Ligne " . $e->getLine());
    }
    unset($pdo);
    return $lesFormations;
}
