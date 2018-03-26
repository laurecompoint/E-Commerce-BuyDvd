<?php

require_once 'tools/_db.php';


if(isset($_POST['login'])){

	if(empty($_POST['email']) OR empty($_POST['password'])){
		$loginmessage = "Merci de remplir tous les champs";
	}
	else{

		$query = $db->prepare('SELECT *
							FROM user
							WHERE email = ? AND password = ?');
		$query->execute( array( $_POST['email'], hash('md5', $_POST['password']), ) );
		$user = $query->fetch();


		if($user){

			$_SESSION['is_admin'] = $user['is_admin'];
			$_SESSION['user'] = $user['firstname'];

			$_SESSION['user_id'] = $user['id'];
		}
		else{
			$loginmessage = "Mauvais identifiants";
		}
	}
}


if(isset($_POST['register'])){


	$query = $db->prepare('SELECT email FROM user WHERE email = ?');
	$query->execute(array($_POST['email']));


	$userAlreadyExists = $query->fetch();


	if($userAlreadyExists){
		$registermessage = "Adresse email déjà enregistrée";
	}
	elseif(empty($_POST['firstname']) OR empty($_POST['password']) OR empty($_POST['email'])){

        $registermessage = "Merci de remplir tous les champs obligatoires (*)";
    }
    elseif($_POST['password'] != $_POST['password_confirm']) {

		$registermessage = "Les mots de passe ne sont pas identiques";
    }
    else {


        $query = $db->prepare('INSERT INTO user (firstname,lastname,email,password) VALUES (?, ?, ?, ?)');
        $newUser = $query->execute(
            [
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
              hash('md5', $_POST['password']),
            ]
        );


		$_SESSION['is_admin'] = 0; //PAS ADMIN !
		$_SESSION['user'] = $_POST['firstname'];
    }
}

if(isset($_SESSION['user'])){
	header('location:index.php');
	exit;
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
    <meta hhtp-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/user.css">
    <link href="https://fonts.googleapis.com/css?family=Bodoni 72" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    <title>Connection/Inscription</title>
</head>
<body>

<head>

    <?php require('partials/nav.php'); ?>

</head>

<div class="d-flex justify-content-center mt-5">

<div id="accordion" role="tablist" class="block col-md-3">
    <div class="card">
        <div class="card-header" role="tab" id="headingOne">
            <h5 class="text-center">
                <a data-toggle="collapse" href="#collapseOne" class="test" aria-expanded="true" aria-controls="collapseOne">
                    Connection
                </a>
            </h5>
        </div>

        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
            <div class="card-body user">

                <form action="user.php" method="post">

                    <?php if(isset($loginmessage)): ?>
                        <div class="text-danger col-sm-8 offset-sm-2 mb-4"><?php echo $loginmessage; ?></div>
                    <?php endif; ?>

                    <label class="text-info">Email <br> <input type="email" name="email" value="" placeholder="Email" /> </label>
                    <label class="text-info">Mot de Passe <br><input type="password" name="password" value="" placeholder="Password" />  </label>

                    <br>

                    <input type="submit" name="login" class="button" value="OK" />
                </form>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header" role="tab" id="headingTwo">
            <h5 class="text-center">
                <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Inscription
                </a>
            </h5>
        </div>
        <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="card-body user">

                <form action="user.php" method="POST">

                    <?php if(isset($registermessage)): ?>
                        <div class="text-danger col-sm-8 offset-sm-2 mb-4"><?php echo $registermessage; ?></div>
                    <?php endif; ?>

                    <label class="text-info">Prénom <br> <input type="text" name="firstname" value="" placeholder="First name" /></label>
                    <label class="text-info">Nom <br> <input type="text" name="lastname" value="" placeholder="Last name" /> <br> </label>
                    <label class="text-info">Email <br> <input type="email" name="email" value="" placeholder="Email" /> <br> </label>

                    <label class="text-info">Mot de Passe <br> <input type="password" name="password" value="" placeholder="Password" /> <br> </label>
                    <label class="text-info">Confirmation mot de passe<input class="form-control" value="" type="password" placeholder="Confirmation du mot de passe" name="password_confirm" id="password_confirm" /></label>
                    <br>

                    <input type="submit" name="register" class="button" value="OK" />
                </form>

            </div>
        </div>
    </div>
</div>
</div>


<footer>

    <?php require('partials/footer.php'); ?>

</footer>
</body>
</html>
