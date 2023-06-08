<?php
if(!empty($topics)){

    ?>
    <p>Published in:
         <?php 
         $t=0;
         foreach($topics as $topic){
            $t++;
            ?>
            <a href="<?php echo URL."topics/".$topic->slug;?>/"
            class="link"><?php echo $topic->topic;?></a>
            <?php if($t<count($topics)){?>,<?php }?>
         <?php }?>
    </p>
    <?php

}