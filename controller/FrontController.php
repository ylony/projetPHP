<?php
namespace App\Controller;

session_start();

use App\metier\Validate;
use Exception;

/**
 * Class FrontController
 * @package App\Controller
 */

class FrontController{

    /**
     * @var string
     */

    public static $user;

    /**
     * @var array
     */

    private $actionUser = array("addListe","login", "logout", "register");

    /**
     * FrontController constructor.
     */

    public function __construct(){
		if(isset($_SESSION["user"])){
        	self::$user = Validate::clean($_SESSION["user"]);
        }else{
        	self::$user = 0;
        }
		if(isset($_GET["action"])){
			$action = Validate::clean($_GET["action"]);
            $this->getController($action); 
        }
        else{
            $this->getController();
        }
	}

    /**
     * Retourne le bon controller en fonction de l'action demandé
     * @param null $action
     */
    
    public function getController($action = null){
        global $vues;
		if(in_array($action, $this->actionUser, TRUE)){
			try{
				$controller = new UserController();
			}catch(Exception $e){
				$erreur = $e->getMessage();
				require($vues["erreur"]);
			}
		}
		else{
			try{
				$controller = new NoteController();
			}catch(Exception $e){
				$erreur = $e->getMessage();
				require($vues["erreur"]);
			}
		}
	}
}