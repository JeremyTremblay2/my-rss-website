<?php

class AdminModel {

    public function isAdmin(): ?User {
        if (isset($_SESSION['login'])) {
            $login = Validation::cleanInput($_SESSION['login']);
            return new User(0, $login, 'password');
        }
        return null;
    }

    public function connection(string $username, string $passwordUser, array &$errorView) {
        global $localPath, $views;
        //$userGateway = new UserGateway(new Connection($dsn, $login, $password));
        
    }

    public function disconnection() {
        session_unset();
        session_destroy();
        $_SESSION = array();
    }
}