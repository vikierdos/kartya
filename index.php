<?php
    include_once "Adatbazis.php";
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magyar kártya</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        $adatbazis = new Adatbazis();

        // megjelenítjük a színtábla adatait
        $eredmeny = $adatbazis->adatLeker("kep", "szin");
        while($sor = $eredmeny->fetch_row()){
            //echo $sor[1]
            echo "<img src=\"forras/$sor[0]\" alt=\"sor[0]\">";
        }
        echo "<br>";

        $adatbazis->adatLeker2("ertek", "szoveg", "forma");

        if($adatbazis->azonMind("kartya") == 0)
            $adatbazis->kartyaFeltolt("kartya");
    ?>
</body>
</html>