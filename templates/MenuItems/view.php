<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\MenuItem $menuItem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Menu Item'), ['action' => 'edit', $menuItem->int], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Menu Item'), ['action' => 'delete', $menuItem->int], ['confirm' => __('Are you sure you want to delete # {0}?', $menuItem->int), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Menu Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Menu Item'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="menuItems view content">
            <h3><?= h($menuItem->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($menuItem->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Menu') ?></th>
                    <td><?= $menuItem->has('menu') ? $this->Html->link($menuItem->menu->name, ['controller' => 'Menus', 'action' => 'view', $menuItem->menu->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($menuItem->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Price') ?></th>
                    <td><?= $this->Number->format($menuItem->price) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sequence') ?></th>
                    <td><?= $this->Number->format($menuItem->sequence) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($menuItem->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($menuItem->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($menuItem->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>
