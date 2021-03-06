<?php
    $this->extend('/Common/registered');
    
    $this->start('sidebar');
        $role = $this->Identity->get('role');
        echo $this->element('sidebar/'.$role, ['active' => 'restaurants']);
    $this->end(); 
?>

<?php $this->start('page-content'); ?>
    <div class="d-flex bd-highlight">
        <div class="p-2 flex-grow-1 bd-highlight"><h3>Manage Restaurant</h3></div>
        <div class="p-2 bd-highlight">
            <?php if($role != 'member') : ?>
                <?= $this->Html->link(__('Register New'), 
                ['controller' => 'Register', 'action' => 'restaurant', $role],['class' => 'btn btn-secondary']); ?>
            <?php endif; ?>
        </div>
    </div>
    <?php if($restaurants->isEmpty()) : ?>
        <p>No records found.</p>
    <?php else: ?> 
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('full_address') ?></th>
                    <th scope="col"></th>
                    <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                    <th scope="actions col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($restaurants as $key => $restaurant): ?>
                <tr>
                    <th scope="row"><?= $this->Html->link($restaurant->name, ['controller' => 'Restaurants', 'action' => 'view', $restaurant->slug]) ?></th>
                    <td><?= h($restaurant->full_address) ?></td>
                    <td><?= $this->Html->link('Saved List', ['controller' => 'SavedRestaurants', 'action' => 'index']);?></td>
                    <td><?= h(ucwords($restaurant->status)) ?></td>
                    <td class="actions">
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                            Edit
                        </button>
                        <?php echo $this->element('button/restaurant_dropdown', ['restaurant' => $restaurant]); ?>
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