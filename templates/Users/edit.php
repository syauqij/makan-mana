<?php
    $this->extend('/Common/registered');

    $this->start('sidebar');
        $role = $this->Identity->get('role');
        echo $this->element('sidebar/'.$role, ['active' => 'users']);
    $this->end(); 

    $roleOptions = ['admin' => 'Admin', 'owner' => 'Owner', 'member' => 'Member']
?>

<?php $this->start('page-content'); ?>
    <h3><?= __('Edit User') ?></h3>
    <?= $this->Form->create($user, ['type' => 'file']) ?>

    <div class="row">
        <div class="col-md-6">
            <?= $this->Form->control('first_name', [
                //'label' => false, 
                'placeholder' => 'First Name'
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= $this->Form->control('last_name', [
                //'label' => false, 
                'placeholder' => 'Last Name'
            ]) ?>
        </div>
        <div class="col-md-6">
            <?= $this->Form->control('password', [
                'label' => "Change Password",
                'id' => 'password',
                'placeholder' => 'Enter new password',
                'autocomplete' => 'new-password',
                'required' => false,
                'value' => ""
            ])?>
        </div>
        <div class="col-md-6">
            <?= $this->Form->control('confirm_password', [
                'id' => 'confirm-password',
                'type' => 'password',
                'label' => "Confirm New Password",
                'placeholder' => 'Re-enter new password',
                'required' => false,
                'autocomplete' => 'new-password',
                'value' => ""
            ])?>
        </div> 
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $this->Form->control('email', [
                //'label' => false,
                'placeholder' => 'Email address',
                'autocomplete' => 'new-email'
            ]) ?>
        </div>
        <div class="col-md-6 col-lg-3">
            <?= $this->Form->control('phone_no', [
                //'label' => false,
                'placeholder' => 'Phone number'
            ]) ?>
        </div>
        <div class="col-md-6 col-lg-3">
            <?= $this->Form->control('user_profile.phone_no_2', [
                'label' => 'Home No', 
                'placeholder' => 'Home Number'
                ]) ?>
        </div>
        <?php if($role == "admin") : ?>
        <div class="col-md-4">
            <?= $this->Form->label('Role')?> <small>(currently as <?= h($user->role) ?>)</small><br/>
            <?= $this->Form->select('role', $roleOptions, [
                'value' => $user->role
            ]) ?>
        </div>
        <div class="col-md-4">
            <?= $this->Form->label('Account Status')?><br/>
            <?= $this->Form->radio('status', [1 => 'Active', 0 => 'Disabled']) ?>
        </div>
        <?php endif;?>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12">
                    <?= $this->Form->control('user_profile.address_line_1', [
                        'label' => 'Residential Address', 
                        'placeholder' => 'Address Line 1'
                    ]) ?>
                </div>
                <div class="col-md-12">
                    <?= $this->Form->control('user_profile.address_line_2', [
                        'label' => false,
                        'placeholder' => 'Address Line 2'
                        ]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <?= $this->Form->control('user_profile.postcode', [
                        'label' => false,
                        'placeholder' => 'Postcode'
                        ])?>
                </div>
                <div class="col-md-12 col-lg-6">
                    <?= $this->Form->control('user_profile.city', [
                        'label' => false,
                        'placeholder' => 'City'
                    ]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <?= $this->Form->select('user_profile.state', $stateOptions, [
                        'label' => false,
                        'placeholder' => 'State',
                        'empty' => 'Select State'
                    ]) ?>
                </div>
                <div class="col-md-12 col-lg-6">
                    <?= $this->Form->control('user_profile.country', [
                        'disabled' => true,
                        'label' => false,
                        'value' => 'Malaysia'
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12 col-lg-6 mb-2">
                    <?= $this->Form->control('photo', [
                        'label' => "Profile Photo",
                        'type' => 'file',
                    ]); ?>
                    <?php if ($user->image_file):?>
                        <div class="mb-2">
                            <?= $this->Html->image('user-profile-photos/' . $user->image_file, [
                                'alt' =>  $user->image_file,
                                'class' => 'img-fluid img-thumbnail'
                            ]);?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-md-12 col-lg-6">
                    <?= $this->Form->label('Gender')?><br/>
                    <?= $this->Form->radio('user_profile.gender', [1 => 'Male', 0 => 'Female']) ?>
                </div>
            </div>
        </div>

        <div class="col-md-6">
        <?= $this->Form->button(__('Update'),[
            'class' => 'btn btn-primary btn-lg'
        ]) ?>
        </div>
    </div>
    <?= $this->Form->end(); ?>   

<?php $this->end(); ?>