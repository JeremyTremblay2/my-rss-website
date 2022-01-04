<?php

/**
 * Name : UserModel.php
 * Project : My RSS website
 * Usefulness : contains a UserModel class, manage the User part.
 * Last Modification date : 29/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

/**
 * A User model manage data about users between the controller and the gateway.
 */
class UserModel {
    private $gateway;

    /**
     * Create a new UserGateway
     */
    public function __construct() {
        global $dsn, $login, $password;
        $this->gateway = new UserGateway(new Connection($dsn, $login, $password));
    }

    public function initialize(){
        $dark = $_SESSION["darktheme"] ?? 0;
        var_dump($dark);
        $dark=Validation::cleanInput($dark);
        $dark=Validation::int($dark,"theme_sombre");
    }

    /**
     * Get the user whose username is passed in argument
     * @param string $username The username of the user
     * @return User|null A user or null
     */
    public function getUser(string $username) : ?User {
        $results = $this->gateway->get($username);
        if (!empty($results)) {
            return new User($results[0]['idUser'], $results[0]['username'], $results[0]['password']);
        }
        return null;
    }

    /**
     * Insert an User
     * @param string $username The username of the user
     * @param string $password The password of the user
     * @return void
     */
    public function insertUser(string $username, string $password) : void {
        $this->gateway->insert($username, $password);
    }

    /**
     * Open a session
     * @param string $username The username of the user
     * @return void
     */
    public function connection(string $username) {
        $_SESSION['login'] = $username;
    }
}