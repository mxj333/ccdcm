<?php
/**
  * @var \App\View\AppView $this
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $strategy->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $strategy->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Strategies'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="strategies form large-9 medium-8 columns content">
    <?= $this->Form->create($strategy) ?>
    <fieldset>
        <legend><?= __('Edit Strategy') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('status');
            echo $this->Form->control('priority');
            echo $this->Form->control('is_input');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
