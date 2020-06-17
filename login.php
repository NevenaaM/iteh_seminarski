<?php
require "sesija.php";
require "Broker.php";

$db = new Broker();

$poruka = "";

if(isset($_POST['login'])){
    $username = $db->ocistiVrednost(trim($_POST["username"]));
    $password = $db->ocistiVrednost(trim($_POST["password"]));

    $uspesno = $db->login($username,$password);

    if($uspesno){
		$poruka = "USPESNO LOGOVANJE";
		header("Location: index.php");
    }else{
        $poruka = "Doslo je do greske prilikom logovanja, proverite podatke";
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
									<h2>Login stranica</h2>
								</header>
								<p>Ako nemate nalog, molim vas da se registrujete</p>
								<form method="post" action="">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" name="username">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password">
                                    <label for="login">Login</label>
                                    <input type="submit" name="login" value="Log In" id="login">

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