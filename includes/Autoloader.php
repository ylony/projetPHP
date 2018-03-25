<?php

namespace App\Includes;

/**
 * Class Autoloader
 * @package App\Includes
 */

class Autoloader {

    public static function register() {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    public static function autoload($class) {
        $class = explode('\\', $class);
        array_shift($class); // On enleve le "App" en trop pour l'inclusion
        $className = array_pop($class); // On enlève le dernier élément pour l'inclusion tout en le récupérant
        $path = implode('\\', $class);
        $file = $className.'.php';
        $filepath = __DIR__ . '/../' . strtolower($path) . '/' . $file;
        if(file_exists($filepath)) {
            require_once $filepath;
        }
    }

}