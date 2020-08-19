<?php
    $this->extend('/Common/members_page');

    $this->start('sidebar');
        echo $this->element('sidebar/members', ['active' => 'account-details']);
    $this->end(); 
?>

<?php $this->start('page-content'); ?>
    <h3><?= __('Account Details') ?></h3>

    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user, ['type' => 'file']) ?>
            <fieldset>
                <?php
                    echo $this->Form->control('first_name');
                    echo $this->Form->control('last_name');
                    echo $this->Form->control('email');
                    echo $this->Form->control('password');
                    echo $this->Form->control('phone_no');
                    echo $this->Form->control('role');
                    echo $this->Form->control('active');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
<?php $this->end(); ?>