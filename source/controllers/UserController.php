<?php

/**
 * Name : UserController.php
 * Project : My RSS website
 * Usefulness : contains a UserController class, manages the controls into user part.
 * Last Modification date : 29/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

class UserController {

    /**
     * Create a new UserController and select the best method in function of the action passed in URL
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
                case "changeTheme":
                    $this->changeTheme();
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

        //To get errors and exceptions
        catch (Throwable $e){
            $errorView[] = Constants::GENERAL_ERROR . $e->getMessage();
            require($localPath . $views["error"]);
        }
    }

    /**
     * Initialize the news from the BD for the page
     * @return void
     * @throws Exception Exception raise in Validation class
     */
    private function init(){
        global $localPath, $views;
        $dark = $_SESSION["darktheme"]??2;
        if(isset($dark)) {

            $dark=Validation::cleanInput($dark);
            $dark=Validation::int($dark,"darktheme");
            $dark = $_SESSION["darktheme"];
        }
        else{
            $dark = 2;
        }
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

        if ($numberOfNews == 0) {
            $currentPage = 1;
        }

        $viewData = $newsModel->findNewsInRange($numberOfNewsPerPage, ($currentPage - 1) * $numberOfNewsPerPage);
        require($localPath . $views['news']);
    }

    /**
     * Give access to the admin mode if you are connected, else call the connection page
     * @return void
     */
    private function connection() {
        global $localPath, $views;
        $adminModel = new AdminModel();
        $admin = $adminModel->isAdmin();
        if(isset($_SESSION['darktheme'])) {
            $dark = $_SESSION["darktheme"];
        }
        else{
            $dark = 0;
        }
        if ($admin == null) {
            require($localPath . $views['auth']);
        }
        else {
            header('Location: ?action=homeAdmin');
        }
    }

    /**
     * Verify if the couple pseudo/password is true or false, if it's the good couple that's open the admin page
     * @return void
     * @throws Exception Exception raise in Validation class
     */
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
            $userModel = new UserModel();
            $user = $userModel->getUser($username);

            if ($user == null) {
                $errorView[] = Constants::CONNECTION_ERROR;
            }
            else {
                if (password_verify($password, $user->getPassword())) {
                    $userModel->connection($username);
                    header('Location: ?action=homeAdmin');
                }
                else {
                    $errorView[] = Constants::CONNECTION_ERROR;
                }
            }
        }

        if (count($errorView) != 0) {
            require($localPath . $views['auth']);
        }
    }
    private function changeTheme(){
        global $localPath, $views;
        $page = $_REQUEST['page'];
        if($_SESSION['darktheme']==2){
            $_SESSION['darktheme'] = 1;
        }
        else{
            $_SESSION['darktheme']=2;
        }
        try {
            if($page == "home"){
                $this->init();
            }
            else if($page=="login"){
                $this->connection();
            }
            else if($page=="admin"){
                header('Location: ?action=homeAdmin');
            }

        } catch (Exception $e) {
            require ($localPath.$views["error"]);
        }
    }
}
?>

