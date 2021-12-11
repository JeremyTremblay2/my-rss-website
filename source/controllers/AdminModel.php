<?php

class AdminModel {

    public function isAdmin(): ?User {
        if (isset($_SESSION['login']) && isset($_SESSION['role'])) {
            $login = Validation::cleanInput($_SESSION['login']);
            $role = Validation::cleanInput($_SESSION['role']);
            return new User(0, $login, 'password');
        }
        return null;
    }

    public function connection(string $username, string $passwordUser, array &$errorView) {
        global $localPath, $views;
        //$userGateway = new UserGateway(new Connection($dsn, $login, $password));
        $userModel = new UserModel();
        $user = $userModel->getUser($username);

        if ($user == null) {
            $errorView[] = "Le nom d'utilisateur spécifié n'existe pas.";
        }
        else {
            if (password_verify($passwordUser, $user->getPassword())) {
                $_SESSION['role'] = 'Admin';
                $_SESSION['login'] = $username;
                $_SESSION['password'] = $passwordUser;
                $_REQUEST['action'] = 'homeAdmin';
                require($localPath . $views['admin']);
            }
            else {
                $errorView[] = "Le couple nom d'utilisateur / mot de passe est incorrect.";
            }
        }
    }

    public function disconnection() {
        session_unset();
        session_destroy();
        $_SESSION = array();
    }
}