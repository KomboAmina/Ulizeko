<?php
namespace Ulizeko\Core;

class UlizekoModel extends ConnectedModel{

    /**
     * @var array $validActions
     */
    public $validActions=array();

    public function setValidActions($newActions):void{

        $this->validActions=$newActions;

    }

    /**
     * @param string $rawString Value to be turned into url slug.
     * @return string
     */
    public function generateSlug($rawString):string{

        return parent::generateURL($rawString);

    }

    /**
     * @return array $topics    An array of all topics in the database.
     */
    public function getAllTopics():array{

        $topics=array();

        $st=$this->dbcon->executeQuery("SELECT * FROM `topics` ORDER BY `topic` ASC",array());

        while($ro=$st->fetchObject()){

            $topics[]=$ro;

        }

        return $topics;

    }

}
