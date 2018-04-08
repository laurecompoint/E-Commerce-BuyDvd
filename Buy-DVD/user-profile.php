<?php

require_once 'tools/_db.php';

if(!isset($_SESSION['user'])){
	header('location:../index.php');
	exit;
}


$query = $db->prepare('SELECT * FROM user WHERE id = ?');
$query->execute(array($_SESSION['user_id']));
$user = $query->fetch();


if(isset($_POST['update'])){


	$query = $db->prepare('SELECT email FROM user WHERE email = ?');
	$query->execute(array($_POST['email']));

	$emailAlreadyExists = $query->fetch();

	if($emailAlreadyExists && $emailAlreadyExists['email'] != $user['email']){
		$updateMessage = "Adresse email déjà utilisée";
	}
	elseif(empty($_POST['firstname']) OR empty($_POST['email'])){

        $updateMessage = "Merci de remplir tous les champs obligatoires (*)";
    }

	elseif( !empty($_POST['password']) AND ($_POST['password'] != $_POST['password_confirm'])) {

		$updateMessage = "Les mots de passe ne sont pas identiques";
	}
    else {


		$queryString = 'UPDATE user SET firstname = :firstname, lastname = :lastname, email = :email,';

		$queryParameters = [ 'firstname' => $_POST['firstname'], 'lastname' => $_POST['lastname'], 'email' => $_POST['email'], 'id' => $_SESSION['user_id'] ];


		if( !empty($_POST['password'])) {

			$queryString .= ', password = :password ';

			$queryParameters['password'] = hash('md5', $_POST['password']);
		}


		$queryString .= 'WHERE id = :id';


		$query = $db->prepare($queryString);
		$result = $query->execute($queryParameters);

		if($result){

			$_SESSION['user'] = $_POST['firstname'];
			$updateMessage = "Informations mises à jour avec succès !";


			$query = $db->prepare('SELECT * FROM user WHERE id = ?');
			$query->execute(array($_SESSION['user_id']));
			$user = $query->fetch();
		}
		else{
			$updateMessage = "Erreur";
		}
    }
}

?>

<!DOCTYPE html>
<html>
 <head>

	<title>Login - Buy DVD !</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta hhtp-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Bodoni 72" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>


   <?php require 'partials/nav.php'; ?>

 </head>
 <body class="article-body">
	<div class="container-fluid">

		<div class="row my-3 article-content">

			<main class="col-9">

				<form action="user-profile.php" method="post" class="p-4 row flex-column">

					<h4 class="pb-4 col-sm-8 offset-sm-2">Mise à jour des informations utilisateur</h4>

					<?php if(isset($updateMessage)): ?>
					<div class="text-danger col-sm-8 offset-sm-2 mb-4"><?php echo $updateMessage; ?></div>
					<?php endif; ?>

					<div class="form-group col-sm-8 offset-sm-2">
						<label for="firstname">Prénom <b class="text-danger">*</b></label>
						<input class="form-control" value="<?php echo $user['firstname']?>" type="text" placeholder="Prénom" name="firstname" id="firstname" />
					</div>
					<div class="form-group col-sm-8 offset-sm-2">
						<label for="lastname">Nom de famille</label>
						<input class="form-control" value="<?php echo $user['lastname']?>" type="text" placeholder="Nom de famille" name="lastname" id="lastname" />
					</div>
					<div class="form-group col-sm-8 offset-sm-2">
						<label for="email">Email <b class="text-danger">*</b></label>
						<input class="form-control" value="<?php echo $user['email']?>" type="email" placeholder="Email" name="email" id="email" />
					</div>
					<div class="form-group col-sm-8 offset-sm-2">
						<label for="password">Mot de passe (uniquement si vous souhaitez modifier votre mot de passe actuel)</label>
						<input class="form-control" value="" type="password" placeholder="Mot de passe" name="password" id="password" />
					</div>
					<div class="form-group col-sm-8 offset-sm-2">
						<label for="password_confirm">Confirmation du mot de passe (uniquement si vous souhaitez modifier votre mot de passe actuel)</label>
						<input class="form-control" value="" type="password" placeholder="Confirmation du mot de passe" name="password_confirm" id="password_confirm" />
					</div>

					<div class="text-right col-sm-8 offset-sm-2">
						<p class="text-danger">* champs requis</p>
						<input class="btn btn-success" type="submit" name="update" value="Valider" />
					</div>

				</form>
			</main>
		</div>
		<footer class="mt-5">

		    <?php require('partials/footer.php'); ?>

		</footer>
	</div>
 </body>
</html>
