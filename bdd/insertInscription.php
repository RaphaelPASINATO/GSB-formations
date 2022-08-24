<?php
/**
* insertInscription
* Ajoute une nouvelle session dans la base de données
*
* @param int $id_formation le numero correspondant à la formation
* @param string $matricule_visiteur le numero correspondant au visiteur
* @param string $statut un string contenant le statut de l'inscription
* @param string $date_inscription un string contenant la date de l'inscription
*
* @return mixed identifiant de la formation ajouté, ou false en cas d'erreur
*/
function insertInscription($id_formation, $matricule_visiteur, $statut, $date_inscription) {
    $pdo = connectBDD();
    $ret = false;
    $sql ="insert into inscription (id_formation,matricule_visiteur, statut, date_inscription) values(:id_formation, :matricule_visiteur, :statut, :date_inscription)";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id_formation', $id_formation);
            $stmt->bindParam(':matricule_visiteur', $matricule_visiteur);
            $stmt->bindParam(':statut', $statut);
            $stmt->bindParam(':date_inscription', $date_inscription);
            $pdo->beginTransaction();
            if ($stmt->execute()) {
            $ret = $pdo->lastInsertId();
            }
            $pdo->commit();
            } catch (PDOException $e) {
            if ($pdo) {
            $pdo->rollBack();
            }
        } catch (PDOException $e) {
            header('Content-Type: text/html; charset=latin-1');
            die("Erreur insertInscription : " . $e->getMessage() . " - Ligne " . $e->getLine());
        }
    unset($pdo);
    return $ret;        
}
?>