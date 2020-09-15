<?php
/**
 * Created by PhpStorm.
 * User: sstee
 * Date: 25/08/2020
 * Time: 16:08
 */

/**
 * Class Autoloader
 *
 *
 */
class Autoloader
{
    /**
     * Method Static function register
     */
    static function register()
    {
        /**
         * Call to spl_autoload_register
         */
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Method Static function autoload
     * @param string $className
     */
    static function autoload($className)
    {
        $configFile = file_get_contents("Config/config.json");
        $config = json_decode($configFile);

        foreach ($config->autoloadFolder as $folder) {
            $className = str_replace('App\\' . substr($folder, 1) . '\\', "", $className);

            if (file_exists('.' . $folder . '/' . $className . '.php')) {
                require_once('.' . $folder . '/' . $className . '.php');
                break;
            }
        }
    }
}