<?php

namespace App\Metier;

/**
 * Class Note
 * @package App\Metier
 */

class Note {

	private $id, $message, $date, $valid, $listeId;

    /**
     * Note constructor.
     * @param $message
     * @param $listeId
     */

    public function __construct($message, $listeId){
		$this->setMessage($message);
		$this->setValid(0);
		$this->setDate(date("d/m/Y"));
        $this->setListeId($listeId);
	}

    /**
     * @return int
     */

    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */

    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */

    public function getMessage() : string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */

    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */

    public function getDate() : string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */

    public function setDate(string $date)
    {
        $this->date = $date;
    }

    /**
     * @return int
     */

    public function getValid() : int
    {
        return $this->valid;
    }

    /**
     * @param int $valid
     */

    public function setValid(int $valid)
    {
        $this->valid = $valid;
    }

    /**
     * @return int
     */

    public function getListeId() : int
    {
        return $this->listeId;
    }

    /**
     * @param int $listeId
     */

    public function setListeId(int $listeId)
    {
        $this->listeId = $listeId;
    }
    
}