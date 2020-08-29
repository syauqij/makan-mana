<?php
    $this->extend('/Common/registered');

    $this->start('sidebar');
        $role = $this->Identity->get('role');
        echo $this->element('sidebar/'.$role, ['active' => 'setting']);
    $this->end(); 
?>

<?php $this->start('page-content'); ?>
<h3>Edit Menu Category - <?= h($menuCategory->name) ?></h3><hr/>

<?= $this->Form->create($menuCategory) ?>
<div class="form-row">
    <div class="col-md-6 form-group">
        <?= $this->Form->control('name'); ?>
    </div>
    <div class="col-md-2 form-group">
        <?= $this->Form->control('sequence'); ?>
    </div>
</div>
<div class="row">
<div class="col-md-2">
    <?= $this->Form->submit('Update', ['class' => 'btn btn-primary']) ?>
</div>
<?= $this->Form->end() ?>
<?php $this->end(); ?>
