<?php

require_once '../tools/_db.php';

if(!isset($_SESSION['is_admin']) OR $_SESSION['is_admin'] == 0){
	header('location:../index.php');
	exit;
}

if(isset($_GET['categoryserie_id']) && isset($_GET['action']) && $_GET['action'] == 'delete'){

	$query = $db->prepare('SELECT image FROM categoryserie WHERE id = ?');
	$query->execute(array($_GET['categoryserie_id']));
	$imageToDelete = $query->fetch();

	if($imageToDelete){ //si différent de NULL
		unlink('../img/imgserie/imgcategory/' . $imageToDelete["image"]);
	}


	$query = $db->prepare('DELETE FROM categoryserie WHERE id = ?');
	$result = $query->execute(
		[
			$_GET['categoryserie_id']
		]
	);

	if($result){
		$message = "Suppression efféctuée.";
	}
	else{
		$message = "Impossible de supprimer la séléction.";
	}
}

$query = $db->query('SELECT * FROM categoryserie');
$categoriesserie = $query->fetchall();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Administration des catégories - Buy DVD !</title>
		<?php require 'partials/head_assets.php'; ?>
	</head>
	<body class="index-body">
		<div class="container-fluid">

			<?php require 'partials/header.php'; ?>

			<div class="row my-3 index-content">

				<?php require 'partials/nav.php'; ?>

				<section class="col-9">
					<header class="pb-4 d-flex justify-content-between">
						<h4>Liste des catégories Séries</h4>
						<a class="btn btn-primary" href="categoryserie-form.php">Ajouter une catégorie</a>
					</header>

					<?php if(isset($message)): ?>
					<div class="bg-success text-white p-2 mb-4">
						<?php echo $message; ?>
					</div>
					<?php endif; ?>

					<table class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th class="d-flex justify-content-end mr-5">Action</th>
							</tr>
						</thead>
						<tbody>

							<?php if($categoriesserie): ?>
							<?php foreach($categoriesserie as $category): ?>

							<tr>

								<th><?php echo htmlentities($category['id']); ?></th>
								<td><?php echo htmlentities($category['name']); ?></td>
								<td class="d-flex justify-content-end">
									<a href="categoryserie-form.php?categoryserie_id=<?php echo $category['id']; ?>&action=edit" class="btn button mr-1">Modifier</a>
									<a onclick="return confirm('Are you sure?')" href="categoryserie-list.php?categoryserie_id=<?php echo $category['id']; ?>&action=delete" class="btn btn-danger">Supprimer</a>
								</td>
							</tr>

							<?php endforeach; ?>
							<?php else: ?>
								Aucune catégorie enregistré.
							<?php endif; ?>

						</tbody>
					</table>

				</section>

			</div>

		</div>
	</body>
</html>
