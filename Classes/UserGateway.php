<?php
/**
 * Name : UserGateway.php
 * Project : My RSS website
 * Usefulness : contains a UserGateway class, allowing actions on data inside the database, like researches.
 * Last Modification date : 18/11/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

/**
 * A UserGateway class, allows you to carry out actions on the users in the database.
 *
 * UserGateway must have a way to connect to the database. A UserGateway can do some actions on data.
 */
class UserGateway {
    private Connection $connection;

    /**
     * Create a new UserGateway.
     *
     * @param Connection $connection A way to connect at the database.
     */
    public function __construct(Connection $connection) {
        $this->connection = $connection;
    }

    /**
     * Get a User in the database with its username.
     *
     * @param string $username The id of the User that will be get retrieve.
     * @return User Returns a User found by the username or null.
     */
    public function get(string $username) : ?User {
        $query = 'SELECT * FROM USER WHERE username = :username';
        $this->connexion->executeQuery($query, array(
            ':username' => array($username, PDO::PARAM_STR)
        ));
        $user = $this->connection->getResults();
        // Please add a try catch block
        $user = new User($user['username'], $user['password']);
        return $user[0];
    }
}