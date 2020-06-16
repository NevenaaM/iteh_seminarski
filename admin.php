<?php
require "sesija.php";
require "Broker.php";

$db = new Broker();

$poruka = "";
$narudzbine = $db->vratiNarduzbine();

$curl = curl_init("http://localhost/karte/api/dogadjaji");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, false);
$curl_odgovor = curl_exec($curl);
$dogadjaji = json_decode($curl_odgovor);
curl_close($curl);

if(isset($_POST['unos'])){
    $naziv = $db->ocistiVrednost(trim($_POST["naziv"]));
    $datum = $db->ocistiVrednost(trim($_POST["datum"]));
    $opis = $db->ocistiVrednost(trim($_POST["opis"]));
    $kolicina = $db->ocistiVrednost(trim($_POST["kolicina"]));
    $cena = $db->ocistiVrednost(trim($_POST["cena"]));

    $uspesno = $db->unesiDogadjaj($naziv,$datum,$opis,$kolicina,$cena);

    if($uspesno){
        $poruka = "USPESNO UNET NOVI DOGADJAJ";
    }else{
        $poruka = "Doslo je do greske prilikom unosa, pokusajte kasnije";
    }
}

if(isset($_POST['unosSlike'])){

    $target_dir = "assets/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    $dogadjaj = $db->ocistiVrednost(trim($_POST["dogadjaj"]));

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $uspesno = $db->unesiSliku($dogadjaj,basename($_FILES["fileToUpload"]["name"]));

        if($uspesno){
            header("Location: vidiDogadjaj.php?id=".$dogadjaj);
        }else{
            $poruka = "Doslo je do greske prilikom unosa slike";
        }
    } else {
        $poruka = "Doslo je do greske prilikom uplouda slike";
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
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
									<h2>Unos novog dogadjaja</h2>
								</header>
								<form method="post" action="">
                                    <label for="naziv">Naziv</label>
                                    <input type="text" id="naziv" name="naziv">
                                    <label for="datum">Datum (yyyy-mm-dd)</label>
                                    <input type="text" id="datum" name="datum">
                                    <label for="opis">Opis</label>
                                    <textarea rows="5" id="opis" name="opis"></textarea>
                                    <label for="kolicina">Broj karata</label>
                                    <input type="number" id="kolicina" name="kolicina" style="color: #000";>
                                    <label for="cena">Cena</label>
                                    <input type="number" id="cena" name="cena" style="color: #000";>
                                    <label for="unos">Unesi</label>
                                    <input type="submit" name="unos" value="Unesi dogadjaj" id="unos">

                                </form>
                                <p><?php echo $poruka ?></p>
							</div>
						</section>
                        <section id="two">
                            <div class="inner">
                                <header class="major">
                                    <h2>Unos slika za dogadjaj</h2>
                                </header>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <label for="dogadjaj">Dogadjaj</label>
                                    <select name="dogadjaj" >
                                        <?php
                                        foreach ($dogadjaji as $dogadjaj){
                                            ?>
                                        <option value="<?= $dogadjaj->dogadjajID ?>"><?= $dogadjaj->naziv ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <label for="slika">Slika</label>
                                    <input type="file" name="fileToUpload" id="fileToUpload">
                                    <label for="unosSlike">Unesi sliku</label>
                                    <input type="submit" name="unosSlike" value="Unesi sliku" id="unosSlike">

                                </form>
                                <p><?php echo $poruka ?></p>
                            </div>
                        </section>

                        <section id="two">
                            <div class="inner">
                                <header class="major">
                                    <h2>Narudzbine</h2>
                                </header>
                                <p>Ovde mozete videti trenutno aktivne dogadjaje u nasoj ponudi</p>
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Naziv dogadjaja</th>
                                        <th>Datum</th>
                                        <th>Broj karata</th>
                                        <th>Ukupna cena</th>
                                        <th>Status narudzbine</th>
                                        <th>Promeni status</th>
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
                                            <td> <?php if($nar->status == 'U obradi'){
                                                ?>
                                                <a href="odbij.php?id=<?= $nar->id ?>">Odbij narudzibnu</a>
                                                <a href="prihvati.php?id=<?= $nar->id ?>">Prihvati narudzibnu</a>
                                                <?php
                                            } ?>
                                            </td>
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
            <script src="assets/js/datepicker.js"></script>
            <script>
                $( function() {
                    $( "#datum" ).datepicker({ dateFormat: 'yy-mm-dd' });
                } );

	</body>
</html>