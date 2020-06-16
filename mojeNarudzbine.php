<?php
require "sesija.php";
require "Broker.php";

$db = new Broker();

$curl = curl_init("http://localhost/karte/api/narudzbine/".$_SESSION['user']->userID);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, false);
$curl_odgovor = curl_exec($curl);
$narudzbine = json_decode($curl_odgovor);
curl_close($curl);


;

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
									<h2>Moje narudzbine</h2>
								</header>
								<table class="table">
									<thead>
									<tr>
										<th>Naziv dogadjaja</th>
										<th>Datum</th>
                                        <th>Broj karata</th>
                                        <th>Ukupna cena</th>
                                        <th>Status narudzbine</th>
									</tr>
									</thead>
									<tbody>
                                    <?php
                                    foreach ($narudzbine as $nar) {
                                        ?>
                                        <tr>
                                            <td> <?= $nar->naziv ?></td>
                                            <td><?= $nar->datum ?></td>
                                            <td><?= $nar->kolicina ?></td>
                                            <td><?= $nar->ukupno ?></td>
                                            <td <?php if($nar->status == 'Odbijen'){
                                                ?>
                                                style="color: red"
                                                    <?php
                                            }elseif ($nar->status == 'Odobren'){
                                                ?>
                                                style="color: greenyellow"
                                                <?php
                                            } ?>
                                            ><?= $nar->status ?></td>
                                        </tr>
                                    <?php
                                    }

                                    ?>

									</tbody>
								</table>
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