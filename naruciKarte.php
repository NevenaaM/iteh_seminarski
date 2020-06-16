<?php
require "sesija.php";
require "Broker.php";

$id = (int) $_GET['id'];

$db = new Broker();

$dogadjaj = $db->vratiJedanDogadjaj($id);

$poruka = "";

if(isset($_POST['naruci'])){
    $kolicina = $db->ocistiVrednost(trim($_POST["kolicina"]));

    $dogadjaj = $db->vratiJedanDogadjaj($id);

    if((int)$dogadjaj->brojKarata < (int)$kolicina){
        $poruka = "Broj preostalih karata za dogadjaj je: ".$dogadjaj->brojKarata . ". Molimo vas da promenite kolicinu koju narucujete.";
    }else{
        $ukupno = (int) $kolicina * (double)$dogadjaj->cenaPoKarti;
        $uspesno = $db->naruci($dogadjaj->dogadjajID,$_SESSION['user']->userID,$kolicina,$ukupno);
        $noviBrojKarata = (int) $dogadjaj->brojKarata - (int) $kolicina;
        if($uspesno){
            $poruka = "USPESNO NARUCENO";
            $db->promeniBrojKarata($noviBrojKarata,$dogadjaj->dogadjajID);
        }else{
            $poruka = "Doslo je do greske prilikom narucivanja, pokusajte kasnije";
        }
    }
}

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
									<h2>Stranica za narucivanje - <?= $dogadjaj->naziv ?></h2>
								</header>
								<p>Ako nemate nalog, molim vas da se registrujete</p>
								<form method="post" action="">
                                    <label for="kolicina">Broj karata</label>
                                    <input type="number" id="kolicina" name="kolicina" style="color: #000";>

                                    <label for="naruci">Naruci</label>
                                    <input type="submit" name="naruci" value="Naruci" id="naruci">

                                </form>
                                <p><?php echo $poruka ?></p>
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