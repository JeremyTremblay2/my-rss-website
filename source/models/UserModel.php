<?php

class UserModel {
    private $gateway;

    public function __construct() {
        global $dsn, $login, $password;
        $this->gateway = new UserGateway(new Connection($dsn, $login, $password));
    }

    public function getUser(string $username) : ?User {
        $results = $this->gateway->get($username);
        if (!empty($results)) {
            return new User($results[0]['idUser'], $results[0]['username'], $results[0]['password']);
        }
        return null;
    }

    public function insertUser(string $username, string $password) : void {
        $this->gateway->insert($username, $password);
    }
}