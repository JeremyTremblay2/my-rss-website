<?php
/** Name : index.php
* Project : My RSS website
* Usefulness : Main page of the website.
* Last Modification date : 17/11/2021
* Authors : Maxime GRANET, Jérémy TREMBLAY
*/

require_once(__DIR__ . '/config/config.php');
require_once("controllers/UserController.php");
$ctrl = new UserController();
?>