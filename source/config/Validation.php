<?php
/**
 * Name : Validation.php
 * Project : My RSS website
 * Usefulness : contains a Validation class, allowing verifications on data entered in forms.
 * Last Modification date : 05/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

/**
 * A Validation class. Used for validates fields in a form, when a user wants to connect himself.
 */

require_once('Constants.php');

class Validation {
    private static $_errors = true;

    static function str($val, string $inputName) {
        if (empty($val)) {
            self::throwError(Constants::EMPTY_ERROR . " " . $inputName, 921);
        }
        if (!is_string($val)) {
            self::throwError(Constants::INCORRECT_ERROR . " " . $inputName, 922);
        }
        if ($val != filter_var($val, FILTER_SANITIZE_STRING)) {
            self::throwError(Constants::INJECTION_ERROR . " " . $inputName, 923);
        }
    }

    static function int($val, string $inputName) {
        if (empty($val)) {
            self::throwError(Constants::EMPTY_ERROR . " " . $inputName, 900);
        }
        if (!is_numeric($val)) {
            var_dump($inputName);
            self::throwError(Constants::INCORRECT_ERROR . " " . $inputName, 901);
        }
        if ($val != filter_var($val, FILTER_VALIDATE_INT)) {
            self::throwError(Constants::INCORRECT_ERROR . " " . $inputName, 901);
        }
    }

    static function cleanInput(string $data): string {
        if ($data != null) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
        }
        return $data;
    }

    /**
     * @throws Exception
     */
    static function throwError($error = Constants::GLOBAL_ERROR, $errorCode = 0)  {
        if (self::$_errors == true) {
            throw new UserValidationException($error, $errorCode);
        }
    }
}