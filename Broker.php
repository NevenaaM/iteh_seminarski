<?php
class Broker
{
    private $konekcija;

    public function __construct()
    {
        $this->konekcija = new mysqli("localhost","root","","karte");
        $this->konekcija->set_charset("utf8");
    }

    public function getAktivniDogadjaji()
    {
        $rezultat = $this->konekcija->query("SELECT * FROM dogadjaj where brojKarata > 0");

        $dogadjaji = [];

        while ($jedanDogadjaj = $rezultat->fetch_object()){
            $dogadjaji[] = $jedanDogadjaj;
        }

        return $dogadjaji;
    }

    public function getSveDogadjaje()
    {
        $rezultat = $this->konekcija->query("SELECT * FROM dogadjaj");

        $dogadjaji = [];

        while ($jedanDogadjaj = $rezultat->fetch_object()){
            $dogadjaji[] = $jedanDogadjaj;
        }

        return $dogadjaji;
    }

    public function vratiJedanDogadjaj($id)
    {
        $rezultat = $this->konekcija->query("SELECT * FROM dogadjaj where dogadjajID = ".$id);

        while ($jedanDogadjaj = $rezultat->fetch_object()){
            return $jedanDogadjaj;
        }

        return null;
    }

    public function getSlikeZaDogadjaj($dogadjajID)
    {
        $rezultat = $this->konekcija->query("SELECT * FROM dogadjaj d join slike s on d.dogadjajID = s.dogadjajID where d.dogadjajID = ".$dogadjajID);

        $dogadjaji = [];

        while ($jedanDogadjaj = $rezultat->fetch_object()){
            $dogadjaji[] = $jedanDogadjaj;
        }

        return $dogadjaji;
    }

    public function vratiNarduzbineKorisnika($id)
    {
        $rezultat = $this->konekcija->query("SELECT * FROM narudzbina n join dogadjaj d on n.dogadjajID = d.dogadjajID join user u on n.userID = u.userID where u.userID = ".$id);

        $narudzbine = [];

        while ($red = $rezultat->fetch_object()){
            $narudzbine[] = $red;
        }

        return $narudzbine;
    }
    public function vratiNarduzbine()
    {
        $rezultat = $this->konekcija->query("SELECT * FROM narudzbina n join dogadjaj d on n.dogadjajID = d.dogadjajID join user u on n.userID = u.userID ");

        $narudzbine = [];

        while ($red = $rezultat->fetch_object()){
            $narudzbine[] = $red;
        }

        return $narudzbine;
    }

    public function ocistiVrednost($vrednost)
    {
        return $this->konekcija->real_escape_string($vrednost);
    }

    public function login($username, $password)
    {
        $rezultat = $this->konekcija->query("SELECT * FROM user where username = '".$username."' AND password = '".$password."'");

        while ($rez = $rezultat->fetch_object()){
            $_SESSION['user'] = $rez;
            return $rez;
        }

        return null;
    }

    public function registruj($imePrezime, $username, $password)
    {
        return $this->konekcija->query("INSERT INTO user(imePrezime,username,password) VALUES ('".$imePrezime."','".$username."','".$password."')");
    }

    public function naruci($dogadjajID, $userID, $kolicina, $ukupno)
    {
        return $this->konekcija->query("INSERT INTO narudzbina(dogadjajID,userID,kolicina,ukupno,status) VALUES (".$dogadjajID.",".$userID.",".$kolicina.",".$ukupno.",'U obradi')");
    }

    public function promeniBrojKarata($noviBrojKarata, $dogadjajID)
    {
        return $this->konekcija->query("UPDATE dogadjaj SET brojKarata = ".$noviBrojKarata." WHERE dogadjajID =".$dogadjajID);
    }

    public function unesiDogadjaj($naziv, $datum, $opis, $kolicina, $cena)
    {
        return $this->konekcija->query("INSERT INTO dogadjaj VALUES (null,'".$naziv."','".$opis."','".$datum."',".$kolicina.",".$cena.")");
    }

    public function unesiSliku($dogadjaj, $slika)
    {
        return $this->konekcija->query("INSERT INTO slike VALUES (null,'".$dogadjaj."','".$slika."')");
    }

    public function promeniStatusNarudzbine( $status,  $id)
    {
        return $this->konekcija->query("UPDATE narudzbina SET status = '".$status."' WHERE id =".$id);
    }

    public function vratiNarudzbinu($id)
    {
        $rezultat = $this->konekcija->query("SELECT * FROM narudzbina n join dogadjaj d on n.dogadjajID = d.dogadjajID join user u on n.userID = u.userID where n.id = ".$id);

        while ($red = $rezultat->fetch_object()){
            return $red;
        }

        return null;
    }

    public function vratiPodatkeZaGrafik(){
        $rezultat = $this->konekcija->query("SELECT d.naziv, count(n.id) as brojKarataProdatih FROM narudzbina n join dogadjaj d on n.dogadjajID = d.dogadjajID join user u on n.userID = u.userID WHERE n.status = 'Odobren' group by  d.dogadjajID");

        $narudzbine = [];

        while ($red = $rezultat->fetch_object()){
            $narudzbine[] = $red;
        }

        return $narudzbine;
    }
}