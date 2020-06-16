<?php
require "sesija.php";
require "Broker.php";

$id = (int) $_GET['id'];

$db = new Broker();

$db->promeniStatusNarudzbine("Odobren",$id);

header("Location: admin.php");