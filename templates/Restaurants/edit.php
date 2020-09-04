<?php
    $this->extend('/Common/registered');

    $this->start('sidebar');
        $role = $this->Identity->get('role');
        echo $this->element('sidebar/'.$role, ['active' => 'restaurants']);
    $this->end(); 
?>

<?php $this->start('page-content'); ?>
    <?= $this->Form->create($restaurant, ['type' => 'file']); ?>
    <div class="col-md-10">
        <div class="d-flex bd-highlight">
            <div class="flex-grow-1 bd-highlight"><h3>Edit <?= h($restaurant->name) ?></h3></div>
            <div class="bd-highlight">
                <?php if($role != 'member') : ?>
                    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                        Edit
                    </button>
                    <?php echo $this->element('button/restaurant_dropdown') ?>
                <?php endif; ?>
            </div>
        </div>
        <p class="mb-3">Fill in your restaurant basic information.</p >
        <?php echo $this->element('form/restaurant_info'); ?>
    </div>

    <div class="col-md-10">
        <?php echo $this->element('form/restaurant_profiles'); ?>
    </div>    

    <div class="col-md-10 pt-4">
        <?= $this->Form->button(__('Save'),[
            'class' => 'btn btn-primary btn-lg'
        ]) ?>
    </div>
    <?= $this->Form->end(); ?>
<?php $this->end(); ?>