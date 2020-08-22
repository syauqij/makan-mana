<div class="page-header">
    <div class="container">  
        <?= $this->Form->create(null, [
            'type' => 'get',
            'url' => [
                'controller' => 'Restaurants',
                'action' => 'search'
            ]
        ]); ?>
        <div class="form-row pt-4 pb-2">  
            <?php echo $this->element('form/search'); ?>
        </div>
        <?= $this->Form->end() ?>
    </div>
</div>
<div class="album py-5 bg-light">
    <div class="container">
    <div class="row">
    <?php foreach ($restaurants as $restaurant): ?>
        <div class="col-sm-4">
        <div class="card mb-4 shadow-sm">                    
            <?php if ($restaurant->image_file):?>
                <?= $this->Html->image('restaurant-profile-photos/' . $restaurant->image_file, [
                    'url' => ['action' => 'view', $restaurant->slug],
                    'alt' =>  $restaurant->image_file,
                    'class' => 'bd-placeholder-img card-img-top'
                ]);?>
            <?php endif; ?>
            <div class="card-body">
                <h5 class="card-title">
                    <?= $this->Html->link($restaurant->name, 
                        ['action' => 'view', $restaurant->slug]
                    );?>
                </h5>
                <p class="cuisines card-text">
                    <?= h($restaurant->city) ?>, <?=h($restaurant->state) ?><br/>
                    <?php $count = 0; ?>
                    <?php foreach ($restaurant->cuisines as $cuisine) : ?>
                        <?php if($count < 5) : ?>
                        <?= $this->Html->link($cuisine->name, 
                            ['action' => 'search', $cuisine->name],
                            ['class' => 'badge badge-secondary']
                        );?>
                        <?php $count++; endif; ?>
                    <?php endforeach; ?>
                    <br/>
                    <?php if ($restaurant->timeslots) : ?>
                        <div class="timeslots">
                        <?php foreach ($restaurant->timeslots as $key => $timeslot) : ?>
                            <?= $this->Html->link($timeslot, [
                                'controller' => 'reservations', 'action' => 'create',
                                    '?' => ['restaurant_id' => $restaurant->id, 'total_guests' => $guests, 'reserved_date' => $key]],
                                ['class' => 'btn btn-secondary btn-sm mb-2']
                            );  ?>
                        <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <h4>No available time slots</h4>
                    <?php endif;?>
            </div>
        </div>
        </div>
    <?php endforeach; ?>        
    </div>
    </div>
</div>