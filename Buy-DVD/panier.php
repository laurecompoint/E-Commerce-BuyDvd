
<?php
// Start the session

// eventuellement vider le panier
if (isset($_GET["vider"]))
{
  session_unset();
}
?>

<!DOCTYPE html>
<html>
<body>

<h3>Mon panier</h3>

<a href="panier.php?vider=1">Vider le panier</a>

<hr>

<?php if(isset($_SESSION["list"])) : ?>


<?php $query = $db->query('SELECT * FROM dvd_serie');?>


  <?php while( $data = $query->fetch () ) : ?>

    <?php echo $data['prix'];?>



  <?php endwhile; ?>

  <?php $query->closeCursor();?>


<?php endif; ?>

<hr>

<a href="index.php">Continue shopping</a>

</body>
</html>
