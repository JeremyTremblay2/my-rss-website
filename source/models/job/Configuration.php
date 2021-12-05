<?php
/**
 * Name : Configuration.php
 * Project : My RSS website
 * Usefulness : contains a Configuration class, representing a kay / value pair, useful for some operations.
 * Last Modification date : 05/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

/**
 * A Configuration class. Represent a key / value pair with just a couple key (string) and value.
 *
 * Used for save the number of news in a page of the website.
 */
class Configuration {
    private $key;
    private $value;

    /**
     * Create a configuration.
     *
     * @param $key string The key of the configuration.
     * @param $value int The value of the configuration.
     */
    public function __construct(string $key, int $value) {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * Get the key of the configuration.
     *
     * @return string The key of the configuration.
     */
    public function getKey(): string {
        return $this->key;
    }

    /**
     * Set the key of the configuration.
     *
     * @param string $key The key to set on the configuration.
     */
    private function setKey(string $key) {
        $this->key = $key;
    }

    /**
     * Get the value of the configuration.
     *
     * @return int The value of the configuration.
     */
    public function getValue() : int {
        return $this->value;
    }

    /**
     * Set the value of the configuration.
     *
     * @param int $value The value to set on the configuration.
     */
    private function setValue(int $value) {
        $this->value = $value;
    }

    /**
     * Return a string representing the configuration.
     *
     * @return string A string representing the configuration.
     */
    public function __toString() : string {
        return '{' . $this->key . ' : ' . $this->value . '}';
    }
}