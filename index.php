<?php
require "sesija.php";
require "Broker.php";

$db = new Broker();

$sort = null;
$tip = null;

if(isset($_GET['tip']) && isset($_GET['sort'])){
    $tip = $_GET['tip'];
    $sort = $_GET['sort'];
}

$dogadjaji = $db->getAktivniDogadjaji($tip,$sort);

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
									<h2>Trenutno u prodaji</h2>
                                    <h3>Sortiraj:</h3>
                                    <a class="button" href="index.php?tip=datum&sort=asc">Datumu rastuce</a>
                                    <a class="button" href="index.php?tip=datum&sort=desc">Datumu opadajuce</a>
                                    <a class="button" href="index.php?tip=brojKarata&sort=asc">Broju karata rastuce</a>
                                    <a class="button" href="index.php?tip=brojKarata&sort=desc">Broju karata opadajuce</a>

                                </header>
								<p>Ovde mozete videti trenutno aktivne dogadjaje u nasoj ponudi</p>
								<table class="table">
									<thead>
									<tr>
										<th>Naziv</th>
										<th>Datum</th>
                                        <th>Cena po karti</th>
                                        <th>Preostalo karata</th>
									</tr>
									</thead>
									<tbody>
                                    <?php
                                    foreach ($dogadjaji as $dogadjaj) {
                                        ?>
                                        <tr>
                                            <td><a href="vidiDogadjaj.php?id=<?= $dogadjaj->dogadjajID ?>"> <?= $dogadjaj->naziv ?></a></td>
                                            <td><?= $dogadjaj->datum ?></td>
                                            <td><?= $dogadjaj->cenaPoKarti ?></td>
                                            <td <?php if((int)$dogadjaj->brojKarata < 10){
                                                ?>
                                                style="color: red"
                                                    <?php
                                            } ?>
                                            ><?= $dogadjaj->brojKarata ?></td>
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
    <script>
        function uzmiCitat() {
            $.ajax({
                url: 'http://api.quotable.io/random',
                success: function (data) {
                    $("#citat").html(data.content + ' - '+data.author);
                }
            })
        }
        uzmiCitat();
    </script>

	</body>
</html>