<?php require_once 'tools/_db.php';



if(isset($_GET['logout']) && isset($_SESSION['user'])){


	unset($_SESSION["user"]);

	unset($_SESSION["is_admin"]);
	unset($_SESSION["user_id"]);

}
?>

<!DOCTYPE html>
<html>
  <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta hhtp-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
   <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="css/style.css">
   <link href="https://fonts.googleapis.com/css?family=Bodoni 72" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>

	 <title>Buy DVD</title>

  </head>
  <body>

<head>

<?php require('partials/nav.php'); ?>

</head>
<div class="d-flex flex-column align-items-center justify-content-center mt-5">
<?php if(isset($_SESSION['user'])): ?>

    <h2 class="text-center">Hello <?php echo $_SESSION['user']; ?>, You Can Choose Your DVD</h2>


<?php else: ?>

   <h3 class="">Choose Your DVD</h3>
</div>
<?php endif; ?>

<a href="film_list.php" class="d-flex flex-column align-items-center justify-content-center">
    <img src="img/film.png" class="col-md-3"/>
</a>

    <div class="container card-columns">

        <div class="degrade card">
            <a href="dvd_film.php?dvdmoovie_id=1"> <img id="devant" class="picture col-8 card-img-top rounded mx-auto d-block mt-5" src="img/imgfilm/comedie1.jpg" alt="Card image cap">


            </a>

            <div class="card-body">
                <a href="film_list.php?category_moovie_id=1"><h5 class="card-title text-center">Comédie</h5></a>

            </div>
        </div>

        <div class="degrade card">
          <a href="dvd_film.php?dvdmoovie_id=5">  <img class="picture col-8 card-img-top rounded mx-auto d-block mt-5" src="img/imgfilm/romance3.jpg" alt="Card image cap"> </a>
            <div class="card-body">
                <a href="film_list.php?category_moovie_id=2"><h5 class="card-title text-center">Romance</h5></a>

            </div>
        </div>

        <div class="degrade card">
          <a href="dvd_film.php?dvdmoovie_id=9">  <img class="picture col-8 card-img-top rounded mx-auto d-block mt-5" src="img/imgfilm/policier3.jpg" alt="Card image cap"></a>
            <div class="card-body">
                <a href="film_list.php?category_moovie_id=3">  <h5 class="card-title text-center">Policier/Drama</h5> </a>

            </div>
        </div>


        <div class="degrade card">
          <a href="dvd_film.php?dvdmoovie_id=4">  <img class="picture col-8 card-img-top rounded mx-auto d-block mt-5" src="img/imgfilm/overdrive.jpg" alt="Card image cap"> </a>
            <div class="card-body">
                <a href="film_list.php?category_moovie_id=4">  <h5 class="card-title text-center">Action/Aventure</h5> </a>

            </div>
        </div>
        <div class="degrade card">
            <a href="dvd_film.php?dvdmoovie_id=14"> <img class="picture col-8 card-img-top rounded mx-auto d-block mt-5" src="img/imgfilm/fanstastique2.jpg" alt="Card image cap"> </a>
            <div class="card-body">
                <a href="film_list.php?category_moovie_id=5">  <h5 class="card-title text-center">Fantastique</h5> </a>

            </div>
        </div>
        <div class="degrade card">
            <a href="dvd_film.php?dvdmoovie_id=16"> <img class="picture col-8 card-img-top rounded mx-auto d-block mt-5" src="img/imgfilm/dragon.jpg" alt="Card image cap"> </a>
            <div class="card-body">
                <a href="film_list.php?category_moovie_id=6">  <h5 class="card-title text-center">Dessin Animé</h5> </a>

            </div>
        </div>

    </div>


  </div>

  <a href="serie_list.php" class="d-flex flex-column align-items-center justify-content-center">
      <img src="img/serie.png" class="col-md-3"/>
  </a>

  <div class="responsive container card-columns">
      <div class="degrade card">
          <a href="dvd_serie.php?dvd_serie_id=1"> <img class="picture col-8 card-img-top rounded mx-auto d-block mt-5" src="img/imgserie/friends.jpg" alt="image cap"> </a>
          <div class="card-body">
              <a href="serie_list.php?category_serie_id=1"><h5 class="card-title text-center">Comédie</h5></a>

          </div>
      </div>
      <div class="degrade card">
        <a href="dvd_serie.php?dvd_serie_id=4">  <img class="picture col-8 card-img-top rounded mx-auto d-block mt-5" src="img/imgserie/beautyandthebeast.jpg" alt="Card image cap"> </a>
          <div class="card-body">
              <a href="serie_list.php?category_serie_id=2"><h5 class="card-title text-center">Romance</h5></a>

          </div>
      </div>
      <div class="degrade card">
        <a href="dvd_serie.php?dvd_serie_id=6">  <img class="picture col-8 card-img-top rounded mx-auto d-block mt-5" src="img/imgserie/elementary1.jpg" alt="Card image cap"></a>
          <div class="card-body">
              <a href="serie_list.php?category_serie_id=3">  <h5 class="card-title text-center">Policier/Drama</h5> </a>

          </div>
      </div>

      <div class="degrade card">
        <a href="dvd_serie.php?dvd_serie_id=11">  <img class="picture col-8 card-img-top rounded mx-auto d-block mt-5" src="img/imgserie/flash.jpg" alt="Card image cap"> </a>
          <div class="card-body">
              <a href="serie_list.php?category_serie_id=4">  <h5 class="card-title text-center">Action/Aventure</h5> </a>

          </div>
      </div>
      <div class="degrade card">
          <a href="dvd_serie.php?dvd_serie_id=14"> <img class="picture col-8 card-img-top rounded mx-auto d-block mt-5" src="img/imgserie/magisien.jpg" alt="Card image cap"> </a>
          <div class="card-body">
              <a href="serie_list.php?category_serie_id=5">  <h5 class="card-title text-center">Fantastique</h5> </a>

          </div>
      </div>
      <div class="degrade card">
          <a href="dvd_serie.php?dvd_serie_id=16"> <img class="picture col-8 card-img-top rounded mx-auto d-block mt-5" src="img/imgserie/anime.jpg" alt="Card image cap"> </a>
          <div class="card-body">
              <a href="serie_list.php?category_serie_id=6">  <h5 class="card-title text-center">Dessin Animé</h5> </a>

          </div>
      </div>

  </div>


</div>

</div>

<footer class="mt-5">

    <?php require('partials/footer.php'); ?>

</footer>

  </body>
</html>
