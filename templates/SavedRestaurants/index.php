<?php
    $this->extend('/Common/registered');
    
    $this->start('sidebar');
        $role = $this->Identity->get('role');
        echo $this->element('sidebar/'.$role, ['active' => 'saved-restaurants']);
    $this->end(); 
?>

<?php $this->start('page-content'); ?>
    <h3>Saved Restaurants</h3>
    <?php if($savedRestaurants->isEmpty()) : ?>
        <p>No records found.</p>
    <?php else: ?> 
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('restaurant_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                    <th scope="actions col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($savedRestaurants as $key => $saved): ?>
                <tr>
                    <th scope="row"><?= h($saved->user->full_name) ?></th>
                    <td><?= $saved->has('restaurant') ? $this->Html->link($saved->restaurant->name, 
                            ['controller' => 'Restaurants', 'action' => 'view', $saved->restaurant->slug]) : '' ?></td>
                    <td><?= h($saved->created) ?></td>
                    <?php if($this->Identity->get('role') == "member") : ?>
                    <td class="actions">
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $saved->id],
                                    ['confirm' => __('Confirm delete {0}?', $saved->restaurant->name)]) ?>
                    </td>
                    <?php endif; ?>
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