<?php

namespace App\Metier;

use PDO;

/**
 * Class Sql
 * @package App\Metier
 */

class Sql extends PDO {

    /**
     * @var
     */

    private $stmt;

    /**
     * Sql constructor.
     * @param $host
     * @param $database
     * @param $user
     * @param $password
     */

    public function __construct($host, $database, $user, $password){
		parent::__construct("mysql:host=" . $host. ";dbname=" . $database, $user, $password);
		$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

    /**
     * Lance une requête SQL
     * @param string $query
     * @param array $parameters
     * @return bool
     */

    public function query($query, array $parameters=[]){
		$this->stmt = parent::prepare($query);
		foreach($parameters as $name => $value){
			$this->stmt->bindValue($name, $value[0], $value[1]);
		}
		return $this->stmt->execute();
	}

    /**
     * Retourne les élements de la requête
     * @return mixed
     */
    
    public function get(){
		return $this->stmt->fetchAll();
	}

}