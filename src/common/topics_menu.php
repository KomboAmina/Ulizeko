<?php
$menuTopics=$this->model->getAllTopics();
?>
<nav class="SideNav" aria-label="Person settings">
  <?php foreach($menuTopics as $menuTopic){?>
  <a class="SideNav-item"
    href="<?php echo URL."topics/".$menuTopic->slug."/";?>"
    <?php if(isset($_GET['levelb']) && $_GET['levelb']==$menuTopic->slug){?>
        aria-current="page"
    <?php }?>
    ><?php echo $menuTopic->topic;?></a>
  <?php }?>
</nav>
