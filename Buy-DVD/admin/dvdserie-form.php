<?php

require_once '../tools/_db.php';

if(!isset($_SESSION['is_admin']) OR $_SESSION['is_admin'] == 0){
	header('location:../index.php');
	exit;
}


if(isset($_POST['save'])){

    $query = $db->prepare('INSERT INTO dvd_serie (title, summary, realisateur, format, acteur, prix, prix2, qualite, language_subtitle, stereo, type_color, public, content, editeur, is_published, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())');
    $newSerie = $query->execute(
		[

		 $_POST['title'],
		 $_POST['summary'],
		 $_POST['realisateur'],
		 $_POST['format'],
		 $_POST['acteur'],
		 $_POST['prix'],
		 $_POST['prix2'],
		 $_POST['qualite'],
		 $_POST['language_subtitle'],
		 $_POST['stereo'],
		 $_POST['type_color'],
		 $_POST['public'],
		 $_POST['editeur'],
		 $_POST['content'],
		 $_POST['is_published']

		]
    );

		$lastInsertedArticleId = $db->lastInsertId();

		foreach ($_POST['categories'] as $categoryserie_id) {

			$query = $db->prepare('INSERT INTO dvdserie_category (dvd_serie_id, categoryserie_id) VALUES (?, ?)');
	    $newSerie = $query->execute(
			[
			  $lastInsertedArticleId,
			  $categoryserie_id,

			]
	    );

		}

  if($newSerie){

   if(isset($_FILES['image'])){

		 $allowed_extensions = array( 'jpg' , 'jpeg' , 'gif' , 'png' );


		 $my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);


		 if ( in_array($my_file_extension , $allowed_extensions) ){

			 $new_file_name = md5(rand());

			 $destination = '../img/imgserie/imgproduit/' . $new_file_name . '.' . $my_file_extension;

			 $result = move_uploaded_file( $_FILES['image']['tmp_name'], $destination);

			 $lastInsertarticleId =  $db->lastInsertId();


				 $query = $db->prepare('UPDATE dvd_serie SET
					 image = :image
					 WHERE id = :id'
				 );

				 $resultUpdateImage = $query->execute(
		       [
		         'image' =>$new_file_name . '.' . $my_file_extension,
		         'id' => $lastInsertarticleId
		   		]
		     );

		 }
	 }

		header('location:dvdserie-list.php');
		exit;
    }
	else{
		$message = "Impossible d'enregistrer le nouvel article...";
	}
}

if(isset($_POST['update'])){

  $query = $db->prepare('UPDATE dvd_serie SET

		title = :title,
		summary = :summary,
		realisateur = :realisateur,
		format = :format,
		acteur = :acteur,
		prix = :prix,
		prix2 = :prix2,
		qualite = :qualite,
		language_subtitle = :language_subtitle,
		stereo = :stereo,
		type_color = :type_color,
		public = :public,
		editeur = :editeur,
		content = :content,
		is_published = :is_published
		WHERE id = :id'
  );

  	$resultSerie = $query->execute(
      [

        'title' => $_POST['title'],
        'summary' => $_POST['summary'],
				'realisateur' => $_POST['realisateur'],
				'format' => $_POST['format'],
        'acteur' => $_POST['acteur'],
				'prix' => $_POST['prix'],
				'prix2' => $_POST['prix2'],
				'qualite' => $_POST['qualite'],
				'language_subtitle' => $_POST['language_subtitle'],
				'stereo' => $_POST['stereo'],
				'type_color' => $_POST['type_color'],
				'public' => $_POST['public'],
				'editeur' => $_POST['editeur'],
        'content' => $_POST['content'],
        'is_published' => $_POST['is_published'],
        'id' => $_POST['id'],
  		]
    );


		$query = $db->prepare('DELETE FROM dvdserie_category WHERE dvd_serie_id = ?');
		$result = $query->execute(
			[
				$_POST['id']
			]
		);

			foreach ($_POST['categories'] as $categoryserie_id) {

				$query = $db->prepare('INSERT INTO dvdserie_category (dvd_serie_id, categoryserie_id) VALUES (?, ?)');
		    $newSerie = $query->execute(
				[
				  $_POST['id'],
				  $categoryserie_id,

				]
		    );

			}


if($resultSerie){
			if(isset($_FILES['image'])){

					$allowed_extensions = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
					$my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);

					if ( in_array($my_file_extension , $allowed_extensions) ){


			if(isset($_POST['current-image'])){
				unlink('../img/imgserie/imgproduit/' . $_POST['current-image']);
			}

							$new_file_name = md5(rand());
							$destination = '../img/imgserie/imgproduit/' . $new_file_name . '.' . $my_file_extension;
							$result = move_uploaded_file( $_FILES['image']['tmp_name'], $destination);

							$query = $db->prepare('UPDATE dvd_serie SET
				image = :image
				WHERE id = :id'
							);
							$resultUpdateImage = $query->execute(
									[
											'image' => $new_file_name . '.' . $my_file_extension,
											'id' => $_POST['id']
									]
							);
					}
			}

			header('location:article-list.php');
			exit;
	}
else{
	$message = 'Erreur.';
}
}

if(isset($_GET['dvd_serie_id']) && isset($_GET['action']) && $_GET['action'] == 'edit'){
	$query = $db->prepare('SELECT * FROM dvd_serie WHERE id = ?');
    $query->execute(array($_GET['dvd_serie_id']));

	$dvdserie = $query->fetch();

	$query = $db->prepare('SELECT categoryserie_id FROM dvdserie_category WHERE dvd_serie_id = ?');
	$query->execute(array($_GET['dvd_serie_id']));

	$dvdCategories = $query->fetchAll();
}
?>

<!DOCTYPE html>
<html>
	<head>

		<title>Administration des produits - Buy DVD !</title>

		<?php require 'partials/head_assets.php'; ?>

	</head>
	<body class="index-body">
		<div class="container-fluid">

			<?php require 'partials/header.php'; ?>

			<div class="row my-3 index-content">

				<?php require 'partials/nav.php'; ?>

				<section class="col-9">
					<header class="pb-3">

						<h4><?php if(isset($dvdserie)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> un produit</h4>
					</header>
					<?php if(isset($message)): ?>
					<div class="bg-danger text-white">
						<?php echo $message; ?>
					</div>
					<?php endif; ?>


					<form action="dvdserie-form.php" method="post" enctype="multipart/form-data">

						<div class="form-group">
							<label for="title">Titre :</label>
							<input class="form-control" <?php if(isset($dvdserie)): ?>value="<?php echo $dvdserie['title']; ?>"<?php endif; ?> type="text" placeholder="Titre" name="title" id="title" />
						</div>

						<div class="form-group">
							<label for="summary">Résumé :</label>
							<input class="form-control" <?php if(isset($dvdserie)): ?>value="<?php echo $dvdserie['summary']; ?>"<?php endif; ?> type="text" placeholder="Résumé" name="summary" id="summary" />
						</div>

						<div class="form-group">
							<label for="image">Image :</label>
							<input class="form-control" type="file" name="image" id="image" />
							<?php if(isset($dvdserie) && $dvdserie['image']): ?>
							<img class="img-fluid py-4 col-2" src="../img/imgserie/imgproduit/<?php echo $dvdserie['image']; ?>" alt="" />
							<input type="hidden" name="current-image" value="<?php echo $dvdserie['image']; ?>" />
							<?php endif; ?>
						</div>

						<div class="form-group">
							<label for="categories"> Catégorie </label>
							<select class="form-control" name="categories[]" id="categories" multiple>
								<?php
								$queryCategory= $db ->query('SELECT * FROM categoryserie');
								$categories = $queryCategory->fetchAll();
								?>
								<?php foreach($categories as $key => $category) : ?>

									<?php
									$selected = '';

									foreach ($dvdCategories as $dvdCategorie) {
										if($category['id'] == $dvdCategorie['categoryserie_id']){
											$selected = 'selected="selected"';
										}
									}
									?>
									<option value="<?php echo $category['id']; ?>" <?php echo $selected; ?>> <?php echo $category['name']; ?> </option>
								<?php endforeach; ?>
							</select>
						</div>

						<div class="form-group">
							<label for="content">Réalisateurs :</label>
							<textarea class="form-control" name="realisateur" id="realisateur" placeholder="realisateur"><?php if(isset($dvdserie)): ?><?php echo $dvdserie['realisateur']; ?><?php endif; ?></textarea>
						</div>

						<div class="form-group">
							<label for="content">Format:</label>
							<textarea class="form-control" name="format" id="content" placeholder="Contenu"><?php if(isset($dvdserie)): ?><?php echo $dvdserie['format']; ?><?php endif; ?></textarea>
						</div>

						<div class="form-group">
							<label for="content">Acteurs :</label>
							<textarea class="form-control" name="acteur" id="acteur" placeholder="acteur"><?php if(isset($dvdserie)): ?><?php echo $dvdserie['acteur']; ?><?php endif; ?></textarea>
						</div>

						<div class="form-group">
							<label for="content">Prix Standart :</label>
							<textarea class="form-control" name="prix" id="content" placeholder="Contenu"><?php if(isset($dvdserie)): ?><?php echo $dvdserie['prix']; ?><?php endif; ?></textarea>
						</div>

						<div class="form-group">
							<label for="content">Prix D'occation :</label>
							<textarea class="form-control" name="prix2" id="content" placeholder="Contenu"><?php if(isset($dvdserie)): ?><?php echo $dvdserie['prix2']; ?><?php endif; ?></textarea>
						</div>

						<div class="form-group">
							<label for="content">Qualité :</label>
							<textarea class="form-control" name="qualite" id="content" placeholder="Contenu"><?php if(isset($dvdserie)): ?><?php echo $dvdserie['qualite']; ?><?php endif; ?></textarea>
						</div>

						<div class="form-group">
							<label for="content">Langue et Sous titres :</label>
							<textarea class="form-control" name="language_subtitle" id="content" placeholder="Contenu"><?php if(isset($dvdserie)): ?><?php echo $dvdserie['language_subtitle']; ?><?php endif; ?></textarea>
						</div>

						<div class="form-group">
							<label for="content">Stéréo/Mono :</label>
							<textarea class="form-control" name="stereo" id="content" placeholder="Contenu"><?php if(isset($dvdserie)): ?><?php echo $dvdserie['stereo']; ?><?php endif; ?></textarea>
						</div>

						<div class="form-group">
							<label for="content">Type de couleur :</label>
							<textarea class="form-control" name="type_color" id="content" placeholder="Contenu"><?php if(isset($dvdserie)): ?><?php echo $dvdserie['type_color']; ?><?php endif; ?></textarea>
						</div>

						<div class="form-group">
							<label for="content">Publics :</label>
							<textarea class="form-control" name="public" id="content" placeholder="Contenu"><?php if(isset($dvdserie)): ?><?php echo $dvdserie['public']; ?><?php endif; ?></textarea>
						</div>

						<div class="form-group">
							<label for="content">Editeurs :</label>
							<textarea class="form-control" name="editeur" id="content" placeholder="Contenu"><?php if(isset($dvdserie)): ?><?php echo $dvdserie['editeur']; ?><?php endif; ?></textarea>
						</div>


						<div class="form-group">
							<label for="content">Contenue du DVD :</label>
							<textarea class="form-control" name="content" id="content" placeholder="Contenu"><?php if(isset($dvdserie)): ?><?php echo $dvdserie['content']; ?><?php endif; ?></textarea>
						</div>

						<div class="form-group">
							<label for="is_published"> Publié ?</label>
							<select class="form-control" name="is_published" id="is_published">
								<option value="0" <?php if(isset($dvdserie) && $dvdserie['is_published'] == 0): ?>selected<?php endif; ?>>Non</option>
								<option value="1" <?php if(isset($dvdserie) && $dvdserie['is_published'] == 1): ?>selected<?php endif; ?>>Oui</option>
							</select>
						</div>


					  <div class="text-right">

						<?php if(isset($dvdserie)): ?>
						<input class="button btn" type="submit" name="update" value="Mettre à jour" />

						<?php else: ?>
						<input class="button btn" type="submit" name="save" value="Enregistrer" />
						<?php endif; ?>
					  </div>


					  <?php if(isset($dvdserie)): ?>
					  <input type="hidden" name="id" value="<?php echo $dvdserie['id']; ?>" />
					  <?php endif; ?>

					</form>
				</section>
			</div>

		</div>
  </body>
</html>
