<?php
namespace Ulizeko\Search;

class SearchController extends \Ulizeko\Core\UlizekoController{

    /**
     * @param \Ulizeko\Search\SearchModel $model
     */
    public function __construct($model){

        $actions=array("articles","topics");

        parent::__construct($model,$actions);

        $this->currentAction=($this->currentAction=="intro") ? "articles":$this->currentAction;

    }

}