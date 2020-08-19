<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Menu[]|\Cake\Collection\CollectionInterface $menus
 */
?>
<div class="menus index content">
    <?= $this->Html->link(__('New Menu'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Menus') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th><?= $this->Paginator->sort('restaurant_id') ?></th>
                    <th><?= $this->Paginator->sort('menu_category_id') ?></th>
                    <th><?= $this->Paginator->sort('sequence') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menus as $menu): ?>
                <tr>
                    <td><?= $this->Number->format($menu->id) ?></td>
                    <td><?= h($menu->name) ?></td>
                    <td><?= h($menu->description) ?></td>
                    <td><?= $menu->has('restaurant') ? $this->Html->link($menu->restaurant->name, ['controller' => 'Restaurants', 'action' => 'view', $menu->restaurant->id]) : '' ?></td>
                    <td><?= $menu->has('menu_category') ? $this->Html->link($menu->menu_category->name, ['controller' => 'MenuCategories', 'action' => 'view', $menu->menu_category->id]) : '' ?></td>
                    <td><?= $this->Number->format($menu->sequence) ?></td>
                    <td><?= h($menu->created) ?></td>
                    <td><?= h($menu->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $menu->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $menu->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id)]) ?>
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
