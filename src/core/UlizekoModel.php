<?php
namespace Komboamina\Ulizeko\Core;

class UlizekoModel extends ConnectedModel{

    public $validActions=array();

    public function setValidActions($newActions){

        $this->validActions=$newActions;

    }

    public function generateSlug($string){

        return $this->generateURL($string);

    }

    public function getAllTopics(){

        $topics=array();

        $st=$this->dbcon->executeQuery("SELECT * FROM `topics` ORDER BY `topic` ASC",array());

        while($ro=$st->fetchObject()){

            $topics[]=$ro;

        }

        return $topics;

    }

}
