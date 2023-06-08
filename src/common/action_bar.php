
<nav class="UnderlineNav UnderlineNav--right">
  <div class="UnderlineNav-body" role="tablist">
    <?php if(ALLOWEDIT){?>
        <a href="<?php echo URL.$_GET['levela']."/edit/".$element->slug;?>/"
        class="UnderlineNav-item" <?php if($_GET['levelb']=="edit"){echo "aria-current='page'";}?>>
            Edit <?php echo ucwords($elementItem);?>
        </a>
    <?php }?>
    <?php if(ALLOWDELETE){?>
        <a href="<?php echo URL.$_GET['levela']."/delete/".$element->slug;?>/"
        class="UnderlineNav-item" <?php if($_GET['levelb']=="delete"){echo "aria-current='page'";}?>>
            Delete <?php echo ucwords($elementItem);?>
        </a>
    <?php }?>
  
  </div>
</nav>
