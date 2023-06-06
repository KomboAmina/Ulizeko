<?php
namespace Komboamina\Ulizeko\Core;

class RoutesModel extends BaseModel{

    public $validRoutes=array();

    public function __construct(){

        $this->validRoutes=$this->getValidRoutes();

        $this->defaultRoute=$this->getDefaultRoute();

    }

    private function getValidRoutes(){

        $routes=array("topics","articles","search");

        if(defined(ALLOWADD) && ALLOWADD){
            $routes[]="add";
        }
        if(defined(ALLOWEDIT) && ALLOWEDIT){
            $routes[]="edit";
        }
        if(defined(ALLOWDELETE) && ALLOWDELETE){
            $routes[]="delete";
        }

        return $routes;

    }

    public function getDefaultRoute(){

        return (!empty($this->validRoutes)) ? $this->validRoutes[0]:"";

    }

    public function isValidRoute($checkString){

        return in_array($checkString,$this->validRoutes);

    }

}
