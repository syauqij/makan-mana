<section class="jumbotron" id="home-banner">
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
                    'min' => $date,
                    'id' => 'date'
                ]); ?>
            </div>
            <div class="col-sm-2">
                <?= $this->Form->select('time', $timeOptions, [
                    'value' => $time,
                    'id' => "time"
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
        <div class="quick-searches">
            <?php foreach ($cuisines as $key => $cuisine) : ?>
                <?= $this->Html->link($cuisine, 
                    ['controller' => 'Restaurants', 'action' => 'search',$cuisine],
                    ['class' => 'badge badge-secondary']
                );?>
            <?php endforeach; ?>
        </p>
        <?= $this->Form->end() ?>
                
    </div>
</section>

<section class="bg-light home-content">
<div class="py-3">
    <div class="container">
        <!-- to replace slick-->
        <div class="row ">
        <?php foreach ($featured as $restaurant): ?>
        <div class="col-sm-3">
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
                        <?php if($count < 3) : ?>
                        <?= $this->Html->link($cuisine->name, 
                            ['action' => 'search', $cuisine->name],
                            ['class' => 'badge badge-secondary']
                        );?>
                        <?php $count++; endif; ?>
                    <?php endforeach; ?>
                </p>
            </div>
        </div>
        </div>
        <?php endforeach; ?>   
        </div>        
        <hr/>
    </div>
</div>
</section>

<?php $this->start('script'); ?>
<script>
    var selected = $("#DD1 option:selected").val();
    $('#DD1 option').each(function() {
        
        if ($(this).val() == selected ) {
            return false;           
        }
    });
</script>
<?php $this->end(); ?>