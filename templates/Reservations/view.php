<?php
    $this->extend('/Common/registered');

    $this->start('sidebar');
        $role = $this->Identity->get('role');
        echo $this->element('sidebar/'.$role, ['active' => 'reservations']);
    $this->end(); 
?>

<?php $this->start('page-content'); ?>

        <div class="row">
            <div class="col-md-10 order-md-1">
                <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <h4 class="mb-1"><?= h($reservation->restaurant->name) ?></h4>
                        
                            <div class="mb-1 text-muted">
                                Date:<?= h($date)?><br/>
                                Time:<?= h($time)?><br/>
                                Guests:<?= h($reservation->total_guests)?>
                            </div>

                        </div>
                    <div class="col-auto d-none d-lg-block">
                        <svg class="bd-placeholder-img" width="180" height="180" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
                    </div>
                </div>                
                <h5 class="mb-3">Diner details</h5 >
                <?= $this->Form->create($reservation) ?>
            
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <?= $this->Form->control('name', [
                            'disabled' => true,
                            'label' => false, 
                            'value' => 'Muhamad Syauqi bin Jamil',
                            'placeholder' => 'Full Name'
                        ]) ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <?= $this->Form->control('phone_no', [
                            'label' => false, 
                            'value' => '0182569784',
                            'placeholder' => 'Phone Number'
                        ]) ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <?= $this->Form->select('occasion', $occasions, [
                            //'value' => '',
                            'empty' => 'Select Occasion (optional)'
                        ]); ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <?= $this->Form->control('request', [
                            'label' => false,
                            'placeholder' => 'Add special requests (optional)'
                        ]); ?>
                    </div>
                </div>
                <?php if ($this->Identity->get('role') !== "member") : ?>
                <button type="button" class="btn btn-info dropdown-toggle" id="dropdownMenuOffset" data-toggle="dropdown">
                    Update
                </button>
                <div class="dropdown-menu" id="dropdownMenuOffset">
                    <?= $this->Form->postLink(__('Accept'), 
                            ['action' => 'updateStatus', 'accepted', $reservation->id],
                            ['class' => 'dropdown-item', 'confirm' => __('Confirm accept reservation at {0}?', $reservation->reserved_date)]) ?>

                    <?= $this->Form->postLink(__('Decline'), ['action' => 'updateStatus', 'declined', $reservation->id], 
                            ['class' => 'dropdown-item', 'confirm' => __('Confirm decline reservation at {0}?', $reservation->reserved_date)]) ?>

                    <?= $this->Form->postLink(__('Complete'), ['action' => 'updateStatus', 'completed', $reservation->id], 
                            ['class' => 'dropdown-item', 'confirm' => __('Confirm reservation is complete {0}?', $reservation->reserved_date)]) ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

<?php $this->end(); ?>