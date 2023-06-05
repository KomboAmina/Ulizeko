<?php
namespace Komboamina\Ulizeko\Core;

class UlizekoView{

    private $route;

    private $controller;

    private $model;

    public function __construct($controller,$route){

        $this->route=$route;

        $this->controller=$controller;

        $this->model=$controller->model;

    }

    public function load(){

        echo "logical thing.";

    }

}