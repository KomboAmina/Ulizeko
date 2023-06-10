<?php
namespace Ulizeko\Articles;

class ArticlesModel extends \Ulizeko\Topics\TopicsModel{

    /**
     * @return array $articles  Array of Articles to be returned.
    */
    public function getAllVisibleArticles():array{

        $articles=array();

        $st=$this->dbcon->executeQuery("SELECT id,title,brief,updated,slug FROM `articles`
        WHERE visible=? ORDER BY updated DESC",array(true));

        while($ro=$st->fetchObject()){

            $articles[]=$ro;

        }

        return $articles;

    }

    /**
     * @param string $slug  Possible article slug.
     * @return boolean  Boolean tied to the number of articles of given slug.
     */
    public function isVisibleArticle($slug):bool{

        $st=$this->dbcon->executeQuery("SELECT COUNT(id) FROM `articles`
        WHERE slug=? AND visible=?",array($slug,true));

        return $st->fetchColumn()>0;

    }

    /**
     * @param mixed $identifier can be an ID or a slug
     * @return Object $article  can be null or article Object
     */
    public function getArticleProfile($identifier):Object{

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

    /**
     * @param int $articleID    ID of queried article
     * @return mixed $topics    Array of topics
     */
    public function getArticleTopics($articleID):array{

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

    /**
     * @param string $check Article title to be searched
     * @param int $id   an ID to exclude from the search
     */
    public function articleTitleExists($check,$excludeID=0):bool{

        $st=$this->dbcon->executeQuery("SELECT COUNT(id) FROM `articles` WHERE title=? AND id!=?",
        array($check,$excludeID));

        return intval($st->fetchColumn())>0;

    }

    /**
     * @param string $check Article slug to be searched
     * @param int $id   an ID to exclude from the search
     */
    public function articleSlugExists($check,$excludeID=0):bool{

        $st=$this->dbcon->executeQuery("SELECT COUNT(id) FROM `articles` WHERE slug=? AND id!=?",
        array($check,$excludeID));

        return intval($st->fetchColumn())>0;

    }

    /**
     * @param array $article    Associative array with new Article values
     * @param array $topics integer array with new article topic IDs
     * @return string $slug Slug of new article, to be used in navigation
     */
    public function addArticle($article,$topics=array()):string{

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

    /**
     * @param int $articleID    ID of the article whose topics are being deleted.
     */
    public function deleteTopicArticles($articleID):void{

        $this->dbcon->executeQuery("DELETE FROM `article_topics` WHERE articleid=?",
        array($articleID));

    }

    /**
     * @param int $topicID  ID of topic being added to article.
     * @param int $articleID    ID of article being added to topic.
     */
    public function addTopicToArticle($topicID,$articleID):void{

        $this->dbcon->executeQuery("DELETE FROM `article_topics`
         WHERE topicid=? AND articleid=?",array($topicID,$articleID));

        $this->dbcon->executeQuery("INSERT INTO `article_topics`(articleid,topicid)
        VALUES(?,?)",array($articleID,$topicID));

    }

    /**
     * @param array $article    Associative array with new Article values
     * @param array $topics integer array with new article topic IDs
     * @return string $slug slug of updated article, to be used in navigation
     */
    public function editArticle($article,$topics=array()):string{

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

    /**
     * @param int $articleID    ID of article to be deleted.
     */
    public function deleteArticle($articleID):void{

        $this->deleteTopicArticles($articleID);

        $this->dbcon->executeQuery("DELETE FROM `articles`
        WHERE id=?",array($articleID));

    }

}
