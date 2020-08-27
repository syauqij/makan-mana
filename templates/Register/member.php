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
            <div class="col-md-5 col-lg-4 offset-lg-1 order-md-2 mb-3">
                <h4>Sign In</h5 >
                <p class="mb-3">Please sign in if you own an account</p >
                <?php echo $this->element('form/login'); ?>
            </div>

            <div class="col-md-7 order-md-1">
                <h4>Register</h4>
                <p class="mb-3">It's free and only takes a minute.</p >
                <?php echo $this->Form->create($user);?>
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
                        <?= $this->Form->control('email', [
                            //'label' => false,
                            'placeholder' => 'Email address'
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('phone_no', [
                            //'label' => false,
                            'placeholder' => 'Phone number'
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('password', [
                           // 'label' => false,
                            'id' => 'password',
                            'placeholder' => 'Enter password',
                            'autocomplete' => 'new-password'
                        ])?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('confirm_password', [
                            'id' => 'confirm-password',
                            'type' => 'password',
                            'label' => "Confirm Password",
                            'placeholder' => 'Re-enter password',
                            'required' => true,
                            'autocomplete' => 'new-password'
                        ])?>
                    </div>
                </div>
                <hr/>
                <?= $this->Form->button(__('Register'),[
                    'class' => 'btn btn-primary btn-lg btn-block'
                ]) ?>
                <?= $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>

<?php $this->start('script'); ?>
<script>
    $(document).ready(function(){
        $('#login-button').click(function(){
            $('#_email').attr('name', 'email');
            $('#_password').attr('name', 'password');
        });

        if($('#confirm-password').hasClass('is-invalid'))
            $('#password').addClass('is-invalid')
    });
</script>
<?php $this->end(); ?>