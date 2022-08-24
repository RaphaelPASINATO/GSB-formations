<?php

/**
 * getLesOrganisateurs
 * Retourne sous forme d'un tableau d'objets les organisateurs des formations
 *
 * @return array tableau d'objets
 */
function getLesOrganisateurs()
{
    $pdo = connectBDD();
    $lesOrganisateurs = [];
    $sql = "SELECT *
FROM organisateur";
    try {
        $stmt = $pdo->query($sql);
        $lesOrganisateurs = $stmt->fetchAll();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        header('Content-Type: text/html; charset=latin-1');
        die("Erreur getLesOrganisateurs : " . $e->getMessage() .
            " - Ligne " . $e->getLine());
    }
    unset($pdo);
    return $lesOrganisateurs;
}
