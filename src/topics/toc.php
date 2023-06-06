<p>Use the list below to navigate.</p>

<ol>

<?php foreach($topics as $topic){?>

    <li>
        <a href="<?php echo URL.$_GET['levela']."/".$topic->slug."/";?>">
        <?php echo $topic->topic." (".$this->model->countTopicArticles($topic->id).")";?>
        </a>
    </li>

<?php }?>

</ol>
