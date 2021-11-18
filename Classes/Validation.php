<?php
/**
 * Name : Validation.php
 * Project : My RSS website
 * Usefulness : contains a Validation class, allowing verifications on data entered in forms.
 * Last Modification date : 18/11/2021
 * Authors : Maxime GRANET, Jérémy TREMBLAY
 */

/**
 * A Validation class. Used for validates fields in a form, when a user wants to connect himself.
 */
class Validation {

    static bool $errors = true;

    static function str(string $val) : string {
        if (empty($val)) {
            self::throwError(Constants::EMPTY_ERROR, 900);
        }
        if (!is_string($val)) {
            self::throwError(Constants::INCORRECT_ERROR, 901);
        }
        return self::cleanInput($val);
    }

    static function cleanInput(string $data): string {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }

    static function throwError($error = Constants::GLOBAL_ERROR, $errorCode = 0) {
        if (self::$errors == true) {
            throw new Exception($error, $errorCode);
        }
    }
}