<?php
namespace Komboamina\Ulizeko\Articles;

class ArticlesController extends \Komboamina\Ulizeko\Core\UlizekoController{

    public function __construct($model){

        $actions=array("intro","read","add");

        if(ALLOWEDIT){$actions[]="edit";}

        if(ALLOWDELETE){$actions[]="delete";}

        parent::__construct($model,$actions);

    }

}
