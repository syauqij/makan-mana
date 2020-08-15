
<section class="jumbotron">
    <div class="container">
		<div class="row">
			<?= $this->Flash->render() ?>
			<h1 class="display-4"><?= h($restaurant->name)?></h1>
    	</div>
    </div>
</section>
<div class="album py-3 bg-light">
<div class="container">
	<nav id="navbar-example" class="navbar navbar-light bg-light sticky-top pl-0">
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
		<div class="col-md-8" data-spy="scroll">
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
				<p><?= printf($restaurant->description) ?></p>
			</div>
			<div id="photos" class="py-4">
				<h4>Photos</h4><hr/>
				<div id="carouselExampleFade" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					<div class="carousel-item active">
						<svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em"><?= h($restaurant->slug) ?></text></svg>
						</div>
						<div class="carousel-item">
						<svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em"><?= h($restaurant->slug) ?></text></svg>
						</div>
						<div class="carousel-item">
						<svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em"><?= h($restaurant->slug) ?></text></svg>
					</div>
				</div>
				<a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
				</div>	
			
				</div>
			<div id="menu" class="py-4">
				<h4>Menu</h4><hr/>
				<p>Occaecat commodo aliqua delectus. Fap craft beer deserunt skateboard ea. Lomo bicycle rights adipisicing banh mi, velit ea sunt next level locavore single-origin coffee in magna veniam. High life id vinyl, echo park consequat quis aliquip banh mi pitchfork. Vero VHS est adipisicing. Consectetur nisi DIY minim messenger bag. Cred ex in, sustainable delectus consectetur fanny pack iphone.
				<p>Occaecat commodo aliqua delectus. Fap craft beer deserunt skateboard ea. Lomo bicycle rights adipisicing banh mi, velit ea sunt next level locavore single-origin coffee in magna veniam. High life id vinyl, echo park consequat quis aliquip banh mi pitchfork. Vero VHS est adipisicing. Consectetur nisi DIY minim messenger bag. Cred ex in, sustainable delectus consectetur fanny pack iphone.
				<p>Occaecat commodo aliqua delectus. Fap craft beer deserunt skateboard ea. Lomo bicycle rights adipisicing banh mi, velit ea sunt next level locavore single-origin coffee in magna veniam. High life id vinyl, echo park consequat quis aliquip banh mi pitchfork. Vero VHS est adipisicing. Consectetur nisi DIY minim messenger bag. Cred ex in, sustainable delectus consectetur fanny pack iphone.</p>
			</div>
		</div>
		<div class="col-md-4">
			<div id="photos" class="sticky-top py-2">
			<h4>Make a Resevation</h4><hr/>
			<?php if ($restaurant->timeslots) : ?>
				<?php foreach ($restaurant->timeslots as $key => $timeslot) : ?>
					<?= $this->Html->link($timeslot, [
						'controller' => 'reservations', 'action' => 'add',
							'?' => ['restaurant_id' => $restaurant->id, 'total_guests' => 2, 'reserved_date' => $key]],
						['class' => 'btn btn-secondary btn-sm mb-2']
					);  ?>
				<?php endforeach; ?>
				</div>
				<?php else: ?>
					<h4>No available time slots</h4>
				<?php endif;?>
			</div>
		</div>
	</div>

	</div>
</div>
</div>