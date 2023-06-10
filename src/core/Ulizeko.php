<?php
namespace Ulizeko\Core;

class Ulizeko{

    /**
     * @var string $route
     */
    private $route="read";

    /**
     * @var \Ulizeko\Core\BaseModel $model
     */
    private $model;

    /**
     * @var \Ulizeko\Core\BaseController $controller
     */
    private $controller;

    /**
     * @var \Ulizeko\Core\UlizekoView $view
     */
    private $view;

    public function __construct(){

        $this->route=$this->getRoute();

        $this->model=$this->getActiveModel();

        $this->controller=$this->getActiveController();

        $this->view=new \Ulizeko\Core\UlizekoView($this->controller,$this->route);

        if(method_exists($this->view,"load")){

            $this->view->load();

        }

    }

    /**
     * @return string $route    Current active route
     */
    private function getRoute():string{

        $route="";

        $routesModel=new \Ulizeko\Core\RoutesModel();

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

    /**
     * @return \Ulizeko\Core]UlizekoModel
     */
    public function getActiveModel():\Ulizeko\Core\UlizekoModel{

        $desiredClass="\\Ulizeko\\".ucwords($this->route)."\\".ucwords($this->route)."Model";
        
        $defaultClass="\\Ulizeko\\Core\\UlizekoModel";

        return (class_exists($desiredClass)) ? new $desiredClass():new $defaultClass();

    }

    /**
     * @return \Ulizeko\Core\UlizekoController
     */
    public function getActiveController():Ulizeko\Core\UlizekoController{

        $desiredClass="\\Ulizeko\\".ucwords($this->route)."\\".ucwords($this->route)."Controller";
        
        $defaultClass="\\Ulizeko\\Core\\UlizekoController";

        return (class_exists($desiredClass)) ? new $desiredClass($this->model):new $defaultClass($this->model);

    }

}
