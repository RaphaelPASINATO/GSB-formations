<?php

/**
 * getNombreInscription
 * Retourne le nombre de place validé pour une formation
 * 
 * @param int $id
 * 
 * @return mixed objet contenant le nombre d'inscrits  ou false
 */
function getNombreInscription($id)
{
    $pdo = connectBDD();

    $nbInscrit = false;

    $sql='select COUNT(id_formation) as "nbInscrit"
        from inscription
        where inscription.id_formation =:id';
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $nbInscrit = $stmt->fetch();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        header('Content-Type: text/html; charset=latin-1');
        die ("Erreur getNombreInscription : " . $e->getMessage(). " - Ligne " . $e->getLine());
    }

    unset($pdo);

    return $nbInscrit;
}
