<?php
/** Name : config.php
 * Project : My RSS website
 * Usefulness : contains the global variables and constants of the website.
 * Last Modification date : 17/11/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

// The local folder
$localPath = __DIR__ . '/../';

// Database configuration
$login = 'root';
$password = '';
$databaseName = "db" . $login;
$dsn = 'mysql:host=local;dbname=' . $databaseName;

// Files and views
$parser['parser'] = 'parser/parser.php';
$views['error'] = 'views/error.php';
$views['auth'] = 'views/auth.php';
$views['autherror'] = 'views/autherror.php';
?>