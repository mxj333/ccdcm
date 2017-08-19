<ul class="nav nav-sidebar">
    <?php 
        //echo $controllerName;
        foreach ($ZEN_MEUN[$bannerActive]['sub'] as $key => $left) {
        //pr($left);
    ?>
    <li><a class="list-group-item <?php if(strtolower($controllerName) == strtolower($left['name'])) echo 'disabled'; ?>" href="/zen/<?php echo $left['name'];?>"><i class="<?php echo $left['icon'];?>"></i>&nbsp;<?php echo $left['label'];?></a></li>
    <?php } ?>
</ul>