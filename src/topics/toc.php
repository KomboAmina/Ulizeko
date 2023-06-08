<p>Use the list below to navigate.</p>

<ol class="filter-list">

<?php for($t=0; $t<count($topics); $t++){
    $topic=$topics[$t];
    ?>

    <li>
        <a href="<?php echo URL.$_GET['levela']."/".$topic->slug."/";?>" class="filter-item">
        <?php echo ($t+1).". ".$topic->topic." (".$this->model->countTopicArticles($topic->id).")";?>
        </a>
    </li>

<?php }
if(ALLOWADD){
    
    ?>
    <li>
    <div class="filter-item">
        <?php include_once "add_topic.php";?>
    </div>
    </li>
    <?php
}
?>

</ol>
