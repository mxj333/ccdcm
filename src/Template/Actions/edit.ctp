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
                ['action' => 'delete', $action->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $action->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Actions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Strategies'), ['controller' => 'Strategies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Strategy'), ['controller' => 'Strategies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sends'), ['controller' => 'Sends', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Send'), ['controller' => 'Sends', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="actions form large-9 medium-8 columns content">
    <?= $this->Form->create($action) ?>
    <fieldset>
        <legend><?= __('Edit Action') ?></legend>
        <?php
            echo $this->Form->control('strategy_id', ['options' => $strategies, 'empty' => true]);
            echo $this->Form->control('type');
            echo $this->Form->control('sendto');
            echo $this->Form->control('status');
            echo $this->Form->control('delay');
            echo $this->Form->control('repeat');
            echo $this->Form->control('interval');
            echo $this->Form->control('executed_num');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
