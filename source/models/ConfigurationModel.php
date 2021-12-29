<?php

/**
 * Name : ConfigurationModel.php
 * Project : My RSS website
 * Usefulness : contains a ConfigurationModel class, manage the configuration.
 * Last Modification date : 29/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */


class ConfigurationModel {
    private $gateway;

    /**
     *create a new configurationgateway with a new connection
     */
    public function __construct() {
        global $dsn, $login, $password;
        $this->gateway = new ConfigurationGateway(new Connection($dsn, $login, $password));
    }

    /**
     * return the configuration of the key
     * @param string $key key of the configuration
     * @return Configuration|null return the configuration if there is no problem, null otherwise
     */
    public function getConfiguration(string $key) : ?Configuration {
        $results = $this->gateway->get($key);
        if (!empty($results)) {
            return new Configuration($results[0]['idConfiguration'], $key, $results[0]['valuep']);
        }
        return null;
    }

    /**
     * insert a new configuration
     * @param string $key key of the configuration
     * @param int $value value of the configuration
     * @return void
     */
    public function insertConfiguration(string $key, int $value) : void {
        $this->gateway->insert($key, $value);
    }

    /**
     * delete the configuration whose id is passed in argument
     * @param string $key key of the configuration
     * @return void
     */
    public function deleteConfiguration(string $key) : void {
        $this->gateway->delete($key);
    }

    /**
     * update a configuration
     * @param string $key key of the configuration
     * @param int $value new value for the configuration
     * @return void
     */
    public function updateConfiguration(string $key, int $value) : void {
        $this->gateway->update($key, $value);
    }
}