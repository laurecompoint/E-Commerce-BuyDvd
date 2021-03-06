<?php require_once 'tools/_db.php'; ?>
<?php

require_once 'tools/_db.php';

if(isset($_GET['dvdmoovie_id'] ) ){


	$query = $db->prepare('
		SELECT dvdmoovie.*, GROUP_CONCAT(categorymoovie.name SEPARATOR " / ") AS categories
		FROM dvdmoovie
		JOIN dvdmoovie_category ON dvdmoovie.id = dvdmoovie_category.dvdmoovie_id
		JOIN categorymoovie ON dvdmoovie_category.categorymoovie_id = categorymoovie.id
		WHERE dvdmoovie.id = ? AND dvdmoovie.is_published = 1
	');


	$query->execute( array( $_GET['dvdmoovie_id'] ) );

	$dvdmoovie = $query->fetch();

	if(!$dvdmoovie){
		header('location:index.php');
		exit;
	}

}
else{
	header('location:index.php');
	exit;
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

<div class="d-flex container align-content-start mt-5">

	<div class="name mt-5">

			<h1 class="title"><?php echo $dvdmoovie ['title'];?></h1>

	</div>


</div>

	<div class="row d-flex justify-content-center">

<div class="col-md-5 mt-5">
			<div class="picture">
				<a class="col-4 my-3" data-fancybox="gallery" href="img/imgfilm/imgproduit/<?php echo $dvdmoovie['image']; ?>">
					<img src="img/imgfilm/imgproduit/<?php echo $dvdmoovie ['image'];?>" class="picture"/>
        </a>
			</div>

			<nav>
				<div class="nav nav-tabs mt-5" id="nav-tab" role="tablist">
					<a class="nav-item nav-link active bg-light text-center" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Résumé</a>
					<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Détail Produit</a>

				</div>
			</nav>
			<div class="tab-content" id="nav-tabContent">
				<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">


								<div class="content mt-4 text-justify"><?php echo $dvdmoovie['summary']; ?></div>

				</div>


				<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

					<div class="row d-flex mt-5">

							 <div class="col-md-2">

									<p class="text-secondary">Réalisateurs:</p>

							 </div>

							 <div class="col-md-4">

										<div class="realisateur"><?php echo $dvdmoovie ['realisateur']; ?></div> <br>
							 </div>
					</div>

					<div class="row">

							 <div class="col-md-2">

										<p class="text-secondary">Acteurs : </p>

							 </div>

							 <div class="col-md-8">

								 <div class="acteur"><?php echo $dvdmoovie ['acteur']; ?></div> <br>

							 </div>
					</div>

					<div class="row">

							 <div class="col-md-2">

										<p class="text-secondary">Format : </p>

							 </div>

							 <div class="col-md-8">

								 <div class="acteur"><?php echo $dvdmoovie ['format']; ?></div> <br>

							 </div>
					</div>
					<div class="row">

							 <div class="col-md-2">

										<p class="text-secondary">Date de parusion: </p>

							 </div>

							 <div class="col-md-8">

								 <div class="acteur"><?php echo $dvdmoovie ['created_at']; ?></div> <br>

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

<a href="#" class="mt-4 viewTwo bg-dark text-center">Donnez Votre Avis</a>

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
												<div class="prix text-danger"><h4><?php echo $dvdmoovie['prix']; ?></h4></div> <br>
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
										<button type="button" class="button btn mt-3 ml-5 col-4">

												<a href="article.php?id=
						 <?php echo $dvdmoovie['id'] ?>">  Ajouter au panier
												</a>
										</button>
										<a href="#" class="bg-light mt-4 pb-3 text-center">

												Voir toutes les options et délais de livraison
										</a>
										</div>
								</div>

								<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

										<div class="row d-flex justify-content-around mt-4">
												<div>Prix</div>
												<div class="prix text-danger"><h4><?php echo $dvdmoovie['prix2']; ?></h4></div> <br>
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
												<button type="button" class="button btn mt-3 ml-5 col-4">

														<a href="article.php?id=
						 <?php echo $dvdmoovie['id'] ?>">  Ajouter au panier
														</a>
												</button>
												<a href="#" class="bg-light mt-4 pb-3 text-center">

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

<div class="mt-5 bg-white pb-5">
<hr>

<h5 class="container mt-4">Autre Oeuvres</h5>




						<div class="card-group col-11 m-auto">
								<div class="card col-md-3">
										<img class="card-img-top pictures rounded mx-auto d-block mt-5" src="img/imgfilm/imgproduit/<?php echo  $dvdmoovie['imageOne'];?>" alt="Card image cap">
										<div class="mt-3">
												<button type="button" class="buttonThree  btn mt-1 ml-4 col-9">

													<a class="product" href="dvd_film.php?dvdmoovie_id=<?php echo $dvdmoovie['id'] ?>">  Voir le Produit
													</a>
												</button>
										</div>

								</div>
								<div class="card col-md-3">
										<img class="card-img-top pictures rounded mx-auto d-block mt-5" src="img/imgfilm/imgproduit/<?php echo  $dvdmoovie['imageTwo'];?>" alt="Card image cap">
										<div class="mt-3">
												<button type="button" class="buttonThree btn mt-1 ml-4 col-9">

													<a class="product" href="dvd_film.php?dvdmoovie_id=<?php echo $dvdmoovie['id'] ?>">   Voir le Produit
													</a>
												</button>
										</div>

								</div>
								<div class="card col-md-3">
										<img class="card-img-top pictures rounded mx-auto d-block mt-5" src="img/imgfilm/imgproduit/<?php echo  $dvdmoovie ['imageThree'];?>" alt="Card image cap">
										<div class="mt-3">
												<button type="button" class="buttonThree  btn mt-1 ml-4 col-9">

													<a class="product" href="dvd_film.php?dvdmoovie_id=<?php echo $dvdmoovie['id'] ?>">   Voir le Produit
													</a>
												</button>
										</div>

								</div>
								<div class="card col-md-3">
										<img class="card-img-top pictures rounded mx-auto d-block mt-5" src="img/imgfilm/imgproduit/<?php echo  $dvdmoovie ['imageFoor'];?>" alt="Card image cap">
										<div class="mt-3">
												<button type="button" class="buttonThree  btn mt-1 ml-4 col-9">

													<a class="product" href="dvd_film.php?dvdmoovie_id=<?php echo $dvdmoovie['id'] ?>">   Voir le Produit
													</a>
												</button>
										</div>

								</div>
								<div class="card col-md-3">
										<img class="card-img-top pictures rounded mx-auto d-block mt-5" src="img/imgfilm/imgproduit/<?php echo  $dvdmoovie ['imageFive'];?>" alt="Card image cap">
										<div class="mt-3">
												<button type="button" class="buttonThree  btn mt-1 ml-4 col-9">

													<a class="product" href="dvd_film.php?dvdmoovie_id=<?php echo $dvdmoovie['id'] ?>">   Voir le Produit
													</a>
												</button>
										</div>

								</div>
						</div>
				</div>

</div>



</div>



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
			<td><?php echo $dvdmoovie ['realisateur']; ?></td>
		</tr>
		<tr>
			<td>Acteur</td>
			<td><?php echo $dvdmoovie ['acteur']; ?></td>
		</tr>
		<tr>
			<td>Editeur</td>
			<td><?php echo $dvdmoovie ['editeur']; ?></td>
		</tr>
		<tr>
			<td>Public Légale</td>
			<td><?php echo $dvdmoovie ['public']; ?></td>
		</tr>
		<tr>
			<td>Langue/Sous-Titres</td>
			<td><?php echo $dvdmoovie ['language_subtitle']; ?></td>
		</tr>
		<tr>
			<td>Qualité</td>
			<td><?php echo $dvdmoovie ['qualite']; ?></td>
		</tr>
		<tr>
			<td>Type de couleur</td>
			<td><?php echo $dvdmoovie ['type_color']; ?></td>
		</tr>
		<tr>
			<td>Stéreo / Mono</td>
			<td><?php echo $dvdmoovie  ['stereo']; ?></td>
		</tr>
		<tr>
			<td>Contenue</td>
			<td><?php echo $dvdmoovie ['content']; ?></td>
		</tr>
	</tbody>
</table>

</div>




<footer>

    <?php require('partials/footer.php'); ?>

</footer>

</body>
</html>
