<?php
namespace Ulizeko\Topics;

class TopicsModel extends \Ulizeko\Core\UlizekoModel{

    /**
     * @return boolean
     */
    public function hasActiveTopics():boolean{

        return !empty($this->getAllTopics());

    }

    /**
     * @param string $slug  url slug to be searched
     * @param int $excludeID   ID of any topic to be excluded from search
     * @return boolean
     */
    public function topicSlugExists($slug,$excludeID=0):boolean{

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

    /**
     * @param string $string  topic to be searched
     * @param int $excludeID   ID of any topic to be excluded from search
     * @return boolean
     */
    public function topicExists($string,$excludeID=0):boolean{

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

    /**
     * @param string $newTopic  New topic to be added
     */
    public function addTopic($newTopic):void{

        $slug=$this->generateSlug($newTopic);

        $this->dbcon->executeQuery("INSERT INTO `topics`(topic,slug) VALUES(?,?)",
        array($newTopic,$slug));

    }

    /**
     * @param int $id   ID of topic to be updated
     * @param string $newTopic  new value of topic to be updated.
     */
    public function editTopic($id,$newTopic):void{

        $id=intval($id);

        $slug=$this->generateSlug($newTopic);

        $this->dbcon->executeQuery("UPDATE `topics` SET topic=?,slug=? WHERE id=?",array($newTopic,$slug,$id));

    }

    /**
     * @param int $topicID  ID of topic to be queried for articles
     * @return int  result of search
     */
    public function countTopicArticles($topicID):int{

        $st=$this->dbcon->executeQuery("SELECT COUNT(*) FROM `article_topics` WHERE topicid=?",array($topicID));

        return $st->fetchColumn();

    }

    /**
     * @param int $topicID  ID of topic to be searched
     * @return boolean
     */
    public function hasArticles($topicID):boolean{

        $cn=$this->countTopicArticles($topicID);

        return (intval($cn))>0;

    }

    /**
     * @param mixed $identifier can be string or integer
     * @return Object $topic    result of search
     */
    public function getTopicProfile($identifier):Object{

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

    /**
     * @param int $topicID  ID of topic
     * @return array $articles  Articles associated with topic
     */
    public function getVisibleTopicArticles($topicID):array{

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

    /**
     * @param int $topicID  ID of topic to be deleted
     */
    public function deleteTopic($topicID):void{

        $this->dbcon->executeQuery("DELETE FROM `article_topics` WHERE topicid=?",array($topicID));

        $this->dbcon->executeQuery("DELETE FROM `topics` WHERE id=?",array($topicID));

    }

}
