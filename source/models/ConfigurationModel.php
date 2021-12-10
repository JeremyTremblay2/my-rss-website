<?php

class ConfigurationModel {

    private $gateway;

    public function __construct(Connection $connection) {
        $this->gateway = new ConfigurationGateway($connection);
    }

    public function getConfiguration(string $key) : ?Configuration {
        $results = $this->gateway->get($key);
        if (!empty($results)) {
            return new Configuration($results[0]['idConfiguration'], $key, $results[0]['valuep']);
        }
        return null;
    }

    public function insertConfiguration(string $key, int $value) : void {
        $this->gateway->insert($key, $value);
    }

    public function deleteConfiguration(string $key) : void {
        $this->gateway->delete($key);
    }

    public function updateConfiguration(string $key, int $value) : void {
        $this->gateway->update($key, $value);
    }
}