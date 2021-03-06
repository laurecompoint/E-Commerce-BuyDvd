<?php

if (isset($_GET["produit"]))
{
  if (!isset($_SESSION["list"]))
  {
    $_SESSION["list"] = array();
  }
  array_push($_SESSION["list"], $_GET["produit"]);
}
//compter elements dans panier
$panier_count = 0;
if (isset($_SESSION["list"]))
{
  $panier_count = sizeof($_SESSION["list"]);
}
?>
<?php

require_once 'tools/_db.php';

if(isset($_POST['save'])){
		$query = $db->prepare('INSERT INTO commentaire (speudo,objet,avis,is_published,created_at) VALUES (?, ?, ?, ?,NOW())');
		$newCommentaire = $query->execute(
		[
			$_POST['speudo'],
            $_POST['objet'],
			$_POST['avis'],
			$_POST['is_published']

		]
		);
		$lastInsertedArticleId = $db->lastInsertId();

		foreach ($_POST['categories'] as $commentaire_id) {

			$query = $db->prepare('INSERT INTO commentaire_produitserie (commentaire_id, dvd_serie_id) VALUES (?, ?)');
	    $newSerie = $query->execute(
			[
			  $lastInsertedArticleId,
			  $commentaire_id,

			]
	    );

		}
	if($newCommentaire){
		header('location:index.php');
		exit;

		}
	else{
		$message = "Impossible d'enregistrer le commentaire";
	}
}


if(isset($_GET['dvd_serie_id'] ) ){


	$query = $db->prepare('
		SELECT dvd_serie.*, GROUP_CONCAT(categoryserie.name SEPARATOR " / ") AS categories
		FROM dvd_serie
		JOIN dvdserie_category ON dvd_serie.id = dvdserie_category.dvd_serie_id
		JOIN categoryserie ON dvdserie_category.categoryserie_id = categoryserie.id
		WHERE dvd_serie.id = ? AND dvd_serie.is_published = 1
	');


	$query->execute( array( $_GET['dvd_serie_id'] ) );

	$dvd_serie = $query->fetch();

	if($dvd_serie){
		$query = $db->prepare('
		SELECT commentaire.*
		FROM commentaire
		JOIN commentaire_produitserie ON commentaire.id = commentaire_produitserie.commentaire_id
		JOIN dvd_serie ON commentaire_produitserie.dvd_serie_id = dvd_serie.id
		WHERE commentaire.is_published = 1 AND dvd_serie.id = ?
		GROUP BY commentaire.id
		ORDER BY created_at DESC
		LIMIT 0, 3
	');
	$result = $query->execute( array($_GET['dvd_serie_id']) );
	$commentaire = $query->fetchAll();
	}

}

else{
	header('location:dvd_serie.php');
	exit;
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require 'partials/head_assets.php'; ?>
    <title>Buy DVD - Série TV</title>
</head>

<body>

  <head>

      <?php require('partials/nav.php'); ?>



  </head>

<div class="d-flex container align-content-start mt-5">

	<div class="name mt-5">

			<h2><?php echo $dvd_serie ['title'];?></h2>

	</div>


</div>

  <div class="row d-flex justify-content-center">

<div class="col-md-5 mt-5">
      <div class="picture">
        <a class="col-4 my-3" data-fancybox="gallery" href="img/imgserie/imgproduit/<?php echo $dvd_serie['image']; ?>">
          <img src="img/imgserie/imgproduit/<?php echo $dvd_serie ['image'];?>" class="picture"/>
        </a>
      </div>

			<nav>
				<div class="nav nav-tabs mt-4" id="nav-tab" role="tablist">
					<a class="nav-item nav-link active bg-light text-center" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Résumé</a>
					<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Détail Produit</a>

				</div>
			</nav>
			<div class="tab-content" id="nav-tabContent">
				<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">


								<div class="content mt-4 text-justify"><?php echo $dvd_serie ['summary']; ?></div>

				</div>


				<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

					<div class="row mt-5">

							 <div class="col-md-3">

									<p class="text-secondary">Réalisateurs:</p>

							 </div>

							 <div class="col-md-7">

										<div class="realisateur"><?php echo $dvd_serie ['realisateur']; ?></div> <br>
							 </div>
					</div>

					<div class="row">

							 <div class="col-md-3">

										<p class="text-secondary">Acteurs: </p>

							 </div>

							 <div class="col-md-7">

								 <div class="acteur"><?php echo $dvd_serie ['acteur']; ?></div> <br>

							 </div>
					</div>

					<div class="row">

							 <div class="col-md-3">

										<p class="text-secondary">Format: </p>

							 </div>

							 <div class="col-md-7">

								 <div class="acteur"><?php echo $dvd_serie ['format']; ?></div> <br>

							 </div>
					</div>
					<div class="row">

							 <div class="col-md-3">

										<p class="text-secondary">Date de parusion: </p>

							 </div>

							 <div class="col-md-7">

								 <div class="acteur"><?php echo $dvd_serie ['created_at']; ?></div> <br>

							 </div>
					</div>

					<button type="button" class="button btn">

						<a href="#caracteristique">Plus de caractéristiques
						</a>
					</button>
                </div>
            </div>


</div>

<div class="col-md-5 d-flex flex-column">

<a href="#avis" class="viewTwo text-center">Donnez Votre Avis</a>


		<div class="prise borderOne border border-secondary mt-4">

            <ul class="nav nav-tabs d-flex justify-content-center" id="myTab" role="tablist">
                <li class="nav-item col-6">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Prix Standart</a>
                </li>
                <li class="nav-item col-6">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Prix D'occations</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                    <div class="row d-flex justify-content-around mt-4">
                        <div>Prix</div>
                        <div class="prix text-danger"><h4><?php echo $dvd_serie['prix']; ?></h4></div> <br>
                    </div> <br>
                    <div class="livraison row d-flex justify-content-around"> <br>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Livraison Gratuite</label>
                        </div>
                        <div>Or</div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                            <label class="custom-control-label" for="customCheck2">Livraison Premium</label>
                        </div>
                    </div>
                    <div class="d-flex flex-column mt-1">
                        <form method="POST" action="panier.php">
                            <button class="buttontwo" name="produit">
                               <a href="panier.php" name="produit">Ajouter au panier </a>
                            </button>
                        </form>
                    <a href="#" class="bg-light pb-3 text-center mt-3">
                        Voir toutes les options et délais de livraison
                    </a>
                    </div>
                </div>

                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                    <div class="row d-flex justify-content-around mt-4">
                        <div>Prix</div>
                        <div class="prix text-danger"><h4><?php echo $dvd_serie['prix2']; ?></h4></div> <br>
                    </div> <br>
                    <div class="livraison row d-flex justify-content-around"> <br>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Livraison Gratuite</label>
                        </div>
                        <div>Or</div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck2">
                            <label class="custom-control-label" for="customCheck2">Livraison Premium</label>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        <button class="buttontwo mt-1">
													<a href="">  Ajouter au panier
													</a>
												</button>
                        <a href="#" class="bg-light pb-3 text-center mt-3">

                            Voir toutes les options et délais de livraison
                        </a>
                    </div>
                </div>
            </div>
        </div>
</div>

  </div>

</div>

  </div>

<div class="block col-md-12 mt-5 bg-white pb-5">

<hr>

    <h5 class="container mt-4">Autre Oeuvres</h5>
                <div class="card-group col-11 m-auto">
                    <div class="card col-md-3">
                        <img class="card-img-top pictures rounded mx-auto d-block mt-5" src="img/imgserie/imgProduitSimilaire/<?php echo $dvd_serie['imageOne'];?>" alt="Card image cap">
                        <div class="mt-3">
                            <button type="button" class="buttonThree  btn mt-1 ml-4 col-md-9">

                                <a href="#">  Voir le Produit
                                </a>
                            </button>
                        </div>

                    </div>
                    <div class="card col-md-3">
                        <img class="card-img-top pictures rounded mx-auto d-block mt-5" src="img/imgserie/imgProduitSimilaire/<?php echo $dvd_serie ['imageTwo'];?>" alt="Card image cap">
                        <div class="mt-3">
                            <button type="button" class="buttonThree  btn mt-1 ml-4 col-md-9">

                                <a href="#"> Voir le Produit
                                </a>
                            </button>
                        </div>

                    </div>
                    <div class="card col-md-3">
                        <img class="card-img-top pictures rounded mx-auto d-block mt-5" src="img/imgserie/imgProduitSimilaire/<?php echo $dvd_serie ['imageThree'];?>" alt="Card image cap">
                        <div class="mt-3">
                            <button type="button" class="buttonThree  btn mt-1 ml-4 col-md-9">

                                <a href="#">  Voir le Produit
                                </a>
                            </button>
                        </div>

                    </div>
                    <div class="card col-md-3">
                        <img class="card-img-top pictures rounded mx-auto d-block mt-5" src="img/imgserie/imgProduitSimilaire/<?php echo $dvd_serie ['imageFoor'];?>" alt="Card image cap">
                        <div class="mt-3">
                            <button type="button" class="buttonThree btn mt-1 ml-4 col-md-9">

                                <a href="#"> Voir le Produit
                                </a>
                            </button>
                        </div>

                    </div>
                    <div class="card col-md-3">
                        <img class="card-img-top pictures rounded mx-auto d-block mt-5" src="img/imgserie/imgProduitSimilaire/<?php echo $dvd_serie ['imageFive'];?>" alt="Card image cap">
                        <div class="mt-3">
                            <button type="button" class="buttonThree btn mt-1 ml-4 col-md-9">

                                <a href="">  Voir le Produit
                                </a>
                            </button>
                        </div>

                    </div>
                </div>
            </div>

    </div>

</div>

<div class="row d-flex justify-content-center mt-5" id="avis">

	<div class="col-md-7">

	<h5>Avis clients</h5>



<?php if(!empty($commentaire)) : ?>

<?php foreach ($commentaire as $key => $value):?>
<div class="col-12 row view">
	<div class="mt-3 col-md-3 bg-dark d-flex justify-content-center flex-column" style="color:#1582D6;">
		<i class="fa fa-user-o m-auto" style="font-size:36px;"></i>
<h5 class="text-center text-white mb-4"><?php echo $value['speudo']; ?></h5>
	</div>
	<div class="mt-3 col-md-9 bg-white border borderdark">
	<p><?php echo $value['objet']; ?></p>
	<p class="text-secondary">Posté le : <?php echo $value['created_at']; ?></p>
	<p><?php echo $value['avis']; ?></p>

	</div>
</div>

<?php endforeach ?>
<?php else: ?>
Pas encore de commentaire pour ce produit
<?php endif;?>




	</div>


	<div class="col-md-3 d-flex justify-content-end">


	 <form class="d-flex flex-column m-auto align-items-center" action="dvd_serie.php?dvd_serie_id=<?php echo $dvd_serie['id'];?>" method="post">

			<h5>Laisser un commentaire</h5>

			<?php if(isset($message)): ?>
			<div class="bg-danger text-white">
				<?php echo $message; ?>
			</div>
			<?php endif; ?>


			<input class="mt-5" type="text" name="speudo" value="" placeholder="Speudo" /> <br>
			<input type="text" name="objet" value="" placeholder="Objet" /> <br>
			<input type="text" name="avis" value="" placeholder="Votre avis" /> <br>
			<input type="hidden" name="is_published" value="1" placeholder="is_published" /> <br>
			<input type="hidden" name="categories[]" value="<?php echo $dvd_serie['id']; ?>" placeholder="is_published" />


			 <input type="submit" name="save" class="button" value="Envoyer" />




	 </form>

	</div>


</div>

<hr>

	<div class="avis col-10 m-auto">

	<table class="table table-striped mt-5">
	  <thead class="type" id="caracteristique">
	    <tr>
	      <th scope="col">Caracteristique détailler</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>
	      <td>Réalisateur</td>
	      <td class="realisateur"><?php echo $dvd_serie ['realisateur']; ?></td>
	    </tr>
	    <tr>
	      <td>Acteur</td>
	      <td><?php echo $dvd_serie ['acteur']; ?></td>
	    </tr>
			<tr>
	      <td>Editeur</td>
	      <td><?php echo $dvd_serie ['editeur']; ?></td>
	    </tr>
			<tr>
	      <td>Public Légale</td>
	      <td><?php echo $dvd_serie ['public']; ?></td>
	    </tr>
	    <tr>
	      <td>Langue/Sous-Titres</td>
	      <td><?php echo $dvd_serie ['language_subtitle']; ?></td>
	    </tr>
			<tr>
	      <td>Qualité</td>
	      <td><?php echo $dvd_serie ['qualite']; ?></td>
	    </tr>
			<tr>
	      <td>Type de couleur</td>
	      <td><?php echo $dvd_serie ['type_color']; ?></td>
	    </tr>
			<tr>
	      <td>Stéreo / Mono</td>
	      <td><?php echo $dvd_serie ['stereo']; ?></td>
	    </tr>
			<tr>
	      <td>Contenue</td>
	      <td><?php echo $dvd_serie ['content']; ?></td>
	    </tr>
	  </tbody>
	</table>

</div>


<footer class="mt-5">

    <?php require 'partials/footer.php'; ?>

</footer>

</body>
</html>
