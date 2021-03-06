<?php
    $this->extend('/Common/registered');

    $this->start('sidebar');
        $role = $this->Identity->get('role');
        echo $this->element('sidebar/'.$role, ['active' => 'restaurants']);
    $this->end(); 
?>

<?php $this->start('page-content'); ?>

<?= $this->Form->create($menu) ?>
    <div class="d-flex bd-highlight pb-2">
        <div class="flex-grow-1 bd-highlight">
            <h3>Add Menu <?= !empty($restaurant) ? $restaurant->name : '' ?></h3>
        </div>
        <div class="bd-highlight">
            <?= $this->Html->link(__('Back'), 
            ['controller' => 'Menus', 'action' => 'index', $restaurant->id],['class' => 'btn btn-secondary']); ?>
        </div>
    </div>
    
    <?php echo $this->element('form/restaurant_menu'); ?>
    
    <div class="row" id="menu-items">
        <?php echo $this->element('form/menu_items'); ?>
    </div>

    <hr/>
    <button type="type" class="btn btn-primary mb-2">Create</button>
    <button type="button" class="add-item btn btn-info btn-sm mb-2 float-right"> 
        <i class="fas fa-plus add-item "></i> Menu Item
    </button>
<?php $this->end(); ?>