<?php
namespace Ulizeko\Core;

class UlizekoView{

    /**
     * @var string $route
     */
    private $route;

    /**
     * @var \Ulizeko\Core\UlizekoController $controller
     */
    private $controller;

    /**
     * @var \Ulizeko\Core\UlizekoModel $model
     */
    private $model;

    /**
     * @param \Ulizeko\Core\Controller $controller  Controller for this View
     * @param string $route Route for this View
     */
    public function __construct($controller,$route){

        $this->route=$route;

        $this->controller=$controller;

        $this->model=$controller->model;

    }

    public function load():void{

        include_once "src".DS."common".DS."header.php";

        if(file_exists($baseFile="src".DS.$this->route.DS."base.php")){

            $this->showBreadCrumbs();

            include_once $baseFile;

        }
        
        else{

            $this->show404();

        }

        include_once "src".DS."common".DS."footer.php";

    }

    private function show404():void{

        include_once "src".DS."common".DS."404.html";

    }

    private function showNoRecords():void{

        include_once "src".DS."common".DS."no_records.html";

    }

    private function showBreadCrumbs():void{

        include_once "src".DS."common".DS."breadcrumbs.php";

    }

    /**
     * @param array $topics topics to be displayed in article.
     */
    private function showArticleTopics($topics=array()):void{

        if(!empty($topics)){

            include "src".DS."common".DS."article_topics.php";
            
        }

    }

}
