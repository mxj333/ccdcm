<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\Action $action
  */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Action'), ['action' => 'edit', $action->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Action'), ['action' => 'delete', $action->id], ['confirm' => __('Are you sure you want to delete # {0}?', $action->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Actions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Action'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Strategies'), ['controller' => 'Strategies', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Strategy'), ['controller' => 'Strategies', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Sends'), ['controller' => 'Sends', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Send'), ['controller' => 'Sends', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="actions view large-9 medium-8 columns content">
    <h3><?= h($action->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Strategy') ?></th>
            <td><?= $action->has('strategy') ? $this->Html->link($action->strategy->name, ['controller' => 'Strategies', 'action' => 'view', $action->strategy->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Sendto') ?></th>
            <td><?= h($action->sendto) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($action->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Type') ?></th>
            <td><?= $this->Number->format($action->type) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Delay') ?></th>
            <td><?= $this->Number->format($action->delay) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Repeat') ?></th>
            <td><?= $this->Number->format($action->repeat) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Interval') ?></th>
            <td><?= $this->Number->format($action->interval) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Executed Num') ?></th>
            <td><?= $this->Number->format($action->executed_num) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $action->status ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Sends') ?></h4>
        <?php if (!empty($action->sends)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Action Id') ?></th>
                <th scope="col"><?= __('Type') ?></th>
                <th scope="col"><?= __('Sendto') ?></th>
                <th scope="col"><?= __('Subject') ?></th>
                <th scope="col"><?= __('Message') ?></th>
                <th scope="col"><?= __('Status') ?></th>
                <th scope="col"><?= __('Delay') ?></th>
                <th scope="col"><?= __('Repeat') ?></th>
                <th scope="col"><?= __('Interval') ?></th>
                <th scope="col"><?= __('Executed Num') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($action->sends as $sends): ?>
            <tr>
                <td><?= h($sends->id) ?></td>
                <td><?= h($sends->action_id) ?></td>
                <td><?= h($sends->type) ?></td>
                <td><?= h($sends->sendto) ?></td>
                <td><?= h($sends->subject) ?></td>
                <td><?= h($sends->message) ?></td>
                <td><?= h($sends->status) ?></td>
                <td><?= h($sends->delay) ?></td>
                <td><?= h($sends->repeat) ?></td>
                <td><?= h($sends->interval) ?></td>
                <td><?= h($sends->executed_num) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Sends', 'action' => 'view', $sends->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Sends', 'action' => 'edit', $sends->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Sends', 'action' => 'delete', $sends->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sends->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
