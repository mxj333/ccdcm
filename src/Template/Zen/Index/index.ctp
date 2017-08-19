<div class="panel panel-primary">
    <div class="panel-heading">
        <span class="panel-title">Dashboard</span>
    </div>
    <div class="panel-body dashboard-section">
        <?php foreach ($structures as $key => $str):?>
        <h4><span class="label label-default"><?= $str['label']?></span></h4>
        <br>
        <?php foreach ($managements[$str['id']] as $k => $mana):?>
            <a class="btn btn-default um-btn" href="/zen/<?= $mana['name']?>"><?= $mana['label']?></a>
        <?php endforeach;?>
        <hr>
        <?php endforeach;?>
        
    </div>
</div>