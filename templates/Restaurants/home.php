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

<div class="album py-3 bg-light">
    <div class="container">
        <div class="row featured">
        <?php foreach ($featured as $restaurant): ?>
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

<?php $this->start('script'); ?>
<script>
    $(document).ready(function(){
        $('.featured').slick({
            infinite: false,
            speed: 300,
            slidesToShow: 4,
            arrows: true,
            responsive: [
                {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
                },
                {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    });

    var selected = $("#DD1 option:selected").val();
    //alert(selected);
    $('#DD1 option').each(function() {
        
        if ($(this).val() == selected ) {
            return false;           
        }
    });
</script>
<?php $this->end(); ?>