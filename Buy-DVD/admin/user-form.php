<?php
require_once '../tools/_db.php';

if(!isset($_SESSION['is_admin']) OR $_SESSION['is_admin'] == 0){
	header('location:../index.php');
	exit;
}


if(isset($_POST['save'])){
    $query = $db->prepare('INSERT INTO user (firstname, lastname, password, email, is_admin) VALUES (?, ?, ?, ?, ?)');
    $newUser = $query->execute(
		[
			$_POST['firstname'],
			$_POST['lastname'],
			  hash('md5', $_POST['password']),
			$_POST['email'],
			$_POST['is_admin'],
		]
    );

		if($newUser){

	   if(isset($_FILES['image'])){

			 $allowed_extensions = array( 'jpg' , 'jpeg' , 'gif' , 'png' );

			 $my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);


			 if ( in_array($my_file_extension , $allowed_extensions) ){

				 $new_file_name = md5(rand());

				 $destination = '../img/imguser/' . $new_file_name . '.' . $my_file_extension;

				 $result = move_uploaded_file( $_FILES['image']['tmp_name'], $destination);

				 $lastInsertImageId = (int) $db->lastInsertId();


					 $query = $db->prepare('UPDATE user SET
						 image = :image
						 WHERE id = :id'
					 );

					 $resultUpdateImage = $query->execute(
			       [
			         'image' =>$new_file_name . '.' . $my_file_extension,
			         'id' => $lastInsertImageId
			   		]
			     );

			 }
		 }

			header('location:user-list.php');
			exit;
	    }
	else{
		$message = "Impossible d'enregistrer le nouvel utilisateur...";
	}
}

if(isset($_POST['update'])){

	$query = $db->prepare('UPDATE user SET
		firstname = :firstname,
		lastname = :lastname,
		password = :password,
		email = :email,
		is_admin = :is_admin
		WHERE id = :id'
	);


	$resultUser = $query->execute(
		[
			'firstname' => $_POST['firstname'],
			'lastname' => $_POST['lastname'],
			'password' => $_POST['password'],
			'email' => $_POST['email'],
			'is_admin' => $_POST['is_admin'],
			'id' => $_POST['id'],
		]
	);

	if($resultUser){
				if(isset($_FILES['image'])){

						$allowed_extensions = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
						$my_file_extension = pathinfo( $_FILES['image']['name'] , PATHINFO_EXTENSION);

						if ( in_array($my_file_extension , $allowed_extensions) ){

         if(isset($_POST['current-image'])){
					unlink('../img/imguser/' . $_POST['current-image']);
				}

								$new_file_name = md5(rand());
								$destination = '../img/imguser/' . $new_file_name . '.' . $my_file_extension;
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

		header('location:user-list.php');
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

		<title>Administration des utilisateurs - Buy DVD !</title>

		<?php require 'partials/head_assets.php'; ?>

	</head>
	<body class="index-body">
		<div class="container-fluid">

			<?php require 'partials/header.php'; ?>

			<div class="row my-3 index-content">

				<?php require 'partials/nav.php'; ?>

				<section class="col-9">
					<header class="pb-3">

						<h4><?php if(isset($user)): ?>Modifier<?php else: ?>Ajouter<?php endif; ?> un utilisateur</h4>
					</header>

					<?php if(isset($message)): ?>
					<div class="bg-danger text-white">
						<?php echo $message; ?>
					</div>
					<?php endif; ?>


					<form action="user-form.php" method="post">

						<div class="form-group">
							<label for="firstname">Prénom :</label>
							<input class="form-control" <?php if(isset($user)): ?>value="<?php echo $user['firstname']?>"<?php endif; ?> type="text" placeholder="Prénom" name="firstname" id="firstname" />
						</div>
						<div class="form-group">
							<label for="lastname">Nom de famille : </label>
							<input class="form-control" <?php if(isset($user)): ?>value="<?php echo $user['lastname']?>"<?php endif; ?> type="text" placeholder="Nom de famille" name="lastname" id="lastname" />
						</div>

						<div class="form-group">
							<label for="image">Image :</label>
							<input class="form-control" type="file" name="image" id="image" />
							<?php if(isset($user) && $user['image']): ?>
							<img class="col-5 img-fluid py-4" src="../img/imguser/<?php echo $user['image']; ?>" alt="" />
							<input type="hidden" name="current-image" value="<?php echo $user['image']; ?>" />
							<?php endif; ?>
						</div>

						<div class="form-group">
							<label for="email">Email :</label>
							<input class="form-control" <?php if(isset($user)): ?>value="<?php echo $user['email']?>"<?php endif; ?> type="email" placeholder="Email" name="email" id="email" />
						</div>
						<div class="form-group">
							<label for="password">Password : </label>
							<input class="form-control" <?php if(isset($user)): ?>value="<?php echo $user['password']?>"<?php endif; ?> type="password" placeholder="Mot de passe" name="password" id="password" />
						</div>
						<div class="form-group">
							<label for="is_admin"> Admin ?</label>
							<select class="form-control" name="is_admin" id="is_admin">
								<option value="0" <?php if(isset($user) && $user['is_admin'] == 0): ?>selected<?php endif; ?>>Non</option>
								<option value="1" <?php if(isset($user) && $user['is_admin'] == 1): ?>selected<?php endif; ?>>Oui</option>
							</select>
						</div>

						<div class="text-right">

							<?php if(isset($user)): ?>
							<input class="btn button" type="submit" name="update" value="Mettre à jour" />

							<?php else: ?>
							<input class="btn button" type="submit" name="save" value="Enregistrer" />
							<?php endif; ?>
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
