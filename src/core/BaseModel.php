<?php
namespace Komboamina\Ulizeko\Core;

class BaseModel{

    public function isNull($checkString){

        return $this->isBlank($checkString);

    }

    public function isBlank($checkString){

        $checkString=str_replace(' ','',strip_tags($checkString));

        return !strlen($checkString)>0;

    }

    public function getIP(){

        return $this->getIPAddress();

    }

    public function getIPAddress(){

        return $_SERVER['REMOTE_ADDR'];

    }

    public function generateURL($string){

        $url=strtolower($string);

        $url=str_replace(' ','-',$url);

        return $url;

    }

}
