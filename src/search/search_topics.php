<?php
if(strlen($key)>0){
?>
<h2>Showing search results for <em><?php echo $key;?></em>.
 <a href="<?php echo URL.$_GET['levela']."/";?>" class="btn btn-secondary">Clear this Search</a></h2>

<?php

$topics=$this->model->searchTopics($key);

    if(!empty($topics)){

        ?>
        <ol class="filter-list">
        <?php

        foreach($topics as $topic){
           ?>
           <li>
                <a href="<?php echo URL."topics/".$topic->slug."/";?>" class="filter-item">
                <?php echo $topic->topic." (".$this->model->countTopicArticles($topic->id).")";?>
                </a>
            </li>
        <?php }

        ?>
        </ol>
        <?php

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