<?php echo $this->Form->create($restaurant); ?>
<div class="row">
    <div class="col-md-10">
        <?= $this->Form->control('description', [
            'rows' => 5,
            'label' => 'Describe your Restaurant'
        ]) ?>
    </div> 
</div>

<div class="row">
    <div class="col-md-7">
        <?= $this->Form->control('Cuisines', [
            'label' => 'Select Cuisines', 
            'placeholder' => 'Choose at least one'
            ]) ?>
    </div>
    <div class="col-md-7">
        <?= $this->Form->control('operation_hours', [
            'rows' => 3,
            'placeholder' =>'Example:
Tue - Sun: 10:00 am - 11:00 pm
Closed on Mondays'
        ]) ?>
    </div>
</div>

<div class="row">
    <div class="col-md-7">
    <?= $this->Form->control('payment_options', [
            'placeholder' => 'E.g. eWallet, MasterCard, Visa, AMEX',
        ]) ?>    
    </div>
    <div class="col-md-7">
        <?= $this->Form->control('price_range', [
            'placeholder' => 'E.g. Avg spending: RM 50 per pax',
        ]) ?>
    </div>
</div>
