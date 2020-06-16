<?php
require "sesija.php";
require "Broker.php";

$id = (int) $_GET['id'];

$db = new Broker();

$db->promeniStatusNarudzbine("Odbijen",$id);
$narudzbina = $db->vratiNarudzbinu($id);

$kolicinaZaDodavanje = $narudzbina->kolicina;

$dogadjaj = $db->vratiJedanDogadjaj($narudzbina->dogadjajID);

$novaKolicinaKarata = (int)$dogadjaj->brojKarata + (int)$kolicinaZaDodavanje;

$db->promeniBrojKarata($novaKolicinaKarata,$dogadjaj->dogadjajID);

header("Location: admin.php");