<?php
    $this->extend('/Common/registered');
    
    $this->start('sidebar');
        $role = $this->Identity->get('role');
        echo $this->element('sidebar/'.$role, ['active' => 'restaurants']);
    $this->end(); 
?>

<?php $this->start('page-content'); ?>
    <div class="d-flex bd-highlight pb-2">
        <div class="flex-grow-1 bd-highlight">
            <h3>Manage Menu 
                <?php if($restaurant) : ?>
                   <?= $this->Html->link(__($restaurant->name), 
                        ['controller' => 'Restaurants','action' => 'view', $restaurant->slug], 
                        ['target' => ['_blank']
                    ]) ?>
                <?php endif;?>
            </h3>
        </div>
        <div class="bd-highlight">
            <?php if($restaurant) : ?>
                <?= $this->Html->link(__('New Menu'), 
                ['controller' => 'Menus', 'action' => 'add', (!empty($restaurant) ? $restaurant->id : '')],['class' => 'btn btn-secondary']); ?>
            <?php endif; ?>
        </div>
    </div>
    <?php if($menus->isEmpty()) : ?>
        <p>No records found.</p>
    <?php else: ?> 
        <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <?php if (empty($restaurant)) : ?>
                        <th><?= $this->Paginator->sort('restaurant_id') ?></th>
                    <?php endif; ?>
                    <th><?= $this->Paginator->sort('menu_category_id', 'Category') ?></th>
                    <th><?= $this->Paginator->sort('title', 'Title') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($menus as $menu): ?>
                <tr>
                    <?php if(empty($restaurant) ) : ?>
                    <td><?= $menu->has('restaurant') ? $this->Html->link($menu->restaurant->name, ['controller' => 'Menus', 'action' => 'index', $menu->restaurant->id]) : '' ?></td>
                    <?php endif; ?>
                    <td><?= $menu->has('menu_category') ? h($menu->menu_category->name) : '' ?></td>
                    <td><?= $this->Html->link($menu->title, ['action' => 'view', $menu->id]) ?></td>
                    <td><?= h($menu->created) ?></td>
                    <td><?= h($menu->modified) ?></td>
                    <td class="actions">
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
    <?php endif; ?>
<?php $this->end(); ?>