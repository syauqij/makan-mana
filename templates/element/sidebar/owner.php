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
<?= $this->Html->link('Reports', [
    'controller' => 'reports', 'action' => 'index'],
    ['class' => 'nav-link', 'id' => 'reports']
); ?>
<?= $this->Html->link('Account Details', [
    'controller' => 'users', 'action' => 'edit', $user_id],
    ['class' => 'nav-link', 'id' => 'users']
); ?>

<?php $this->start('script'); ?>
<script>
    $(document).ready(function(){
        $("#<?=h($active)?>").addClass('active');
    });
</script>
<?php $this->end(); ?>