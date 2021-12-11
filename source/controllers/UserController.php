<?php

//classe config static/singleton => construct => param clé

class UserController {

    public function __construct() {
        global $localPath, $views;
        $errorView = array();

        try{
            $action = $_REQUEST['action'] ?? null;
            if ($action != null) {
                $action = Validation::cleanInput($action);
                Validation::str($action, "action");
            }

            switch($action){
                case null:
                case "home":
                    $this->init();
                    break;
                case "connection":
                    $this->connection();
                    break;
                case "connectionClick":
                    $this->connectionClicked();
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

    private function init(){
        global $localPath, $views;
        $currentPage = $_REQUEST['page'] ?? 1;
        try {
            Validation::int($currentPage, "page courante");
        }
        catch (UserValidationException $e) {
            $currentPage = 1;
        }

        if ($currentPage <= 0) {
            $currentPage = 1;
        }

        $newsModel = new NewsModel();
        $configurationModel = new ConfigurationModel();

        $numberOfNews = $newsModel->getNumberOfNews();
        $numberOfNewsPerPage = $configurationModel->getConfiguration('numberOfNewsPerPage');

        // Shouldn't happen
        if ($numberOfNewsPerPage == null) {
            $configurationModel->insertConfiguration('numberOfNewsPerPage', Constants::DEFAULT_NUMBER_OF_NEWS);
            $numberOfNewsPerPage = Constants::DEFAULT_NUMBER_OF_NEWS;
        }
        // Shouldn't happen
        else if ($numberOfNewsPerPage->getValue() <= 0) {
            $configurationModel->updateConfiguration("numberOfNewsPerPage", Constants::DEFAULT_NUMBER_OF_NEWS);
            $numberOfNewsPerPage = Constants::DEFAULT_NUMBER_OF_NEWS;
        }
        else {
            $numberOfNewsPerPage = $numberOfNewsPerPage->getValue();
        }

        $numberOfPages = (int) ($numberOfNews / $numberOfNewsPerPage);
        if ($numberOfNews % $numberOfNewsPerPage != 0) {
            $numberOfPages = $numberOfPages + 1;
        }

        if ($currentPage > $numberOfPages) {
            $currentPage = $numberOfPages;
        }

        $viewData = $newsModel->findNewsInRange($numberOfNewsPerPage, ($currentPage - 1) * $numberOfNewsPerPage);
        require($localPath . $views['news']);
    }

    private function reset() {
        global $localPath, $views;
        $dataView = array (
            'pseudo' => "",
            'password' => ""
        );
        require($localPath . $views['auth']);
    }

    private function connection() {
        global $localPath, $views;
        $adminModel = new AdminModel();
        $admin = $adminModel->isAdmin();
        if ($admin == null) {
            require ($localPath . $views['auth']);
        }
        else {
            require ($localPath . $views['admin']);
        }
    }

    private function connectionClicked() {
        global $localPath, $views;
        $errorView = [];

        $username = $_POST['name'] ?? null;
        $password = $_POST['password'] ?? null;

        $username = Validation::cleanInput($username);
        $password = Validation::cleanInput($password);

        try {
            Validation::str($username, "pseudo");
        }
        catch (UserValidationException $e) {
            $errorView[] = $e->getMessage();
        }

        try {
            Validation::str($password, "mot de passe");
        }
        catch (UserValidationException $e) {
            $errorView[] = $e->getMessage();
        }

        $viewData = array(
            'username' => $username,
            'password' => $password
        );

        if (count($errorView) == 0) {
            $adminModel = new AdminModel();
            $adminModel->connection($username, $password, $errorView);
        }

        if (count($errorView) != 0) {
            require($localPath . $views['auth']);
        }
    }
}
?>

