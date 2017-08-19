<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Strategy[]|\Cake\Collection\CollectionInterface $strategies
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Strategy'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Actions'), ['controller' => 'Actions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Action'), ['controller' => 'Actions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="strategies index large-9 medium-8 columns content">
    <h3><?= __('Strategies') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('priority') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_input') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($strategies as $strategy): ?>
            <tr>
                <td><?= $this->Number->format($strategy->id) ?></td>
                <td><?= h($strategy->name) ?></td>
                <td><?= h($strategy->status) ?></td>
                <td><?= $this->Number->format($strategy->priority) ?></td>
                <td><?= h($strategy->is_input) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $strategy->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $strategy->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $strategy->id], ['confirm' => __('Are you sure you want to delete # {0}?', $strategy->id)]) ?>
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
