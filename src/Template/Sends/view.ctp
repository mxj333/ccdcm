<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Send $send
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Send'), ['action' => 'edit', $send->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Send'), ['action' => 'delete', $send->id], ['confirm' => __('Are you sure you want to delete # {0}?', $send->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Sends'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Send'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="sends view large-9 medium-8 columns content">
    <h3><?= h($send->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Action') ?></th>
            <td><?= $send->has('action') ? $this->Html->link($send->action->id, ['controller' => 'Actions', 'action' => 'view', $send->action->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sendto') ?></th>
            <td><?= h($send->sendto) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Subject') ?></th>
            <td><?= h($send->subject) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($send->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= $this->Number->format($send->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delay') ?></th>
            <td><?= $this->Number->format($send->delay) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Repeat') ?></th>
            <td><?= $this->Number->format($send->repeat) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Interval') ?></th>
            <td><?= $this->Number->format($send->interval) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Executed Num') ?></th>
            <td><?= $this->Number->format($send->executed_num) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $send->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Message') ?></h4>
        <?= $this->Text->autoParagraph(h($send->message)); ?>
    </div>
</div>
