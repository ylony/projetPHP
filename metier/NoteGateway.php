<?php

namespace App\Metier;

/**
 * Class NoteGateway
 * @package App\Metier
 */

class NoteGateway {

    /**
     * @var Sql
     */

    private $con;

    /**
     * NoteGateway constructor.
     * @param Sql $con
     */

    public function __construct(Sql $con)
    {
        $this->con = $con;
    }

    /**
     * Insère une note dans la db
     * @param Note $n
     */

    public function insert(Note $n){
        $this->con->query("INSERT INTO note (message,date,valid,listId) VALUES (:message, :date, :valid, :listId)", array(
            ':message' => array($n->getMessage(), \PDO::PARAM_STR),
            ':date' => array($n->getDate(), \PDO::PARAM_STR),
            ':valid' => array($n->getValid(), \PDO::PARAM_INT),
            ':listId' => array($n->getListeId(), \PDO::PARAM_INT)
        ));
    }

    /**
     * Met à jour une note dans la db
     * @param int $id
     * @param string $message
     */

    public function update(int $id, string $message)
    {
        $this->con->query("UPDATE note SET message = :message WHERE id = :id", array(
            ':id' => array($id, \PDO::PARAM_INT),
            ':message' => array($message, \PDO::PARAM_STR)
        ));
    }

    /**
     * Supprime une note de la db
     * @param int $id
     */

    public function delete(int $id){
        $this->con->query("DELETE FROM note WHERE id = :id", array(
            ':id' => array($id, \PDO::PARAM_INT)
        ));
    }

    /**
     * Convertit une note issue de la db en objet Note
     * @param $data
     * @return Note
     */

    public function convertToNote($data) : Note {
        $note = new Note($data["message"], $data["listId"]);
        $note->setId($data["id"]);
        $note->setValid($data["valid"]);
        $note->setDate($data["date"]);
        return $note;
    }

    /**
     * Retourne une note via son id
     * @param int $id
     * @return Note|null
     */

    public function findOne(int $id) {
        $this->con->query("SELECT * FROM note WHERE id = :id", array(
            ':id' => array($id, \PDO::PARAM_INT)
        ));
        $data = $this->con->get();
        if(empty($data)) { return null; }
        return $this->convertToNote($data[0]);
    }

    /**
     * Retourne toutes les notes
     * @return array
     */

    public function findAll() : array{
        $array = array();
        $i = 0;
        $this->con->query("SELECT * FROM note");
        $data = $this->con->get();
        while(isset($data[$i])){
            $array[$i] = $this->convertToNote($data[$i]);
            $i++;
        }
        return $array;
    }

    /**
     * Compte le nombre de note d'une liste
     * @param int $id
     * @return mixed
     */

    public function countNoteByListeId(int $id){
        $this->con->query("SELECT COUNT(*) FROM note WHERE listId = :id", array(
            ':id' => array($id, \PDO::PARAM_INT)
        ));
        return $this->con->get()[0][0];
    }

    /**
     * Retourne des notes d'une liste en fonction de la page demandé
     * @param int $id
     * @param int $nb
     * @param int $page
     * @return array
     */

    public function findByListeId(int $id, int $nb, int $page) : array{
        $array = array();
        $i = 0;
        $this->con->query("SELECT * FROM note WHERE listId = :id LIMIT :offset, :nb", array(
            ':id' => array($id, \PDO::PARAM_INT),
            ':offset' => array($page * $nb, \PDO::PARAM_INT),
            ':nb' => array($nb, \PDO::PARAM_INT)
        ));
        $data = $this->con->get();
        while(isset($data[$i])){
            $array[$i] = $this->convertToNote($data[$i]);
            $i++;
        }
        return $array;
    }

    /**
     * Retourne toutes les notes d'une liste
     * @param int $id
     * @return array
     */
    
    public function findAllByListeId(int $id) : array{
        $array = array();
        $i = 0;
        $this->con->query("SELECT * FROM note WHERE listId = :id ", array(
            ':id' => array($id, \PDO::PARAM_INT)));
        $data = $this->con->get();
        while(isset($data[$i])){
            $array[$i] = $this->convertToNote($data[$i]);
            $i++;
        }
        return $array;
    }
}