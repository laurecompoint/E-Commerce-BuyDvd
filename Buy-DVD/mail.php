<?php
$errors = [];

if(!array_key_exists('name', $_POST) OR $_POST['name'] == ''){
  $errors['name'] = 'vous n\'avez pas renseigner votre nom';
}
if(!array_key_exists('email', $_POST) OR $_POST['email'] == ''){
  $errors['email'] = 'vous n\'avez pas renseigner votre email';
}
if(!array_key_exists('message', $_POST) OR $_POST['message'] == ''){
  $errors['message'] = 'vous n\'avez pas renseigner votre message';
}

if(!empty($errors)){
  header('location: contact.php');
}
else {
  $message = $_POST['message'];
   $header = 'FROM site@logal.dev';
  mail('compointlaure@gmail.com', 'formulaire de contact', $message, $header);

}


?>
<!DOCTYPE html>
<html>
	<head>

		<title>Administration - Buy DVD !</title>

		<?php require 'partials/head_assets.php'; ?>

	</head>
	<body class="index-body" style="background-image: url(img/cine2.jpg); background-attachment: fixed;background-repeat: no-repeat;background-position: center center;">
		<div class="container-fluid">

			<div class="row my-3 index-content" >


				<main class="col-12 d-flex justify-content-center">

          Votre mail à bien été envoyé !!

				</main>
			</div>

		</div>
	</body>
</html>
