<?php
$article=$this->model->getArticleProfile($_GET['levelc']);

$artopics=$this->model->getArticleTopics($article->id);

$element=$article;

$elementItem="article";

include_once "src".DS."common".DS."action_bar.php";
?>
<form method="post" class="p-3">

    <input type="hidden" value="<?php echo $article->id;?>" name="id"/>

    <h3>Edit Article</h3>

    <div class="form-group">
        <div class="form-group-header">
            <label for="title">Title</label>
        </div>
        <div class="form-group-body">
            <input type="text" name="title" id="title"
            class="form-control input-block"
            value="<?php echo $article->title;?>"/>
        </div>
    </div>

    <div class="form-group">
        <div class="form-group-header">
            <label for="brief">Summary</label>
        </div>
        <div class="form-group-body">
            <textarea class="form-control input-block"
            name="brief" id="brief" rows="3" required><?php echo $article->brief;?></textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="form-group-header">
            <label for="body">Full Text</label>
        </div>
        <div class="form-group-body">
            <textarea class="form-control input-block"
            name="body" id="body" required><?php echo $article->body;?></textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="form-group-header">
            <label for="topics">Topics</label>
        </div>
        <div class="form-group-body">
            <select class="form-control" name="topics[]" id="topics" required multiple>
                <?php
                $topics=$this->model->getAllTopics();
                foreach($topics as $topic){
                    echo "<option value='".$topic->id."'";
                    if(isset($_GET['topic']) && $_GET['topic']==$topic->slug){
                        echo " selected";
                    }
                    foreach($artopics as $artopic){
                        if($topic->slug==$artopic->slug){
                            echo " selected";
                        }
                    }
                    echo ">".$topic->topic."</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="form-group-body">
            <button type="submit" name="act" value="edit article" class="btn btn-primary">Save</button>
        </div>
    </div>

</form>
