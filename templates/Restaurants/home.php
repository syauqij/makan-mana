<?php use Cake\Utility\Text; ?>

<section class="jumbotron mb-0" id="home-banner">
    <div class="container">
        <h1 class="display-4">Discover & Book Your Ideal Restaurant</h1>
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
</section>

<section class="bg-light home-content">
<div class="py-3">
    <div class="container-fluid px-4">
        <!-- to replace slick-->
        <h5 class="pt-3">Our Featured Restaurants</h5><hr/>
        <div class="row ">
        <?php foreach ($featured as $restaurant): ?>
        <div class="col-sm-4 col-md-3 d-flex align-items-stretch">
        <div class="card mb-4 shadow-sm">
            <?php if ($restaurant->image_file):?>
                <?= $this->Html->image('restaurant-profile-photos/' . $restaurant->image_file, [
                    'url' => ['action' => 'view', $restaurant->slug],
                    'alt' =>  $restaurant->image_file,
                    'class' => 'card-img-top restaurant-photo'
                ]);?>
            <?php endif; ?>
            <div class="card-body">
                <h5 class="card-title">
                    <?= $this->Html->link(Text::truncate($restaurant->name, 25), 
                        ['action' => 'view', $restaurant->slug]
                    );?>
                </h5>
                <div class="card-text">
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
                    <?= $this->cell('Booked', array($restaurant->id)) ?>
                </div>
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