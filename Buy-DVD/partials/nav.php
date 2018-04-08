
<link rel="stylesheet" href="css/nav.css">

<nav class="nav navbar navbar-expand-lg navbar-light bg-white col-12">
   <img src="img/logo.png" alt="logo" class="img-fluid logo col-md-2" />
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse navmarge mr-5" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active mt-3">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>

      <li class="nav-item active dropdown mt-3 linkTwo">
        <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          DVD-Film
        </a>
        <div class="dropdown-menu button" aria-labelledby="navbarDropdownMenuLink">
          <?php $query = $db->query('SELECT * FROM categorymoovie'); ?>


          <?php while( $data = $query->fetch () ) : ?>
          <a class="dropdown-item" href="film_list.php?category_moovie_id=<?php echo $data['id']; ?>"><?php echo $data['name'];?>

          <?php endwhile; ?>

          <?php $query->closeCursor();?>
          </a>
        </div>
      </li>
      <li class="nav-item active dropdown mt-3 linkTwo">
        <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          DVD-Série
        </a>
        <div class="dropdown-menu dropdown-menu-right button" aria-labelledby="navbarDropdownMenuLink">
          <?php $query = $db->query('SELECT * FROM categoryserie') ; ?>

          <?php while( $data = $query->fetch () ) : ?>

          <a class="dropdown-item" href="serie_list.php?category_serie_id=<?php echo $data['id']; ?>"><?php echo $data['name'];?>

              <?php endwhile; ?>

              <?php $query->closeCursor();?>

          </a>
        </div>
      </li>
      <li class="nav-item active dropdown">
          <?php if(isset($_SESSION['user'])) : ?>

          <a class="nav-link" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">


          <?php

          $query = $db->prepare('SELECT * FROM user WHERE id = ?');
          $query->execute(array($_SESSION['user_id']));
          $user = $query->fetch();

          ?>

          <?php if(!empty($user['image'])): ?>
            <img src="img/imguser/<?php echo $user['image'];?>" alt="contacte" style="height:50px;width:50px;" class="image img-fluid"/>
          <?php else : ?>
            <img src="img/contacte.png" alt="contacte" style="height:50px;"/>
          <?php endif; ?>

          </a>
        <div class="dropdown-menu menu button" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="user-information.php">User Information</a> <br>

          <p><a class="m-auto d-block btn degrade col-8 text-center text-white" href="index.php?logout">Déconnexion</a></p>

        </div>
      </li>
          <?php else: ?>

        <li class="nav-item mt-3 active">
            <a class="nav-link" href="user.php">Connection/Incription</a>
        </li>

        <?php endif; ?>
      <li class="nav-item mt-3 active">
        <a class="nav-link" href="#">Panier</a>
      </li>
    </ul>
  </div>
</nav>
