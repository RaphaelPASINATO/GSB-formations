<?php

/**
 * getLesInscriptionsAvecCriteres
 * Retourne sous forme d'un tableau d'objets la liste des inscriptions
 * répondant aux critères fournis
 *
 * @param mixed $idStatut id du statut ou false ou null
 * @param mixed $filtreMatricule un matricule de visiteur pour sélection inscription ou false ou null
 * @param mixed $idOrganisateur id de l'organisateur
 * @param mixed $idFormation d'une formation
 *
 * @return array tableau d'inscriptions
 */
function getLesInscriptionsAvecCriteres(
    $idStatut,
    $filtreMatricule,
    $idOrganisateur,
    $idFormation
) {
    $pdo = connectBDD();
    $lesInscriptions = [];
    $param = [];
    $sql = "SELECT DISTINCT inscription.*,formation.intitule as 'nomFormation',organisateur.nom as 'nomOrganisateur'
from inscription
JOIN formation on formation.id = inscription.id_formation
JOIN organisateur on organisateur.id = formation.id_organisateur";
    $clause = " where ";
    if (!empty($idStatut)) {
        $sql .= "$clause statut = :idStatut";
        $clause = " and ";
        $param[':idStatut'] = $idStatut;
    }
    if (!empty($filtreMatricule)) {
        $sql .= "$clause matricule_visiteur = :filtreMatricule";
        $clause = " and ";
        $param[':filtreMatricule'] = $filtreMatricule;
    }
    if (!empty($idFormation)) {
        $sql .= "$clause id_formation = :idFormation";
        $clause = " and ";
        $param[':idFormation'] = $idFormation;
    }
    if (!empty($idOrganisateur)) {
        $sql .= "$clause id_organisateur = :idOrganisateur";
        $clause = " and ";
        $param[':idOrganisateur'] = $idOrganisateur;
    }
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($param);
        $lesInscriptions = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        header('Content-Type: text/html; charset=latin-1');
        die("Erreur getLesInscriptionsAvecCriteres : " . $e->getMessage() .
            " - Ligne " . $e->getLine());
    }
    unset($pdo);
    return $lesInscriptions;
}
