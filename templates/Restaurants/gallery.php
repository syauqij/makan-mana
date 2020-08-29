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
    <?= $this->Form->create($restaurant, [
        'type' => 'file',
        'class' => 'dropzone pt-4', 'id' => 'my-awesome-dropzone',
        'url' => ['controller' => 'RestaurantPhotos', 'action' => 'upload', $restaurant->id]
    ]); ?>
</div>

<div class="row">
<?php foreach($restaurant->restaurant_photos as $photo): ?>
    <div class="d-flex flex-nowrap">
    <div class="card-image-top" style="width: 18rem; height: 15rem">
                <?= $this->Html->image('restaurant-photos/' . $photo->image_file, [
                            'class' => 'card-img-top', 
                ]);?>
            <div class="card-body">
            </div>
            </div>
    </div>
    <?php endforeach; ?>
</div>
    <?= $this->Form->end(); ?>
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
            alert("asd")
            }
            else {
                done();
                $('.gallery').html(response);
            }
        }
        };
    });
    </script>
<?php $this->end(); ?>