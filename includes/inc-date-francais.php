<?php
/**
 * Transforme une date au format anglais aaaa-mm-jj vers le format français jj mmm. aaaa
 *
 * @param date $uneDate Date au format  aaaa-mm-jj
 * @return string       La date au format français jj mmm. aaaa
 */
function dateAnglaisVersFrancais($uneDate)
{
    $lesMois = ['Janv.', 'Févr.', 'Mars', 'Avr.', 'Mai', 'Juin', 'Juill.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'];
    @list($annee, $mois, $jour) = explode('-', $uneDate);
    return $jour . ' ' . $lesMois[$mois - 1] . ' ' . $annee;
}

?>