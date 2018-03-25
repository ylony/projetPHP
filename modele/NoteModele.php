<?php


namespace App\Modele;

use App\Metier\Sql;
use App\Metier\NoteGateway;
use App\Metier\ListeTacheGateway;
use App\Metier\Note;
use Exception;

/**
 * Class NoteModele
 * @package App\Modele
 */

class NoteModele {


    /**
     * Retourne toutes les notes
     * @return array
     */

    public static function getAllNote() : array {
        global $config;
        $con = new Sql($config["host"], $config["database"], $config["username"], $config["password"]);
        $noteGateway = new NoteGateway($con);
        return $noteGateway->findAll();
    }

    /**
     * Retourne toutes les notes à partir d'une id de liste
     * @param int $id
     * @param $page
     * @return array
     * @throws Exception
     */

    public static function getAllNoteFromListeId(int $id, $page) {
        global $config;
        if($id == NULL){ throw new Exception("La liste de note est introuvable."); }
        $con = new Sql($config["host"], $config["database"], $config["username"], $config["password"]);
        $noteGateway = new NoteGateway($con);
        $data = $noteGateway->findByListeId($id, $config["maxPerPage"], $page);
        if(empty($data) && $page > 0){
            throw new Exception("Cette page n'existe pas");
        }
        return $data;
    }

    /**
     * Insère une note en DB
     * @param Note $note
     */

    public static function insertNote(Note $note){
        global $config;
        $con = new Sql($config["host"], $config["database"], $config["username"], $config["password"]);
        $noteGateway = new NoteGateway($con);
        $noteGateway->insert($note);
    }

    /**
     * Supprime une note
     * @param int $note
     */

    public static function deleteNote(int $note){
        global $config;
        $con = new Sql($config["host"], $config["database"], $config["username"], $config["password"]);
        $noteGateway = new NoteGateway($con);
        $noteGateway->delete($note);
    }

    /**
     * Test si une note existe ou non
     * @param int $id
     * @return Note|null
     */

    public static function testNote(int $id){
        global $config;
        $con = new Sql($config["host"], $config["database"], $config["username"], $config["password"]);
        $noteGateway = new NoteGateway($con);
        $note = $noteGateway->findOne($id);
        if($note == null){
            return null;
        }
        return $note;
    }

    /**
     * Retourne le nombre de note contenu par une liste particulière
     * @param $id
     * @return null
     */

    public static function countNoteByListeId($id){
        global $config;
        $con = new Sql($config["host"], $config["database"], $config["username"], $config["password"]);
        $noteGateway = new NoteGateway($con);
        if($id == NULL){
            $listeGateWay = new ListeTacheGateway($con);
            $firstList = $listeGateWay->findLast();
            if(empty($firstList)){ return null; }
            $id = $firstList->getListeId(); 
        }
        return $noteGateway->countNoteByListeId($id);
    }

    /**
     * Retourne la première liste présente en base de données
     * @return int
     * @throws Exception
     */
    
    public static function getFirstListeId(){
        global $config;
        $con = new Sql($config["host"], $config["database"], $config["username"], $config["password"]);
        $listeGateWay = new ListeTacheGateway($con);
        $firstList = $listeGateWay->findLast();
        if(empty($firstList)){ throw new Exception("Aucunes listes trouvés "); }
        return $firstList->getListeId();
    }
}