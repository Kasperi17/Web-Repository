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
            padding: 20px;
            flex: 1;
        }
        
        .slideshow-container {
            max-width: 300px;
            position: relative;
            margin: auto;
            right: -40%;
            top: -160px; /* Muuta tähän haluamasi yläreuna */
        }

        .mySlides {
            display: none;
        }

        .mySlides img {
            max-width: 100%;
            height: auto;
        }

        /* Alatunniste kartalle ja sesonkimainoksille */
        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: left;
            margin-top: 11%;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .video-container {
            margin-left: auto;
            margin-right: 50px;
            right: 19.20%;
            position: fixed;
            top: 30.5%;

        }
        /*dadadadadadada
        /* Lisää responsiivisuus mediakyselyillä */
        @media only screen and (max-width: 600px) {
            #logo {
                width: 150px;
            }

            main {
                padding: 10px;
            }

            .video-container {
                margin-right: 10px;
            }
        }
    </style>
    
</head>
<body>

<!-- Ylätunniste yrityksen tiedoille, mukana logo -->
<header>
    <img id="logo" src="logo_dark.svg" alt="Mustat Renkaat Logo">
</header>

<?php
session_start();
$host = "127.0.0.1";
$username = "root";
$password = "";
$database_in_use = "renkaat";

try {
    $connection = new PDO("mysql:host=$host;dbname=$database_in_use", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $Type = $_POST['type'];
        $Size = $_POST['size'];
        if (!empty($Type) && !empty($Size))  {
            $query = "SELECT * FROM Renkaat WHERE Tyyppi LIKE '%".$Type."%' AND Koko LIKE '%".$Size."%'";

            $result = $connection->query($query);

            $result->execute();

            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $Tire = "id: " . $row["RengasID"]. " - Name: " . $row["Merkki"]. " - Model: " . $row["Malli"]. " - Type: " . $row["Tyyppi"]. " - Size: " . $row["Koko"]. " - Price: $ " . $row["Hinta"]. " - Balance: " . $row["Saldo"];

                    // Tulosta rengastiedot
                    echo $Tire . "<br>";

                    // Lisää tilauslomake
                    echo '<form method="post" action="">';
                    echo '  <label for="maara">Määrä:</label>';
                    echo '  <input type="number" name="maara" id="maara" min="1" max="' . $row["Saldo"] . '" required>';
                    echo '  <input type="hidden" name="rengasID" value="' . $row["RengasID"] . '">';
                    echo '  <input type="submit" value="Tilaa">';
                    echo '</form>';
                }
            } else {
                echo "Rengasta ei löytynyt.";
            }
        } else {
            echo "Tietoja puuttuu";
        }
    }

    // Käsittely tilauksen jälkeen
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['maara'])) {
        $maara = $_POST['maara'];
        $rengasID = $_POST['rengasID'];

        // Tässä voit lisätä tilauksen käsittelyn ja päivittää tietokantaa
        // esim. vähentää saldoa ja tallentaa tilaustietoja

        echo "Tilaus on vastaanotettu. Kiitos!";
    }
} catch (PDOException $e) {
    echo "Virhe: " . $e->getMessage();
}
?>
<!-- Tähän osioon lisätty kuva -->

<div id="box">
    <form method="post">
        <div style="font-size: 30px;margin: 10px;font-family: Arial, Helvetica, sans-serif;color: white; text-align:center;">Mustat Renkaat</div>
        Tyyppi: <select name="type" id="Type">
            <option value="Nasta">Nasta</option>
            <option value="Kitka">Kitka</option>
            <option value="Kesä">Kesä</option>
        </select><br><br>
        Koko: <select name="size" id="Size">
            <option value="165/55-14">165/55-14</option>
            <option value="165/55-15">165/55-15</option>
            <option value="165/65-14">165/65-14</option>
            <option value="175/65-14">175/65-14</option>
            <option value="175/65-15">175/65-15</option>
            <option value="185/55-15">185/55-15</option>
            <option value="185/65-14">185/65-14</option>
            <option value="185/65-15">185/65-15</option>
            <option value="195/55-15">195/55-15</option>
            <option value="195/55-15">195/65-15</option>
            <option value="205/55-16">205/55-16</option>
            <option value="205/65-16">205/65-16</option>
            <option value="225/55-18">225/55-18</option>
            <option value="235/60-17">235/60-17</option>
            <option value="235/60-18">235/60-18</option>
            <option value="235/65-17">235/65-17</option>
            <option value="255/50-19">255/50-19</option>
        </select><br><br>
        <input id="button" type="submit" value="Hae"><br><br>
    </form>        
</div>

<!-- PHP-koodi renkaiden haulle -->


<!-- Slideshow-container ja kuvat -->
<main>
    <div class="slideshow-container">
        <div class="mySlides">
            <img src="pexels-pixabay-416728.jpg" alt="Kuva 1">
        </div>
        <div class="mySlides">
            <img src="pexels-mihis-alex-21014.jpg" alt="Kuva 2">
        </div>
        <div class="mySlides">
            <img src="tekton-O_ufcLVTAYw-unsplash.jpg" alt="Kuva 3">
        </div>
    </div>
</main>

<main>
    <div class="video-container">
        <iframe width="200" height="200" src="https://www.youtube.com/embed/U1Y5DAZ_4PY?si=a6rIn7E3PG34qhVZ" frameborder="0" allowfullscreen></iframe>
    </div>
</main>

<!-- JavaScript slideshowin toiminnallisuutta varten -->
<script>
    var slideIndex = 0;

    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) { slideIndex = 1 }
        slides[slideIndex - 1].style.display = "block";
        setTimeout(showSlides, 2000); // Vaihda kuvaa joka 2 sekunti
    }

    showSlides(); // Käynnistä slideshow
</script>

<!-- Alatunniste kartalle ja sesonkimainoksille -->
<footer>
    <div id="company-info">
        <p>Mustapään Auto Oy</p>
        <p>Mustat Renkaat</p>
        <p>Kosteenkatu 1, 86300 Oulainen</p>
        <p>Puh. 040-7128158</p>
        <p>Email: myyntimies@mustatrenkaat.net</p>
        <!-- Lisää linkki kartan avaamiseen -->
        <a href="#" onclick="showMap()">Näytä kartta</a>
    </div>
    <!-- Lisää div kuvan säiliöksi -->
    <div id="mapContainer" style="display: none;">
        <!-- Tähän lisätään kuva -->
        <img src="MUSTATrenkaat_Karttakuva.jpg" alt="Yrityksen kartta">
    </div>
</footer>

<!-- Lisää tämä script-elementin sisään, mieluiten ennen </body> -tagia -->
<script>
    // Funktio, joka näyttää kuvan
    function showMap() {
        // Avaa kuvan uudessa ikkunassa
        var mapWindow = window.open("", "_blank");
        // Lisää kuva ikkunaan
        mapWindow.document.write('<img src="MUSTATrenkaat_Karttakuva.jpg"" alt="Yrityksen kartta">');
    }
</script>
// Fdadadad
</body>
</html>
