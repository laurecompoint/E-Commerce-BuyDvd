<?php

require_once 'tools/_db.php';

if(isset($_GET['category_serie_id']) ){


    $query = $db->prepare('SELECT * FROM categoryserie WHERE id = ?');
    $query->execute( array($_GET['category_serie_id']) );

    $categorieserie = $query->fetch();

    if($categorieserie){

    		$query = $db->prepare('
    			SELECT dvd_serie.*
    			FROM dvd_serie
    			JOIN dvdserie_category ON dvd_serie.id = dvdserie_category.dvd_serie_id
    			JOIN categoryserie ON dvdserie_category.categoryserie_id = categoryserie.id
    			WHERE dvd_serie.is_published = 1 AND categoryserie.id = ?
    			GROUP BY dvd_serie.id
    			ORDER BY created_at DESC
    		');
        $result = $query->execute( array($_GET['category_serie_id']) );

        $dvd_serie = $query->fetchAll();
    }
    else{
        header('location:index.php');
        exit;
    }

}
else{


    $query = $db->query('
  		SELECT dvd_serie.*, GROUP_CONCAT(categoryserie.name SEPARATOR " / ") AS categories
  		FROM dvd_serie
  		JOIN dvdserie_category ON dvd_serie.id = dvdserie_category.dvd_serie_id
  		JOIN categoryserie ON dvdserie_category.categoryserie_id = categoryserie.id
  		WHERE dvd_serie.is_published = 1
  		GROUP BY dvd_serie.id
  		ORDER BY created_at DESC'
  	);
    $dvd_serie = $query->fetchAll();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
    <meta hhtp-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/moovieseries_tv.css">
    <link rel="stylesheet" href="css/animate.css">
    <link href="https://fonts.googleapis.com/css?family=Bodoni 72" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    <title>Buy DVD - Séries</title>
</head>
<body>

<head>

  <?php require('partials/nav.php'); ?>

</head>


<header class="m-auto">

<div class="name text-center text-white">




 <h2><?php if(isset($categorieserie)) : ?><div id="banniere_image" class="col-12 d-flex align-items-center justify-content-center" style="height:100px;background: url('img/imgserie/imgcategory/<?php  echo $categorieserie ['image'];?>'); background-repeat:no-repeat; background-size: 1450px;"><?php echo $categorieserie['name'];?></div><?php else : ?><h1 class="background color d-flex align-items-center justify-content-center">
   <img src="img/serie.png" alt="logo serie" class="logo_moovieserie col-md-3"/> </h1>
 <?php endif; ?> </h2>

</div>

</header>

<?php if(!empty($dvd_serie)): ?>

<?php foreach($dvd_serie as $key => $dvd_serie): ?>

    <div class="row d-flex justify-content-center mt-5">


          <div class="margin picture col-md-3">

              <img src="img/imgserie/imgproduit/<?php echo $dvd_serie['image'];?>" class="picture mt-5"/>

          </div>

          <div class="text col-md-7 text-justify">

              <h2 class="mt-5"><?php echo $dvd_serie ['title'];?></h2>

              <div class="content mt-4"><?php echo $dvd_serie ['summary']; ?></div>

              <div class="content mt-3">Prix du DVD: <?php echo $dvd_serie ['prix']; ?></div> <br>

              <button type="button" class="button btn">

                <a href="dvd_serie.php?dvd_serie_id=<?php echo $dvd_serie['id'] ?>">  Plus d'information
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
