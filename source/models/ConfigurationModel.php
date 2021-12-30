<?php

/**
 * Name : ConfigurationModel.php
 * Project : My RSS website
 * Usefulness : contains a ConfigurationModel class, manage the configuration.
 * Last Modification date : 29/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

/**
 * A Configuration model manage the exchange of data between a database and a controller.
 */
class ConfigurationModel {
    private $gateway;

    /**
     * Create a new configuration gateway with a new connection
     */
    public function __construct() {
        global $dsn, $login, $password;
        $this->gateway = new ConfigurationGateway(new Connection($dsn, $login, $password));
    }

    /**
     * Get a configuration from a key
     * @param string $key The key of the configuration
     * @return Configuration|null The configuration if there is no problem, null otherwise
     */
    public function getConfiguration(string $key) : ?Configuration {
        $results = $this->gateway->get($key);
        if (!empty($results)) {
            return new Configuration($results[0]['idConfiguration'], $key, $results[0]['valuep']);
        }
        return null;
    }

    /**
     * Insert a new configuration
     * @param string $key The key of the configuration
     * @param int $value The value of the configuration
     * @return void
     */
    public function insertConfiguration(string $key, int $value) : void {
        $this->gateway->insert($key, $value);
    }

    /**
     * Delete the configuration whose id is passed in argument
     * @param string $key The key of the configuration
     * @return void
     */
    public function deleteConfiguration(string $key) : void {
        $this->gateway->delete($key);
    }

    /**
     * Update a configuration from the key
     * @param string $key The key of the configuration
     * @param int $value The new value for the configuration
     * @return void
     */
    public function updateConfiguration(string $key, int $value) : void {
        $this->gateway->update($key, $value);
    }
}