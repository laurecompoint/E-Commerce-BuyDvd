<?php
	//nombre d'enregistrements de la table user
	$nbUsers = $db->query("SELECT COUNT(*) FROM user")->fetchColumn();
	//nombre d'enregistrements de la table category
	$nbCategoriesSerie = $db->query("SELECT COUNT(*) FROM categoryserie")->fetchColumn();
	//nombre d'enregistrements de la table article
	$nbDvdSeries = $db->query("SELECT COUNT(*) FROM dvd_serie")->fetchColumn();

	$nbCategoriesFilm = $db->query("SELECT COUNT(*) FROM categorymoovie")->fetchColumn();
	//nombre d'enregistrements de la table article
	$nbDvdFilm = $db->query("SELECT COUNT(*) FROM dvdmoovie")->fetchColumn();
?>

<nav class="col-3 py-2 categories-nav border-white" style="background-color:#C4BFFF;">
	<ul class="text-dark">
     <li>Gestion des utilisateurs</li>
			<ul class="text-dark">
			<li><a href="user-list.php">Les différent Utilisateurs (<?php echo $nbUsers; ?>)</a></li> <br>
			</ul>
		 <li>Gestion des DVD : Séries</li>
		 <ul class="text-dark">
			 <li><a href="categoryserie-list.php">Gestion des catégories(<?php echo $nbCategoriesSerie; ?>)</a></li>
	 		<li><a href="dvdserie-list.php">Gestion des DVD(<?php echo $nbDvdSeries; ?>)</a></li> <br>
		 </ul>
		 <li>Gestion des DVD :  Films</li>
		 <ul class="text-dark">
			<li><a href="categoryfilm-list.php">Gestion des catégories(<?php echo $nbCategoriesFilm; ?>)</a></li>
		 <li><a href="dvdfilm-list.php">Gestion des DVD(<?php echo $nbDvdFilm; ?>)</a></li>
		</ul>
	</ul>
</nav>
