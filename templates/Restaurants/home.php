<?php 
    use Cake\I18n\FrozenTime;
    $now = FrozenTime::now();
    $time = $now->modify('+2 hours')->i18nFormat('HH:mm');
?>
<section class="jumbotron">
    <div class="container">
        <h1 class="display-4">Discover & Book Your Ideal Restaurant</h1>
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
                <div class="col-sm-3">
                    <?= $this->Form->date('date', [
                        'value' => $now
                    ]); ?>
                </div>
                <div class="col-sm-2">
                    <?= $this->Form->time('time', [
                        'min' => '10:00',
                        'max' => '20:00',
                        'value' => $time
                    ]); ?>
                </div>
                
                <div class="col-sm-2">
                    <?= $this->Form->select('total_guests', $options, [
                        'value' => '2'
                        ]); ?>
                </div>
                <div class="col">
                    <?= $this->Form->control('key', [
                        'label' => false, 
                        'value' => $this->request->getQuery('key'),
                        'placeholder' => 'Search a Location, Restaurant, or Cuisine'
                        ]
                    ) ?>
                </div>
                <?= $this->Form->submit('Search', ['class' => 'btn btn-primary']) ?>
            </div>  
        </p>
        <p class="text-muted">Quick Search: Birthday, BBQ, Steamboat, Dating, Family, Rooftop </p>
        <?= $this->Form->end() ?>
                
    </div>
</section>
<div class="album py-5 bg-light">
    <div class="container">
    <div class="row">
        <?php foreach ($featured as $restaurant): ?>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" 
                    preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: thumbnail">
                    <title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/>
                    <text x="50%" y="50%" fill="#eceeef" dy=".3em"><?= h($restaurant->name) ?></text>
                </svg>
                <div class="card-img-overlay">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    <p class="card-text">Last updated 3 mins ago</p>
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?= h($restaurant->name) ?></h5>
                    <p class="card-text"><?= h($restaurant->city) ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                    <small class="text-muted">9 mins</small>
                    </div>
                </div>
                </div>
            </div>
        <?php endforeach; ?>        

    </div>
    </div>
</div>