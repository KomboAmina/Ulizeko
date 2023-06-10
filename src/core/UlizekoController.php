<?php
namespace Ulizeko\Core;

class UlizekoController extends BaseController{

    public $currentAction="intro";

    public function __construct($model,$validActions=array()){

        parent::__construct($model);

        $this->handleFormSubmissions();

        if(!empty($validActions) && property_exists($this->model,"validActions")){

            $this->model->validActions=$validActions;

            $this->currentAction=$this->getCurrentAction();

        }

    }

    protected function handleFormSubmissions(){

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

    protected function formatMethodName($actName){

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

    public function getCurrentAction(){

        $return=$this->currentAction;

        if(property_exists($this->model,"validActions") &&
        (isset($_GET['levelb']) &&
        in_array($_GET['levelb'],$this->model->validActions))){

            $return=$_GET['levelb'];

        }

        return $return;

    }

}
