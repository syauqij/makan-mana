<?php 
	use Cake\I18n\FrozenTime; 

    $no = 1;
    while($no <= 20) {
        $options[$no] = $no . ' people';
        $no++;
    }

    $this->extend('/Common/registered');

    $this->start('sidebar');
        $role = $this->Identity->get('role');
        echo $this->element('sidebar/'.$role, ['active' => 'upcoming']);
    $this->end();
    
?>

<?php $this->start('page-content'); ?>
    <h3>Upcoming</h3><hr/>
    <div class="row">
    <div class="col-md-12">
        <ul class="list-unstyled">
            <li class="media">
                <?php if ($reservation->restaurant->image_file):?>
                    <?= $this->Html->image('restaurant-profile-photos/' . $reservation->restaurant->image_file, [
                        'url' => ['action' => 'view', $reservation->id],
                        'alt' =>  $reservation->restaurant->image_file,
                        'class' => 'mr-3 restaurant-photo-mini'
                    ]);?>
                <?php endif; ?>
                <div class="media-body">
                    <h5 class="m-0">
                        <?= $this->Html->link($reservation->restaurant->name, 
                            ['controller' => 'Restaurants', 'action' => 'view', $reservation->restaurant->slug]) ?>
                    </h5>
                    <div><?= h($reservation->reserved_date) ?></div>
                    <div>Table for <?=h($reservation->total_guests) ?> people</div>
                </div>
            </li>
        </ul>
        <?= $this->Form->create(null, [
        'type' => 'get',
        'url' => [
            'controller' => 'Reservations',
            'action' => 'edit', $reservation->id
        ]
        ]); ?>

        <div class="form-row">
            <div class="col-md-3 form-group">
                <?= $this->Form->date('date', [
                    'value' => $date,
                    'min' => $today,
                    'id' => 'date'
                ]); ?>
            </div>
            <div class="col-md-2 form-group">
                <?= $this->Form->select('time', $timeOptions, [
                    'value' => $time,
                    'id' => "time"
                ]); ?>
            </div>
            <div class="col-md-2 form-group">
                <?= $this->Form->select('guests', $options, [
                    'value' => $guests  
                ]); ?>
            </div>    
            <div class="col-md-2">
                <?= $this->Form->submit('Search', ['class' => 'btn btn-primary btn-block']) ?>
            </div>
        </div>
        <?= $this->Form->end() ?>
    
    <?php if (!empty($timeslots)) : ?>
        <div class="timeslots pt-2">
            <?php foreach ($timeslots as $key => $timeslot) : ?>
                <?php $timeFormatted = $this->Time->format($key, 'h:mm a'); $dateFormatted = $this->Time->format($date, 'dd/MM/yy');?>
                    <?php if ($timeslot) : ?>
                        <?= $this->Form->postLink(h($timeFormatted), [
                            'action' => 'edit', $reservation->id, $key, $guests],
                            ['class' => 'btn btn-danger btn-sm mb-2', 
                            'confirm' => __('Confirm modify reservation to {0}?', $dateFormatted . ', ' . $timeFormatted)]) ?>
                    <?php else: ?>
                        <button type="button" class="btn btn-secondary btn-sm mb-2 disabled"><?= h($timeFormatted) ?></button>
                    <?php endif; ?>
            <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No available time slots. Please select a different date or time.</p>
        </div>
    <?php endif;?>

    </div>
    </div>

<?php $this->end(); ?>

