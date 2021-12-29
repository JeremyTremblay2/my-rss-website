<?php

/**
 * Name : FrontController.php
 * Project : My RSS website
 * Usefulness : contains a FrontController class, manages the controls into all of the website.
 * Last Modification date : 29/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */


class FrontController {

    /**
     * select the good controler in function of the action
     */
    public function __construct() {
        global $localPath, $views;

        $adminModel = new AdminModel();
        $admin = $adminModel->isAdmin();
        $actions = array(
            'User' => array(
                null,
                'home',
                'connection',
                'connectionClick'
            ),
            'Admin' => array(
                'homeAdmin',
                'changeNumberOfNews',
                'addRssFeed',
                'deleteRssFeed',
                'refreshRssFeed',
                'disconnection'
            )
        );

        try{
            $action = $_REQUEST['action'] ?? null;
            if ($action != null) {
                $action = Validation::cleanInput($action);
                Validation::str($action, "action");
            }

            if (in_array($action, $actions['Admin'])) {
                if ($admin == null) {
                    require($localPath . $views['auth']);
                }
                else {
                    new AdminController();
                }
            }
            else {
                new UserController();
            }
        }
        catch(PDOException $e) {
            $errorView[] = Constants::PDO_ERROR . $e->getMessage();
            require($localPath . $views["error"]);
        }
        catch (Throwable $e){
            $errorView[] = Constants::GENERAL_ERROR . $e->getMessage();
            require($localPath . $views["error"]);
        }
    }
}