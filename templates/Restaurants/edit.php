<?php
    $this->extend('/Common/registered');

    $this->start('sidebar');
        $role = $this->Identity->get('role');
        echo $this->element('sidebar/'.$role, ['active' => 'restaurants']);
    $this->end(); 
?>

<?php $this->start('page-content'); ?>
    <?= $this->Form->create($restaurant, ['type' => 'file']); ?>
    <div class="col-md-12">
        <h3>Edit <?= h($restaurant->name) ?></h3>
        <p class="mb-3">Fill in your restaurant basic information.</p >
        <?php echo $this->element('form/restaurant_info'); ?>
    </div>

    <div class="col-md-12">
        <?php echo $this->element('form/restaurant_profiles'); ?>
    </div>    

    <div class="col-md-12">
        <?= $this->Form->button(__('Save'),[
            'class' => 'btn btn-primary'
        ]) ?>
    </div>
    <?= $this->Form->end(); ?>
<?php $this->end(); ?>