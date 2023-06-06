<?php
if(isset($_GET['levelc']) && $this->model->topicSlugExists($_GET['levelc'])){

    $topic=$this->model->getTopicProfile($_GET['levelc']);
?>
<form method="post">

    <input type="hidden" name="id" value="<?php echo $topic->id;?>" />

    <label for="topic">Title</label>

    <input type="text" name="topic" id="topic" value="<?php echo $topic->topic;?>" required/>

    <button type="submit" name="act" value="edit topic">Save</button>

</form>
<?php }
else{

    $this->showNoRecords();

}
