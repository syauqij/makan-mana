<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Restaurant Booking System">
    <meta name="author" content="Muhamad Syauqi bin Jamil">
    <meta name="generator" content="Makan Mana v0.1">
    <title><?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:ital,wght@0,200;0,300;0,700;0,800;1,200;1,700&family=Oswald:wght@200;300;400;500;600&family=Bebas+Neue&display=swap" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!--Tiny Slider 2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.3/tiny-slider.css">
    <!-- Select2 JS CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
    <?= $this->Html->css('select2-bootstrap4.min'); ?>
    <!-- Dropzone JS css -->
    <?= $this->Html->css('dropzone'); ?>
    <!-- Makan Mana custom styling -->
    <?= $this->Html->css('custom.css') ?>
</head>

<body data-spy="scroll" data-target="#navbar-restaurant" data-offset="56">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <?= $this->Html->link('Makan Mana', '/', ['class' => 'navbar-brand']);?>

  <div class="login">
    <div class="collapse navbar-collapse" id="navbarToggler">
     <ul class="nav">
         <?php if ($this->Identity->isLoggedIn() == false) : ?>
        <li class="nav-item">
            <?= $this->Html->link('For Businesses', ['controller' => 'Register', 'action' => 'owner'], ['class' => 'nav-link']);?>
        </li>
         <?php endif; ?>
    </ul>
    <div class="btn-group">
        <?php if ($this->Identity->isLoggedIn()) : ?>
            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                My Account
            </button>
            <div class="dropdown-menu">
                <div class="loggedin-user text-center py-1">
                <?php if($this->Identity->get('image_file')) : ?>
                    <?= $this->Html->image('user-profile-photos/' . h($this->Identity->get('image_file')), [
                        'alt' =>  h($this->Identity->get('image_file')),
                        'class' => ''
                    ]);?>
                <?php else: ?>
                    <?= $this->Html->image('OIP.jfif', [
                        'alt' =>  'oip',
                        'class' => 'img-fluid'
                    ]); ?>
                <?php endif; ?>
                    <?= $this->Html->link($this->Identity->get('full_name'), ['controller' => 'Users', 'action' => 'edit', $this->Identity->get('id')], 
                    ['class' => 'dropdown-item']);?>
                </div>
                <?php if ($this->Identity->get('role') == "member") : ?>
                    <?= $this->Html->link('My Reservations', ['controller' => 'Reservations', 'action' => 'upcoming'], ['class' => 'dropdown-item']);?>
                    <?= $this->Html->link('My Saved Restaurants', ['controller' => 'SavedRestaurants', 'action' => 'index'], ['class' => 'dropdown-item']);?>
                <?php elseif ($this->Identity->get('role') == "owner") : ?>
                    <?= $this->Html->link('Reservations', ['controller' => 'Reservations', 'action' => 'upcoming'], ['class' => 'dropdown-item']);?>
                    <?= $this->Html->link('Restaurants', ['controller' => 'Restaurants', 'action' => 'index'], ['class' => 'dropdown-item']);?>
                <?php else: ?>
                    <?= $this->Html->link('Manage Restaurants', ['controller' => 'Restaurants', 'action' => 'index'], ['class' => 'dropdown-item']);?>
                    <?= $this->Html->link('Manage Users', ['controller' => 'Users', 'action' => 'index'], ['class' => 'dropdown-item']);?>
                <?php endif; ?>
                    <div class="dropdown-divider"></div>
                    <?= $this->Html->link('Log Out', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'dropdown-item']);?>
                </div>
            </div>
        <?php else : ?>
            <?= $this->Html->link('Register', ['controller' => 'Register', 'action' => 'member'], ['class' => 'btn btn-danger']);?>
            <?= $this->Html->link('Sign In', ['controller' => 'Users', 'action' => 'login'], ['class' => 'btn btn-secondary']);?>        
        <?php endif; ?>
    </div>
  </form>
</div>
</nav>
    <main role="main">
        <?php if($this->Flash) : ?>
            <div class='container'> <?= $this->Flash->render()?> </div>
        <?php endif; ?>
            <?= $this->fetch('content') ?> 
    </main>

    <footer class="container">
        <p class="float-right"><a href="#">Back to top</a></p>
        <p>© 2020 Makan Mana Sdn. Bhd.</a></p>
    </footer>

    <!-- Bootstrap & jQuery JS-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- Select2 JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js" integrity="sha512-RtZU3AyMVArmHLiW0suEZ9McadTdegwbgtiQl5Qqo9kunkVg1ofwueXD8/8wv3Af8jkME3DDe3yLfR8HSJfT2g==" crossorigin="anonymous"></script>  
    <!-- For Gallery Photo Uploads -->
    <?= $this->Html->script('dropzone.js') ?>
    <!-- Awesome Icons -->
    <script src="https://kit.fontawesome.com/9afbc8028b.js" crossorigin="anonymous"></script>
    <!-- Tiny Slider JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js"></script>

    <!-- fetches custom scripts from the other pages (if any). -->
    <?= $this->fetch('script'); ?>
    <?= $this->fetch('from_sidebar'); ?>

    <script>
        $(document).ready(function(){
            $( ".invalid-feedback" ).each(function() {
                $( this ).prev('input').addClass( "is-invalid" );
            });
        });
    </script>
</body>
</html>
