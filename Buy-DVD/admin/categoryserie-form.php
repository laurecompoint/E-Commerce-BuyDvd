<?php
require_once '../tools/_db.php';

if(!isset($_SESSION['is_admin']) OR $_SESSION['is_admin'] == 0){
	header('location:../index.php');
	exit;
}

if(isset($_POST['save'])){
    $query = $db->prepare('INSERT INTO categoryserie (name) VALUES (?)');
    $newCategorySerie = $query->execute(
		[
			$_POST['name'],

		]
    );

		if($newCategorySerie){

	   if(isset($_FILES['image'])){

			 $allowed_extensions = array( 'jpg' , 'jpeg' , 'gif' , 'png' );

			 $my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);


			 if ( in_array($my_file_extension , $allowed_extensions) ){

				 $new_file_name = md5(rand());

				 $destination = '../img/imgserie/imgcategory/' . $new_file_name . '.' . $my_file_extension;

				 $result = move_uploaded_file( $_FILES['image']['tmp_name'], $destination);

				 $lastInsertarticleId = (int) $db->lastInsertId();


					 $query = $db->prepare('UPDATE categoryserie SET
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

		 	header('location:categoryserie-list.php');
		 	exit;

		 	}
		 else{
		 	$message = "Impossible d'enregistrer la nouvelle catégorie";
		 }
	}

if(isset($_POST['update'])){

	$query = $db->prepare('UPDATE categoryserie SET
		name = :name
		WHERE id = :id'
	);


	$result = $query->execute(
		[
			'name' => $_POST['name'],
			'id' => $_POST['id']
		]
	);
	if($newCategorySerie){
				if(isset($_FILES['image'])){

						$allowed_extensions = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
						$my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);

						if ( in_array($my_file_extension , $allowed_extensions) ){


					unlink('../img/imgserie/imgcategory/' . $_POST['current-image']);
				}

								$new_file_name = md5(rand());
								$destination = '../img/imgserie/imgcategory/' . $new_file_name . '.' . $my_file_extension;
								$result = move_uploaded_file( $_FILES['image']['tmp_name'], $destination);

								$query = $db->prepare('UPDATE categorieserie SET
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

	$query = $db->prepare('SELECT * FROM categoryserie WHERE id = ?');
    $query->execute(array($_GET['categoryserie_id']));

	$categoryserie = $query->fetch();
}

?>

<!DOCTYPE html>
<html>
	<head>

		<title>Administration des catégories series - Buy DVD!</title>

		<?php require 'partials/head_assets.php'; ?>

	</head>
	<body class="index-body">
		<div class="container-fluid">

			<?php require 'partials/header.php'; ?>

			<div class="row my-3 index-content">

				<?php require 'partials/nav.php'; ?>

				<section class="col-9">
					<header class="pb-3">

						<h4><?php if(isset($categoryserie)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> une catégorie</h4>
					</header>

					<?php if(isset($message)): ?>
					<div class="bg-danger text-white">
						<?php echo $message; ?>
					</div>
					<?php endif; ?>

					<form action="categoryserie-form.php" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label for="name">Nom :</label>
							<input class="form-control" <?php if(isset($categoryserie)): ?>value="<?php echo $categoryserie['name']?>"<?php endif; ?> type="text" placeholder="Nom" name="name" id="name" />
						</div>

						<div class="form-group">
							<label for="image">Image :</label>
							<input class="form-control" type="file" name="image" id="image" />
							<?php if(isset($categoryserie) && $categoryserie['image']): ?>
							<img class="img-fluid py-4" src="../img/imgserie/imgcategory/<?php echo $categoryserie['image']; ?>" alt="" />
							<input type="hidden" name="current-image" value="<?php echo $categoryserie['image']; ?>" />
							<?php endif; ?>
						</div>


						<div class="text-right">

							<?php if(isset($categoryserie)): ?>
							<input class="btn button" type="submit" name="update" value="Mettre à jour" />

							<?php else: ?>
							<input class="btn btn-success" type="submit" name="save" value="Enregistrer" />
							<?php endif; ?>
						</div>


						<?php if(isset($categoryserie)): ?>
						<input type="hidden" name="id" value="<?php echo $categoryserie['id']?>" />
						<?php endif; ?>

					</form>
				</section>
			</div>

		</div>
	</body>
</html>
