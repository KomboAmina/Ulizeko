<?php
namespace Ulizeko\Search;

class SearchModel extends \Ulizeko\Topics\TopicsModel{

    /**
     * @param string $key   search keyword
     * @return array $articles  array of discovered articles
     */
    public function searchArticles($key):array{

        $articles=array();

        $key="%".$key."%";

        $st=$this->dbcon->executeQuery("SELECT id,title,brief,updated,slug FROM `articles`
        WHERE visible=? AND (title LIKE ? OR brief LIKE ? OR body LIKE ? OR slug LIKE ?)
        ORDER BY updated DESC",array(true,$key,$key,$key,$key));

        while($ro=$st->fetchObject()){

            $articles[]=$ro;

        }


        return $articles;

    }

    /**
     * @param string $key   search keyword
     * @return array $topics  array of discovered articles
     */
    public function searchTopics($key):array{

        $topics=array();

        $key="%".$key."%";

        $st=$this->dbcon->executeQuery("SELECT * FROM `topics`
        WHERE topic LIKE ? OR slug LIKE ? ORDER BY topic ASC",
        array($key,$key));

        while($ro=$st->fetchObject()){

            $topics[]=$ro;

        }

        return $topics;

    }

}