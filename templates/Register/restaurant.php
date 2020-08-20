<section class="jumbotron" id="register-restaurant-banner">
    <div class="container">
		<div class="row">
            <h1 class="display-4">Register your Restaurant</h1>
            <?= $this->Flash->render() ?>
    	</div>
    </div>
</section>

<div class="album py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-5 order-md-2 mb-4">

            </div>

            <div class="col-md-7 order-md-1">
                <h4>Step 2: Restaurant Details</h4>
                <p class="mb-3">Fill in your restaurant profile.</p >
                <?php echo $this->Form->create($restaurant);
                ?>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <?= $this->Form->control('name', [
                            'label' => 'Restaurant Name', 
                            'placeholder' => 'Restaurant Name'
                            ]
                        ) ?>
                    </div>
                    <div class="col-md-12 mb-2">
                        <?= $this->Form->control('address_line_1', [
                            'label' => 'Restaurant Address', 
                            'placeholder' => 'Address Line 1'
                            ]
                        ) ?>
                    </div>
                    <div class="col-md-12 mb-2">
                        <?= $this->Form->control('address_line_2', [
                            'label' => false,
                            'placeholder' => 'Address Line 2'
                            ]
                        ) ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <?= $this->Form->control('postcode', [
                            'label' => false,
                            'placeholder' => 'Postcode'
                            ]
                        ) ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <?= $this->Form->control('city', [
                            'label' => false,
                            'placeholder' => 'City'
                            ]
                        ) ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <?= $this->Form->control('state', [
                            'label' => false,
                            'placeholder' => 'State'
                            ]
                        ) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-0"><label>Restaurant Contacts</label></div>
                    <div class="col-md-6 mb-2">
                        <?= $this->Form->control('contact_no', [
                            'label' => false,
                            'placeholder' => 'Contact No'
                            ]
                        ) ?>
                    </div>
                    <div class="col-md-6 mb-2">
                        <?= $this->Form->control('website', [
                            'label' => false,
                            'placeholder' => 'Website'
                            ]
                        ) ?>
                    </div>
                </div>


                <hr class="mb-4">
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