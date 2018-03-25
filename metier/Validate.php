<?php

namespace App\Metier;

/**
 * Class Validate
 * @package App\Metier
 */

class Validate {

    /**
     * Nettoie une chaîne de caractères
     * @param string|NULL $str
     * @return string
     */

    public static function clean(string $str = NULL) : string {
        return filter_var($str, FILTER_SANITIZE_STRING);
    }

    /**
     * Check si la string donnée est bien un email ou non
     * @param string|NULL $str
     * @return bool
     */

    public static function checkMail(string $str = NULL) : bool {
        return filter_var($str, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Force la variable à être un int
     * @param string|NULL $str
     * @return int
     */

    public static function toInt(string $str = NULL) : int {
        return intval($str);
    }

    /**
     * Crypte deux chaines de caractères en une avec un ":" entre à l'aide de password_hash
     * @param $str1
     * @param $str2
     * @return bool|string
     */

    public static function crypt($str1, $str2){
    	return password_hash(SHA1(strtoupper($str1) . ":" . strtoupper($str2)), PASSWORD_DEFAULT);
    }

    /**
     * Crypte deux chaines de caractères en une avec un ":" entre
     * @param $str1
     * @param $str2
     * @return string
     */
    
    public static function cryptLogin($str1, $str2){
    	return SHA1(strtoupper($str1) . ":" . strtoupper($str2));
    }
}