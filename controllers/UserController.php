<?php
require("../Classes/Validation.php");
require("../config/config.php");
class UserController
{
    public function __construct()
    {
        global $localPath, $views;
        $errorViews = array();
        require_once($localPath . $views['connect']);

        try{
            $action = $_REQUEST['action'] ?? null;
            $action = Validation::cleanInput($action);

            switch($action){
                case null:
                    $this->Init();
                    break;
                case "connection":
                    $this->connection();
                    break;
                case "connectionClick":
                    $this->connectionClicked();
                    break;
                default:
                    $errorViews[] = "Erreur lors de l'appel PHP.";
                    require_once($localPath . $views["auth"]);
                    break;
            }
        }
        catch(PDOException $e) {
            $errorViews[] = 'Erreur innatendue lors de l\'accès à la base de données.' ;
            require_once($localPath . $views["error"]);
        }
        catch (Exception $e){
            $errorViews[] = 'Erreur innatendue dans le traitement de votre requête. Informations complémentaires : ' .
                $e->getMessage();
            require_once($localPath . $views["error"]);
        }
    }

    private function Init(){
        global $localPath, $views, $numberOfPages;

        $newsModel = new NewsModel();
        $configurationModel = new ConfigurationModel();

        $numberOfNews = $newsModel->getNumberOfNews();
        $numberOfNewsPerPage = $configurationModel->getValue('numberOfNewsPerPage');

        // Shouldn't happen
        if ($numberOfNewsPerPage == null or $numberOfNewsPerPage <= 0) {
            throw new Exception('Le nombre de news par page du site semble mal configuré, contactez l\'administrateur');
        }

        if ($numberOfNews == null or $numberOfNews <= 0) {
            $numberOfNews = 1;
        }

        $numberOfPages = (int) ($numberOfNews / $numberOfNewsPerPage);
        if ($numberOfPages % $numberOfNewsPerPage != 0) {
            $numberOfPages = $numberOfPages + 1;
        }

        $newsList = $newsModel->findAllNews();
        require_once($localPath . $views['news']);
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

        try {
            Validation::str($username);
            Validation::str($password);
            //$valeur = $model->get_value();
            $viewData = array(
                'pseudo' => $username,
                'password' => $password,
            );
            require ($localPath . $views['auth']);
        }
        catch (Exception $e){
            $errorViews[] = $e->getMessage();
            require ($localPath.$views['auth']);
        }
    }

    private function connectionClicked() {

    }
}
new UserController();
//password_hash
//password_verify(mdpclaire,mdpcripté)
?>

