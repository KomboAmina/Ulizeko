<?php
namespace Ulizeko\Core;

class RoutesModel extends BaseModel{

    /**
     * @var array $validRoutes
     */
    public $validRoutes=array();

    public function __construct(){

        $this->validRoutes=$this->getValidRoutes();

        $this->defaultRoute=$this->getDefaultRoute();

    }

    /**
     * @return array $routes    Array of valid routes.
     */
    private function getValidRoutes():array{

        $routes=array("topics","articles","search","about");

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

    /**
     * @return string
     */
    public function getDefaultRoute():string{

        return (!empty($this->validRoutes)) ? $this->validRoutes[0]:"";

    }

    /**
     * @return boolean
     */
    public function isValidRoute($checkString):boolean{

        return in_array($checkString,$this->validRoutes);

    }

}
