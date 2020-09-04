<div class="dropdown-menu">
    <?= $this->Html->link('Details', ['controller' => 'Restaurants', 'action' => 'edit', $restaurant->id], ['class' => 'dropdown-item']);?>
    <?= $this->Html->link('Gallery', ['controller' => 'Restaurants', 'action' => 'gallery', $restaurant->id], ['class' => 'dropdown-item']);?>
    <?= $this->Html->link('Menu', ['controller' => 'Menus', 'action' => 'index', $restaurant->id], ['class' => 'dropdown-item']);?>
</div>