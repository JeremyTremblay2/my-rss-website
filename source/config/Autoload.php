<?php

class Autoload
{
    private static $_instance = null;

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

    public static function shutDown()
    {
        if (self::$_instance !== null) {
            if (!spl_autoload_unregister(array(self::$_instance, '_autoload'))) {
                throw new RuntimeException('Could not stop the autoload');
            }
            self::$_instance = null;
        }
    }

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