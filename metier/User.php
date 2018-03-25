<?php


namespace App\Metier;

/**
 * Class User
 * @package App\Metier
 */

class User {

	private $login, $password;

    /**
     * User constructor.
     * @param $login
     * @param $password
     */

    public function __construct($login, $password) {
		$this->setLogin($login);
		$this->setPassword($password);
	}

    /**
     * @return string
     */

    public function getLogin() : string {
		return $this->login;
	}

    /**
     * @param string $login
     */

    public function setLogin(string $login){
		$this->login = $login;
	}

    /**
     * @return string
     */

    public function getPassword() : string {
		return $this->password;
	}

    /**
     * @param string $password
     */
    
    public function setPassword(string $password){
		$this->password = $password;
	}
}