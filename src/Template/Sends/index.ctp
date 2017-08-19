<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Send[]|\Cake\Collection\CollectionInterface $sends
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Send'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="sends index large-9 medium-8 columns content">
    <h3><?= __('Sends') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('action_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('type') ?></th>
                <th scope="col"><?= $this->Paginator->sort('sendto') ?></th>
                <th scope="col"><?= $this->Paginator->sort('subject') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('delay') ?></th>
                <th scope="col"><?= $this->Paginator->sort('repeat') ?></th>
                <th scope="col"><?= $this->Paginator->sort('interval') ?></th>
                <th scope="col"><?= $this->Paginator->sort('executed_num') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sends as $send): ?>
            <tr>
                <td><?= $this->Number->format($send->id) ?></td>
                <td><?= $send->has('action') ? $this->Html->link($send->action->id, ['controller' => 'Actions', 'action' => 'view', $send->action->id]) : '' ?></td>
                <td><?= $this->Number->format($send->type) ?></td>
                <td><?= h($send->sendto) ?></td>
                <td><?= h($send->subject) ?></td>
                <td><?= h($send->status) ?></td>
                <td><?= $this->Number->format($send->delay) ?></td>
                <td><?= $this->Number->format($send->repeat) ?></td>
                <td><?= $this->Number->format($send->interval) ?></td>
                <td><?= $this->Number->format($send->executed_num) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $send->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $send->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $send->id], ['confirm' => __('Are you sure you want to delete # {0}?', $send->id)]) ?>
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
