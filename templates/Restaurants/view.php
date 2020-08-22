
<?php use Cake\I18n\FrozenTime; ?>

<style>
	/*to fetch image from restaurant data*/
	#restaurant-banner {
		background-image: url("../img/jumbotron_register_member.jpg");
	}
</style>

<section class="jumbotron" id="restaurant-banner">
    <div class="container">
		<div class="row">
			<?= $this->Flash->render() ?>
			<h1 class="display-4"><?= h($restaurant->name)?></h1>
    	</div>
    </div>
</section>
<div class="album py-3 bg-light">
<div class="container">
	<nav id="navbar-restaurant" class="navbar navbar-light bg-light sticky-top pl-0">
		<div class="col-12 col-md-5 text-truncate pl-0">
			<strong><?= h($restaurant->name)?></strong>
		</div>
		<div class="col-12 col-md-7">
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
		<div class="col-md-9" data-spy="scroll">

			<div id="about" class="py-4">
				<div class="details pb-4">
					<?= h($restaurant->city) ?>,<?= h($restaurant->state) ?>

					<?php foreach ($restaurant->cuisines as $cuisine) : ?>
						<?= $this->Html->link($cuisine->name, 
							['action' => 'search', $cuisine->name],
							['class' => 'badge badge-secondary']
						);?>
					<?php endforeach; ?>

				</div>
				<div class="description">
					<p><?= printf($restaurant->description) ?></p>
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

		<div class="col-md-3">
			<div id="reservation" class="sticky-top py-2">
			
				<?= $this->Form->create(null, [
				'type' => 'get',
				'url' => [
					'controller' => 'Restaurants',
					'action' => 'view', $restaurant->slug
				]
				]); ?>
						
				<h4>Make a Resevation</h4><hr/>
				
				<div class="row">
					<div class="col-12">
						<?= $this->Form->date('date', [
							'value' => $date,
							'min' => $date,
							'id' => 'date'
						]); ?>
					</div>
					<div class="col-12">
						<?= $this->Form->select('time', $timeOptions, [
							'value' => $time,
							'id' => "time"
						]); ?>
					</div>
					<div class="col-12">
						<?= $this->Form->select('guests', $options, [
							'value' => '2'
							]); ?>
					</div>
					<div class="col-12">
						<?= $this->Form->submit('Search', ['class' => 'btn btn-primary btn-block']) ?>
					</div>
				</div>
				<?= $this->Form->end() ?>
				<?php if ($restaurant->timeslots) : ?>
				<div class="timeslots pt-2">
					<?php foreach ($restaurant->timeslots as $key => $timeslot) : ?>
						<?php $timeFormatted = $this->Time->format($timeslot, 'h:mm a'); ?>
						<?= $this->Html->link($timeFormatted, [
							'controller' => 'reservations', 'action' => 'create',
								'?' => ['restaurant_id' => $restaurant->id, 'total_guests' => 2, 'reserved_date' => $key]],
							['class' => 'btn btn-danger btn-sm mb-2']
						);  ?>
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