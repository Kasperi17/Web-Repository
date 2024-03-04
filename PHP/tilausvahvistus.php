<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mustat Renkaat</title>
    
    <style>
        /* Perustyyli sivulle */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0; 
            position: relative;
            min-height: 100vh;
        }

        /* Ylätunniste yrityksen tiedoille */
        header {
            background-color: #19a5ec;
            color: #fff;
            text-align: center;
        }

        /* Logon koko ja muut tyylit */
        #logo {
            width: 250px;
            height: auto;
            margin: left;
            display: block;
        }

        /* Pääsisältö renkaiden haulle */
        main {
            padding: 10px;
            flex: 1;
            margin: 0px;
        }
    </style>
<header>
    <img id="logo" src="logo_dark.svg" alt="Mustat Renkaat Logo">
</header>


<?php
    // Tarkista, onko tilausvahvistuksen tietoja saatavilla
    if (isset($_POST['submit'])) {
        // Tässä voit hakea tallennetut tiedot tietokannasta tai käyttää niitä suoraan
        $nimi = $_POST['nimi'];
        $postiosoite = $_POST['postiosoite'];
        $sahkopostiosoite = $_POST['sahkopostiosoite'];
        $puhelinnumero = $_POST['puhelinnumero'];
        $rengasID = $_POST['rengasID'];
        $maara = $_POST['maara'];
        $toimitustapa = $_POST['toimitustapa'];

        // Hae renkaan tiedot tietokannasta (oletetaan tässä vain yksi tuote tilauksessa)
        $host = "127.0.0.1";
        $username = "root";
        $password = "";
        $database_in_use = "renkaat";

        try {
            $connection = new PDO("mysql:host=$host;dbname=$database_in_use", $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM Renkaat WHERE RengasID = $rengasID";
            $result = $connection->query($query);
            $row = $result->fetch(PDO::FETCH_ASSOC);

            // Näytä tilausvahvistuksen tiedot
            echo "<h1>Tilausvahvistus</h1>";

            // Tuotetiedot
            echo "<div id='order-summary'>";
            echo "<h2>Tuotteen tiedot:</h2>";
            echo "<p><strong>Tuotteen nimi:</strong> " . $row["Merkki"] . " " . $row["Malli"] . " " . $row["Tyyppi"] . " " . $row["Koko"] . "</p>";
            echo "<p><strong>Tuotteen hinta:</strong> " . $row["Hinta"] . " €</p>";
            echo "<p><strong>Tuotteen kuva:</strong><br>";
            if (!empty($row["Kuva"])) {
                echo '<img src="' . $row["Kuva"] . '" alt="Tilattu rengas">';
            } else {
                echo "Kuvaa ei saatavilla";
            }
            echo "</p>";
            echo "</div>";

            // Toimitustapa
            echo "<h2>Toimitustapa:</h2>";
            echo "<p><strong>Toimitustapa:</strong> $toimitustapa</p>";

            // Asiakastiedot
            echo "<h2>Asiakastiedot:</h2>";
            echo "<p><strong>Nimi:</strong> $nimi</p>";
            echo "<p><strong>Postiosoite:</strong> $postiosoite</p>";
            echo "<p><strong>Sähköpostiosoite:</strong> $sahkopostiosoite</p>";
            echo "<p><strong>Puhelinnumero:</strong> $puhelinnumero</p>";

            // Tilauksen yhteenveto
            echo "<h2>Tilauksen yhteenveto:</h2>";
            echo "<p><strong>Tilattu määrä:</strong> $maara kpl</p>";

            // Loppusumma
            $kappalehinta = $row["Hinta"];
            $loppusumma = $maara * $kappalehinta;
            echo "<p><strong>Loppusumma:</strong> $loppusumma €</p>";
        } catch (PDOException $e) {
            echo "Virhe: " . $e->getMessage();
        }
    } else {
        // Jos tätä sivua yritetään käyttää suoraan ilman tilauksen tietoja, ohjaa takaisin etusivulle
        header("Location: index.php");
        exit();
    }
    ?>


</body>
</html>