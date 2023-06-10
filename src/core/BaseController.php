<?php
namespace Ulizeko\Core;

class BaseController{

    /**
     * @var \Ulizeko\Core\BaseModel $model
     */
    public $model;

    /**
     * @param \Ulizeko\Core\BaseModel   Model for this controller
     */
    public function __construct($model){

        $this->model=$model;

    }

    public function reloadPage():void{

        $this->relocate($this->getCurrentURL());

    }

    /**
     * @param string $url   URL string to replace into address bar.
     */
    public function relocate($url):void{

        if(filter_var($url,FILTER_VALIDATE_URL)){

            header("Location: ".$url);

        }

    }

    /**
     * @return string
     */
    public function getCurrentURL():string{

        return (empty($_SERVER['HTTPS']) ? 'http' : 'https')."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    }

}
