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
    static $errors = true;

    static function str(string $val): ?string {
        if ((string) empty($val)) {
            self::throwError(Constants::EMPTY_ERROR, 900);
        }
        if (!is_string($val)) {
            self::throwError(Constants::INCORRECT_ERROR, 901);
        }
        return self::cleanInput($val);
    }

    static function int(int $val) : ?int {
        if ((int) empty($val)) {
            self::throwError(Constants::EMPTY_ERROR, 900);
        }
        if (!is_int($val)) {
            self::throwError(Constants::INCORRECT_ERROR, 901);
        }
        return self::cleanInput($val);
    }

    static function cleanInput(string $data): string {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }

    /**
     * @throws Exception
     */
    static function throwError($error = Constants::GLOBAL_ERROR, $errorCode = 0)  {
        if (self::$errors == true) {
            throw new Exception($error, $errorCode);
        }
    }
}