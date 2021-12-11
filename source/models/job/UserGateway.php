<?php
/**
 * Name : UserGateway.php
 * Project : My RSS website
 * Usefulness : contains a UserGateway class, allowing actions on data inside the database, like researches.
 * Last Modification date : 05/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

/**
 * A UserGateway class, allows you to carry out actions on the users in the database.
 *
 * UserGateway must have a way to connect to the database. A UserGateway can do some actions on data.
 */
class UserGateway {
    private $connection;

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
     * @return array Returns an array of results or null if the request fails.
     * @throws PDOException If the request fails.
     */
    public function get(string $username) : ?array {
        $query = 'SELECT * FROM user WHERE username = :username';
        $success = $this->connection->executeQuery($query, array(
            ':username' => array($username, PDO::PARAM_STR)
        ));
        if ($success) {
            $results = $this->connection->getResults();
            return $results;
        }
        throw new PDOException("Impossible d'executer la commande de récupération d'utilisateur depuis la base.", 914);
    }

    /**
     * Insert a User in the database.
     *
     * @param string $username The username of the User that will be inserted.
     * @param string $password The password of the User that will be inserted.
     * @throws PDOException If the request fails.
     */
    public function insert(string $username, string $password) {
        $query = 'INSERT INTO user VALUES(NULL, :username, :password)';
        $success = $this->connection->executeQuery($query, array(
            ':username' => array($username, PDO::PARAM_STR),
            ':password' => array($password, PDO::PARAM_STR)
        ));
        if (!$success) {
            throw new PDOException("Impossible d'insérer un utilisateur dans la base.", 915);
        }
    }
}