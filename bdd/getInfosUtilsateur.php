<?php
/**
* getInfosUtilisateur
* Récupère les informations d’un utilisateur authentifié
*
* @param string $login
* @param string $pass
*
* @return mixed l'utilisateur si l'authentification a réussi, null dans le cas contraire
*/
function getInfosUtilisateur($login, $pass)
{
$pdo = connectBDD();
$utilisateur = null;
try {
$sql = "select utilisateur.id_role as profil, utilisateur.login, utilisateur.mdp,utilisateur.matricule
from utilisateur
where login=:login";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':login', $login);
$stmt->execute();
$data = $stmt->fetch();
if ($data !== false) {
    if (password_verify($pass, $data->mdp)) {
        $utilisateur = $data;
    }
}
$stmt->closeCursor();
} catch (PDOException $e) {
header('Content-Type: text/html; charset=latin-1');
die("Erreur getInfosUtilisateur : " . $e->getMessage() . " - Ligne " .
 $e->getLine());
}
unset($pdo);
return $utilisateur ;
}
