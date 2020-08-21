<?php echo $this->Form->create($restaurant); ?>
<div class="row">
    <div class="col-md-12 mb-2">
        <?= $this->Form->control('name', [
            'label' => 'Restaurant Name', 
            'placeholder' => 'Restaurant Name'
        ]) ?>
    </div>
    <div class="col-md-12 mb-2">
        <?= $this->Form->control('address_line_1', [
            'label' => 'Restaurant Address', 
            'placeholder' => 'Address Line 1'
        ]) ?>
    </div>
    <div class="col-md-12 mb-2">
        <?= $this->Form->control('address_line_2', [
            'label' => false,
            'placeholder' => 'Address Line 2'
        ]) ?>
    </div>
    <div class="col-md-6 mb-2">
        <?= $this->Form->control('postcode', [
            'label' => false,
            'placeholder' => 'Postcode'
        ])?>
    </div>
    <div class="col-md-6 mb-2">
        <?= $this->Form->control('city', [
            'label' => false,
            'placeholder' => 'City'
        ]) ?>
    </div>
    <div class="col-md-6 mb-2">
        <?= $this->Form->control('state', [
            'label' => false,
            'placeholder' => 'State'
        ]) ?>
    </div>
    <div class="col-md-6 mb-2">
        <?= $this->Form->control('country', [
            'disabled' => true,
            'label' => false,
            'value' => 'Malaysia'
        ]) ?>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-0"><label>Restaurant Contacts</label></div>
    <div class="col-md-6 mb-2">
        <?= $this->Form->control('contact_no', [
            'label' => false,
            'placeholder' => 'Contact No'
        ]) ?>
    </div>
    <div class="col-md-6 mb-2">
        <?= $this->Form->control('website', [
            'label' => false,
            'placeholder' => 'Website'
        ]) ?>
    </div>
    <div class="col-md-12 mb-2">
        <?= $this->Form->control('photo', [
            'label' => "Restaurant Profile Photo",
            'type' => 'file',
        ]); ?>
        <div class="row">
            <div class="col-md-6 mb-2">
            <?php if ($restaurant->image_file):?>
                <?= $this->Html->image('restaurant-profile-photos/' . $restaurant->image_file, [
                    'alt' =>  $restaurant->image_file,
                    'class' => 'img-fluid img-thumbnail'
                ]);?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>