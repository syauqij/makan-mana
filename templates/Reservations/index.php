<?php 
    $user_id = $this->request->getAttribute('identity')->getIdentifier();
?>

<div class="page-header">
    <div class="container">
        <h1 class="display-4"><?= h($this->Identity->get('full_name')) ?></h1>
    </div>
</div>

<div class="album py-3 bg-light">
<div class="container">
    <div class="row">
    <div class="col-md-3 pb-3">
        <nav class="nav nav-pills flex-column">
            <?= $this->Html->link('Reservations', [
                'controller' => 'reservations', 'action' => 'index'],
                ['class' => 'nav-link active']
            ); ?>
            <?= $this->Html->link('Dining History', [
                'controller' => 'reservations', 'action' => 'history'],
                ['class' => 'nav-link']
            ); ?>
            <?= $this->Html->link('Favourites', [
                'controller' => 'restaurants', 'action' => 'favourites'],
                ['class' => 'nav-link']
            ); ?>
            <?= $this->Html->link('Account Details', [
                'controller' => 'users', 'action' => 'edit', $user_id],
                ['class' => 'nav-link']
            ); ?>
        </nav>
    </div>
    <div class="col-md-9">
        <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
        <h3><?= __('Reservations') ?></h3>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class>No</th>
                            <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('restaurant_id') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('reserved_date') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('total_guests', 'Guests') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('status') ?></th>
                            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                            <th scope="actions col"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservations as $key => $reservation): ?>
                        <tr>
                            <th scope="row"><?= $key+1 ?></th>
                            <td><?= h($reservation->user->full_name) ?></td>
                            <td><?= $reservation->has('restaurant') ? $this->Html->link($reservation->restaurant->name, ['controller' => 'Restaurants', 'action' => 'view', $reservation->restaurant->slug]) : '' ?></td>
                            <td><?= h($reservation->reserved_date) ?></td>
                            <td><?= $this->Number->format($reservation->total_guests) ?></td>
                            <td><?= h($reservation->status) ?></td>
                            <td><?= h($reservation->created) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['action' => 'view', $reservation->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $reservation->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $reservation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reservation->id)]) ?>
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
        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
        </div>
    </div>
    </div>
</div>
</div>