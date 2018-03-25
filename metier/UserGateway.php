<?php


namespace App\Metier;

/**
 * Class UserGateway
 * @package App\Metier
 */

class UserGateway {

    /**
     * @var Sql
     */

    private $con;

    /**
     * UserGateway constructor.
     * @param Sql $con
     */

    public function __construct(Sql $con)
    {
        $this->con = $con;
    }

    /**
     * Insère un utilisateur dans la db
     * @param User $n
     */

    public function insert(User $n){
        $this->con->query("INSERT INTO users (login,password) VALUES (:login, :password)", array(
            ':login' => array($n->getLogin(), \PDO::PARAM_STR),
            ':password' => array($n->getPassword(), \PDO::PARAM_STR)
        ));
    }

    /**
     * Méthode de connexion
     * @param User $n
     * @return bool
     */

    public function login(User $n) : bool {
        $this->con->query("SELECT * FROM users WHERE login = :login", array(
            ':login' => array($n->getLogin(), \PDO::PARAM_STR)
        ));
        $data = $this->con->get();
        if(empty($data)){ return false; }
        if(!password_verify($n->getPassword(), $data[0]["password"])){
            return false;
        }
        return true;
    }

    /**
     * Check si un utilisateur existe
     * @param User $n
     * @return bool
     */

    public function checkUserExists(User $n) : bool {
        $this->con->query("SELECT login FROM users WHERE login = :login", array(
            ':login' => array($n->getLogin(), \PDO::PARAM_STR)
        ));
        $data = $this->con->get();
        if(empty($data)){ return true; }
        return false;
    }

    /**
     * Retourne l'id d'un utilisateur en fonction de son login
     * @param string $nom
     * @return int
     */
    
    public function getUserId(string $nom) : int {
        $this->con->query("SELECT id FROM users WHERE login = :login", array(
            ':login' => array($nom, \PDO::PARAM_STR)
        ));
        $data = $this->con->get();
        if(empty($data)){ return false; }
        return $data[0]["id"];
    }
}