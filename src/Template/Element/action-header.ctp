<?php
if (!$this->exists('actions')) {
    $this->start('actions');
        echo $this->element('actions', [
            'actions' => $actions['table'],
            'singularVar' => false,
        ]);
        // to make sure ${$viewVar} is a single entity, not a collection
        if (${$viewVar} instanceof \Cake\Datasource\EntityInterface && !${$viewVar}->isNew()) {
            echo $this->element('actions', [
                'actions' => $actions['entity'],
                'singularVar' => ${$viewVar},
            ]);
        }

        if ($viewVar == 'subjects') {
            echo '<a href="/zen/subjects/adds" class="btn btn-default">单题录入</a>';
            echo '<a href="/zen/subjects/addpage" class="btn btn-default">多题录入</a>';
        }
    $this->end();
}
?>
<h2><?= $this->get('title'); ?></h2>
<div class="actions-wrapper">
    <?= $this->fetch('actions'); ?>
</div>
