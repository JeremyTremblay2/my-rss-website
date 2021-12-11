<?php

class AdminController {

    public function __construct() {
        global $localPath, $views;
        $errorView = array();

        try{
            $action = $_REQUEST['action'] ?? null;
            if ($action != null) {
                $action = Validation::cleanInput($action);
                Validation::str($action, "action");
            }
            var_dump($action . "Je suis un admin");

            switch($action) {
                case 'homeAdmin':
                    $this->init();
                    break;
                case 'changeNumberOfNews':
                    $this->modifyNumberNews();
                    break;
                case 'addRssFeed':
                    $this->addRssFeed();
                    break;
                case 'deleteRssFeed':
                    $this->deleteRssFeed();
                    break;
                case 'disconnection':
                    $this->disconnection();
                    break;
                default:
                    $errorView[] = "Erreur lors de l'appel PHP.";
                    require($localPath . $views["error"]);
                    break;
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

    public function init() {
        //Appel de cette fonction ?
        global $localPath, $views;

        $rssFeedModel = new RssFeedModel();
        $numberOfRssFeed = $rssFeedModel->getNumberOfRssFeeds();
        $viewData = $rssFeedModel->getAllRssFeed();
        var_dump($viewData);
        require($localPath . $views['admin']);
    }

    public function modifyNumberNews() {
        global $localPath, $views;
        $errorView = [];
        var_dump($_REQUEST['numberPerPage']);
        var_dump($_REQUEST['action']);

        $configurationModel = new ConfigurationModel();
        $numberOfNews = $_REQUEST['numberPerPage'] ?? null;
        $numberOfNews = Validation::cleanInput($numberOfNews);

        Validation::int($numberOfNews, "Nombre de news");

        if ($numberOfNews <= 0) {
            $errorView[] ="Veuillez entrer un nombre valide de news par page.";
            require($localPath . $views["error"]);
        }
        else {
            $configurationModel->updateConfiguration('numberOfNewsPerPage', $numberOfNews);
            require($localPath . $views['admin']);
        }
    }

    public function addRssFeed() {
        global $localPath, $views;
        require($localPath . $views['admin']);
    }

    public function deleteRssFeed() {
        global $localPath, $views;

        $idRssFeed = $_REQUEST['idStream'] ?? null;
        var_dump($idRssFeed);
        $idRssFeed = Validation::cleanInput($idRssFeed);

        Validation::int($idRssFeed, "id du flux");

        $rssFeedModel = new RssFeedModel();
        $rssFeedModel->deleteRssFeed($idRssFeed);

        require($localPath . $views['admin']);
    }

    public function disconnection() {
        global $localPath, $views;
        $adminModel = new AdminModel();
        $adminModel->disconnection();
        // Revenir accueil ?
        require($localPath . $views['auth']);
    }
}