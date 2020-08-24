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
        <?= $this->Form->create($restaurant, ['type' => 'file']); ?>
        <div class="row">
            <div class="col-12">
                <h4>Step 2: Restaurant Details</h4>
            </div>
            <div class="col-md-6">
                <p class="mb-3">Fill in your restaurant basic information.</p >
                <!-- Fetch restaurant_info.php -->
                <?php echo $this->element('form/restaurant_info'); ?>
            </div>
            <div class="col-md-6">
                <p class="mb-3">Then your restaurant profiles.</p >
                <!-- Fetch restaurant_profiles.php -->
                <?php echo $this->element('form/restaurant_profiles'); ?>
            </div>
            <div class="col-12">
                <?= $this->Form->button(__('Submit for Review'),[
                    'class' => 'btn btn-primary'
                    ]) ?>
            </div>
        </div>
        <?= $this->Form->end(); ?>
    </div>
</div>

<?php $this->start('script'); ?>
<script>
    $(document).ready(function() {
        $('#select2-cuisines').select2({
            maximumSelectionLength: 5,
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear'))
        });
    });
</script>
<?php $this->end() ?>