<?php

/** Name : Constants.php
 * Project : My RSS website
 * Usefulness : create constants usable into all of classes.
 * Last Modification date : 29/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */


class Constants {
    const GLOBAL_ERROR = 'Erreur durant la validation du champ';
    const INCORRECT_ERROR = 'Chaine de caractères non valide dans le champ';
    const EMPTY_ERROR = 'Veuillez renseigner le champ';
    const INJECTION_ERROR = 'Tentative d\'injection de code déjouée sur le champ';
    const PDO_ERROR = 'Erreur innatendue lors de l\'accès à la base de données.';
    const GENERAL_ERROR = 'Erreur innatendue dans le traitement de votre requête. Informations complémentaires :';
    const CONNECTION_ERROR = 'Le couple nom d\'utilisateur / mot de passe est incorrect.';
    const NOT_A_VALID_NUMBER_ERROR = 'Veuillez entrer un nombre valide de news par page.';
    const PARSE_ERROR = 'Impossible de parser le flux RSS, il est incorrect ou non-reconnu.';
    const ERROR_RSS_FEED_ALREADY_EXISTS = 'Ce flux RSS est déjà présent en base de données';
    const DEFAULT_NUMBER_OF_NEWS = 12;
}