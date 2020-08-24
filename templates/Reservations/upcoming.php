<?php
    $this->extend('/Common/registered');

    $this->start('sidebar');
        $role = $this->Identity->get('role');
        echo $this->element('sidebar/'.$role, ['active' => 'upcoming']);
    $this->end(); 
?>

<?php $this->start('page-content'); ?>
    <h3>Upcoming</h3><hr/>
    <?php if($reservations->isEmpty()) : ?>
        <p>No Upcoming Reservations. 
            <?=$this->Html->link('Book a Table', '/'); ?></p>
    <?php else: ?>
        <?php foreach ($reservations as $key => $reservation): ?>
        <ul class="list-unstyled">
        <li class="media">
            <svg class="bd-placeholder-img mr-3" width="64" height="64" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 64x64"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">64x64</text></svg>
            <div class="media-body">
                <h5 class="m-0">
                    <?= $reservation->has('restaurant') ? $this->Html->link($reservation->restaurant->name, 
                        ['controller' => 'Restaurants', 'action' => 'view', $reservation->restaurant->slug]) : '' ?>
                </h5>
                <div><?= h($reservation->reserved_date) ?></div>
                <div>Table for <?=h($reservation->total_guests) ?> people</div>
                <?= $this->Html->link(__('Modify'), ['action' => 'edit', $reservation->id], ['class' => 'pr-3']) ?>
                <?= $this->Form->postLink(__('Cancel'), ['action' => 'updateStatus', 'cancelled', $reservation->id], 
                        ['class' => '', 'confirm' => __('Confirm cancelling reservation {0}?', $reservation->reserved_date)]) ?>
            </div>
        </li>
        </ul>
        <?php endforeach; ?>
    <?php endif; ?>
<?php $this->end(); ?>