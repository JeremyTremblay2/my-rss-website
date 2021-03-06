<?php
/** Name : config.php
 * Project : My RSS website
 * Usefulness : contains the global variables and constants of the website.
 * Last Modification date : 29/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

// The local folder
$localPath = __DIR__ . '/../';

// Database configuration
$login = 'login';
$password = 'mdp';
$databaseName = "project";
$dsn = 'mysql:dbname=' . $databaseName . ';host=localhost';

// Files and views
$views['index'] = '';
$views['error'] = 'views/error.php';
$views['news'] = 'views/newsList.php';
$views['auth'] = 'views/login.php';
$views['admin'] = 'views/admin.php';