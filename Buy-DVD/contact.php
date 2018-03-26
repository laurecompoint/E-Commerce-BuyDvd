<?php require_once 'tools/_db.php';?>

<?php

  $message = $_POST['message'];
   $header = 'FROM site@logal.dev';
  mail('compointlaure@gmail.com', 'formulaire de contact', $message, $header);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
    <meta hhtp-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/contact.css">
    <link href="https://fonts.googleapis.com/css?family=Bodoni 72" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    <title>Contact Us</title>
</head>
<body>

<head>

<?php require('partials/nav.php'); ?>

</head>

<div class="d-flex justify-content-center mt-5">

<div id="accordion" role="tablist" class="block col-md-4">
    <div class="card">
        <div class="card-header color" role="tab" id="headingOne">
            <h5 class="text-center">
                <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Qui somme nous ?
                </a>
            </h5>
        </div>

        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
            <p class="text-center mt-4 text-secondary">

            Notre concept est simple, nous vous proposont différent type de DVD, que se soit un film ou une série !!!

            </p>
        </div>
    </div>
    <div class="card">
        <div class="card-header color" role="tab" id="headingTwo">
            <h5 class="text-center">
                <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Pour nous contacter ?
                </a>
            </h5>
        </div>
        <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="card-body user">


  <form method="POST" action="contact.php">

       <div class="col-xs-6">
             <div class="form-group">
               <label for="inputname">Nom</label> <br>
               <input type="text" class="form-controle" name="name" id="inputname"/>

             </div>
        </div>
        <div class="col-xs-6">

             <div class="form-group">
               <label for="inputemail">Email</label> <br>
               <input type="text" class="form-control" name="email" id="inputemail"/>

             </div>
        </div>
        <div class="col-xs-12">
              <div class="form-group">
              <label for="inputmessage">Message</label>
              <textarea id="inputmessage" name="message" class="form-control"></textarea>
              </div>
          <button type="submit" name="contact" class="btn btn-primary">Envoyer</button>
        </div>


</form>

            </div>
        </div>
    </div>
</div>
</div>
<footer class="mt-5">

    <?php require('partials/footer.php'); ?>

</footer>

</body>
</html>
