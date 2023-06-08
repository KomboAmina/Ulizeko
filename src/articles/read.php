<?php
if(isset($_GET['levelc']) && $this->model->isVisibleArticle($_GET['levelc'])){

    $article=$this->model->getArticleProfile($_GET['levelc']);

    $topics=$this->model->getArticleTopics($article->id);

    ?>
    
    <h1><?php echo $article->title;?></h1>

    <p><small>Last Updated <?php echo date("l jS F, Y",strtotime($article->updated));?></small></p>

    <?php $this->showArticleTopics($topics);?>

    <blockquote class="border p-3">
        <?php echo $article->brief;?>
    </blockquote>

    <?php echo $article->body;

    $this->showArticleTopics($topics);
    
}
else{
    $this->showNoRecords();
}
