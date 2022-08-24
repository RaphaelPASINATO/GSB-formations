<?php

/**
 * updateDemandeAnnulationConfirmation
 * Sert a changer le statut d'une demande d'inscription.
 *
 * @param int  $idFormation nombre identifiant de l'inscription
 * @param int $valide sert à changer le statut de la demande
 * @param string  $idvisiteur matricule identifiant du visiteur
 *
 * @return bool true si la requête s'est exécutée correctement, false sinon
 */
function updateDemandeAnnulationConfirmation($idFormation, $valide,$idvisiteur)
{
    $pdo = connectBDD();
    $ret = false;
    $sql = "UPDATE  inscription
            set statut =:valide
            where matricule_visiteur = :idvisiteur and id_formation = :idFormation";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([
            ':valide' => $valide,
            ':idFormation' => $idFormation,
            ':idvisiteur' => $idvisiteur,
        ]);
    } catch (PDOException $e) {
        header('Content-Type: text/html; charset=latin-1');
        die("Erreur updateDemandeAnnulationConfirmation : " . $e->getMessage() . " - Ligne " . $e->getLine());
    }
    unset($pdo);
    return $ret;
}