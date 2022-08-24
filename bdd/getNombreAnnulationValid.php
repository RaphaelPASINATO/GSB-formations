<?php

/**
 * getNombreAnnulationValid
 * Retourne le nombre d'annulations validées  depuis le début de l'année courante
 */
function getNombreAnnulationValid()
{
    $pdo = connectBDD();

    $lesRefus = false;
    $sql="select COUNT(*) as 'nbvalid'
        from inscription
        WHERE year(date_inscription) = year(now()) and statut = 4";
        try {
            $stmt = $pdo->query($sql);
            $lesRefus = $stmt->fetch();
            $stmt->closeCursor();
        } catch (PDOException $e) {
            header('Content-Type: text/html; charset=latin-1');
            die("Erreur getNombreAnnulationValid : " . $e->getMessage() .
                " - Ligne " . $e->getLine());
        }
        unset($pdo);
        return $lesRefus;
    }
    