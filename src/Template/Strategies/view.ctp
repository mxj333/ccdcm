<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Strategy $strategy
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Strategy'), ['action' => 'edit', $strategy->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Strategy'), ['action' => 'delete', $strategy->id], ['confirm' => __('Are you sure you want to delete # {0}?', $strategy->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Strategies'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Strategy'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="strategies view large-9 medium-8 columns content">
    <h3><?= h($strategy->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($strategy->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($strategy->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Priority') ?></th>
            <td><?= $this->Number->format($strategy->priority) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $strategy->status ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Is Input') ?></th>
            <td><?= $strategy->is_input ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Actions') ?></h4>
        <?php if (!empty($strategy->actions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Strategy Id') ?></th>
                <th scope="col"><?= __('Type') ?></th>
                <th scope="col"><?= __('Sendto') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Delay') ?></th>
                <th scope="col"><?= __('Repeat') ?></th>
                <th scope="col"><?= __('Interval') ?></th>
                <th scope="col"><?= __('Executed Num') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($strategy->actions as $actions): ?>
            <tr>
                <td><?= h($actions->id) ?></td>
                <td><?= h($actions->strategy_id) ?></td>
                <td><?= h($actions->type) ?></td>
                <td><?= h($actions->sendto) ?></td>
                <td><?= h($actions->status) ?></td>
                <td><?= h($actions->delay) ?></td>
                <td><?= h($actions->repeat) ?></td>
                <td><?= h($actions->interval) ?></td>
                <td><?= h($actions->executed_num) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Actions', 'action' => 'view', $actions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Actions', 'action' => 'edit', $actions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Actions', 'action' => 'delete', $actions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $actions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
