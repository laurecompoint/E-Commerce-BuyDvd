<?php
try
{
$db = new PDO('mysql:host=localhost;dbname=BuyDVD;charset=utf8', 'root', 'root', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $exception)
{
die( 'Erreur : ' . $exception->getMessage() );

}

session_start();


?>
