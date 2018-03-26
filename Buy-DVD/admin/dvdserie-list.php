<?php

require_once '../tools/_db.php';

if(!isset($_SESSION['is_admin']) OR $_SESSION['is_admin'] == 0){
	header('location:../index.php');
	exit;
}


if(isset($_GET['dvd_serie_id']) && isset($_GET['action']) && $_GET['action'] == 'delete'){

	$query = $db->prepare('DELETE FROM dvd_serie WHERE id = ?');
	$result = $query->execute(
		[
			$_GET['dvd_serie_id']
		]
	);

	if($result){
		$message = "Suppression efféctuée.";
	}
	else{
		$message = "Impossible de supprimer la séléction.";
	}
}


$query = $db->query('SELECT * FROM dvd_serie');
$dvdseries = $query->fetchall();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Administration des Produits - Buy DVD !</title>
		<?php require 'partials/head_assets.php'; ?>
	</head>
	<body class="index-body">
		<div class="container-fluid">

			<?php require 'partials/header.php'; ?>

			<div class="row my-3 index-content">

				<?php require 'partials/nav.php'; ?>

				<section class="col-9">
					<header class="pb-4 d-flex justify-content-between">
						<h4>Liste des produits (DVD Séries)</h4>
						<a class="btn btn-primary" href="dvdserie-form.php">Ajouter un produit</a>
					</header>

					<?php if(isset($message)):  ?>
					<div class="bg-success text-white p-2 mb-4">
						<?php echo $message; ?>
					</div>
					<?php endif; ?>

					<table class="table table-striped">
						<thead>
							<tr>
								<th>#</th>
								<th>Titre</th>
								<th>Publié</th>
								<th class="d-flex justify-content-end mr-5">Action</th>
							</tr>
						</thead>
						<tbody>

							<?php if($dvdseries): ?>
							<?php foreach($dvdseries as $dvdserie): ?>

							<tr>
                <th><?php echo htmlentities($dvdserie['id']); ?></th>
								<td><?php echo htmlentities($dvdserie['title']); ?></td>
								<td>
									<?php if($dvdserie['is_published'] == 1): ?>
									Oui
									<?php else: ?>
									Non
									<?php endif; ?>
								</td>
								<td class="d-flex justify-content-end">
									<a href="dvdserie-form.php?dvd_serie_id=<?php echo $dvdserie['id']; ?>&action=edit" class="btn button mr-1">Modifier</a>
									<a onclick="return confirm('Are you sure?')" href="dvdserie-list.php?dvd_serie_id=<?php echo $article['id']; ?>&action=delete" class="btn btn-danger mr-1">Supprimer</a>
								</td>
							</tr>

							<?php endforeach; ?>
							<?php else: ?>
								Aucun article enregistré.
							<?php endif; ?>

						</tbody>
					</table>

				</section>

			</div>

		</div>
	</body>
</html>
