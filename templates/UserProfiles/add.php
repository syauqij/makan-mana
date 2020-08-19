<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UserProfile $userProfile
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List User Profiles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="userProfiles form content">
            <?= $this->Form->create($userProfile) ?>
            <fieldset>
                <legend><?= __('Add User Profile') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('profile_photo');
                    echo $this->Form->control('phone_no_2');
                    echo $this->Form->control('gender');
                    echo $this->Form->control('address_line_1');
                    echo $this->Form->control('address_line_2');
                    echo $this->Form->control('postcode');
                    echo $this->Form->control('city');
                    echo $this->Form->control('state');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
