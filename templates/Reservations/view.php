<?php
    $this->extend('/Common/registered');

    $this->start('sidebar');
        $role = $this->Identity->get('role');
        echo $this->element('sidebar/'.$role, ['active' => 'reservations']);
    $this->end(); 
?>

<?php $this->start('page-content'); ?>
    <div class="row">
        <div class="col-md-8 order-md-1">
            <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <h4 class="mb-1"><?= $this->Html->link($reservation->restaurant->name, 
                            ['controller' => 'Restaurants', 'action' => 'view', $reservation->restaurant->slug],
                            ['target' => ['_blank']
                        ]); ?></h4>
                    
                        <div class="mb-1 text-muted">
                            Date: <?= h($date)?><br/>
                            Time: <?= h($time)?><br/>
                            Guests: <?= h($reservation->total_guests)?> people<br/>
                            Status: <?= h($reservation->get('UpdatedStatus'))?>
                        </div>
                    </div>
                <div class="col-auto d-none d-lg-block">
                <?php if ($reservation->restaurant->image_file):?>
                    <?= $this->Html->image('restaurant-profile-photos/' . $reservation->restaurant->image_file, [
                        'height' => '180', 'width' => '210',
                        'alt' =>  $reservation->restaurant->image_file,
                        'class' => 'float-right'
                    ]);?>
                <?php endif; ?>            
            </div>
            </div>                
            <h5 class="mb-3">Diner details</h5 >       
            <div class="row">
                <div class="col-md-6 mb-2">
                    <div><strong>Full Name</strong></div>
                    <?= h($reservation->user->full_name)?>
                </div>
                <div class="col-md-6 mb-2">
                    <div><strong>Phone No</strong></div>
                    <?= h($reservation->phone_no)?>
                </div>
                <div class="col-md-6 mb-2">
                    <div><strong>Ocassion</strong></div>
                    <?= h($reservation->ocassion ? $reservation->ocassion : "No ocassion selected")?>
                </div>
                <div class="col-md-6 mb-2">
                    <div><strong>Ocassion</strong></div>
                    <?= h($reservation->request ? $reservation->request : "No special requests mentioned")?>
                </div>
            </div>
            <div class="pt-3">
            <?php if ($this->Identity->get('role') == "member" && $canModify) : ?>
                <?= $this->Html->link(__('Modify'), ['action' => 'edit', $reservation->id], ['class' => 'pr-3 btn btn-info']) ?>
                <?= $this->Form->postLink(__('Cancel'), ['action' => 'updateStatus', 'cancelled', $reservation->id], 
                    ['class' => 'btn btn-danger', 'confirm' => __('Confirm cancelling reservation {0}?', $reservation->reserved_date)]) ?>

            <?php elseif($this->Identity->get('role') != "member"): ?>
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
    </div>

<?php $this->end(); ?>