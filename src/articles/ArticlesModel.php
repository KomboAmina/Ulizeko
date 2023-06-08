<?php
namespace Komboamina\Ulizeko\Articles;

class ArticlesModel extends \Komboamina\Ulizeko\Topics\TopicsModel{

    public function getAllVisibleArticles(){

        $articles=array();

        $st=$this->dbcon->executeQuery("SELECT id,title,brief,updated,slug FROM `articles`
        WHERE visible=? ORDER BY updated DESC",array(true));

        while($ro=$st->fetchObject()){

            $articles[]=$ro;

        }

        return $articles;

    }

    public function isVisibleArticle($slug){

        $st=$this->dbcon->executeQuery("SELECT COUNT(id) FROM `articles`
        WHERE slug=? AND visible=?",array($slug,true));

        return $st->fetchColumn()>0;

    }

    public function getArticleProfile($identifier){

        $article=null;

        $query="SELECT * FROM `articles` WHERE ";

        switch(is_int($identifier)){

            case true: case 1:
                $query.="id=?";
                $vals=array($identifier);
                break;
            default:
                $query.="slug=?";
                $vals=array($identifier);
                break;

        }

        $st=$this->dbcon->executeQuery($query,$vals);

        while($ro=$st->fetchObject()){

            $article=$ro;

        }

        return $article;

    }

    public function getArticleTopics($articleID){

        $topics=array();

        $st=$this->dbcon->executeQuery("SELECT topics.id,topics.topic,topics.slug
        FROM `topics` INNER JOIN `article_topics` ON topics.id=article_topics.topicid
        WHERE article_topics.articleid=? ORDER BY topics.topic ASC",
        array($articleID));

        while($ro=$st->fetchObject()){

            $topics[]=$ro;

        }

        return $topics;

    }

}
