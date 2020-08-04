<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Restaurant[]|\Cake\Collection\CollectionInterface $restaurants
 */
?>
<div class="restaurants index content">
    <?= $this->Html->link(__('New Restaurant'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Restaurants') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('address_line_1') ?></th>
                    <th><?= $this->Paginator->sort('address_line_2') ?></th>
                    <th><?= $this->Paginator->sort('city') ?></th>
                    <th><?= $this->Paginator->sort('state') ?></th>
                    <th><?= $this->Paginator->sort('contact_no') ?></th>
                    <th><?= $this->Paginator->sort('website') ?></th>
                    <th><?= $this->Paginator->sort('price_range') ?></th>
                    <th><?= $this->Paginator->sort('payment_options') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($restaurants as $restaurant): ?>
                <tr>
                    <td><?= h($restaurant->name) ?></td>
                    <td><?= $restaurant->has('user') ? $this->Html->link($restaurant->user->id, ['controller' => 'Users', 'action' => 'view', $restaurant->user->id]) : '' ?></td>
                    <td><?= h($restaurant->address_line_1) ?></td>
                    <td><?= h($restaurant->address_line_2) ?></td>
                    <td><?= h($restaurant->city) ?></td>
                    <td><?= h($restaurant->state) ?></td>
                    <td><?= h($restaurant->contact_no) ?></td>
                    <td><?= h($restaurant->website) ?></td>
                    <td><?= $this->Number->format($restaurant->price_range) ?></td>
                    <td><?= h($restaurant->payment_options) ?></td>
                    <td><?= h($restaurant->created) ?></td>
                    <td><?= h($restaurant->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $restaurant->id]) ?>
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
</div>
