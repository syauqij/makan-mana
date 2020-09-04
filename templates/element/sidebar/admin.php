<?php 
    $user_id = $this->request->getAttribute('identity')->getIdentifier();
?>
<?php //debug($active)?>
<?= $this->Html->link('Reservations', [
    'controller' => 'reservations', 'action' => 'index'],
    ['class' => 'nav-link mb-1', 'id' => 'reservations']
); ?>
<?= $this->Html->link('Restaurants', [
    'controller' => 'restaurants', 'action' => 'index'],
    ['class' => 'nav-link mb-1', 'id' => 'restaurants']
); ?>
<?= $this->Html->link('Users', [
    'controller' => 'users', 'action' => 'index', $user_id],
    ['class' => 'nav-link mb-1', 'id' => 'users']
); ?>

<li class="nav-item dropdown mb-1">
    <a class="nav-link dropdown-toggle" id="setting" data-toggle="dropdown" href="#" 
    role="button" aria-haspopup="true" aria-expanded="false">Setting</a>
    <div class="dropdown-menu">
        <?= $this->Html->link('Menu Categories', [
            'controller' => 'menu_categories', 'action' => 'index'],
            ['class' => 'dropdown-item']
        ); ?>
      <?= $this->Html->link('Cuisines Selection', [
            'controller' => 'cuisines', 'action' => 'index'],
            ['class' => 'dropdown-item']
        ); ?>
    </div>
  </li>
<?php $this->start('from_sidebar'); ?>
<script>
    $(document).ready(function() {
        $("#<?=h($active)?>").addClass('active');
        $('#select2-cuisines').select2({
            maximumSelectionLength: 5,
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear'))
        });
    });
</script>
<?php $this->end() ?>