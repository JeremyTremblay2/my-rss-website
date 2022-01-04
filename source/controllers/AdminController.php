<?php

/**
 * Name : AdminController.php
 * Project : My RSS website
 * Usefulness : contains a AdminController class, manages the controls into admin part.
 * Last Modification date : 29/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

class AdminController {
    /**
     * Create a new AdminController, call the best methode in function of the action passed into URL
     */
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

    /**
     * Initialize the array of RSS feeds
     * @return void
     */
    public function init() {
        global $localPath, $views, $errorView;

        $rssFeedModel = new RssFeedModel();
        $numberOfRssFeed = $rssFeedModel->getNumberOfRssFeeds();
        $viewData = $rssFeedModel->getAllRssFeed();
        require($localPath . $views['admin']);
    }

    /**
     * This function modify the number of news into the database
     * @return void
     * @throws Exception if the number is not an integer
     */
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

        if ($numberOfNews <= 0 and count($errorView) == 0) {
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

    /**
     * Add a rss feed into the database, and try to parse it.
     * @return void
     * @throws Exception if the link is not valid
     */
    public function addRssFeed() {
        global $errorView;
        $errorView = [];
        $rssFeedModel = new RssFeedModel();
        // A past date
        $date = strftime("%Y-%m-%d %H:%M:%S", strtotime('4 december 2000'));

        $rssFeedName = $_REQUEST['rssFeedName'] ?? 'Flux non nommé';
        $rssFeedName = Validation::cleanInput($rssFeedName);

        $rssFeedLink = $_REQUEST['rssFeedLink'] ?? null;
        $rssFeedLink = Validation::cleanInput($rssFeedLink);

        try {
            Validation::str($rssFeedName, "nom du flux");
            Validation::str($rssFeedLink, "lien du flux");
            $parser = new Parser();
            $parser->setPath($rssFeedLink);
            $parser->parse($date);
        }
        catch (UserValidationException $e) {
            $errorView[] = $e->getMessage();
        }
        catch (ParseError $e) {
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
            $this->init();
        }
    }

    /**
     * Delete a stream whose id is passed in the URL
     * @return void
     * @throws Exception Exception raise in Validation class
     */
    public function deleteRssFeed() {
        $idRssFeed = $_REQUEST['idStream'] ?? null;
        $idRssFeed = Validation::cleanInput($idRssFeed);

        //We have no try/catch block because in case of a problem, we go on the error page
        Validation::int($idRssFeed, "id du flux");

        $rssFeedModel = new RssFeedModel();
        $rssFeedModel->deleteRssFeed($idRssFeed);

        $this->init();
    }

    /**
     * Refresh a stream whose id is passed by argument
     * @return void
     * @throws Exception Exception raise in Validation class
     */
    public function refreshRssFeed() {
        $idRssFeed = $_REQUEST['idStream'] ?? null;
        $idRssFeed = Validation::cleanInput($idRssFeed);
        //If they are a problem here, it's because of a too long description or data in the stream.
        //So we just go on the error page.
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

        if (!empty($results)) {
            foreach ($results as $line) {
                $newsModel->insertNews($rssFeed->getId(), $line[0], $line[1], $line[2],
                    strftime("%Y-%m-%d %H:%M:%S", strtotime($line[3])));
            }
        }
        $rssFeedModel->updateRssFeed($rssFeed->getId(), $rssFeed->getName(), $rssFeed->getLink(), $date);

        $this->init();
    }

    /**
     * Disconnect an Admin
     * @return void
     */
    public function disconnection() {
        $adminModel = new AdminModel();
        $adminModel->disconnection();
        header('Location: ?');
    }
}