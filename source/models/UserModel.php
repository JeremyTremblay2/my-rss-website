<?php

class UserModel {

    private $gateway;

    public function __construct(Connection $connection) {
        $this->gateway = new UserGateway($connection);
    }

    public function getUser(string $username) : ?User {
        $results = $this->gateway->get($username);
        if (!empty($results)) {
            $user = new User($results[0]['username'], $results[0]['password']);
            return $user;
        }
        return null;
    }

    public function insertUser(string $username, string $password) : void {
        $this->gateway->insert($username, $password);
    }
}