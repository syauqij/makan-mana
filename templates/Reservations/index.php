<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reservation[]|\Cake\Collection\CollectionInterface $reservations
 */
?>
<div class="reservations index content">
    <?= $this->Html->link(__('New Reservation'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Reservations') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('restaurant_id') ?></th>
                    <th><?= $this->Paginator->sort('reserved_date') ?></th>
                    <th><?= $this->Paginator->sort('total_guests') ?></th>
                    <th><?= $this->Paginator->sort('restaurant_table_id') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservations as $reservation): ?>
                <tr>
                    <td><?= $this->Number->format($reservation->id) ?></td>
                    <td><?= $reservation->has('user') ? $this->Html->link($reservation->user->id, ['controller' => 'Users', 'action' => 'view', $reservation->user->id]) : '' ?></td>
                    <td><?= $reservation->has('restaurant') ? $this->Html->link($reservation->restaurant->name, ['controller' => 'Restaurants', 'action' => 'view', $reservation->restaurant->id]) : '' ?></td>
                    <td><?= h($reservation->reserved_date) ?></td>
                    <td><?= $this->Number->format($reservation->total_guests) ?></td>
                    <td><?= $reservation->has('restaurant_table') ? $this->Html->link($reservation->restaurant_table->name, ['controller' => 'RestaurantTables', 'action' => 'view', $reservation->restaurant_table->id]) : '' ?></td>
                    <td><?= h($reservation->status) ?></td>
                    <td><?= h($reservation->created) ?></td>
                    <td><?= h($reservation->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $reservation->uuid]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $reservation->uuid]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $reservation->uuid], ['confirm' => __('Are you sure you want to delete # {0}?', $reservation->id)]) ?>
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
