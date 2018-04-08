<?php

require_once 'tools/_db.php';

if(isset($_GET['category_moovie_id']) ){


    $query = $db->prepare('SELECT * FROM categorymoovie WHERE id = ?');
    $query->execute( array($_GET['category_moovie_id']) );

    $categoriefilm = $query->fetch();

    if($categoriefilm){

        $query = $db->prepare('
          SELECT dvdmoovie.*
          FROM dvdmoovie
          JOIN dvdmoovie_category ON dvdmoovie.id = dvdmoovie_category.dvdmoovie_id
          JOIN categorymoovie ON dvdmoovie_category.categorymoovie_id = categorymoovie.id
          WHERE dvdmoovie.is_published = 1 AND categorymoovie.id = ?
          GROUP BY dvdmoovie.id
          ORDER BY created_at DESC
        ');
        $result = $query->execute( array($_GET['category_moovie_id']) );

        $dvd_film = $query->fetchAll();
    }
    else{
        header('location:index.php');
        exit;
    }

}
else{


    $query = $db->query('
      SELECT dvdmoovie.*, GROUP_CONCAT(categorymoovie.name SEPARATOR " / ") AS categories
      FROM dvdmoovie
      JOIN dvdmoovie_category ON dvdmoovie.id = dvdmoovie_category.dvdmoovie_id
      JOIN categorymoovie ON dvdmoovie_category.categorymoovie_id = categorymoovie.id
      WHERE dvdmoovie.is_published = 1
      GROUP BY dvdmoovie.id
      ORDER BY created_at DESC'
    );
    $dvd_film = $query->fetchAll();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require 'partials/head_assets.php'; ?>
    <title>Buy DVD - Film</title>
</head>
<body>

  <head>

    <?php require('partials/nav.php'); ?>

  </head>


  <header class="m-auto">

  <div class="name text-center text-white">

   <h2><?php if(isset($categoriefilm)) : ?><div id="banniere_image" class="col-12 d-flex align-items-center justify-content-center" style="height:100px;background: url('img/imgserie/imgcategory/<?php  echo $categoriefilm ['image'];?>'); background-repeat:no-repeat; background-size: 1450px;"><?php echo $categoriefilm['name'];?></div><?php else : ?><h1 class="color background d-flex align-items-center justify-content-center">
     <img src="img/film.png" alt="logo films" class="logo_moovieserie col-md-3"/>
   <?php endif; ?> </h2>

  </div>

  </header>
<style>
.background{
  background-image: url(img/imgserie/imgcategory/bannieredvd.png);
  background-size: 1210px;
  height:100px;
}
@media(max-width: 425px){
  .background{
    background-image: none;
  }
  .logo_moovieserie{
    margin-top: 100px;
  }
  .margin{
    margin-top: 50px;
  }
}
@media(max-width: 768px){
  .background{
    background-image: none;
  }

}

</style>

  <?php if(!empty($dvd_film)):?>
  <?php foreach($dvd_film as $key => $dvd_film): ?>



  <div class="row d-flex justify-content-center mt-5">


        <div class="margin picture col-md-3">

          <img src="img/imgfilm/imgproduit/<?php echo $dvd_film['image'];?>" class="picture mt-5"/>

        </div>

        <div class="text col-md-7 text-justify">

            <h2 class="mt-5"><?php echo $dvd_film ['title'];?></h2>

            <div class="content mt-4"><?php echo $dvd_film ['summary']; ?></div>

            <div class="content mt-3">Prix du DVD: <?php echo $dvd_film['prix']; ?></div> <br>

            <button type="button" class="button btn">

              <a href="dvd_film.php?dvdmoovie_id=<?php echo $dvd_film['id'] ?>">  Plus d'information
              </a>
            </button>

        </div>

  </div>

  <?php endforeach; ?>

  <?php else: ?>

    Aucun article dans cette catégorie...
  <?php endif; ?>
  <footer class="mt-5">

      <?php require('partials/footer.php'); ?>

  </footer>

  </body>
  </html>
