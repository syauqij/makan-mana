<?php
    $this->extend('/Common/registered');
    
    $this->start('sidebar');
        $role = $this->Identity->get('role');
        echo $this->element('sidebar/'.$role, ['active' => 'restaurants']);
    $this->end(); 
?>

<?php $this->start('page-content'); ?>
    <h3>Manage Restaurants</h3>
    <?php if($restaurants->isEmpty()) : ?>
        <p>No records found.</p>
    <?php else: ?> 
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('full_address') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                    <th scope="actions col"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($restaurants as $key => $restaurant): ?>
                <tr>
                    <th scope="row"><?= $this->Html->link($restaurant->name, ['controller' => 'Restaurants', 'action' => 'view', $restaurant->slug]) ?></th>
                    <td><?= h($restaurant->full_address) ?></td>
                    <td><?= h($restaurant->status) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $restaurant->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $restaurant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $restaurant->id)]) ?>
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