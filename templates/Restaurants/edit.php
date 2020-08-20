<?php
    $this->extend('/Common/registered');

    $this->start('sidebar');
        $role = $this->Identity->get('role');
        echo $this->element('sidebar/'.$role, ['active' => 'restaurants']);
    $this->end(); 
?>

<?php $this->start('page-content'); ?>   
    <div class="col-md-12">
        <h3>Edit <?= h($restaurant->name) ?></h3>
        <?php echo $this->element('form/restaurant_info'); ?>
    </div>

    <div class="col-md-12">
        <?php echo $this->element('form/restaurant_profiles'); ?>
    </div>    

    <hr class="mb-4">
    <?= $this->Form->button(__('Save'),[
            'class' => 'btn btn-primary btn-lg btn-block'
        ]) ?>
    <?= $this->Form->end(); ?>
<?php $this->end(); ?>