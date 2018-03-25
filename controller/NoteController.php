<?php

namespace App\Controller;

use App\Modele\NoteModele;
use App\Modele\ListeTacheModele;
use App\Modele\UserModele;
use App\Metier\User;
use App\Metier\Validate;
use App\Metier\Note;
use Exception;

/**
 * Class NoteController
 * @package App\Controller
 */

class NoteController {

    /**
     * NoteController constructor.
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
            case "deleteListe" :
                if(isset($_GET["id"])){
                    $id = Validate::toInt($_GET["id"]);
                    if(ListeTacheModele::isThisListePrivate($id)){
                        if(!empty(FrontController::$user)){
                            if(ListeTacheModele::checkAccess($id, FrontController::$user)){
                                ListeTacheModele::deleteListe($id, 1);
                                header('Location: ./');
                            }
                            else{
                                throw new Exception("Vous n'avez pas le droit de supprimer cette liste !");
                            }
                        }
                        else{
                            header('Location: ./?action=login'); // Si pas connecté on redirige vers la page de connexion
                        }
                    }
                    else{
                         ListeTacheModele::deleteListe($id);
                         header('Location: ./');
                    }    
                }
                else{
                    throw new Exception("Vous n'êtes pas supposé arriver ici :)");
                }
                
            break;

            case "ajouterNote" :
                if(isset($_POST["submit"])){
                    $message = Validate::clean($_POST["message"]);
                    $listeId = Validate::toInt($_POST["liste"]);
                    if(empty($message) || empty($listeId)){
                        throw new Exception("Au-moins un des champs est vide.");
                    }
                    $note = new Note($message, $listeId);
                    NoteModele::insertNote($note);
                    header('Location: ./');    
                }
                else{
                    if(file_exists($vues["ajouterNote"])) {
                        $dataListeNotePublic = ListeTacheModele::getAllListeTachePublic();
                        $dataListeNotePrivate = ListeTacheModele::getAllListeTachePrivate();
                        require($vues["ajouterNote"]);
                    }
                }

            break;

            case "supprimerNote" : 
                if(isset($_GET["id"])){
                    $id = Validate::toInt($_GET["id"]);
                    $note = NoteModele::testNote($id);
                    if($note != NULL){
                        if(ListeTacheModele::isThisListePrivate($note->getListeId())){
                            if(isset(FrontController::$user)){
                                if(ListeTacheModele::checkAccess($note->getListeId(), FrontController::$user)){
                                    NoteModele::deleteNote($id);    
                                    header('Location: ./');
                                }
                                throw new Exception("Vous ne pouvez pas supprimer cette note !");
                            }
                            throw new Exception("Vous ne pouvez pas supprimer cette note !");
                        }
                        else{
                            NoteModele::deleteNote($id);    
                            header('Location: ./');
                        }
                    }
                    else{
                        throw new Exception("La note n'existe pas !");
                    }
                }
            break;

            case "gestionListes" :
                if(file_exists($vues["gestionListes"])) {
                    $dataListeNotePublic = ListeTacheModele::getAllListeTachePublic();
                    $dataListeNotePrivate = ListeTacheModele::getAllListeTachePrivate();
                    require($vues["gestionListes"]);
                }
            break;

            default :
                if(file_exists($vues["vuePrincipal"])) {
                    if(isset($_GET["selectedList"])){
                        $id = Validate::toInt($_GET["selectedList"]);
                    
                    }else{
                        $id = NoteModele::getFirstListeId();
                    }
                    if(isset($_GET["page"])){
                        $page = Validate::toInt($_GET["page"]);
                    }else{
                        $page = 0;
                    }
                    $dataListeNotePublic = ListeTacheModele::getAllListeTachePublic();
                    $dataListeNotePrivate = ListeTacheModele::getAllListeTachePrivate();
                    if(ListeTacheModele::isThisListePrivate($id)){
                        if(!empty(FrontController::$user)){
                            if(ListeTacheModele::checkAccess($id, FrontController::$user)){
                                $dataNotes = NoteModele::getAllNoteFromListeId($id, $page);
                            }
                            else{
                                throw new Exception("Cette liste est privé !");
                            }
                        }else{
                            throw new Exception("Cette liste est privé !");
                        }
                    }else{
                        $dataNotes = NoteModele::getAllNoteFromListeId($id, $page);
                    }  
                    $nbNote = NoteModele::countNoteByListeId($id);
                    require($vues["vuePrincipal"]);
                }
            break;
        }
    }
}

