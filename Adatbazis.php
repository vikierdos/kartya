<?php 
class Adatbazis{
    private $host = "localhost";
    private $felhasznaloNev = "root";
    private $jelszo = "";
    private $adatbazisNev = "magyarkartya";
    private $kapcsolat;

    //konstruktor
    public function __construct(){
        //kapcsolat beállítása
        $this->kapcsolat = new mysqli(
            $this->host,
            $this->felhasznaloNev,
            $this->jelszo,
            $this->adatbazisNev,
        );
        $szoveg = "";
        if ($this->kapcsolat->connect_error) {
            $szoveg = "Sikertelen kapcsolódás";
        }
        else{
            $szoveg = "Sikeres kapcsolódás";
        }
        //ékezetes betűk miatt
        $this->kapcsolat->query('SET NAMES UTF8');
        $this->kapcsolat->query('set character set utf8');
        //echo $szoveg;
    }

    //egyéb metódusok
    public function adatLeker($oszlop, $tabla){
        $sql = "SELECT $oszlop FROM $tabla";
        $adatok = $this->kapcsolat->query($sql);
        /*if ($adatok) {
            echo "Sikeres Lekérdezés";
        }
        else{
            echo "Sikertelen Lekérdezés";
        }*/
        return $adatok;
    }

    public function adatLeker2($melyik01, $melyik02, $tabla){
        $sql = "SELECT $melyik01, $melyik02 FROM $tabla";
        $eredmeny = $this->kapcsolat->query($sql);
        while ($row = $eredmeny->fetch_assoc()) {
            echo "$melyik01: $row[$melyik01] - $melyik02: $row[$melyik02]<br>";
        }
    }

    public function azonMind($tabla){
        $result = $this->kapcsolat->query("SELECT * FROM $tabla");
        return $result->num_rows;
    }

    public function kartyaFeltolt($tabla){
        $countSzin = $this->azonMind('szin') + 1;
        $countForma = $this->azonMind('forma') + 1;
        for($indexSzin = 1; $indexSzin < $countSzin; $indexSzin++){
            for($indexForma = 1; $indexForma < $countForma; $indexForma++){
                $sql = "INSERT INTO $tabla (szinAzon, formaAzon) VALUES ($indexSzin, $indexForma);";
                $this->kapcsolat->query($sql);
            }
        }
    }
}
?>