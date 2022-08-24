<?php

/**
 * getUneFormation
 * Retourne sous forme d'un objet les informations de la formation dont
 * l'identifiant est passé en paramètre
 * @return array tableau d'objets
 */
function getUneFormation($id)
{
    $pdo = connectBDD();
    $laFormation = false;
    $sql = "select formation.*, organisateur.nom  as nomOrganisateur, typeformation.libelle as libelleTypeFormation, secteurformation.libelle as secteurFormation
    FROM formation
    JOIN organisateur on organisateur.id = formation.id_organisateur
    JOIN typeformation on typeformation.id = formation.id_type_formation
    JOIN secteurformation on secteurformation.id = formation.id_secteur_formation
    where formation.id =:id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $laFormation = $stmt->fetch();
        $stmt->closeCursor();
    } catch (PDOException $e) {
        header('Content-Type: text/html; charset=latin-1');
        die("Erreur getUneFormation : " . $e->getMessage() .
            " - Ligne " . $e->getLine());
    }
    unset($pdo);
    return $laFormation;
}
