<?php
require "sesija.php";
require "Broker.php";

$id = (int) $_GET['id'];

$db = new Broker();

$dogadjaj = $db->vratiJedanDogadjaj($id);

$slike = $db->getSlikeZaDogadjaj($id);

?>


<!DOCTYPE HTML>
<html>
	<head>
		<title>Kupovina karata</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

			<div id="wrapper">

					<header id="header" class="alt">
						<a href="index.php" class="logo"><strong>Kupovina</strong> <span>karata</span></a>
						<nav>
							<a href="#menu">Meni</a>
						</nav>
					</header>

					<?php include "nav.php"?>


					<section id="banner" class="major">
						<div class="inner">
							<header class="major">
								<h1>Zdravo i dobro nam dosli</h1>
							</header>
							<div class="content">
								<p>Na nasem sajtu mozete uzimati karte za razlicite dogadjaje</p>
							</div>
						</div>
					</section>

					<div id="main">
						<section id="two">
							<div class="inner">
								<header class="major">
									<h2><?php echo $dogadjaj->naziv?></h2>
								</header>
                                <h3><?php echo $dogadjaj->datum?></h3>
                                <h3>Ostalo karata: <?php echo $dogadjaj->brojKarata?></h3>
                                <h3>Cena po karti: <?php echo $dogadjaj->cenaPoKarti?></h3>
								<p><?php echo $dogadjaj->opis?></p>
                                <?php
                                    if($_SESSION['user'] != null){
                                        ?>
                                        <a href="naruciKarte.php?id=<?php echo $dogadjaj->dogadjajID?>"><i class="fa fa-plus-circle"></i> Naruci</a>
                                <?php
                                    }
                                ?>
                                <hr>
                                <?php
                                foreach ($slike as $slika){
                                    ?>
                                <img alt="Nema slike" src="assets/<?= $slika->slika ?>" style="padding: 10px;">
                                <hr>
                                <?php
                                }

                                ?>
							</div>
						</section>

					</div>

                <?php include "footer.php"; ?>

			</div>

			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>