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
        <?= $this->Form->create($restaurant, ['type' => 'file']); ?>
        
    </div>

    <div class="col-md-12">
        
    </div>    

    <hr class="mb-4">
        <?= $this->Form->button(__('Save'),[
            'class' => 'btn btn-primary'
        ]) ?>
    <?= $this->Form->end(); ?>
<?php $this->end(); ?>