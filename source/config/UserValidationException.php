<?php

class UserValidationException extends Exception {
    public function __construct(string $message, int $errorCode = 0, Exception $old = null) {
        parent::__construct($message, $errorCode, $old);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}