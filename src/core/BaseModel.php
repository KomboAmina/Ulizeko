<?php
namespace Ulizeko\Core;

class BaseModel{

    /**
     * @param string $checkString   String value to check
     * @return boolean
     */
    public function isNull($checkString):bool{

        return $this->isBlank($checkString);

    }

    /**
     * @param string $checkString   String value to check
     * @return boolean
     */
    public function isBlank($checkString){

        $checkString=str_replace(' ','',strip_tags($checkString));

        return !strlen($checkString)>0;

    }

    /**
     * @return string
     */
    public function getIP():string{

        return $this->getIPAddress();

    }

    /**
     * @return string
     */
    public function getIPAddress():string{

        return $_SERVER['REMOTE_ADDR'];

    }

    /**
     * @param string $string    String to be transformed
     * @return string $url  Transformed string, as this-kind-of-content
     */
    public function generateURL($rawString):string{

        $rawString=preg_replace("/[^A-Za-z0-9 ]/", '', strip_tags($rawString));

        $url=strtolower($rawString);

        $url=str_replace(' ','-',$url);

        return $url;

    }

}
