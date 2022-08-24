<?php
$mdp = '123';
$hash = password_hash($mdp, PASSWORD_DEFAULT);
echo ('mot de passe crypté : ' . $hash);
