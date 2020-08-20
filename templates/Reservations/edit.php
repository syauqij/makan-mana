<?php
    $this->extend('/Common/registered');

    $this->start('sidebar');
        $role = $this->Identity->get('role');
        echo $this->element('sidebar/'.$role, ['active' => 'reservations']);
    $this->end(); 
?>

<?php $this->start('page-content'); ?>
    <h1>Edit Reservations</h1>
<?php $this->end(); ?>

