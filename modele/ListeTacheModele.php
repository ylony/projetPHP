<?php


namespace App\Modele;

use App\Metier\ListeTache;
use App\Metier\Sql;
use App\Metier\ListeTacheGateway;
use App\Metier\UserGateway;
use App\Controller\FrontController;
use Exception;

/**
 * Class ListeTacheModele
 * @package App\Modele
 */

class ListeTacheModele {

    /**
     * Insère une liste dans la db en effectuant des tests
     * @param ListeTache $liste
     */

    public static function insertListe(ListeTache $liste){
        global $config;
        $con = new Sql($config["host"], $config["database"], $config["username"], $config["password"]);
        $listeGateway = new ListeTacheGateway($con);
        if($liste->getPrivate() == 1){
            if(empty(FrontController::$user)){
                header('Location: ./?action=login');
                exit;
            }
            else{
                $listeGateway->insert($liste);
                $userGateway = new UserGateway($con);
                $listeGateway->insertAccess($listeGateway->findLastPrivateId(), $userGateway->getUserId(FrontController::$user)); 
                return;
            }
        }
        $listeGateway->insert($liste);
    }

    /**
     * Retourne toutes les listes de taches publiques à l'aide de la gateway
     * @return array
     */

    public static function getAllListeTachePublic() : array {
        global $config;
        $con = new Sql($config["host"], $config["database"], $config["username"], $config["password"]);
        $listeGateway = new ListeTacheGateway($con);
        return $listeGateway->findAllPublic();
    }

    /**
     * Retourne toutes les listes de taches privées à l'aide de la gateway
     * @return array|null
     */

    public static function getAllListeTachePrivate(){
        global $config;
        if(isset($_SESSION["user"])){
        	$con = new Sql($config["host"], $config["database"], $config["username"], $config["password"]);
        	$listeGateway = new ListeTacheGateway($con);
        	$userGateway = new UserGateway($con);
        	$idUser = $userGateway->getUserId($_SESSION["user"]);
        	return $listeGateway->findAllPrivate($idUser);
        }else{
        	return NULL;
        }  
    }

    /**
     * Check si la liste donnée est privée ou non
     * @param int $id
     * @return bool
     * @throws Exception
     */

    public static function isThisListePrivate(int $id){
        global $config;
        $con = new Sql($config["host"], $config["database"], $config["username"], $config["password"]);
        $listeGateway = new ListeTacheGateway($con);
        $liste = $listeGateway->findOne($id);
        if($liste == NULL){ throw new Exception("La liste n'existe pas"); }
        if($liste->getPrivate() == 1){
        	return true;
        }
        return false;
    }

    /**
     * Check si un utilisateur possède l'accès à cette liste ou non à l'aide de la gateway
     * @param int $listeId
     * @param string $user
     * @return bool
     */

    public static function checkAccess(int $listeId, string $user){
    	global $config;
        $con = new Sql($config["host"], $config["database"], $config["username"], $config["password"]);
        $listeGateway = new ListeTacheGateway($con);
        $userGateway = new UserGateway($con);
        $idUser = $userGateway->getUserId($_SESSION["user"]);
        return $listeGateway->checkAccess($idUser, $listeId);
    }

    /**
     * Supprime une liste à l'aide de la gateway
     * @param int $listeId
     * @param int $isPrivate
     */
    
    public static function deleteListe(int $listeId, $isPrivate = 0){
        global $config;
        $con = new Sql($config["host"], $config["database"], $config["username"], $config["password"]);
        $listeGateway = new ListeTacheGateway($con);
        $listeGateway->deleteListe($listeId);
        if($isPrivate = 1){
           $listeGateway->removeAccess($listeId); 
        }
    }

}