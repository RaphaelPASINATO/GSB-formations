<?php

/**
 * getNombreAnnulationRefus
 * Retourne le nombre d'annulations refusées depuis le début de l'année courante
 */
function getNombreAnnulationRefus()
{
    //SELECT COUNT(*)
    //FROM inscription
    //WHERE year(date_inscription) = 2020 and statut = 5
    $pdo = connectBDD();

    $lesRefus = false;
    $sql="select COUNT(*) as 'nbRefus'
        from inscription
        WHERE year(date_inscription) = year(now()) and statut = 5";
        try {
            $stmt = $pdo->query($sql);
            $lesRefus = $stmt->fetch();
            $stmt->closeCursor();
        } catch (PDOException $e) {
            header('Content-Type: text/html; charset=latin-1');
            die("Erreur getNombreAnnulationRefus : " . $e->getMessage() .
                " - Ligne " . $e->getLine());
        }
        unset($pdo);
        return $lesRefus;
    }
    