<?php
    $this->extend('/Common/registered');

    $this->start('sidebar');
        $role = $this->Identity->get('role');
        echo $this->element('sidebar/'.$role, ['active' => 'setting']);
    $this->end(); 
?>

<?php $this->start('page-content'); ?>
<h3>Add New Cuisine</h3><hr/>

<?= $this->Form->create($cuisine) ?>
<div class="form-row">
    <div class="col-md-6 form-group">
        <?= $this->Form->control('name'); ?>
    </div>
    <div class="col-md-7 form-group">
        <?= $this->Form->control('description'); ?>
    </div>
</div>
<div class="row">
<div class="col-md-2">
    <?= $this->Form->submit('Create', ['class' => 'btn btn-primary']) ?>
</div>
<?= $this->Form->end() ?>
<?php $this->end(); ?>