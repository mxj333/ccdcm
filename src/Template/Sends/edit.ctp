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
                ['action' => 'delete', $send->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $send->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Sends'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="sends form large-9 medium-8 columns content">
    <?= $this->Form->create($send) ?>
    <fieldset>
        <legend><?= __('Edit Send') ?></legend>
        <?php
            echo $this->Form->control('action_id', ['options' => $actions, 'empty' => true]);
            echo $this->Form->control('type');
            echo $this->Form->control('sendto');
            echo $this->Form->control('subject');
            echo $this->Form->control('message');
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
