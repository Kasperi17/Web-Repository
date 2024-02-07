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
            padding: 0; dadada
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

        /* Alatunniste kartalle ja sesonkimainoksille */
        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: left;
            margin-top: auto;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        /* Lisää tyylit tarvittaessa */
    </style>
</head>
<body>

<!-- Ylätunniste yrityksen tiedoille, mukana logo -->
<header>
    <img id="logo" src="logo_dark.svg" alt="Mustat Renkaat Logo">
</header>

<!-- Pääsisältö renkaiden haulle -->
<main>
    <section id="tire-search">
        <label for="tire-size">Valitse rengaskoko:</label>
        <select id="tire-size">
            <?php
            // Yhdistetään tietokantaan
            $servername = "localhost";
            $username = "root"; // Vaihda käyttäjänimi
            $password = ""; // Vaihda salasana
            $dbname = "renkaat";

            // Luo yhteys
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Tarkista yhteys
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Haetaan renkaiden koot tietokannasta
            $sql = "SELECT DISTINCT Koko FROM renkaat";
            $result = $conn->query($sql);

            // Lisää vaihtoehdot valikkoon
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['Koko'] . '">' . $row['Koko'] . '</option>';
                }
            } else {
                echo '<option value="">Ei kokoja saatavilla</option>';
            }

            // Sulje yhteys
            $conn->close();
            ?>
        </select>
        <button onclick="searchTires()">Hae renkaat</button>
        <div id="search-results"></div>
    </section>
</main>

<!-- Alatunniste kartalle ja sesonkimainoksille -->
<footer>
    <div id="company-info">
        <p>Mustapään Auto Oy</p>
        <p>Mustat Renkaat</p>
        <p>Kosteenkatu 1, 86300 Oulainen</p>
        <p>Puh. 040-7128158</p>
        <p>Email: myyntimies@mustatrenkaat.net</p>
    </div>
</footer>

<!-- JavaScript ja PHP dynaamista toiminnallisuutta varten -->
<script>
    function searchTires() {
        var selectedSize = document.getElementById('tire-size').value;

        // Tee AJAX-pyyntö PHP-skriptille
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Käsittele vastaus ja päivitä hakutulokset
                var result = JSON.parse(xhr.responseText);
                displayResults(result);
            }
        };
        xhr.open("GET", "search.php?size=" + selectedSize, true);
        xhr.send();
    }

    // Funktio näyttää hakutulokset
    function displayResults(results) {
        var resultsContainer = document.getElementById('search-results');
        resultsContainer.innerHTML = ''; // Tyhjennä aiemmat tulokset

        if (results.length > 0) {
            for (var i = 0; i < results.length; i++) {
                var tire = results[i];
                // Luo HTML-elementti ja lisää se hakutuloksiin
                var tireElement = document.createElement('div');
                tireElement.innerHTML = '<strong>' + tire.Merkki + ' ' + tire.Malli + '</strong><br>' +
                                        'Tyyppi: ' + tire.Tyyppi + '<br>' +
                                        'Koko: ' + tire.Koko + '<br>' +
                                        'Hinta: ' + tire.Hinta + ' €<br>' +
                                        'Saldo: ' + tire.Saldo;
                resultsContainer.appendChild(tireElement);
            }
        } else {
            resultsContainer.innerHTML = 'Ei tuloksia.';
        }
    }
</script>

</body>
</html>
