<?php
/**
 * Name : Validation.php
 * Project : My RSS website
 * Usefulness : contains a Validation class, allowing verifications on data entered in forms.
 * Last Modification date : 29/12/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

/**
 * A Validation class. Used for validates fields in a form, when a user wants to connect himself.
 */

class Validation {
    private static $_errors = true;

    /**
     * Input string control
     * @param $val input who need to control
     * @param string $inputName name of the input
     * @return void
     * @throws Exception if it's not a string, or not a valid string, or if it's empty
     */
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

    /**
     * input int control
     * @param $val input who need to control
     * @param string $inputName name of the input
     * @return void
     * @throws Exception if it's not an integer, or not a valid itneger
     */
    static function int($val, string $inputName) {
        if (empty($val)) {
            self::throwError(Constants::EMPTY_ERROR . " " . $inputName, 924);
        }
        if (!is_numeric($val)) {
            self::throwError(Constants::INCORRECT_ERROR . " " . $inputName, 925);
        }
        if ($val != filter_var($val, FILTER_VALIDATE_INT)) {
            self::throwError(Constants::INJECTION_ERROR . " " . $inputName, 926);
        }
    }

    /**
     * Clean and sanitize a string.
     *
     * @param string|null $data The data to be cleaned
     * @return string|null return null if data is null, or return the value of the data after cleaning
     */
    static function cleanInput(?string $data): ?string {
        if ($data != null) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
        }
        return $data;
    }

    /**
     * Throw an exception.
     *
     * @param $error type of the Exception
     * @param $errorCode code of the Exception
     * @return void
     * @throws UserValidationException if there is an exception we throw a UserValidationException with type and code
     * of the Exception
     */
    static function throwError($error = Constants::GLOBAL_ERROR, $errorCode = 0)  {
        if (self::$_errors == true) {
            throw new UserValidationException($error, $errorCode);
        }
    }
}