 <?php
require 'flight/Flight.php';
require '../Broker.php';

Flight::register('db', 'Broker', array(''));

Flight::route('/', function(){
});

Flight::route('GET /dogadjaji', function(){
    header("Content-Type: application/json; charset=utf-8");
    /** @var Broker $db */
	$db = Flight::db();
    $rezultati = $db->getSveDogadjaje();
    echo json_encode($rezultati);
});

Flight::route('GET /narudzbine/@id', function($id){
    header("Content-Type: application/json; charset=utf-8");
    /** @var Broker $db */
    $db = Flight::db();
    $rezultati = $db->vratiNarduzbineKorisnika($id);
    echo json_encode($rezultati);
});

Flight::route('POST /registracija', function()
{
    header("Content-Type: application/json; charset=utf-8");
    /** @var Broker $db */
    $db = Flight::db();
    $imePrezime = $_POST["imePrezime"];
    $username = $_POST["username"];
    $password = $_POST["password"];

   $rez = $db->registruj($imePrezime,$username,$password);
    if($rez)
    {
        $response = "Uspesno registrovan korisnik!";
    }
    else
    {
        $response = "Doslo je do greske!";

    }

    echo json_encode($response);

});

Flight::start();
