<?php
require_once 'tools/_db.php';


if(isset($_POST['update'])){

	$query = $db->prepare('UPDATE user SET
		firstname = :firstname,
		lastname = :lastname,
		password = :password,
		email = :email
		WHERE id = :id'
	);


	$resultUser = $query->execute(
		[
			'firstname' => $_POST['firstname'],
			'lastname' => $_POST['lastname'],
			'password' => $_POST['password'],
			'email' => $_POST['email'],
			'id' => $_POST['id'],
		]
	);


	if($resultUser){
	if(isset($_FILES['image'])){

						$allowed_extensions = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
						$my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);

						if ( in_array($my_file_extension , $allowed_extensions) ){


				if(isset($_POST['current-image'])){
					unlink('img/imguser/' . $_POST['current-image']);
				}

								$new_file_name = md5(rand());
								$destination = 'img/imguser/' . $new_file_name . '.' . $my_file_extension;
								$result = move_uploaded_file( $_FILES['image']['tmp_name'], $destination);

								$query = $db->prepare('UPDATE user SET
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
				header('location:user-information.php');
				exit;
		}
	else{
		$message = 'Erreur.';
	}

}

if(isset($_GET['user_id']) && isset($_GET['action']) && $_GET['action'] == 'edit'){

	$query = $db->prepare('SELECT * FROM user WHERE id = ?');
    $query->execute(array($_GET['user_id']));

	$user = $query->fetch();
}

?>

<!DOCTYPE html>
<html>
	<head>

		<title>User Information - Buy DVD !</title>
		<?php require 'admin/partials/head_assets.php'; ?>
		<link rel="stylesheet" href="css/moovieseriestv.css">


	</head>

	<body>

		    <header class="ActionNav row mb-3 main-header">
		        <div class="col py-4 text-center" style="background-image: linear-gradient(#3A9EEA, #1582D6, #1443D1);">
		            <a href="user-information.php" class="text-dark"><b>User Information - <a href="index.php" class="text-dark">Buy DVD !</a></b></a>
		        </div>
		    </header>

		<div class="container-fluid">

			<div class="row my-3 index-content">

				<section class="col-9">
					<header class="pb-3">

						<h4>Modifier vos informations</h4>
					</header>

					<form action="user-form.php" method="post">
						<div class="form-group">
							<label for="image">Image Profile :</label>
							<input class="form-control" type="file" name="image" id="image" />
							<?php if(isset($user) && $user['image']): ?>
							<img class="img-fluid  col-3 mt-3" src="img/imguser/<?php echo $user['image']; ?>" alt="" />
							<input type="hidden" name="current-image" value="<?php echo $user['image']; ?>" />
							<?php endif; ?>
						</div>
						<div class="form-group">
							<label for="firstname">Prénom :</label>
							<input class="form-control" <?php if(isset($user)): ?>value="<?php echo $user['firstname']?>"<?php endif; ?> type="text" placeholder="Prénom" name="firstname" id="firstname" />
						</div>
						<div class="form-group">
							<label for="lastname">Nom de famille : </label>
							<input class="form-control" <?php if(isset($user)): ?>value="<?php echo $user['lastname']?>"<?php endif; ?> type="text" placeholder="Nom de famille" name="lastname" id="lastname" />
						</div>
						<div class="form-group">
							<label for="email">Email :</label>
							<input class="form-control" <?php if(isset($user)): ?>value="<?php echo $user['email']?>"<?php endif; ?> type="email" placeholder="Email" name="email" id="email" />
						</div>
						<div class="form-group">
							<label for="password">Password : </label>
							<input class="form-control" <?php if(isset($user)): ?>value="<?php echo $user['password']?>"<?php endif; ?> type="password" placeholder="Mot de passe" name="password" id="password" />
						</div>

						<div class="text-right">


							<input class="btn button" type="submit" name="update" value="Mettre à jour" />


						</div>


						<?php if(isset($user)): ?>
						<input type="hidden" name="id" value="<?php echo $user['id']?>" />
						<?php endif; ?>

					</form>
				</section>
			</div>

		</div>

	</body>
</html>
