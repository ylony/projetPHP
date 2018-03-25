<?php

namespace App\Metier;

/**
 * Class ListeTache
 * @package App\Metier
 */

class ListeTache {

    private $listeId, $nom, $private;

    /**
     * ListeTache constructor.
     * @param $nom
     * @param $private
     */

    public function __construct($nom, $private){
		$this->setNom($nom);
		$this->setPrivate($private);
	}

    /**
     * @return int
     */

    public function getListeId() : int
    {
        return $this->listeId;
    }

    /**
     * @param int $id
     */

    public function setListeId(int $listeId)
    {
        $this->listeId = $listeId;
    }

    /**
     * @return string
     */

    public function getNom() : string
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */

    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return int
     */

    public function getPrivate() : int
    {
        return $this->private;
    }

    /**
     * @param int $private
     */
    
    public function setPrivate(int $private)
    {
        $this->private = $private;
    }

}