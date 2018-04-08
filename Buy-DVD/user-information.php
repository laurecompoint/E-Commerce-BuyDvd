<?php

require_once 'tools/_db.php';

if(!isset($_SESSION['user'])){
	header('location:../index.php');
	exit;
}


$query = $db->prepare('SELECT * FROM user WHERE id = ?');
$query->execute(array($_SESSION['user_id']));
$user = $query->fetch();


if(isset($_GET['user_id']) && isset($_GET['action']) && $_GET['action'] == 'delete'){

	$query = $db->prepare('DELETE FROM user WHERE id = ?');
	$result = $query->execute(
		[
			$_GET['user_id']
		]
	);

	if($result){
		$message = "Suppression efféctuée.";
	}
	else{
		$message = "Impossible de supprimer la séléction.";
	}
}


$query = $db->query('SELECT * FROM user');
$users = $query->fetchall();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Users Information - Buy DVD !</title>
		<?php require 'admin/partials/head_assets.php'; ?>
		<link rel="stylesheet" href="css/moovieseries_tv.css">

	</head>
	<body>

    <header class="ActionNav row mb-3 main-header">
        <div class="col py-4 text-center" style="background-image: linear-gradient(#3A9EEA, #1582D6, #1443D1);">
            <a href="user-information.php" class="text-dark"><b>User Information - <a href="index.php" class="text-dark">Buy DVD !</a></b></a>
        </div>
    </header>

					<div class="pb-4 d-flex justify-content-center mt-5">
						<h4>Posibilité de modifier vos informations personnel</h4>

					</div>

					<?php if(isset($message)): ?>
					<div class="bg-success text-white p-2 mb-4">
						<?php echo $message; ?>
					</div>
					<?php endif; ?>

					<?php if($users): ?>

<style>

</style>

          <div class="height row mt-5 d-flex align-content-center">

             <div class="imageuser d-flex justify-content-center align-content-center col-3">
							 <?php if(!empty($user['image'])): ?>
							      <img src="img/imguser/<?php echo $user['image'];?>" alt="contacte" class="image img-fluid col-8"/>
							 <?php else : ?>
							      <img src="img/contacte.png" alt="contacte" class="image col-8 img-fluid" />
							 <?php endif; ?>

             </div>

						 <div class="user_information col-8">

							 <table class="table border">
							 	<thead>

							 		<tr style="background-image: linear-gradient(#3A9EEA, #1582D6, #1443D1);">

							 			<th>First Name</th>
							 			<th>Last Name</th>
							 			<th>Email</th>

							 		</tr>
							 	</thead>
							 	<tbody>


							 		<tr style="background-color: white;">


							 			<td><?php echo htmlentities($user['firstname']); ?></td>
							 			<td><?php echo htmlentities($user['lastname']); ?></td>
							 			<td><?php echo htmlentities($user['email']); ?></td>

							 		</tr>



							 	</tbody>
							 </table>

							 <br>

							 <div class="ActionButton d-flex justify-content-end">
							 	<a href="user-form.php?user_id=<?php echo $user['id']; ?>&action=edit" class="btn button text-dark mr-2">Modifier</a>
							 	<a onclick="return confirm('Are you sure?')" href="user-information.php?user_id=<?php echo $user['id']; ?>&action=delete" class="btn btn-danger">Supprimer</a>
							</div>

						 </div>


					</div>

					<?php else: ?>
						Aucun utilisateur enregistré.
					<?php endif; ?>



	</body>
</html>
