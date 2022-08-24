<?php

/**
 * getDemandesInscriptionsVisiteur
 * Retourne sous forme d'un tableau d'objets les informations sur les inscriptions
 *  
 * @param string $matriculeVisiteur
 *
 * @return array tableau d'objets
 */
function getDemandesInscriptionsVisiteur($matricule)
{
    $pdo = connectBDD();
    $lesDemandes = [];
    $sql = "SELECT inscription.*, formation.intitule, formation.date_debut, formation.duree, formation.lieu
    FROM inscription
    JOIN formation on formation.id = inscription.id_formation
    where inscription.matricule_visiteur =:matricule";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':matricule', $matricule);
        $stmt->execute();
        $lesDemandes = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        header('Content-Type: text/html; charset=latin-1');
        die("Erreur getDemandesInscriptionsVisiteur : " . $e->getMessage() .
            " - Ligne " . $e->getLine());
    }
    unset($pdo);
    return $lesDemandes;
}
