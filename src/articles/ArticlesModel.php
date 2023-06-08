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

    public function articleTitleExists($check,$id=0){

        $st=$this->dbcon->executeQuery("SELECT COUNT(id) FROM `articles` WHERE title=? AND id!=?",
        array($check,$id));

        return intval($st->fetchColumn())>0;

    }

    public function articleSlugExists($check,$id=0){

        $st=$this->dbcon->executeQuery("SELECT COUNT(id) FROM `articles` WHERE slug=? AND id!=?",
        array($check,$id));

        return intval($st->fetchColumn())>0;

    }

    public function addArticle($article,$topics=array()){

        $slug=$this->generateSlug($article['title']);

        $updated=date("Y-m-d H:i:s");

        $this->dbcon->executeQuery("INSERT INTO `articles`(title,slug,brief,body,updated,visible)
        VALUES(?,?,?,?,?,?)",
        array($article['title'],$slug,$article['brief'],$article['body'],$updated,true));

        $newArticleID=$this->getInfo("articles","slug",$slug,"id");

        foreach($topics as $topic){
            $this->addTopicToArticle($topic,$newArticleID);
        }

        return $slug;

    }

    public function deleteTopicArticles($articleID){

        $this->dbcon->executeQuery("DELETE FROM `article_topics` WHERE articleid=?",
        array($articleID));

    }

    public function addTopicToArticle($topicID,$articleID){

        $this->dbcon->executeQuery("DELETE FROM `article_topics`
         WHERE topicid=? AND articleid=?",array($topicID,$articleID));

        $this->dbcon->executeQuery("INSERT INTO `article_topics`(articleid,topicid)
        VALUES(?,?)",array($articleID,$topicID));

    }

    public function editArticle($article,$topics=array()){

        $slug=$this->generateSlug($article['title']);

        $updated=date("Y-m-d H:i:s");

        $this->dbcon->executeQuery("UPDATE `articles` SET title=?,slug=?,brief=?,body=?,updated=? WHERE id=?",
        array($article['title'],$slug,$article['brief'],$article['body'],$updated,$article['id']));

        $this->deleteTopicArticles($article['id']);

        foreach($topics as $topic){
            $this->addTopicToArticle($topic,$article['id']);
        }

        return $slug;

    }

    public function deleteArticle($articleID){

        $this->deleteTopicArticles($articleID);

        $this->dbcon->executeQuery("DELETE FROM `articles`
        WHERE id=?",array($articleID));

    }

}
