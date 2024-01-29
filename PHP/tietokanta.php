<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "asiakastietokanta";

// Luo yhteys tietokantaan
$conn = new mysqli($servername, $username, $password, $dbname);

// Tarkista yhteys
if ($conn->connect_error) {
    die("Yhteys epäonnistui: " . $conn->connect_error);
}

// Lisää autoinkrementoidun id-kentän asiakastauluun, jos sitä ei vielä ole
$sql_check_id = "SHOW COLUMNS FROM asiakastaulu LIKE 'id'";
$result_check_id = $conn->query($sql_check_id);

if ($result_check_id->num_rows == 0) {
    $sql_alter = "ALTER TABLE asiakastaulu MODIFY COLUMN id INT AUTO_INCREMENT PRIMARY KEY";
    if ($conn->query($sql_alter) === TRUE) {
        echo "Id-kenttä lisätty onnistuneesti.<br>";
    } else {
        echo "Virhe lisättäessä id-kenttää: " . $conn->error . "<br>";
    }
}

// Lisää testiasiakas
$sql_lisaa_asiakas = "INSERT INTO asiakastaulu (etunimi, sukunimi, email, osoite, postinumero, paikkakunta) VALUES ('Sinun', 'Nimesi', 'sinun.sposti@example.com', 'Osoitteesi', 12345, 'Kaupunkisi')";
if ($conn->query($sql_lisaa_asiakas) === TRUE) {
    echo "Testiasiakas lisätty onnistuneesti.<br>";
} else {
    echo "Virhe lisättäessä testiasiakasta: " . $conn->error . "<br>";
}

// Tee tilaus omalla nimelläsi
$asiakas_id = mysqli_insert_id($conn); // Hae juuri lisätyn asiakkaan id
$sql_tee_tilaus = "INSERT INTO tilaustaulu (asiakas_id, pvm) VALUES ($asiakas_id, CURRENT_DATE)";
if ($conn->query($sql_tee_tilaus) === TRUE) {
    echo "Tilaus tehty onnistuneesti.<br>";
} else {
    echo "Virhe tilausta tehdessä: " . $conn->error . "<br>";
}

// Sulje tietokantayhteys
$conn->close();
?>
