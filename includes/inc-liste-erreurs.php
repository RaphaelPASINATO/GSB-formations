<?php
/** 
 * Fournit les messages d'erreurs sous forme d'une liste à puces HTML.                    
 * 
 * Retourne une liste à puces HTML, d'après les messages d'erreurs contenus 
 * dans le tableau des messages d'erreurs $tabErr. 
 * @param array $tabErr  Tableau des messages d'erreurs  
 * @return string        Source html
 */
function getListeErreurs($tabErr)
{
    $str = '<ul class="erreur">';
    foreach ($tabErr as $erreur) {
        $str .= '<li>' . $erreur . '</li>';
    }
    $str .= '</ul>';
    return $str;
}
