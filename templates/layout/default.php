<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Restaurant Booking System">
    <meta name="author" content="Syauqi Jamil">
    <meta name="generator" content="Makan Mana v0.1">
    <title><?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Select2 JS CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
    <?= $this->Html->css('select2-bootstrap4.min'); ?>
    
    <?= $this->Html->css('custom.css') ?>
</head>
<body data-spy="scroll" data-target="#navbar-example" data-offset="56">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <?= $this->Html->link('Makan Mana', '/', ['class' => 'navbar-brand']);?>

  <div class="login">
  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
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
                Hi, <?= h($this->Identity->get('first_name')) ?>
            </button>
            <div class="dropdown-menu">
                <?php if ($this->Identity->get('role') == "member") : ?>
                    <?= $this->Html->link('My Reservations', ['controller' => 'Reservations', 'action' => 'upcoming'], ['class' => 'dropdown-item']);?>
                    <?= $this->Html->link('My Saved Restaurants', ['controller' => 'Restaurants', 'action' => 'favourites'], ['class' => 'dropdown-item']);?>
                <?php elseif ($this->Identity->get('role') == "owner") : ?>
                    <?= $this->Html->link('Reservations', ['controller' => 'Reservations', 'action' => 'upcoming'], ['class' => 'dropdown-item']);?>
                    <?= $this->Html->link('Restaurants', ['controller' => 'Restaurants', 'action' => 'index'], ['class' => 'dropdown-item']);?>
                <?php else: ?>
                    <?= $this->Html->link('Manage Restaurants', ['controller' => 'Restaurants', 'action' => 'index'], ['class' => 'dropdown-item']);?>
                <?php endif; ?>
                    <?= $this->Html->link('My Account', ['controller' => 'Users', 'action' => 'edit', $this->Identity->get('id')], ['class' => 'dropdown-item']);?>
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

    <footer class="text-muted">
        <div class="container">
            <p class="float-right">
                <a href="#">Back to top</a>
            </p>
            <p>Album example is &copy; Bootstrap, but please download and customize it for yourself!</p>
        </div>
    </footer>

    <!-- Bootstrap & jQuery JS-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <!-- Select2 JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js" integrity="sha512-RtZU3AyMVArmHLiW0suEZ9McadTdegwbgtiQl5Qqo9kunkVg1ofwueXD8/8wv3Af8jkME3DDe3yLfR8HSJfT2g==" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $( ".invalid-feedback" ).each(function() {
                $( this ).prev('input').addClass( "is-invalid" );
            });
        });
    </script>

    <?= $this->fetch('script'); ?>
    
</body>
</html>
