<?php
if(isset($_GET['levelc']) && $this->model->isVisibleArticle($_GET['levelc'])){

    $article=$this->model->getArticleProfile($_GET['levelc']);

    $topics=$this->model->getArticleTopics($article->id);

    $element=$article;

    $elementItem="article";

    include_once "src".DS."common".DS."action_bar.php";

    ?>
    
    <h1><?php echo $article->title;?></h1>

    <p><small>Last Updated <?php echo date("l jS F, Y",strtotime($article->updated));?></small></p>

    <?php $this->showArticleTopics($topics);?>

    <blockquote class="color-bg-accent p-5 mb-3">
        <?php echo $article->brief;?>
    </blockquote>

    <?php echo $article->body;

    ?>
    <div class="pt-3">
    <?php

    $this->showArticleTopics($topics); ?>
    </div>
    <?php
    
}
else{
    $this->showNoRecords();
}
