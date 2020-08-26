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
            <?php if ($reservation->restaurant->image_file):?>
                <?= $this->Html->image('restaurant-profile-photos/' . $reservation->restaurant->image_file, [
                    'url' => ['action' => 'view', $reservation->restaurant->slug],
                    'alt' =>  $reservation->restaurant->image_file,
                    'class' => 'mr-3 restaurant-photo-mini'
                ]);?>
            <?php endif; ?>
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