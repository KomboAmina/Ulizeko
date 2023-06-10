<?php
$routesModel=new \Ulizeko\Core\RoutesModel();

foreach($routesModel->validRoutes as $validRoute){
    $isCurrent=(isset($_GET['levela']) && $_GET['levela']==$validRoute);
    ?>
    <div class="Header-Item mr-3">
        <?php if(!$isCurrent){?>
        <a href="<?php echo URL.$validRoute;?>/"
        class="Header-link"><?php }?>
        <?php echo ucwords($validRoute);?>
        <?php if(!$isCurrent){?></a><?php }?>

    </div>
    <?php

}
