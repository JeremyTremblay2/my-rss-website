<?php
/**
 * Name : ConfigurationGateway.php
 * Project : My RSS website
 * Usefulness : contains a ConfigurationGateway class, allowing actions on data inside the database, like updates,
 * researches and deletes.
 * Last Modification date : 05/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

/**
 * A ConfigurationGateway class, allows you to carry out actions on the configurations of the database.
 *
 * ConfigurationGateway must have a way to connect to the database. A ConfigurationGateway can do some actions on data.
 */
class ConfigurationGateway {

    private $connection;

    /**
     * Create a ConfigurationGateway.
     *
     * @param Connection $connection A connexion to the database where data will be manipulated.
     */
    public function __construct(Connection $connection) {
        $this->connection = $connection;
    }

    /**
     * Get a configuration in the database with its key.
     *
     * @param string $key The key of the configuration that will be get retrieve.
     * @return array Returns an array or null if the request fails.
     */
    public function get(string $key) : ?array {
        $query = 'SELECT valuep FROM configuration WHERE keyp = :key';
        $success = $this->connection->executeQuery($query, array(
            ':key' => array($key, PDO::PARAM_STR)
        ));
        if ($success) {
            $results = $this->connection->getResults();
            return $results;
        }
        return null;
    }

    /**
     * Insert a configuration in the database.
     *
     * @param string $key The key of the configuration that will be inserted.
     * @param int $value The value of the configuration that will be inserted.
     */
    public function insert(string $key, int $value) {
        $query = 'INSERT INTO configuration VALUES(:key, :value)';
        $this->connection->executeQuery($query, array(
            ':key' => array($key, PDO::PARAM_STR),
            ':value' => array($value, PDO::PARAM_INT)
        ));
    }

    /**
     * Update a configuration from its key.
     *
     * @param string $key The key of the configuration.
     * @param int $value The value of the configuration to update.
     */
    public function update(string $key, int $value) {
        $query = 'UPDATE configuration SET valuep = :value WHERE keyp = :key';
        $this->connection->executeQuery($query, array(
            ':key' => array($key, PDO::PARAM_STR),
            ':value' => array($value, PDO::PARAM_INT)
        ));
    }

    /**
     * Delete a configuration from its key.
     *
     * @param string $key The key of the configuration to delete.
     */
    public function delete(string $key) {
        $query = 'DELETE FROM configuration WHERE keyp = :key';
        $this->connection->executeQuery($query, array(
            ':key' => array($key, PDO::PARAM_STR)
        ));
    }
}