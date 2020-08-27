<div class="album py-5 bg-light login-content">
    <div class="container">
        <div class="row">
        <div class="col-md-5 order-md-2 mb-4">
            <h4>Sign In</h5 >
            <p class="mb-3">Please sign in if you own an account</p >
            <?= $this->Form->create() ?>
            <div class="row">
                <div class="col-md-12 mb-2">
                    <?= $this->Form->control('email', [
                        'label' => false,
                        'placeholder' => 'Email Address'
                        ]
                    ) ?>
                </div>
                <div class="col-md-12 mb-2">
                    <?= $this->Form->control('password', [
                        'label' => false,
                        'placeholder' => 'Password'
                        ]
                    ) ?>
                </div>
                <div class="col-md-12 mb-2">
                    <?= $this->Form->button(__('Sign In'),[
                        'class' => 'btn btn-primary btn-lg mr-2'
                    ]) ?>
                    <?= $this->Html->link("Create an Account", [
                        'controller' => 'register',
                        'action' => 'member',
                        '?' => ['redirect' => $redirect]
                    ]) ?>
                </div>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>