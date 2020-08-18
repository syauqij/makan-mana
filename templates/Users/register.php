<?php 
    $myTemplates = [
        'inputContainer' =>'{{content}}',
        'input' => '<div class="form-group"><input class="form-control" type="{{type}}" name="{{name}}"{{attrs}}/></div>',
        'select' => '<div class="form-group"><select class="form-control" name="{{name}}"{{attrs}}>{{content}}</select></div>',
    ];
    $this->Form->setTemplates($myTemplates); 
?>

<section class="jumbotron" id="register-member-banner">
    <div class="container">
		<div class="row">
            <h1 class="display-4">Register an Account</h1>
            <?= $this->Flash->render() ?>
    	</div>
    </div>
</section>

<div class="album py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-5 order-md-2 mb-4">
                <h4>Sign In</h5 >
                <p class="mb-3">Please sign in if you own an account</p >
                <?= $this->Form->create($user, ['url' => ['contoller' => 'Users', 'action' => 'login']]) ?>
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
                            'class' => 'btn btn-primary btn-lg'
                        ]) ?>
                    </div>
                    <?= $this->Form->end(); ?>
                </div>
            </div>

            <div class="col-md-7 order-md-1">
                <h5>Sign Up</h5 >
                <p class="mb-3">It's free and only takes a minute.</p >
                <?= $this->Form->create($user) ?>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <?= $this->Form->control('first_name', [
                            'label' => false, 
                            'placeholder' => 'First Name'
                            ]
                        ) ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <?= $this->Form->control('last_name', [
                            'label' => false, 
                            'placeholder' => 'Last Name'
                            ]
                        ) ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <?= $this->Form->control('email', [
                            'label' => false,
                            'placeholder' => 'Email address'
                            ]
                        ) ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <?= $this->Form->control('phone_no', [
                            'label' => false,
                            'placeholder' => 'Phone number'
                            ]
                        ) ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <?= $this->Form->control('password', [
                            'label' => false,
                            'placeholder' => 'Enter password'
                            ]
                        ) ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <?= $this->Form->control('reEnter-password', [
                            'type' => 'password',
                            'label' => false,
                            'placeholder' => 'Re-enter password'
                            ]
                        ) ?>
                    </div>
                </div>

                <hr class="mb-4">
                <?= $this->Form->button(__('Sign Up'),[
                    'class' => 'btn btn-primary btn-lg btn-block'
                ]) ?>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>