<?php
    $this->extend('/Common/registered');

    $this->start('sidebar');
        $role = $this->Identity->get('role');
        echo $this->element('sidebar/'.$role, ['active' => 'restaurants']);
    $this->end(); 
?>

<?php $this->start('page-content'); ?>   
    <div class="d-flex bd-highlight">
        <div class="flex-grow-1 bd-highlight"><h3>Edit <?= h($restaurant->name) ?> Gallery</h3></div>
        <div class="bd-highlight">
            <button class="btn btn-secondary", onClick="window.location.href=window.location.href">Reload</button>
            <?php if($role != 'member') : ?>
                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                    Edit
                </button>
                <div class="dropdown-menu">
                    <?= $this->Html->link('Details', ['controller' => 'Restaurants', 'action' => 'edit', $restaurant->id], ['class' => 'dropdown-item']);?>
                    <?= $this->Html->link('Gallery', ['controller' => 'Restaurants', 'action' => 'gallery', $restaurant->id], ['class' => 'dropdown-item']);?>
                    <?= $this->Html->link('Menus', ['controller' => 'Menus', 'action' => 'index', $restaurant->id], ['class' => 'dropdown-item']);?>
                </div>
            <?php endif; ?>
        </div>
    </div><hr/>
<div class = "col-12 mb-4">


<div class="row">
    <?php foreach($restaurant->restaurant_photos as $photo): ?>
    <div class="d-flex align-items-stretch mb-1">
            <div class="card ">
                <?= $this->Html->image('restaurant-photos/' . $photo->image_file, [
                        'class' => 'card-img-top restaurant-photo-mini', 
                ]);?>
            <div class="card-body text-center">
            <?= $this->Form->postLink(__('Delete'), ['controller' => 'RestaurantPhotos',  'action' => 'delete', $photo->id, $restaurant->id],
            ['class' => 'btn btn-danger','confirm' => __('Are you sure you want to delete # {0}?', $photo->image_file)]) ?>
            </div>

        </div>
    </div>
    <?php endforeach; ?>
</div><hr/>

<?= $this->Form->create($restaurant, [
        'type' => 'file',
        'class' => 'dropzone pt-4', 'id' => 'my-awesome-dropzone',
        'url' => ['controller' => 'RestaurantPhotos', 'action' => 'upload', $restaurant->id]
    ]); ?>
        <?= $this->Form->end(); ?>
</div>

<?php $this->end(); ?>


<?php $this->start('script') ?>
<script>
    $(document).ready(function() {
        Dropzone.options.myAwesomeDropzone = {
        paramName: "file", // The name that will be used to transfer the file

        maxFilesize: 2, // MB
        accept: function(file, done) {
            if (file.name == "justinbieber.jpg") {
            done("Naha, you don't.");
            }
            else {
                done();
            }
        }
        };
    });
    </script>
<?php $this->end(); ?>