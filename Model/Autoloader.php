<?php

class Autoloader
{

    static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

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