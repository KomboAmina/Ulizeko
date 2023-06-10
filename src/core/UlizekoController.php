<?php
namespace Ulizeko\Core;

class UlizekoController extends BaseController{

    /**
     * @var string $currentAction
     */
    public $currentAction="intro";

    /**
     * @param \Ulizeko\Core\UlizekoModel $model Model for this controller
     * @param array $validActions   Array of valid actions for this controller
     */
    public function __construct($model,$validActions=array()){

        parent::__construct($model);

        $this->handleFormSubmissions();

        if(!empty($validActions) && property_exists($this->model,"validActions")){

            $this->model->validActions=$validActions;

            $this->currentAction=$this->getCurrentAction();

        }

    }

    protected function handleFormSubmissions():void{

        if(isset($_POST['act'])){

            $methodName=$this->formatMethodName($_POST['act']);

            $ret=false;

            if(method_exists($this,$methodName)){

                $ret=$this->$methodName();

            }

            if(filter_var($ret,FILTER_VALIDATE_URL)){

                $this->relocate($ret);

            }
            else{

                $this->reloadPage();

            }

        }

    }

    /**
     * @param string $actName   Name of value taken from $_POST['act']
     * @return string $methodName   Name of method formatted from $actName
     */
    protected function formatMethodName($actName):string{

        $methodName="";

        $stuff=explode(' ',strtolower($actName));

        for($s=0;$s<count($stuff);$s++){

            if($s>0){

                $methodName.=ucwords($stuff[$s]);

            }
            else{

                $methodName.=$stuff[$s];

            }

        }

        return $methodName;

    }

    /**
     * @return string $return   the current action to be performed.
     */
    public function getCurrentAction():string{

        $return=$this->currentAction;

        if(property_exists($this->model,"validActions") &&
        (isset($_GET['levelb']) &&
        in_array($_GET['levelb'],$this->model->validActions))){

            $return=$_GET['levelb'];

        }

        return $return;

    }

}
