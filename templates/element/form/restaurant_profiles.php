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
        <?= $this->Form->label('Select Cuisines')?>
        <?= $this->Form->select('cuisine_ids', $cuisines, [
                'placeholder' => 'Choose at least one',
                'id' => 'select2-cuisines',
                'multiple' => 'yes'
        ]) ?>
    </div>
    <div class="col-md-7">
        <?= $this->Form->control('operation_hours', [
            'rows' => 3,
            'default' =>'Tue - Sun: 10:00 am - 11:00 pm
Closed on Mondays'
        ]) ?>
    </div>
</div>

<div class="row">
    <div class="col-md-7">
        <?= $this->Form->control('payment_options', [
            'default' => 'eWallet, MasterCard, Visa, AMEX',
        ]) ?>    
    </div>
    <div class="col-md-7">
        <?= $this->Form->control('price_range', [
            'default' => 'Avg spending: RM 50 per pax',
        ]) ?>
    </div>
</div>
