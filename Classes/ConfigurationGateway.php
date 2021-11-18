<?php
/**
 * Name : ConfigurationGateway.php
 * Project : My RSS website
 * Usefulness : contains a ConfigurationGateway class, allowing actions on data inside the database, like updates,
 * researches and deletes.
 * Last Modification date : 18/11/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

/**
 * A ConfigurationGateway class, allows you to carry out actions on the configurations of the database.
 *
 * ConfigurationGateway must have a way to connect to the database. A ConfigurationGateway can do some actions on data.
 */
class ConfigurationGateway {

    private Connection $connection;

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
     * @return Configuration Returns a configuration.
     */
    public function get(string $key) : Configuration {
        $configurationArray = array();
        $query = 'SELECT value FROM CONFIGURATION WHERE key = :key';
        $this->connection->executeQuery($query, array(
            ':key' => array($key, PDO::PARAM_STR)
        ));
        $results = $this->connection->getResults();
        // Please, add a try catch block
        $configurationArray[] = new Configuration($results['key'], $results['value']);
        return $configurationArray[0];
    }

    /**
     * Insert a configuration in the database.
     *
     * @param string $key The key of the configuration that will be inserted.
     * @param int $value The value of the configuration that will be inserted.
     */
    public function insert(string $key, int $value) {
        $query = 'INSERT INTO CONFIGURATION VALUES(:key, :value)';
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
        $query = 'UPDATE CONFIGURATION SET value = :value WHERE key = :key';
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
        $query = 'DELETE FROM CONFIGURATION WHERE key = :key';
        $this->connection->executeQuery($query, array(
            ':key' => array($key, PDO::PARAM_STR)
        ));
    }

}