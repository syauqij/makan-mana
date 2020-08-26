
<?php 
	use Cake\I18n\FrozenTime; 

    $no = 1;
    while($no <= 20) {
        $options[$no] = $no . ' people';
        $no++;
    }
?>

<style>
	/*to fetch image from restaurant data*/
	#restaurant-banner {
		<?php echo $this->Html->style([
			'background-image' => 'url("../img/restaurant-profile-photos/' . $restaurant->image_file . '")'
		]); ?>
	}
</style>

<section class="jumbotron mb-0" id="restaurant-banner">
    <div class="container">
		<div class="row d-flex bd-highlight">
			<div class="p-2 flex-grow-1 bd-highlight">
				<h1 class="display-4"><?= h($restaurant->name)?></h1>
			</div>
			<div class="p-2 bd-highlight align-self-center">
				<?php if(!empty($hasSaved->user_id)) : ?>
					<?= $this->Form->postLink(__('Restaurant Saved'), 
						['controller' => 'SavedRestaurants', 'action' => 'delete', $hasSaved->id, $restaurant->slug],
						['class' => 'btn btn-dark']
					)?>
				<?php else: ?>
					<?= $this->Form->postLink(__('Save Restaurant'), 
						['controller' => 'SavedRestaurants', 'action' => 'add', $restaurant->id, $restaurant->slug],
						['class' => 'btn btn-light']
					)?>
				<?php endif; ?>
			</div>
		</div>
		<div class="row">
			<?= $this->Flash->render() ?>
    	</div>
    </div>
</section>
<div class="album py-3 bg-light">
<div class="container">
	<nav id="navbar-restaurant" class="navbar navbar-light bg-light sticky-top pl-0">
		<div class="col-sm-5 col-lg-5 text-truncate pb-2">
			<strong><?= h($restaurant->name)?></strong>
		</div>
		<div class="col-sm-7 col-lg-6 offset-lg-1">
			<ul class="nav nav-pills">
				<li class="nav-item">
					<a class="nav-link active" href="#about">About</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#photos">Photos</a>
				</li>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#menu">Menu</a>
				</li>
			</ul>
		</div>
	</nav>
	
	<div class="row">
		<div class="col-md-8 col-lg-9" data-spy="scroll">
			<div id="about" class="py-3">
			<div class="d-flex bd-highlight">
				<div class="location flex-grow-1 p-2 bd-highlight">
					<?= h($restaurant->city) ?>, <?= h($restaurant->state) ?>
				</div>
				<div class="cuisines p-2 bd-highlight">
					<?php foreach ($restaurant->cuisines as $cuisine) : ?>
						<?= $this->Html->link($cuisine->name, 
							['action' => 'search', $cuisine->name],
							['class' => 'badge badge-secondary']
						);?>
					<?php endforeach; ?>
				</div>
			</div>
				<div class="description p-2">
					<?= h($restaurant->description) ?>
				</div>
				<div class="criteria col-md-10 p-2">
					<dl class="row">
						<dt class="col-sm-3">Opeation Hours</dt>
						<dd class="col-sm-9"><?= h($restaurant->operation_hours)?></dd>
						<dt class="col-sm-3">Price Range</dt>
						<dd class="col-sm-9"><?= h($restaurant->price_range)?></dd>
						<dt class="col-sm-3">Payment Options</dt>
						<dd class="col-sm-9"><?= h($restaurant->payment_options)?></dd>
						<dt class="col-sm-3">Contact</dt>
						<dd class="col-sm-9"><?= h($restaurant->contact_no)?></dd>
						<dt class="col-sm-3">Website</dt>
						<dd class="col-sm-9"><?= h($restaurant->website)?></dd>
						<dt class="col-sm-3">Contact</dt>
						<dd class="col-sm-9"><?= h($restaurant->contact_no)?></dd>
						<dt class="col-sm-3">Address</dt>
						<dd class="col-sm-9"><?= h($restaurant->full_address)?></dd>
					</dl>
				</div>
			</div>

			<div id="photos" class="py-4">
				<h4>Photos</h4><hr/>
			</div>

			<div id="menu" class="py-4">
				<h4>Menu</h4><hr/>
				<nav>
					<div class="nav nav-tabs" id="nav-tab" role="tablist">
						<?php foreach($menuCategories as $key => $category) : ?>
							<a class="nav-link id=" nav-<?=h($category->id)?>-tab 
							data-toggle="tab" href="#nav-<?=h($category->id)?>" role="tab" aria-controls="nav-<?=h($category->id)?>" 
							aria-selected="<?php echo ($key < 1) ? 'true' : "false"?>">
							<?= h($category->name)?></a>
						<?php endforeach; ?>
					</div>
				</nav>

				<div class="tab-content" id="nav-tabContent">
					<?php foreach($menuCategories as  $key => $category) : ?>
						<div class="tab-pane fade <?php echo ($key < 1) ? 'show active' : ""?>" id="nav-<?=h($category->id)?>" role="tabpanel" aria-labelledby="nav-<?=h($category->id)?>-tab">
						<?php foreach($category->menus as $menu) : ?>
								<h4 class="py-3"><?= h($menu->name)?></h3>
								<div class="row">
								<?php foreach($menu->menu_items as $item) : ?>
									<div class="col-6">
										<h5><?= h($item->name)?> </h5>
										<p><?= h($item->description)?> </p>
										<p>RM <?= h($item->price)?> </p>
									</div> 
								<?php endforeach; ?>
								</div>
								<hr/>
						<?php endforeach; ?>
						</div>
					<?php endforeach; ?>
				</div>	

			</div>
		</div>

		<div class="col-md-4 col-lg-3">
			<div id="reservation" class="sticky-top py-2">
			
				<?= $this->Form->create(null, [
				'type' => 'get',
				'url' => [
					'controller' => 'Restaurants',
					'action' => 'view', $restaurant->slug
				]
				]); ?>
						
				<h4>Make a Resevation</h4><hr/>
				
				<div class="form-row">
					<div class="col-12 form-group">
						<?= $this->Form->date('date', [
							'value' => $date,
							'min' => $today,
							'id' => 'date'
						]); ?>
					</div>
					<div class="col-12 form-group">
						<?= $this->Form->select('time', $timeOptions, [
							'value' => $time,
							'id' => "time"
						]); ?>
					</div>
					<div class="col-12 form-group">
						<?= $this->Form->select('guests', $options, [
							'value' => '2'
							]); ?>
					</div>
					<div class="col-12">
						<?= $this->Form->submit('Search', ['class' => 'btn btn-primary btn-block']) ?>
					</div>
				</div>
				<?= $this->Form->end() ?>
				<?php if ($timeslots) : ?>
				<div class="timeslots pt-2">
					<?php foreach ($timeslots as $key => $timeslot) : ?>
						<?php $timeFormatted = $this->Time->format($key, 'h:mm a'); ?>
                            <?php if ($timeslot) : ?>
                                <?= $this->Html->link($timeFormatted, [
                                    'controller' => 'reservations', 'action' => 'create',
                                    '?' => ['restaurant_id' => $restaurant->id, 'total_guests' => $guests, 'reserved_date' => $key]],
                                    ['class' => 'btn btn-danger btn-sm mb-2']
                                );  ?>
                            <?php else: ?>
                                <button type="button" class="btn btn-secondary btn-sm mb-2 disabled"><?= h($timeFormatted) ?></button>
                            <?php endif; ?>
					<?php endforeach; ?>
					</div>
				<?php else: ?>
					<p>No available time slots. Please select a different date or time.</p>
				</div>
				<?php endif;?>
				
			</div>
		</div>
	</div>
</div>
</div>