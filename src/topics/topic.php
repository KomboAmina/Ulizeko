<?php
$topic=$this->model->getTopicProfile($_GET['levelb']);

$element=$topic;

$elementItem="topic";

include_once "src".DS."common".DS."action_bar.php";
?>

<h2 class="pt-3"><?php echo $topic->topic;?></h2>

<?php

if(ALLOWADD){

    echo "<p class='pt-3 pb-3'><a href='".URL."articles/add/?topic=".
    $topic->slug."' class='btn btn-primary'>Add Article</a></p>";

}

$articles=$this->model->getVisibleTopicArticles($topic->id);

if(!empty($articles)){

    foreach($articles as $article){
        $readLink=URL."articles/read/".$article->slug."/";
    ?>
    <div class="border-bottom p-3">
    <h3><?php echo $article->title;?></h3>
    <p><small><?php echo date("jS F, Y",strtotime($article->updated));?></small></p>
    <p><?php echo $article->brief;?></p>
    <p><a href="<?php echo $readLink;?>" class="btn">Read Now</a></p>
    </div>
    <?php }

}
else{

    $this->showNoRecords();

}
