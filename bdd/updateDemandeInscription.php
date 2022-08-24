<?php

/**
 * updateDemandeInscription
 * Sert a changer le statut d'une demande d'inscription.
 *
 * @param int  $idFormation nombre identifiant de l'inscription
 * @param int $valide sert à changer le statut de la demande
 * @param string  $idvisiteur matricule identifiant du visiteur
 * @param string  $dateAnnulation date de l'annulation
 * @param string  $objet_annulation objet de l'annulation
 *
 * @return bool true si la requête s'est exécutée correctement, false sinon
 */
function updateDemandeInscription($idFormation, $valide,$idvisiteur,$dateAnnulation,$objet_annulation)
{
    ///UPDATE inscription
    ///set statut = 3
    ///WHERE matricule_visiteur ="b420"
    $pdo = connectBDD();
    $ret = false;
    $sql = "UPDATE  inscription
            set statut =:valide, date_annulation =:dateAnnulation, objet_annulation =:objet_annulation
            where matricule_visiteur = :idvisiteur and id_formation = :idFormation";
    $stmt = $pdo->prepare($sql);
    try {
        $stmt->execute([
            ':valide' => $valide,
            ':idFormation' => $idFormation,
            ':idvisiteur' => $idvisiteur,
            ':dateAnnulation' => $dateAnnulation,
            ':objet_annulation' => $objet_annulation
        ]);
    } catch (PDOException $e) {
        header('Content-Type: text/html; charset=latin-1');
        die("Erreur updateDemandeInscription : " . $e->getMessage() . " - Ligne " . $e->getLine());
    }
    unset($pdo);
    return $ret;
}
