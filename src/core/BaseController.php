<?php
namespace Komboamina\Ulizeko\Core;

class BaseController{

    public $model;

    public function __construct($model){

        $this->model=$model;

    }

    public function relocate($url){

        if(filter_var($url,FILTER_VALIDATE_URL)){

            header("Location: ".$url);

        }

    }

}
