<?php require_once 'tools/_db.php';?>


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


  <form method="POST" action="mail.php">

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
