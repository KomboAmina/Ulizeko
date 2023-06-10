<?php
namespace Ulizeko\Topics;

class TopicsController extends \Ulizeko\Core\UlizekoController{

    public function __construct($model){

        $actions=array("intro","topic");

        if(ALLOWEDIT){$actions[]="edit";}

        if(ALLOWDELETE){$actions[]="delete";}

        parent::__construct($model,$actions);

    }

    public function addTopic(){

        $ret=false;

        $errors=array();

        if($this->model->isBlank($_POST['topic'])){

            $errors[]="required.";

        }

        if($this->model->topicExists($_POST['topic'])){

            $errors[]="topic already exists.";

        }

        if($this->model->topicSlugExists($_POST['topic'])){

            $errors[]="slug already exists.";

        }

        if(empty($errors)){

            $this->model->addTopic($_POST['topic']);

        }

        return $ret;

    }

    public function editTopic(){

        $ret=false;

        $errors=array();

        if($this->model->isBlank($_POST['topic'])){

            $errors[]="required.";

        }

        if($this->model->topicExists($_POST['topic'],intval($_POST['id']))){

            $errors[]="topic already exists.";

        }

        if($this->model->topicSlugExists($_POST['topic'],intval($_POST['id']))){

            $errors[]="slug already exists.";

        }

        if(empty($errors)){

            $this->model->editTopic($_POST['id'],$_POST['topic']);

            $slug=$this->model->getInfo("topics","id",$_POST['id'],"slug");

            $ret=URL.$_GET['levela']."/".$slug."/";

        }

        return $ret;

    }

    public function deleteTopic(){

        $this->model->deleteTopic($_POST['id']);

        return false;

    }

}
