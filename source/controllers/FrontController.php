<?php

class FrontController {

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
                    var_dump("Je suis un admin");
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
        catch (Exception $e){
            $errorView[] = Constants::GENERAL_ERROR . $e->getMessage();
            require($localPath . $views["error"]);
        }
    }
}