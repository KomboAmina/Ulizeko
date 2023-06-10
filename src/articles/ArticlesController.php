<?php
namespace Ulizeko\Articles;

class ArticlesController extends \Ulizeko\Core\UlizekoController{

    /**
     * @param Ulizeko\Core\UlizekoModel $model  Model for this Controller
     */
    public function __construct($model){

        $actions=array("intro","read","add");

        if(ALLOWEDIT){$actions[]="edit";}

        if(ALLOWDELETE){$actions[]="delete";}

        parent::__construct($model,$actions);

    }

    /**
     * @return mixed $ret   Either URL or Boolean false
     */
    public function addArticle():mixed{

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
    
            //create article, get slug
            $slug=$this->model->addArticle($article,$_POST['topics']);

            //use slug to relocate and read
            if(strlen($slug)>0){

                $ret=URL."articles/read/".$slug."/";

            }

        }

        return $ret;

    }

    /**
     * @return mixed $ret   Either URL or Boolean false
     */
    public function editArticle():mixed{

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

            $errors[]="title unavailable.";

        }

        if($this->model->articleSlugExists($this->model->generateSlug($_POST['title']),$_POST['id'])){

            $errors[]="slug unavailable.";

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
            if(strlen($slug)>0){
                
                $ret=URL."articles/read/".$slug."/";
            
            }

        }

        return $ret;

    }

    /**
     * @return Boolean
     */
    public function deleteArticle():bool{

        $this->model->deleteArticle($_POST['id']);

        return false;

    }

}
