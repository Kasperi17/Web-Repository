<!DOCTYPE html>
<html lang="fi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mustat Renkaat</title>
    
    <style>
        /* sivun normaali tyyli */
        body {
            margin: 0;
            padding: 0; 
            position: relative;
            min-height: 100vh;
            font-family: 'Racing Sans One', sans-serif;
        }

        /* ylätunniste logolle */
        header {
            background-color: #F205B3;
            color: #fff;
            text-align: center;
        }   

        /* sivun päätoiminnalisuus osan tyyli */
        main {
            padding: 150px;
            flex: 1;
            margin: 0px;
            font: ;
            font-family: 'Racing Sans One', sans-serif;
        }

        /* Logon koko ja muut tyylit */
        #logo {
            width: 250px;
            height: auto;
            margin: left;
            display: block;
        }
        
        /* mainos slideshown tila ja sijainti */
        .slideshow-container {
            max-width: 300px;
            position: relative;
            margin: auto;
            right: -50.5%;
            top: -222.5px; 
        }

        /* slideshown kuvien tyyli */
        .mySlides img {
            max-width: 100%;
            height: auto;
        }

        /* Footterin tyyli ja sijainti*/
        footer {
            background-color: #023059;
            color: #fff;
            padding: 10px;
            text-align: left;
            position: absolute; 
            bottom: 0; 
            width: 100%;
        }

        /* video containerin tyyli ja sijainti*/
        .video-container {
            right: 0px;
            position: absolute;
            top: 125px;
        }
        
        /* kartan tyylija sijainti*/
        .custom-map {
        height: 150px;
        width: 300px;
        position: relative;
        right: 50;
        bottom: 0;
        }
    </style>

<!-- Leaflet-karttakirjaston CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<!-- Leaflet-karttakirjasto -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com%22%3E/">
<link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">


</head>


<body>

<!-- logo -->
<header>
    <img id="logo" src="logo_dark.svg" alt="Mustat Renkaat Logo">
</header>

<?php
// luodaan php yhteys tietokantaan
session_start();
$host = "127.0.0.1";
$username = "root";
$password = "";
$database_in_use = "renkaat";

try {
    $connection = new PDO("mysql:host=$host;dbname=$database_in_use", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

     // katsotaan onko lomake lähetetty post metodilla
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        
        // Haetaan renkaat tietokannasta koon ja tyypin perusteella
        $Type = $_POST['type'];
        $Size = $_POST['size'];
        if (!empty($Type) && !empty($Size))  {
            $query = "SELECT * FROM Renkaat WHERE Tyyppi LIKE '%".$Type."%' AND Koko LIKE '%".$Size."%'";

            $result = $connection->query($query);

              // Jos renkaita löytyy, näytetään ne ja tilauslomake
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $Tire = "id: " . $row["RengasID"]. " - Name: " . $row["Merkki"]. " - Model: " . $row["Malli"]. " - Type: " . $row["Tyyppi"]. " - Size: " . $row["Koko"]. " - Price: $ " . $row["Hinta"]. " - Balance: " . $row["Saldo"];

                    // lisää kuvan renkaasta
                    if (!empty($row["Kuva"])) {
                        $Tire .= '<br><img src="' . $row["Kuva"] . '" alt="Rengas" width="50" height="50">';
                    }

                    // tulostetaan renkaan tiedot ja laitetaan tilauslomake
                    echo $Tire . "<br>";

                    // Tilauslomake
                    echo '<form method="post" action="tilausvahvistus.php">'; // Muutettu action
                    echo '  <label for="maara">Määrä:</label>';
                    echo '  <input type="number" name="maara" id="maara" min="1" max="' . $row["Saldo"] . '" required>';
                    echo '  <input type="hidden" name="rengasID" value="' . $row["RengasID"] . '">';
                    echo '  <input type="submit" name="submit" value="Tilaa">'; // Muutettu tyyppi buttonista submitiksi
                    echo '</form>';
                }
                
            } else {
                echo "Rengasta ei löytynyt.";
            }
        } else {
            echo "Tietoja puuttuu";
        }
        
    }

    // Tarkistetaan, onko lomake lähetetty POST-metodilla ja onko määrä asetettu
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['maara'])) {
        $maara = $_POST['maara'];
        $rengasID = $_POST['rengasID'];




    }
} catch (PDOException $e) {
    echo "Virhe: " . $e->getMessage();
}
?>

<!-- hakulomake renkaitten etsimistä varten -->

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

    <div class="video-container">
        <iframe width="200" height="200" src="https://www.youtube.com/embed/U1Y5DAZ_4PY?si=a6rIn7E3PG34qhVZ" frameborder="0" allowfullscreen></iframe>
    </div>
</main>


<!-- JavaScript slideshowin toiminnallisuutta -->
<script>
    // Alustetaan slideshowin indeksi
    var slideIndex = 0;
    // Funktio, joka näyttää kuvat
    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) { slideIndex = 1 }
        slides[slideIndex - 1].style.display = "block";
        setTimeout(showSlides, 2000); 
    }

    showSlides(); 
</script>

<!-- Alatunniste kartalle ja sesonkimainoksille -->
<footer>
    <div id="company-info">
        <p>Mustapään Auto Oy</p>
        <p>Mustat Renkaat</p>
        <p>Kosteenkatu 1, 86300 Oulainen</p>
        <p>Puh. 040-7128158</p>
        <p>Email: myyntimies@mustatrenkaat.net</p>
        <a href="#" onclick="showMap()" style="color: #ADD8E6;">Näytä kartta</a>
    </div>
    <div id="mapContainer" style="display: none;">
        <img src="MUSTATrenkaat_Karttakuva.jpg" alt="Yrityksen kartta">
    </div>
    <div id="map" class="custom-map"></div>
</footer>

<!-- Avaa kartan -->
<script>
    function showMap() {
        var mapWindow = window.open("", "_blank");
        mapWindow.document.write('<img src="MUSTATrenkaat_Karttakuva.jpg"" alt="Yrityksen kartta">');
    }
</script>

<!-- JavaScript Leaflet-kartan luomiseksi -->
<script>
    // Luo kartan ja asettaa sijainnin ja zoom-tason
  var mymap = L.map('map').setView([64.265957, 24.818990], 16);
  // Lisää OpenStreetMap-kerros
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
  }).addTo(mymap);
   // Lisää merkki Siltakadun sijaintiin
  L.marker([64.265957, 24.818990]).addTo(mymap);
</script>

</body>
</html>