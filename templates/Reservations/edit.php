<?php
    $this->extend('/Common/members_page');

    $this->start('sidebar');
        echo $this->element('sidebar/members', ['active' => 'reservations']);
    $this->end(); 
?>

<?php $this->start('page-content'); ?>
    <h1>Edit Reservations</h1>
<?php $this->end(); ?>

