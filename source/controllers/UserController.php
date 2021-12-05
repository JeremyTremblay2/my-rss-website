<?php

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
                    require_once($localPath . $views["error"]);
                    break;
            }
        }
        catch(PDOException $e) {
            $errorView[] = 'Erreur innatendue lors de l\'accès à la base de données.' ;
            require_once($localPath . $views["error"]);
        }
        catch (Exception $e){
            $errorView[] = 'Erreur innatendue dans le traitement de votre requête. Informations complémentaires : ' .
                $e->getMessage();
            require_once($localPath . $views["error"]);
        }
    }

    private function init(){
        global $localPath, $views, $numberOfPages, $dsn, $login, $password;
        $currentPage = $_REQUEST['page'] ?? 1;
        $currentPage = Validation::int($currentPage);

        $newsModel = new NewsModel(new Connection($dsn, $login, $password));
        $configurationModel = new ConfigurationModel(new Connection($dsn, $login, $password));

        $numberOfNews = $newsModel->getNumberOfNews();
        $numberOfNewsPerPage = $configurationModel->getConfiguration('numberOfNewsPerPage')->getValue();

        // Shouldn't happen
        if ($numberOfNewsPerPage == null or $numberOfNewsPerPage <= 0) {
            $configurationModel->insertConfiguration('numberOfNewsPerPage', 10);
            $numberOfNewsPerPage = 10;
        }

        $numberOfPages = (int) ($numberOfNews / $numberOfNewsPerPage);
        if ($numberOfPages % $numberOfNewsPerPage != 0) {
            $numberOfPages = $numberOfPages + 1;
        }

        if ($currentPage > $numberOfPages) {
            $currentPage = 1;
        }

        $viewData = $newsModel->findNewsInRange($numberOfNewsPerPage, ($currentPage - 1) * $numberOfNewsPerPage);
        require($localPath . $views['news']);
    }

    private function reset() {
        global $localPath, $views;
        $dataVue = array (
            'pseudo' => "",
            'password' => "",
            'data' => "",
        );
        require ($localPath . $views['auth']);
    }

    private function connection() {
        global $localPath, $views;
        $username = $_POST['name'] ?? null;
        $password = $_POST['password'] ?? null;

        if ($username != null and $password != null) {
            Validation::str($username);
            Validation::str($password);
            $viewData = array(
                'pseudo' => $username,
                'password' => $password,
            );

        }
        else {
            $this->reset();
        }
        require ($localPath . $views['auth']);
    }

    private function connectionClicked() {

    }
}
?>

