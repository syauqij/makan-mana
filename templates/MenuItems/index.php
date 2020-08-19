<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MenuItem[]|\Cake\Collection\CollectionInterface $menuItems
 */
?>
<div class="menuItems index content">
    <?= $this->Html->link(__('New Menu Item'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Menu Items') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('price') ?></th>
                    <th><?= $this->Paginator->sort('sequence') ?></th>
                    <th><?= $this->Paginator->sort('menu_id') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menuItems as $menuItem): ?>
                <tr>
                    <td><?= $this->Number->format($menuItem->id) ?></td>
                    <td><?= h($menuItem->name) ?></td>
                    <td><?= $this->Number->format($menuItem->price) ?></td>
                    <td><?= $this->Number->format($menuItem->sequence) ?></td>
                    <td><?= $menuItem->has('menu') ? $this->Html->link($menuItem->menu->name, ['controller' => 'Menus', 'action' => 'view', $menuItem->menu->id]) : '' ?></td>
                    <td><?= h($menuItem->created) ?></td>
                    <td><?= h($menuItem->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $menuItem->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $menuItem->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $menuItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menuItem->int)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
