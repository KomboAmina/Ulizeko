<p>Use the list below to the articles in full.</p>

<?php

$articles=$this->model->getAllVisibleArticles();

?>
<p><a href="<?php echo URL.$_GET['levela']."/add/";?>"
alt="create a new article" class="btn btn-primary">Add Article</a></p>
<?php

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
