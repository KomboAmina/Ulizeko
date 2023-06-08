<form method="post" class="p-3">

    <h3>Add Article</h3>

    <div class="form-group">
        <div class="form-group-header">
            <label for="title">Title</label>
        </div>
        <div class="form-group-body">
            <input type="text" name="title" id="title" class="form-control input-block"/>
        </div>
    </div>

    <div class="form-group">
        <div class="form-group-header">
            <label for="brief">Summary</label>
        </div>
        <div class="form-group-body">
            <textarea class="form-control input-block"
            name="brief" id="brief" rows="3" required>Brief summary here.</textarea>
        </div>
    </div>

    <div class="form-group">
        <div class="form-group-header">
            <label for="body">Full Text</label>
        </div>
        <div class="form-group-body">
            <textarea class="form-control input-block"
            name="body" id="body" required>Full Article Text Here.</textarea>
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
                    echo ">".$topic->topic."</option>";
                }
                ?>
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="form-group-body">
            <button type="submit" name="act" value="add article" class="btn btn-primary">Save</button>
        </div>
    </div>

</form>
