<div class="col-md-6 pt-2 menu-item">
    <div class="d-flex bd-highlight pb-2">
        <div class="flex-grow-1 bd-highlight">
            Menu Item
        </div>
        <div class="bd-highlight">
            <button type="button" class="delete-item btn btn-danger btn-sm"> 
                <i class="fas fa-minus"></i> 
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
        <?= $this->Form->control('menu_items.' . (isset($key) ? $key : 0) . '.id', [
            'label' => false,
            'placeholder' => 'Id'
        ]); ?>
        <?= $this->Form->control('menu_items.' . (isset($key) ? $key : 0) . '.name', [
            'label' => false,
            'placeholder' => 'Name'
        ]); ?>
        </div>
        <div class="col-md-12">
        <?= $this->Form->control('menu_items.' . (isset($key)  ? $key : 0)  . '.description', [
            'label' => false,
            'placeholder' => 'Description',
            'rows' => 3
        ]); ?>
        </div>
        <div class="offset-8 col-md-4">
        <?= $this->Form->control('menu_items.' . (isset($key)  ? $key : 0)  . '.price', [
            'label' => false,
            'placeholder' => 'RM',
        ]); ?>
        </div>
    </div>
</div>