<?php
require "sesija.php";
require "Broker.php";

$db = new Broker();

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
									<h2>Stranica za registraciju</h2>
								</header>
								<p>Ovde se mozete registrovati</p>
                                <label for="imePrezime">Ime i Prezime</label>
                                <input type="text" id="imePrezime" name="imePrezime">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username">
                                <label for="password">Password</label>
                                <input type="password" id="password" name="password">
                                <label for="login">Registruk</label>
                                <button type="button" name="registruj" onclick="registruj()" value="Registruj se">Registruj se</button>

                                <p id="poruka"></p>
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
        function registruj() {
            let imePrezime = $("#imePrezime").val();
            let username = $("#username").val();
            let password = $("#password").val();

            $.ajax({
                url: "api/registracija",
                type: "POST",
                data: {
                    imePrezime : imePrezime,
                    username : username,
                    password : password
                },
                success: function (data) {
                    $("#poruka").html(data);
                }
            })
        }
    </script>

	</body>
</html>