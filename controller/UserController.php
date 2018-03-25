<?php

namespace App\Controller;

use App\Metier\Validate;
use App\Modele\UserModele;
use App\Metier\ListeTache;
use App\Modele\ListeTacheModele;
use Exception;

/**
 * Class UserController
 * @package App\Controller
 */

class UserController{

    /**
     * UserController constructor.
     */

    public function __construct() {
        if(isset($_GET["action"])){
        	$action = Validate::clean($_GET["action"]);
            $this->getVue($action); 
        }
        else{
            $this->getVue();
        }
    }

    /**
     * Implémente la bonne vue en fonction de l'action demandé
     * @param string|NULL $str
     * @throws Exception
     */

    public function getVue(string $str = NULL) {
        global $vues;
        switch($str){
            case "login" :
                if(file_exists($vues["login"])) {
                    $error = NULL;
                    try{
                        if(isset($_POST["submit"])){
                            UserModele::login();
                        }
                    }catch(Exception $e){
                        $error = $e->getMessage();
                    }
                    require($vues["login"]);
                }
                break;

            case "addListe" :
                if(file_exists($vues["addListe"])){
                    if(isset($_POST["submit"])){
                        $nom = Validate::clean($_POST["listeName"]);
                        $isPrivate = 0;
                        if(isset($_POST["isPrivate"])){
                            $isPrivate = 1;
                        }
                        if(empty($nom)){
                            throw new Exception("Le champs nom est vide.");
                        }
                        $listeTache = new ListeTache($nom, $isPrivate);
                        ListeTacheModele::insertListe($listeTache);
                        header('Location: ./');    
                    }
                    require($vues["addListe"]);
                } 
            break;

            case "register" :
                if(file_exists($vues["register"])) {
                    $error = NULL;
                    try{
                        if(isset($_POST["submit"])){
                            UserModele::register();
                        }
                    }catch(Exception $e){
                        $error = $e->getMessage();
                    }
                    require($vues["register"]);
                }
            break;

            case "logout" :
                session_destroy();
                $_SESSION["user"] = NULL;
                header('location: ./');
            break;
            
        }
    }
}
