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
                case 'refreshRssFeed':
                    $this->refreshRssFeed();
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
        catch (Throwable $e){
            $errorView[] = Constants::GENERAL_ERROR . $e->getMessage();
            require($localPath . $views["error"]);
        }
    }

    public function init() {
        global $localPath, $views, $errorView;

        $rssFeedModel = new RssFeedModel();
        $numberOfRssFeed = $rssFeedModel->getNumberOfRssFeeds();
        $viewData = $rssFeedModel->getAllRssFeed();
        require($localPath . $views['admin']);
    }

    public function modifyNumberNews() {
        global $errorView;
        $errorView = [];
        $configurationModel = new ConfigurationModel();
        $numberOfNews = $_REQUEST['numberPerPage'] ?? null;
        $numberOfNews = Validation::cleanInput($numberOfNews);

        try {
            Validation::int($numberOfNews, "Nombre de news");
        }
        catch (UserValidationException $e) {
            $errorView[] = $e->getMessage();
        }

        if ($numberOfNews <= 0) {
            $errorView[] = Constants::NOT_A_VALID_NUMBER_ERROR;
        }

        if (count($errorView) == 0) {
            $configurationModel->updateConfiguration('numberOfNewsPerPage', $numberOfNews);
            header('Location: ?action=homeAdmin');
        }
        else {
            $this->init();
        }
    }

    public function addRssFeed() {
        global $localPath, $views, $errorView;
        $errorView = [];
        $rssFeedModel = new RssFeedModel();
        $date = strftime("%Y-%m-%d %H:%M:%S", strtotime('4 december 2000'));

        $rssFeedName = $_REQUEST['rssFeedName'] ?? 'Flux non nommé';
        $rssFeedName = Validation::cleanInput($rssFeedName);

        $rssFeedLink = $_REQUEST['rssFeedLink'] ?? null;
        $rssFeedLink = Validation::cleanInput($rssFeedLink);

        try {
            Validation::str($rssFeedName, "nom du flux");
        }
        catch (UserValidationException $e) {
            $errorView[] = $e->getMessage();
        }

        try {
            Validation::str($rssFeedLink, "lien du flux");
        }
        catch (UserValidationException $e) {
            $errorView[] = $e->getMessage();
        }

        $parser = new Parser();
        try {
            $parser->setPath($rssFeedLink);
            $parser->parse($date);
        }
        catch (Throwable $e) {
            $errorView[] = $e->getMessage();
        }

        if ($rssFeedModel->checkIfExists($rssFeedLink) == 1) {
            $errorView[] = Constants::ERROR_RSS_FEED_ALREADY_EXISTS;
        }

        if (count($errorView) == 0) {
            $rssFeedModel->insertRssFeed($rssFeedName, $rssFeedLink, $date);
            header('Location: ?action=homeAdmin');
        }
        else {
            require($localPath.$views['error']);
        }
    }

    public function deleteRssFeed() {
        $idRssFeed = $_REQUEST['idStream'] ?? null;
        $idRssFeed = Validation::cleanInput($idRssFeed);

        Validation::int($idRssFeed, "id du flux");

        $rssFeedModel = new RssFeedModel();
        $rssFeedModel->deleteRssFeed($idRssFeed);

        $this->init();
    }

    public function refreshRssFeed() {
        $idRssFeed = $_REQUEST['idStream'] ?? null;
        $idRssFeed = Validation::cleanInput($idRssFeed);
        Validation::int($idRssFeed, "id du flux");

        $rssFeedModel = new RssFeedModel();
        $newsModel = new NewsModel();
        $rssFeed = $rssFeedModel->getRssFeed($idRssFeed);

        if ($rssFeed == null) {
            throw new Exception("Le flux sélectionné n'existe pas.");
        }

        $parser = new Parser();
        $parser->setPath($rssFeed->getLink());
        $results = $parser->parse($rssFeed->getUpdateDate());
        $date = strftime("%Y-%m-%d %H:%M:%S", strtotime('now'));

        if ($results != null && !empty($results)) {
            foreach ($results as $line) {
                $newsModel->insertNews($rssFeed->getId(), $line[0], $line[1], $line[2],
                    strftime("%Y-%m-%d %H:%M:%S", strtotime($line[3])));
            }
        }
        $rssFeedModel->updateRssFeed($rssFeed->getId(), $rssFeed->getName(), $rssFeed->getLink(), $date);

        $this->init();
    }

    public function disconnection() {
        global $localPath;
        $adminModel = new AdminModel();
        $adminModel->disconnection();
        header('Location: ?');
    }
}