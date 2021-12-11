<?php

//classe config static/singleton => construct => param clé

class UserController
{
    public function __construct() {
        global $localPath, $views;
        $errorView = array();

        try{
            $action = $_REQUEST['action'] ?? null;
            if ($action != null) {
                $action = Validation::cleanInput($action);
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
                case "valider":
                    $this->valider();
                    break;
                default:
                    $errorView[] = "Erreur lors de l'appel PHP.";
                    require($localPath . $views["error"]);
                    break;
            }
        }
        catch(PDOException $e) {
            $errorView[] = 'Erreur innatendue lors de l\'accès à la base de données.' . $e->getMessage();
            require($localPath . $views["error"]);
        }
        catch (Exception $e){
            $errorView[] = 'Erreur innatendue dans le traitement de votre requête. Informations complémentaires : ' .
                $e->getMessage();
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
            $configurationModel->insertConfiguration('numberOfNewsPerPage', 9);
            $numberOfNewsPerPage = 9;
        }
        // Shouldn't happen
        else if ($numberOfNewsPerPage->getValue() <= 0) {
            $configurationModel->updateConfiguration("numberOfNewsPerPage", 9);
            $numberOfNewsPerPage = 9;
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
        require ($localPath . $views['auth']);
    }

    private function connectionClicked() {
        global $localPath, $views;
        $errorViews = [];

        $username = $_POST['name'] ?? null;
        $password = $_POST['password'] ?? null;

        $username = Validation::cleanInput($username);
        $password = Validation::cleanInput($password);

        try {
            Validation::str($username, "pseudo");
        }
        catch (UserValidationException $e) {
            $errorViews[] = $e->getMessage();
        }

        try {
            Validation::str($password, "mot de passe");
        }
        catch (UserValidationException $e) {
            $errorViews[] = $e->getMessage();
        }

        $viewData = array(
            'username' => $username,
            'password' => $password
        );

        if (count($errorViews) == 0) {
            $userModel = new UserModel();
            $user = $userModel->getUser($username);

            if ($user == null) {
                $errorViews[] = "Le nom d'utilisateur spécifié n'existe pas.";
            }
            else {
                if (password_verify($password, $user->getPassword())) {
                    require($localPath . $views['admin']);
                }
                else {
                    $errorViews[] = "Le couple nom d'utilisateur / mot de passe est incorrect.";
                }
            }
        }

        if(count($errorViews) != 0) {
            require($localPath . $views['auth']);
        }
    }

    private function valider(){

    }
}
?>

