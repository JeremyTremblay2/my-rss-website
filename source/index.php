<?php
/** Name : index.php
* Project : My RSS website
* Usefulness : Main page of the website.
* Last Modification date : 05/12/2021
* Authors : Maxime GRANET, Jérémy TREMBLAY
*/

session_start();

require_once(__DIR__ . '/config/config.php');
require_once(__DIR__.'/config/Autoload.php');
Autoload::charger();

require_once('controllers/FrontController.php');

new FrontController();
?>