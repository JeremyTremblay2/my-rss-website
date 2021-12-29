<?php

/**
 * Name : UserModel.php
 * Project : My RSS website
 * Usefulness : contains a UserModel class, manage the User part.
 * Last Modification date : 29/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */
class UserModel {
    private $gateway;

    /**
     * create a new UserGateway
     */
    public function __construct() {
        global $dsn, $login, $password;
        $this->gateway = new UserGateway(new Connection($dsn, $login, $password));
    }

    /**
     * return the user whose username is passed in argument
     * @param string $username username of the user
     * @return User|null array of the user or null
     */
    public function getUser(string $username) : ?User {
        $results = $this->gateway->get($username);
        if (!empty($results)) {
            return new User($results[0]['idUser'], $results[0]['username'], $results[0]['password']);
        }
        return null;
    }

    /**
     * insert an User
     * @param string $username username of the user
     * @param string $password password of the user
     * @return void
     */
    public function insertUser(string $username, string $password) : void {
        $this->gateway->insert($username, $password);
    }

    /**
     * open a session
     * @param string $username username of the user
     * @return void
     */
    public function connection(string $username) {
        $_SESSION['login'] = $username;
    }
}