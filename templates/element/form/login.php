<?= $this->Form->create($user, ['url' => ['controller' => 'Users', 'action' => 'login']]) ?>
<div class="row">
    <div class="col-md-12 mb-2">
        <?= $this->Form->control('_email', [
            //'label' => false,
            'id' => '_email',
            'placeholder' => 'Email Address'
            ]
        ) ?>
    </div>
    <div class="col-md-12 mb-2">
        <?= $this->Form->control('_password', [
            //'label' => false,
            'type' => 'password',
            'id' => '_password',
            'placeholder' => 'Password'
            ]
        ) ?>
    </div>
    <div class="col-md-12 mb-2">
        <?= $this->Form->button(__('Sign In'),[
            'id' => "login-button",
            'class' => 'btn btn-primary btn-lg'
        ]) ?>
    </div>
    <?= $this->Form->end(); ?>
</div>