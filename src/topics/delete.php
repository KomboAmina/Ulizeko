<?php
if(isset($_GET['levelc']) && $this->model->topicSlugExists($_GET['levelc'])){

$topic=$this->model->getTopicProfile($_GET['levelc']);

$element=$topic;

$elementItem="topic";

include_once "src".DS."common".DS."action_bar.php";

if(!$this->model->hasArticles($topic->id)){
?>
<form method="post" class="p-5">

    <h3 class="pb-3">Are you sure?</h3>

    <input type="hidden" name="id" value="<?php echo $topic->id;?>" />

    <label for="topic">Title</label>

    <input type="text" name="topic" id="topic"
    value="<?php echo $topic->topic;?>"
    class="form-control" readonly/>

    <p class="pt-3 pb-3"><a href="../../">No. Do not delete.</a></p>

    <button type="submit" name="act" value="delete topic" class="btn btn-danger">Yes, Delete</button>

</form>
<?php }
else{
    ?>
    <div class="p-5">

        <h3 class="pb-3">This topic cannot be deleted.</h3>

        <p>It has associated articles. In order to destroy it,
             you must delete them first or associate them with other topics.</p>

    </div>
    <?php
}
}
else{

    $this->showNoRecords();

}
