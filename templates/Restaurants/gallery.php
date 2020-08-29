<?php
    $this->extend('/Common/registered');

    $this->start('sidebar');
        $role = $this->Identity->get('role');
        echo $this->element('sidebar/'.$role, ['active' => 'restaurants']);
    $this->end(); 
?>

<?php $this->start('page-content'); ?>   
    <div class="col-md-12">
        <h3>Edit <?= h($restaurant->name) ?> Gallery</h3>
        <?= $this->Form->create($restaurant, [
            'type' => 'file',
            'class' => 'dropzone', 'id' => 'my-awesome-dropzone',
            'url' => ['controller' => 'RestaurantPhotos', 'action' => 'upload', $restaurant->id]
            ]
        ); ?>
        
    </div>

<div class="gallery">
<?php foreach($restaurant->restaurant_photos as $photo): ?>
    <?= $this->Html->image('restaurant-profile-photos/' . $photo->image_file, [
        'class' => 'mr-3 restaurant-photo-mini'
    ]);?>
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