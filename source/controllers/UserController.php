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
        $numberOfNewsPerPage = $configurationModel->getConfiguration('numberOfNewsPerPage');

        // Shouldn't happen
        if ($numberOfNewsPerPage == null or $numberOfNewsPerPage->getValue() <= 0) {
            $configurationModel->insertConfiguration('numberOfNewsPerPage', 10);
            $numberOfNewsPerPage = 10;
        }

        $numberOfNewsPerPage = $numberOfNewsPerPage->getValue();

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
            require ($localPath . $views['auth']);
        }
        else {
            $this->reset();
        }
    }

    private function connectionClicked() {
        global $localPath, $views;
        $errorViews = [];
        $err = 0;
        $username = $_POST['name'] ?? null;
        $password = $_POST['password'] ?? null;

        if($username==null){
            $errorViews[0] = "Veuillez entrer un pseudo!";
            $err = 1;
        }
        if($password==null){
            $errorViews[1] = "Veuillez entrer un mot de passe !";
            $err = 1;
        }
        if($err == 1) {
            require($localPath . $views['auth']);
        }
        else{
            require ($localPath . $views['admin']);
        }
    }

    private function valider(){

    }
}
?>

