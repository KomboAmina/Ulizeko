<?php
if(isset($_GET['levelc']) && $this->model->topicSlugExists($_GET['levelc'])){

$topic=$this->model->getTopicProfile($_GET['levelc']);

$element=$topic;

$elementItem="topic";

include_once "src".DS."common".DS."action_bar.php";
?>

<form method="post" class="p-5">

    <h3 class="pb-3">Edit Topic: <?php echo $topic->topic;?></h3>

    <input type="hidden" name="id" value="<?php echo $topic->id;?>" />

    <label for="topic">Title</label>

    <input type="text" name="topic" id="topic" value="<?php echo $topic->topic;?>" class="form-control" required/>

    <button type="submit" name="act" value="edit topic" class="btn btn-primary">Save</button>

</form>
<?php }
else{

    $this->showNoRecords();

}
