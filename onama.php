<?php
require "sesija.php";
require "Broker.php";

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
									<h2>Nevena Milovanovic</h2>
								</header>
								<p>PR i lider nase male organizacije, uvek nasmejana i spremna da pomogne, u prici sa njom mozete videti nestvarnu energiju kojom zraci. Voli duge setnje. Njen deo posla je da redovno prati aktuelne dogadjaje i da u saradnji sa organizatorima dogovara odredjeni broj karata koji ce se prodavati preko nase nove aplikacije. </p>
								<img src="assets/nevenam.jpg" class="image">
							</div>
						</section>
                        <section id="two">
                            <div class="inner">
                                <header class="major">
                                    <h2>Nenad Stojkovic</h2>
                                </header>
                                <p>Nenad je student cetvrte godine Fakulteta organizacionih nauka, i na njegovu inicijativu je pokrenuta ova nasa mala aplikacija. Glavni je programer naseg tima. Svaku Neveninu ideju za izmenu igleda aplikacije lako sprovodi u delo, i tu je za sve neophodne tehnicke problema i dorade.  </p>
                                <img src="assets/necaan.jpg" class="image">
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