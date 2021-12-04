<?php
/**
 * Name : User.php
 * Project : My RSS website
 * Usefulness : contains a User class, allowing the instantiation of users.
 * Last Modification date : 18/11/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

/**
 * A User class, represent a person, with his username (it can be a pseudo) and a password.
 *
 * Users have a username and a password.
 */
class User {

    private $username;
    private $password;

    /**
     * Create a new User.
     *
     * @param string $username The username of the user.
     * @param string $password The password of the user.
     */
    public function __construct(string $username, string $password) {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Get the username of a user.
     *
     * @return string The username of a user.
     */
    public function getUsername(): string {
        return $this->username;
    }

    /**
     * Set the username of a user.
     *
     * @param string $username The username of the user to change.
     */
    private function setUsername(string $username) {
        $this->username = $username;
    }

    /**
     * Get the password of the user.
     *
     * @return string The password of the user.
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * Set the password of a user.
     *
     * @param string $password The new password.
     */
    private function setPassword(string $password) {
        $this->password = $password;
    }

    /**
     * Return a string representing the User.
     *
     * @return string A string representing the user.
     */
    public function __toString() : string {
        return '{' . $this->username . ' ; ' . str_repeat('*', strlen($this->password)) . '}';
    }
}