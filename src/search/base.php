<?php
$key=(isset($_GET['key'])) ? urldecode($_GET['key']):"";
?>
<div class="tabnav">
  <nav class="tabnav-tabs" aria-label="Search Results">
    <?php foreach($this->model->validActions as $validAction){?>
        <a class="tabnav-tab"
        href="<?php echo URL.$_GET['levela']."/".$validAction."/?key=".urlencode($key);?>#results"
        <?php if($this->controller->currentAction==$validAction){?>aria-current="page"<?php }?>>
        <?php echo ucwords($validAction);?></a>
    <?php }?>
  </nav>
</div>
<a href="#" name="results"></a>

<?php

$resultsFile="src".DS."search".DS."search_".$this->controller->currentAction.".php";

if(file_exists($resultsFile)){

    include_once $resultsFile;

}
else{

    $this->show404();

}
