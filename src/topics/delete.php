<?php
if(isset($_GET['levelc']) && $this->model->topicSlugExists($_GET['levelc'])){

    $topic=$this->model->getTopicProfile($_GET['levelc']);
?>
<h3>Are you sure?</h3>
<form method="post">

    <input type="hidden" name="id" value="<?php echo $topic->id;?>" />

    <label for="topic">Title</label>

    <input type="text" name="topic" id="topic" value="<?php echo $topic->topic;?>" readonly/>

    <p><a href="../../">No. Do not delete.</a></p>

    <button type="submit" name="act" value="delete topic">Yes, Delete</button>

</form>
<?php }
else{

    $this->showNoRecords();

}
