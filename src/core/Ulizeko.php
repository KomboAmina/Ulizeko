<?php
namespace Komboamina\Ulizeko\Core;

class Ulizeko{

    private $route="read";

    private $model;

    private $controller;

    private $view;

    public function __construct(){

        $this->route=$this->getRoute();

        $this->model=$this->getActiveModel();

        $this->controller=$this->getActiveController();

        $this->view=new \Komboamina\Ulizeko\Core\UlizekoView($this->controller,$this->route);

        if(method_exists($this->view,"load")){

            $this->view->load();

        }

    }

    private function getRoute(){

        $route="";

        $routesModel=new \Komboamina\Ulizeko\Core\RoutesModel();

        if(!isset($_GET['levela'])){

            header("Location: ".URL.$routesModel->defaultRoute."/");

        }
        else{

            $isValidRoute=$routesModel->isValidRoute($_GET['levela']);

            switch($isValidRoute){

                case true: case 1:
                    
                    $route=$_GET['levela'];

                break;

                default:

                    header("Location: ".URL.$routesModel->defaultRoute."/");

                break;

            }

        }
        
        return $route;

    }

    public function getActiveModel(){

        $desiredClass="\\Komboamina\\Ulizeko\\".ucwords($this->route)."\\".ucwords($this->route)."Model";
        
        $defaultClass="\\Komboamina\\Ulizeko\\Core\\UlizekoModel";

        return (class_exists($desiredClass)) ? new $desiredClass():new $defaultClass();

    }

    public function getActiveController(){

        $desiredClass="\\Komboamina\\Ulizeko\\".ucwords($this->route)."\\".ucwords($this->route)."Controller";
        
        $defaultClass="\\Komboamina\\Ulizeko\\Core\\UlizekoController";

        return (class_exists($desiredClass)) ? new $desiredClass($this->model):new $defaultClass($this->model);

    }

}
