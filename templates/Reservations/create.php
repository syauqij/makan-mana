<div class="album py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-5 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Important Dining Information</span>
                    <span class="badge badge-secondary badge-pill">!</span>
                </h4>
                <div class="mb-2">
                    We have a 15 minute grace period. Please call us if you are running later than 15 minutes after your reservation time.
                </div>
                <div>
                    We may contact you about this reservation, so please ensure your email and phone number are up to date.
                </div>
            </div>

            <div class="col-md-7 order-md-1">
                <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <h4 class="mb-1"><?= h($restaurant->name) ?></h4>
                        
                        <div class="mb-1 text-muted">
                            Date:<?= h($date)?><br/>
                            Time:<?= h($time)?><br/>
                            Guests:<?= h($guests)?>
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
                            ]
                        ) ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <?= $this->Form->control('phone_no', [
                            'label' => false, 
                            'value' => '0182569784',
                            'placeholder' => 'Phone Number'
                            ]
                        ) ?>
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

                <hr class="mb-4">
                <?= $this->Form->button(__('Submit Reservation'),[
                    'class' => 'btn btn-primary btn-lg btn-block'
                ]) ?>

            </div>
        </div>
    </div>
</div>