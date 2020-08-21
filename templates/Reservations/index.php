<?php
    $this->extend('/Common/registered');
    
    $this->start('sidebar');
        $role = $this->Identity->get('role');
        echo $this->element('sidebar/'.$role, ['active' => 'reservations']);
    $this->end(); 
?>

<?php $this->start('page-content'); ?>
    <h3>Manage Reservations</h3>
    <?php if($reservations->isEmpty()) : ?>
        <p>No records found.</p>
    <?php else: ?> 
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('restaurant_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('reserved_date') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('total_guests', 'Guests') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                    <th scope="actions col"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $key => $reservation): ?>
                <tr>
                    <th scope="row"><?= h($reservation->user->full_name) ?></th>
                    <td><?= $reservation->has('restaurant') ? $this->Html->link($reservation->restaurant->name, ['controller' => 'Restaurants', 'action' => 'view', $reservation->restaurant->slug]) : '' ?></td>
                    <td><?= h($reservation->reserved_date) ?></td>
                    <td><?= $this->Number->format($reservation->total_guests) ?></td>
                    <td><?= h($reservation->status) ?></td>
                    <?php if($this->Identity->get('role') == "owner") : ?>
                    <td class="actions">
                        <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                            Update
                        </button>
                        <div class="dropdown-menu">
                            <?= $this->Html->link('Accept', ['controller' => 'Reservation', 'action' => 'update'], ['class' => 'dropdown-item']);?>
                            <?= $this->Html->link('Decline', ['controller' => 'Restaurants', 'action' => 'update'], ['class' => 'dropdown-item']);?>
                            <?= $this->Html->link('Complete', ['controller' => 'Menus', 'action' => 'update'], ['class' => 'dropdown-item']);?>
                        </div>
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