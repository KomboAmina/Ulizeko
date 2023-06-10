<?php
namespace Ulizeko\Topics;

class TopicsModel extends \Ulizeko\Core\UlizekoModel{

    public function hasActiveTopics(){

        return !empty($this->getAllTopics());

    }

    public function topicSlugExists($slug,$excludeID=0){

        switch(intval($excludeID)>0){

            case true: case 1:

                $query="SELECT COUNT(*) FROM `topics` WHERE slug = ? AND(id!=?)";

                $vals=array($slug,$excludeID);


            break;

            default:

                $query="SELECT COUNT(*) FROM `topics` WHERE slug = ?";

                $vals=array($slug);

            break;

        }

        $st=$this->dbcon->executeQuery($query,$vals);

        $cn=$st->fetchColumn();

        return intval($cn>0);

    }

    public function topicExists($string,$excludeID=0){

        switch(intval($excludeID)>0){

            case true: case 1:

                $query="SELECT COUNT(*) FROM `topics` WHERE topic = ? AND(id!=?)";

                $vals=array($string,$excludeID);


            break;

            default:

                $query="SELECT COUNT(*) FROM `topics` WHERE topic = ?";

                $vals=array($string);

            break;

        }

        $st=$this->dbcon->executeQuery($query,$vals);

        $cn=$st->fetchColumn();

        return intval($cn>0);

    }

    public function addTopic($newTopic){

        $slug=$this->generateSlug($newTopic);

        $this->dbcon->executeQuery("INSERT INTO `topics`(topic,slug) VALUES(?,?)",
        array($newTopic,$slug));

    }

    public function editTopic($id,$newTopic){

        $id=intval($id);

        $slug=$this->generateSlug($newTopic);

        $this->dbcon->executeQuery("UPDATE `topics` SET topic=?,slug=? WHERE id=?",array($newTopic,$slug,$id));

    }

    public function countTopicArticles($topicID){

        $st=$this->dbcon->executeQuery("SELECT COUNT(*) FROM `article_topics` WHERE topicid=?",array($topicID));

        return $st->fetchColumn();

    }

    public function hasArticles($topicID){

        $cn=$this->countTopicArticles($topicID);

        return (intval($cn))>0;

    }

    public function getTopicProfile($identifier){

        $topic=null;

        $query="SELECT * FROM `topics` WHERE ";

        $vals=array($identifier);

        switch(is_string($identifier)){

            case true: case 1:

                $query.="slug=?";

                break;
            default:

                $query.="id=?";

            break;

        }

        $st=$this->dbcon->executeQuery($query,$vals);

        while($ro=$st->fetchObject()){

            $topic=$ro;

        }

        return $topic;

    }

    public function getVisibleTopicArticles($topicID){

        $articles=array();

        $st=$this->dbcon->executeQuery("SELECT articles.id,articles.title,articles.brief,articles.slug,articles.updated
        FROM `articles` INNER JOIN `article_topics` ON article_topics.articleid=articles.id
        WHERE article_topics.topicid=? AND articles.visible=?
        ORDER BY articles.updated DESC",array($topicID,true));

        while($ro=$st->fetchObject()){

            $articles[]=$ro;

        }

        return $articles;

    }

    public function deleteTopic($topicID){

        $this->dbcon->executeQuery("DELETE FROM `article_topics` WHERE topicid=?",array($topicID));

        $this->dbcon->executeQuery("DELETE FROM `topics` WHERE id=?",array($topicID));

    }

}
