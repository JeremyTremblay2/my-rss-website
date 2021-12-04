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
$databaseName = "project";
$dsn = 'mysql:dbname=' . $databaseName . ';host=localhost';
// Files and views
$views['index'] = 'index.php';
$views['error'] = 'views/error.php';
$views['news'] = 'views/newsList.php';
$views['auth'] = 'views/connection.php';
$views['admin'] = 'views/admin.php';
$parser['parser'] = 'parser/parsgger.php';

//Global variables
$numberOfPages = 1;
