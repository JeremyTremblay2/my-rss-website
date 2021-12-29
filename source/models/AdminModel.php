<?php

/**
 * Name : AdminModel.php
 * Project : My RSS website
 * Usefulness : contains a AdminModel class, manage the admin part.
 * Last Modification date : 29/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */


class AdminModel {

    /**
     * check if the user is an admin or not
     * @return User|null return true if the user is connected as an admin, false otherwise
     */
    public function isAdmin(): ?User {
        if (isset($_SESSION['login'])) {
            $login = Validation::cleanInput($_SESSION['login']);
            return new User(0, $login, 'password');
        }
        return null;
    }

    /**
     * shut down the connection of an admin
     * @return void
     */
    public function disconnection() {
        session_unset();
        session_destroy();
        $_SESSION = array();
    }
}