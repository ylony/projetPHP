<?php

namespace App\Metier;

/**
 * Class ListeTacheGateway
 * @package App\Metier
 */

class ListeTacheGateway {

    /**
     * @var Sql
     */

    private $con;

    /**
     * ListeTacheGateway constructor.
     * @param Sql $con
     */

    public function __construct(Sql $con)
    {
        $this->con = $con;
    }

    /**
     * Ajoute une liste de tache dans la db
     * @param ListeTache $n
     */

    public function insert(ListeTache $n){
        $this->con->query("INSERT INTO listeTache (nom,isPrivate) VALUES (:nom, :isPrivate)", array(
            ':nom' => array($n->getNom(), \PDO::PARAM_STR),
            ':isPrivate' => array($n->getPrivate(), \PDO::PARAM_INT)
        ));
    }

    /**
     * Met à jour une liste de tache
     * @param int $id
     * @param int $isPrivate
     */

    public function update(int $id, int $isPrivate)
    {
        $this->con->query("UPDATE listeTache SET isPrivate = :isPrivate WHERE listeId = :id", array(
            ':id' => array($id, \PDO::PARAM_INT),
            ':isPrivate' => array($isPrivate, \PDO::PARAM_INT)
        ));
    }

    /**
     * Supprime une liste de tache via son id
     * @param int $id
     */

    public function delete(int $id){
        $this->con->query("DELETE FROM listeTache WHERE listeId = :id", array(
            ':id' => array($id, \PDO::PARAM_INT)
        ));
    }

    /**
     * Convertit une liste issue de la db en objet ListeTache
     * @param $data
     * @return ListeTache
     */

    public function convertToListeTache($data) : ListeTache {
        $liste = new ListeTache($data["nom"], $data["isPrivate"]);
        $liste->setListeId($data["listeId"]);
        return $liste;
    }

    /**
     * Retourne une liste via son id
     * @param int $id
     * @return ListeTache|null
     */

    public function findOne(int $id) {
        $this->con->query("SELECT * FROM listeTache WHERE listeId = :id", array(
            ':id' => array($id, \PDO::PARAM_INT)
        ));
        $data = $this->con->get();
        if(empty($data)){ return NULL; }
        return $this->convertToListeTache($data[0]);
    }

    /**
     * Retourne toutes les listes publiques
     * @return array
     */

    public function findAllPublic() : array{
        $array = array();
        $i = 0;
        $this->con->query("SELECT * FROM listeTache where isPrivate = 0");
        $data = $this->con->get();
        while(isset($data[$i])){
            $array[$i] = $this->convertToListeTache($data[$i]);
            $i++;
        }
        return $array;
    }

    /**
     * Retournes toutes les listes privées
     * @param int $id
     * @return array|null
     */

    public function findAllPrivate(int $id){
        $array = array();
        $i = 0;
        $this->con->query("SELECT * FROM userListe where idUser = :idUser", array(
            ':idUser' => array($id, \PDO::PARAM_INT)
        ));
        $data = $this->con->get();
        if(empty($data)){ return NULL; }
        while(isset($data[$i])){
            $array[$i] = $this->findOne($data[$i]["idListe"]);
            $i++;
        }
        return $array;
    }

    /**
     * Retourne la première liste privé dans la db
     * @return ListeTache|null
     */

    public function findLast(){
        $this->con->query("SELECT * FROM listeTache WHERE isPrivate = 0 LIMIT 1");
        $data = $this->con->get();
        if(!empty($data)){
            return $this->convertToListeTache($data[0]);
        }
        return null;
    }

    /**
     * Retourne la derniere liste privé inséré dans la db
     * @return mixed
     */

    public function findLastPrivateId(){
        $this->con->query("SELECT * FROM listeTache WHERE isPrivate = 1 ORDER BY listeId DESC LIMIT 1");
        return $this->con->get()[0]["listeId"];
    }

    /**
     * Check si un utilisateur peut accéder à une liste ou non
     * @param int $idUser
     * @param int $listeId
     * @return bool
     */

    public function checkAccess(int $idUser, int $listeId){
       $this->con->query("SELECT * FROM userListe WHERE idUser = :idUser AND idListe = :idListe", array(
            ':idUser' => array($idUser, \PDO::PARAM_INT),
            ':idListe' => array($listeId, \PDO::PARAM_INT)
        ));
        $data = $this->con->get();
        if(!empty($data)){
            return true;
        }
        return false; 
    }

    /**
     * Donne les droits à un utilisateur d'accéder à une liste
     * @param int $listeId
     * @param int $idUser
     */

    public function insertAccess(int $listeId, int $idUser){
       $this->con->query("INSERT INTO userListe VALUES(:idUser, :idListe)", array(
            ':idUser' => array($idUser, \PDO::PARAM_INT),
            ':idListe' => array($listeId, \PDO::PARAM_INT)
        ));
    }

    /**
     * Supprime une liste ainsi que toutes les notes associées
     * @param int $listeId
     */

    public function deleteListe(int $listeId){
        $noteGateway = new NoteGateway($this->con);
        $this->con->query("SELECT * FROM listeTache WHERE listeId = :id", array(
            ':id' => array($listeId, \PDO::PARAM_INT)));
        $data = $this->con->get();
        if(empty($data)){
            throw new Exception("Cette liste n'existe pas et ne donc pas être supprimé");
        }
        $allNote = $noteGateway->findAllByListeId($listeId);
        for($i = 0; isset($allNote[$i]); $i++){
            $noteGateway->delete($allNote[$i]->getId());
        }
        $this->delete($data[0]["listeId"]);
    }

    /**
     * Supprime les droits à un utilisateur d'accéder à une liste
     * @param int $listeId
     */
    
    public function removeAccess(int $listeId){
        $this->con->query("DELETE FROM userListe WHERE idListe = :idListe", array(
            ':idListe' => array($listeId, \PDO::PARAM_INT)
        ));
    }
}