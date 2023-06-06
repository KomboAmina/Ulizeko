<?php
$topic=$this->model->getTopicProfile($_GET['levelb']);
?>

<p><a href="../">All Topics</a> &gt; <?php echo $topic->topic;?></p>

<?php
if(ALLOWEDIT){

    echo "<p><a href='".URL.$_GET['levela']."/edit/".$topic->slug."/'>Edit Topic</a></p>";

}
if(ALLOWDELETE){
    
    echo "<p><a href='".URL.$_GET['levela']."/delete/".$topic->slug."/'>Delete Topic</a></p>";

}
?>

<h2><?php echo $topic->topic;?></h2>

<?php

$articles=$this->model->getVisibleTopicArticles($topic->id);

if(!empty($articles)){

    foreach($articles as $article){
        $readLink=URL."articles/read/".$article->slug."/";
    ?>
    <h3><?php echo "<a href='".$readLink."'>".$article->title."</a>";?></h3>
    <p><?php echo $article->brief;?></p>
    <p><a href="<?php echo $readLink;?>">Read Now</a></p>
    <hr>
    <?php }

}
else{

    $this->showNoRecords();

}

if(ALLOWADD){

    echo "<p><a href='".URL."articles/add/?topic=".$topic->slug."'>Add Article</a></p>";

}
