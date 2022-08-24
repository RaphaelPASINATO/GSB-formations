<?php

/**
 * getPlaceOccupe
 * Retourne le nombre de place validé pour une formation
 * 
 * @param int $id
 * 
 * @return mixed objet contenant le nombre d'inscrits  ou false
 */
function getPlaceOccupe($id)
{
    $pdo = connectBDD();

    $leNBPlaceOccupe = false;

    $sql='select COUNT(id_formation) as "nbOccupe"
        from inscription
        where  statut = "acceptée" and inscription.id_formation =:id';
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $leNBPlaceOccupe = $stmt->fetch();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        header('Content-Type: text/html; charset=latin-1');
        die ("Erreur getPlaceOccupe : " . $e->getMessage(). " - Ligne " . $e->getLine());
    }

    unset($pdo);

    return $leNBPlaceOccupe;
}
