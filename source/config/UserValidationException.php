<?php

/** Name : UserValidationException.php
 * Project : My RSS website
 * Usefulness : contains a UserValidationException class,new custom Exception .
 * Last Modification date : 29/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */


class UserValidationException extends Exception {
    /**
     * create an Exception
     * @param string $message message whose describe where is the Exception
     * @param int $errorCode code of the Exception
     * @param Exception|null $old if there's an old Exception we can put it here
     */
    public function __construct(string $message, int $errorCode = 0, Exception $old = null) {
        parent::__construct($message, $errorCode, $old);
    }

    /**
     * useful to print the Exception
     * @return string custom message to describe the Exception
     */
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}