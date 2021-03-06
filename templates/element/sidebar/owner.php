<?php 
    $user_id = $this->request->getAttribute('identity')->getIdentifier();
?>
<?php //debug($active)?>
<?= $this->Html->link('Reservations', [
    'controller' => 'reservations', 'action' => 'index'],
    ['class' => 'nav-link', 'id' => 'reservations']
); ?>
<?= $this->Html->link('Restaurants', [
    'controller' => 'restaurants', 'action' => 'index'],
    ['class' => 'nav-link', 'id' => 'restaurants']
); ?>
<?= $this->Html->link('Account Details', [
    'controller' => 'users', 'action' => 'edit', $user_id],
    ['class' => 'nav-link', 'id' => 'users']
); ?>
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