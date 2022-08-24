<?php

/**
 * getNBFoisInscrits
 * Retourne le nombre de fois qu'une personne est inscripit pour une formation
 * 
 * @param int $id
 * @param string $matricule
 * 
 * @return mixed objet retournant le nombre d'inscrpitions d'une personne ou false
 */
function getNBFoisInscrits($id, $matricule)
{
    $pdo = connectBDD();

    $leNbFoisParticipation = false;

    $sql = 'select COUNT(id_formation) as "nbFoisParticipation"
        from inscription
        where  inscription.matricule_visiteur =:matricule and inscription.id_formation =:id';
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':matricule', $matricule);
        $stmt->execute();
        $leNbFoisParticipation = $stmt->fetch();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        header('Content-Type: text/html; charset=latin-1');
        die("Erreur getNBFoisInscrits : " . $e->getMessage() . " - Ligne " . $e->getLine());
    }

    unset($pdo);

    return $leNbFoisParticipation;
}
