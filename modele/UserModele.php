<?php

namespace App\Modele;

use App\Metier\Sql;
use App\Metier\NoteGateway;
use App\Metier\User;
use App\Metier\UserGateway;
use App\Metier\Validate;
use Exception;

/**
 * Class UserModele
 * @package App\Modele
 */

class UserModele{

    /**
     * Méthode de connexion avec tous les tests
     * @throws Exception
     */

    public static function login(){
		global $config;
        $con = new Sql($config["host"], $config["database"], $config["username"], $config["password"]);
		if(!empty($_POST["login"]) && !empty($_POST["password"])){
			$nomDeCompte = Validate::clean($_POST["login"]);
			$password = Validate::cryptLogin($nomDeCompte, $_POST["password"]);
			$userGateway = new UserGateway($con);
			if($userGateway->login(new User($nomDeCompte, $password))){
				$_SESSION["user"] = $nomDeCompte;
				header('Location: ./');
			}
			else{
				throw new Exception("Le nom de compte ou mot de passe est incorrect");
			}
		}
		throw new Exception("Au-moins un des champs est vide");
	}

    /**
     * Méthode d'inscription avec tous les tests
     * @throws Exception
     */
    
    public static function register(){
		global $config;
        $con = new Sql($config["host"], $config["database"], $config["username"], $config["password"]);
		if(!empty($_POST["login"]) && !empty($_POST["password"])){
			$nomDeCompte = Validate::clean($_POST["login"]);
			$password = Validate::crypt($nomDeCompte, $_POST["password"]);
			$userGateway = new UserGateway($con);
			$u = new User($nomDeCompte, $password);
			if($userGateway->checkUserExists($u)){
				$userGateway->insert($u);
				header('Location: ./');
			}
			else {
				throw new Exception("L'utilisateur existe déjà");
			}
		}
		throw new Exception("Au-moins un des champs est vide");
	}
}