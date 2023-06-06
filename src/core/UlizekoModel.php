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

}
