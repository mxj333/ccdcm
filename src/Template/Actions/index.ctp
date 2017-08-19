<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Action[]|\Cake\Collection\CollectionInterface $actions
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Action'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Strategies'), ['controller' => 'Strategies', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Strategy'), ['controller' => 'Strategies', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Sends'), ['controller' => 'Sends', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Send'), ['controller' => 'Sends', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="actions index large-9 medium-8 columns content">
    <h3><?= __('Actions') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('strategy_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sendto') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delay') ?></th>
                <th scope="col"><?= $this->Paginator->sort('repeat') ?></th>
                <th scope="col"><?= $this->Paginator->sort('interval') ?></th>
                <th scope="col"><?= $this->Paginator->sort('executed_num') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($actions as $action): ?>
            <tr>
                <td><?= $this->Number->format($action->id) ?></td>
                <td><?= $action->has('strategy') ? $this->Html->link($action->strategy->name, ['controller' => 'Strategies', 'action' => 'view', $action->strategy->id]) : '' ?></td>
                <td><?= $this->Number->format($action->type) ?></td>
                <td><?= h($action->sendto) ?></td>
                <td><?= h($action->status) ?></td>
                <td><?= $this->Number->format($action->delay) ?></td>
                <td><?= $this->Number->format($action->repeat) ?></td>
                <td><?= $this->Number->format($action->interval) ?></td>
                <td><?= $this->Number->format($action->executed_num) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $action->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $action->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $action->id], ['confirm' => __('Are you sure you want to delete # {0}?', $action->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
