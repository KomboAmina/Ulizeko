<?php
namespace Komboamina\Ulizeko\Articles;

class ArticlesController extends \Komboamina\Ulizeko\Core\UlizekoController{

    public function __construct($model){

        $actions=array("intro","read","add");

        if(ALLOWEDIT){$actions[]="edit";}

        if(ALLOWDELETE){$actions[]="delete";}

        parent::__construct($model,$actions);

    }

    public function addArticle(){

        $ret=false;

        $errors=array();

        if($this->model->isBlank($_POST['title'])){

            $errors[]="required.";

        }

        if($this->model->isBlank($_POST['brief'])){

            $errors[]="required.";

        }

        if($this->model->isBlank($_POST['body'])){

            $errors[]="required.";

        }

        if($this->model->articleTitleExists($_POST['title'])){

            $errors[]="unavailable.";

        }

        if($this->model->articleSlugExists($this->model->generateSlug($_POST['title']))){

            $errors[]="unavailable.";

        }

        if(empty($errors)){

            $article=array("title"=>$_POST['title'],
                            "brief"=>$_POST['brief'],
                            "body"=>$_POST['body']
                        );
    
            //create article get slug
            $slug=$this->model->addArticle($article,$_POST['topics']);

            //use slug to relocate and read
            $ret=URL."articles/read/".$slug."/";

        }

        return $ret;

    }

    public function editArticle(){

        $ret=false;

        $errors=array();

        if($this->model->isBlank($_POST['title'])){

            $errors[]="required.";

        }

        if($this->model->isBlank($_POST['brief'])){

            $errors[]="required.";

        }

        if($this->model->isBlank($_POST['body'])){

            $errors[]="required.";

        }

        if($this->model->articleTitleExists($_POST['title'],$_POST['id'])){

            $errors[]="unavailable.";

        }

        if($this->model->articleSlugExists($this->model->generateSlug($_POST['title'],$_POST['id']))){

            $errors[]="unavailable.";

        }

        if(empty($errors)){

            $article=array("title"=>$_POST['title'],
                            "brief"=>$_POST['brief'],
                            "body"=>$_POST['body'],
                            "id"=>$_POST['id']
                        );
    
            //create article get slug
            $slug=$this->model->editArticle($article,$_POST['topics']);

            //use slug to relocate and read
            $ret=URL."articles/read/".$slug."/";

        }

        return $ret;

    }

    public function deleteArticle(){

        $ret=false;

        $this->model->deleteArticle($_POST['id']);

        return $ret;

    }

}
