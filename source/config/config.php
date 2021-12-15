<?php
/** Name : config.php
 * Project : My RSS website
 * Usefulness : contains the global variables and constants of the website.
 * Last Modification date : 05/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

// The local folder
$localPath = __DIR__ . '/../';

// Database configuration
$login = 'jetremblay';
$password = 'achanger';
$databaseName = "dbjetremblay";
$dsn = 'mysql:dbname=' . $databaseName . ';host=localhost';
// Files and views
$views['index'] = '../index.php';
$views['error'] = 'views/error.php';
$views['news'] = 'views/newsList.php';
$views['auth'] = 'views/login.php';
$views['admin'] = 'views/admin.php';
