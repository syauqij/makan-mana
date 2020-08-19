<?php 
    $user_id = $this->request->getAttribute('identity')->getIdentifier();
?>
<?php //debug($active)?>
<h3>Manage</h3>
<?= $this->Html->link('Reservations', [
    'controller' => 'reservations', 'action' => 'members'],
    ['class' => 'nav-link', 'id' => 'reservations']
); ?>
<?= $this->Html->link('Restaurants', [
    'controller' => 'reservations', 'action' => 'index'],
    ['class' => 'nav-link', 'id' => 'dining-history']
); ?>
<?= $this->Html->link('Reports', [
    'controller' => 'restaurants', 'action' => 'favourites'],
    ['class' => 'nav-link', 'id' => 'favourites']
); ?>
<?= $this->Html->link('Account Details', [
    'controller' => 'users', 'action' => 'edit', $user_id],
    ['class' => 'nav-link', 'id' => 'account-details']
); ?>

<?php $this->start('script'); ?>
<script>
    $(document).ready(function(){
        $("#<?=h($active)?>").addClass('active');
    });
</script>
<?php $this->end(); ?>