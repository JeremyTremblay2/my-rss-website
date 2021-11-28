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
require_once('Constants.php');
class Validation {

    static bool $errors = true;
    public string $msg;

    static function str(string $val) : ?string {
        try {
            if ((string)empty($val)) {
                throw new Exception(Constants::EMPTY_ERROR);
            }
            if (!is_string($val)) {
                throw new Exception(Constants::INCORRECT_ERROR);
            }
            else{
                return null; // self::cleanInput($val);
            }
        }
        catch (Exception $e) {
            return $e->getMessage();
        }
    }
    static function entier(int $val) : ?int {
        try {
            if (empty($val)) {
                self::throwError(Constants::EMPTY_ERROR, 900);
            }
            if (!is_int($val)) {
                self::throwError(Constants::INCORRECT_ERROR, 901);
            }
            return self::cleanInput($val);
        }
        catch (Exception $e){
            echo $e;
            return null;
        }
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