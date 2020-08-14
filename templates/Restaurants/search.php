<div class="container">
<?php
    //change default form template. 
    $myTemplates = [
        'inputContainer' =>'{{content}}',
        'input' => '<div class="form-group"><input class="form-control" type="{{type}}" name="{{name}}"{{attrs}}/></div>',
        'select' => '<div class="form-group"><select class="form-control" name="{{name}}"{{attrs}}>{{content}}</select></div>'
    ];
    $this->Form->setTemplates($myTemplates); 
    $options = ['1' => '1 People', '2' => '2 People'];
?>
<p> 
    <?= $this->Form->create(null, [
        'type' => 'get',
        'url' => [
            'controller' => 'Restaurants',
            'action' => 'search'
        ]
    ]); ?>
    <div class="form-row">
        <div class="col-sm-2">
            <?= $this->Form->date('date', [
                'value' => $date,
                'min' => $today
            ]); ?>
        </div>
        <div class="col-sm-2">
            <?= $this->Form->select('time', $timeOptions, [
                'value' => $time
                ]); ?>
        </div>
        <div class="col-sm-2">
            <?= $this->Form->select('guests', $options, [
                'value' => '2'
                ]); ?>
        </div>
        <div class="col-sm-4">
            <?= $this->Form->control('term', [
                'label' => false, 
                'value' => $this->request->getQuery('term'),
                'placeholder' => 'Search a Location, Restaurant, or Cuisine'
                ]
            ) ?>
        </div>
        <?= $this->Form->submit('Search', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<div class="album py-5 bg-light">
    <div class="container">
    <div class="row">
    <?php foreach ($restaurants as $restaurant): ?>
        <div class="col-sm-4">
        <div class="card mb-4 shadow-sm">                    
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em"><?= h($restaurant->slug) ?></text></svg>
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
                                'controller' => 'reservations', 'action' => 'add',
                                    '?' => ['restaurant_id' => $restaurant->id, 'total_guests' => 2, 'reserved_date' => $key]],
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