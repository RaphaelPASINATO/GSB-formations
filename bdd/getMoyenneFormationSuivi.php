<?php

/**
 * geMoyenneFormationSuivi
 * Retourne le nombre moyen de jours de formation suivi
 * par les visiteurs médicaux depuis le début de l'année
 * calendaire
 */
function geMoyenneFormationSuivi()
{
    $pdo = connectBDD();

    $laMoyenne = false;
    $sql="SELECT AVG(duree) as 'moyennejoursFormation'
        from inscription
        JOIN formation on formation.id = inscription.id_formation
        WHERE YEAR(date_debut) = year(now()) and date_debut <= now()";
        try {
            $stmt = $pdo->query($sql);
            $laMoyenne = $stmt->fetch();
            $stmt->closeCursor();
        } catch (PDOException $e) {
            header('Content-Type: text/html; charset=latin-1');
            die("Erreur geMoyenneFormationSuivi : " . $e->getMessage() .
                " - Ligne " . $e->getLine());
        }
        unset($pdo);
        return $laMoyenne;
    }
    