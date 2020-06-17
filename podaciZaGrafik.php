<?php
require "sesija.php";
require "Broker.php";

$db = new Broker();

$nizPodataka = $db->vratiPodatkeZaGrafik();

echo json_encode($nizPodataka);