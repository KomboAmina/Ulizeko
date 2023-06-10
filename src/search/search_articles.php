<?php
if(strlen($key)>0){
?>
<h2>Showing search results for <em><?php echo $key;?></em>.
 <a href="<?php echo URL.$_GET['levela']."/";?>" class="btn btn-secondary">Clear this Search</a></h2>
<?php

$articles=$this->model->searchArticles($key);

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

}

else{

    ?>
    <h2>You have not searched</h2>
    <p>Change that with the form below.</p>
    <?php

    include "src".DS."common".DS."search_bar.php";

}