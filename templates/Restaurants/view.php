
<section class="jumbotron">
    <div class="container">
	<?= $this->Flash->render() ?>

    </div>
</section>
<div class="album py-3 bg-light">
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-8">
                <h1 class="display-4"><?= h($restaurant->name)?></h1>
                <hr/>

					<p>
                        <?= h($restaurant->description) ?>
					</p>
                    
					<div class="carousel slide" id="carousel-663395">
						<ol class="carousel-indicators">
							<li data-slide-to="0" data-target="#carousel-663395" class="active">
							</li>
							<li data-slide-to="1" data-target="#carousel-663395">
							</li>
							<li data-slide-to="2" data-target="#carousel-663395">
							</li>
						</ol>
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img class="d-block w-100" alt="Carousel Bootstrap First" src="https://www.layoutit.com/img/sports-q-c-1600-500-1.jpg" />
								<div class="carousel-caption">
									<h4>
										First Thumbnail label
									</h4>
									<p>
										Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
									</p>
								</div>
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" alt="Carousel Bootstrap Second" src="https://www.layoutit.com/img/sports-q-c-1600-500-2.jpg" />
								<div class="carousel-caption">
									<h4>
										Second Thumbnail label
									</h4>
									<p>
										Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
									</p>
								</div>
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" alt="Carousel Bootstrap Third" src="https://www.layoutit.com/img/sports-q-c-1600-500-3.jpg" />
								<div class="carousel-caption">
									<h4>
										Third Thumbnail label
									</h4>
									<p>
										Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.
									</p>
								</div>
							</div>
						</div> <a class="carousel-control-prev" href="#carousel-663395" data-slide="prev"><span class="carousel-control-prev-icon"></span> <span class="sr-only">Previous</span></a> <a class="carousel-control-next" href="#carousel-663395" data-slide="next"><span class="carousel-control-next-icon"></span> <span class="sr-only">Next</span></a>
					</div>
					<div class="tabbable" id="tabs-489614">
						<ul class="nav nav-tabs">
							<li class="nav-item">
								<a class="nav-link active show" href="#tab1" data-toggle="tab">Section 1</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#tab2" data-toggle="tab">Section 2</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="panel-372711">
								<p>
									I'm in Section 1.
								</p>
							</div>
							<div class="tab-pane" id="tab2">
								<p>
									Howdy, I'm in Section 2.
								</p>
							</div>
						</div>
					</div> 
					<address>
						 <strong>Twitter, Inc.</strong><br /> 795 Folsom Ave, Suite 600<br /> San Francisco, CA 94107<br /> <abbr title="Phone">P:</abbr> (123) 456-7890
					</address>
				</div>
				<div class="col-md-4">
					<form role="form">
						<div class="form-group">
							 
							<label for="exampleInputEmail1">
								Email address
							</label>
							<input type="email" class="form-control" id="exampleInputEmail1" />
						</div>
						<div class="form-group">
							 
							<label for="exampleInputPassword1">
								Password
							</label>
							<input type="password" class="form-control" id="exampleInputPassword1" />
						</div>
                    </form>
                    <p class="cuisines card-text">
                        <?= h($restaurant->city) ?>
                        <?php foreach ($restaurant->cuisines as $cuisine) : ?>
                            
                            <?= $this->Html->link($cuisine->name, 
                                ['action' => 'search', $cuisine->name],
                                ['class' => 'badge badge-secondary']
                            );?>
                            
                        <?php endforeach; ?>
                    </p>
				</div>
			</div>
		</div>
	</div>
</div>
</div>