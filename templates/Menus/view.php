<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Menu $menu
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Menu'), ['action' => 'edit', $menu->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Menu'), ['action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Menus'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Menu'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="menus view content">
            <h3><?= h($menu->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($menu->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Description') ?></th>
                    <td><?= h($menu->description) ?></td>
                </tr>
                <tr>
                    <th><?= __('Restaurant') ?></th>
                    <td><?= $menu->has('restaurant') ? $this->Html->link($menu->restaurant->name, ['controller' => 'Restaurants', 'action' => 'view', $menu->restaurant->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Menu Category') ?></th>
                    <td><?= $menu->has('menu_category') ? $this->Html->link($menu->menu_category->name, ['controller' => 'MenuCategories', 'action' => 'view', $menu->menu_category->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($menu->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Order') ?></th>
                    <td><?= $this->Number->format($menu->order) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($menu->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($menu->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Menu Items') ?></h4>
                <?php if (!empty($menu->menu_items)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Int') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Price') ?></th>
                            <th><?= __('Order') ?></th>
                            <th><?= __('Menu Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($menu->menu_items as $menuItems) : ?>
                        <tr>
                            <td><?= h($menuItems->int) ?></td>
                            <td><?= h($menuItems->name) ?></td>
                            <td><?= h($menuItems->description) ?></td>
                            <td><?= h($menuItems->price) ?></td>
                            <td><?= h($menuItems->order) ?></td>
                            <td><?= h($menuItems->menu_id) ?></td>
                            <td><?= h($menuItems->created) ?></td>
                            <td><?= h($menuItems->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'MenuItems', 'action' => 'view', $menuItems->int]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'MenuItems', 'action' => 'edit', $menuItems->int]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'MenuItems', 'action' => 'delete', $menuItems->int], ['confirm' => __('Are you sure you want to delete # {0}?', $menuItems->int)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
