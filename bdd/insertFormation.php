<?php

// A continuer après le getLesFormations
function insertAtelier($intitule, $dateDebut, $duree, $lieu, $nbPlaces, $prixParPersonne, $idOrganisateur, $idType, $idSecteur) {
    $pdo = connectBDD();
    $ret = false;
    $sql = "insert into atelier (intitule, accroche, duree, nbPersonnesMin, 
            nbPersonnesMax, prixParPersonne, idCategorie, description) values (:intitule, :accroche,
            :duree, :nbPersonnesMin, :nbPersonnesMax, :prixParPersonne, :idCategorie, :description)";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':intitule', $intitule);
            $stmt->bindParam(':accroche', $accroche);
            $stmt->bindParam(':duree', $duree);
            $stmt->bindParam(':nbPersonnesMin', $nbPersonnesMin);
            $stmt->bindParam(':nbPersonnesMax', $nbPersonnesMax);
            $stmt->bindParam(':prixParPersonne', $prixParPersonne);
            $stmt->bindParam(':idCategorie', $idCategorie);
            $stmt->bindParam(':description', $description);
            // il faut démarrer une transaction
            $pdo->beginTransaction();
            if ($stmt->execute()) {
            $ret = $pdo->lastInsertId(); // récupère l’id
            }
            $pdo->commit(); // indispensable après un beginTransaction
            } catch (PDOException $e) {
            if ($pdo) {
            $pdo->rollBack(); // annule la transaction si problème
            }


        } catch (PDOException $e) {
            header('Content-Type: text/html; charset=latin-1');
            die("Erreur insertAtelier : " . $e->getMessage() . " - Ligne " . $e->getLine());
        }
    unset($pdo);
    return $ret;
}