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

        include_once "src".DS."common".DS."header.php";

        if(file_exists($baseFile="src".DS.$this->route.DS."base.php")){

            $this->showBreadCrumbs();

            $this->showTitle();

            include_once $baseFile;

        }
        
        else{

            $this->show404();

        }

        include_once "src".DS."common".DS."footer.php";

    }

    private function show404(){

        include_once "src".DS."common".DS."404.html";

    }

    private function showNoRecords(){

        include_once "src".DS."common".DS."no_records.html";

    }

    private function showTitle(){

        echo "<h1>".ucwords($this->route)."</h1>";

    }

    private function showBreadCrumbs(){

        include_once "src".DS."common".DS."breadcrumbs.php";

    }

    private function showArticleTopics($topics=array()){

        if(!empty($topics)){
            include "src".DS."common".DS."article_topics.php";
        }

    }

}
