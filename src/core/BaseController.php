<?php
namespace Ulizeko\Core;

class BaseController{

    public $model;

    public function __construct($model){

        $this->model=$model;

    }

    public function reloadPage(){

        $this->relocate($this->getCurrentURL());

    }

    public function relocate($url){

        if(filter_var($url,FILTER_VALIDATE_URL)){

            header("Location: ".$url);

        }

    }

    public function getCurrentURL(){

        return (empty($_SERVER['HTTPS']) ? 'http' : 'https')."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    }

}
