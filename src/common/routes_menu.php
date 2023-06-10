<?php
$routesModel=new \Ulizeko\Core\RoutesModel();

foreach($routesModel->validRoutes as $validRoute){

    ?>
    <div class="Header-Item">

        <a href="<?php echo URL.$validRoute;?>/" class="Header-link mr-3"><?php echo ucwords($validRoute);?></a>

    </div>
    <?php

}
