<?php
namespace Ulizeko\Topics;

class TopicsController extends \Ulizeko\Core\UlizekoController{

    /**
     * @param \Ulizeko\Core\TopicsModel $model  Model for this controller.
     */
    public function __construct($model){

        $actions=array("intro","topic");

        if(ALLOWEDIT){$actions[]="edit";}

        if(ALLOWDELETE){$actions[]="delete";}

        parent::__construct($model,$actions);

    }

    /**
     * @return mixed $return    Can be either url string or boolean false
     */
    public function addTopic():mixed{

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

    /**
     * @return mixed $return    Can be either url string or boolean false
     */
    public function editTopic():mixed{

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

    /**
     * @return boolean
     */
    public function deleteTopic():boolean{

        $this->model->deleteTopic($_POST['id']);

        return false;

    }

}
