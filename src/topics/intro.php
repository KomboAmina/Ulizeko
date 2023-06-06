<?php

$hasTopics=$this->model->hasActiveTopics();

if($hasTopics){

    $isTopic=(isset($_GET['levelb']) && $this->model->topicSlugExists($_GET['levelb']));

    switch($isTopic){

        case true: case 1:

            include_once "topic.php";

        break;

        default:

            $topics=$this->model->getAllTopics();

            include_once "toc.php";

        break;

    }

}
else{

    $this->showNoRecords();

}

if(ALLOWADD && !$isTopic){

    include_once "add_topic.php";

}
