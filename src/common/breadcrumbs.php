<nav aria-label="Breadcrumb">
  <ol>
    <li class="breadcrumb-item">
        <a href="<?php echo URL.$_GET['levela'];?>/"><?php echo ucwords($this->route);?></a>
    </li>
    <li class="breadcrumb-item breadcrumb-item-selected">
        <a href="#" aria-current="page">
        <?php echo ucwords($this->controller->currentAction);?>
        </a>
    </li>
  </ol>
</nav>