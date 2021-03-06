<?php
/** Name : Autoload.php
 * Project : My RSS website
 * Usefulness : contains a Autoload class, allows to include php classes and files.
 * Last Modification date : 29/12/2021
 * Authors : Sebastien SALVA, Sabastien VIALLEMONTEIL
 */
class Autoload {
    private static $_instance = null;

    /**
     * @return bool true if the autoload is already started
     */
    public static function isStarted(): bool {
        return !self::$_instance == null;
    }

    /**
     * Load the different classes
     * @return void
     * @throws RuntimeException If a problem occurs when you start the autoloader or if it's already started
     */
    public static function charger()
    {
        if (self::$_instance !== null) {
            throw new RuntimeException(sprintf('%s is already started', __CLASS__));
        }
        self::$_instance = new self();

        if (!spl_autoload_register(array(self::$_instance, '_autoload'), false)) {
            throw new RuntimeException(sprintf('%s : Could not start the autoload', __CLASS__));
        }
    }

    /**
     * Unload the different classes
     * @return void
     * @throws RuntimeException If a problem occurs when you stop the autoloader
     */
    public static function shutDown()
    {
        if (self::$_instance !== null) {
            if (!spl_autoload_unregister(array(self::$_instance, '_autoload'))) {
                throw new RuntimeException('Could not stop the autoload');
            }
            self::$_instance = null;
        }
    }

    /**
     * Include the file whose name is passed in parameter
     * @param $class name of classe to be load
     * @return void
     */
    private static function _autoload($class) {
        global $localPath;
        $filename = $class . '.php';
        $directory = array('models/', 'models/job/', './', 'config/', 'controllers/', 'views/', 'parser/');
        foreach ($directory as $folder) {
            $file = $localPath . $folder . $filename;

            if (file_exists($file)) {
                include $file;
            }
        }
    }
}
?>