<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sauvan Pituuslaskuri</title>
</head>
<body>

<?php
// Funktio laskemaan sauvan pituuden käyttötarkoituksen perusteella
function LaskeSauvanPituus($pituus, $kayttotarkoitus) {
    switch ($kayttotarkoitus) {
        case "luisteluhiihto":
            return $pituus * 0.9;
        case "perinteinen":
            return $pituus * 0.85;
        case "sauvakavely":
            return $pituus * 0.68;
        default:
            return "Virheellinen käyttötarkoitus";
    }
}

// Lomake henkilön pituuden ja käyttötarkoituksen kysymiseen
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $henkilonPituus = $_POST["pituus"];
    $kayttotarkoitus = $_POST["kayttotarkoitus"];

    // Kutsutaan funktiota LaskeSauvanPituus ja tulostetaan tulos
    $sauvanPituus = LaskeSauvanPituus($henkilonPituus, $kayttotarkoitus);
    echo "Henkilön pituus: $henkilonPituus cm<br>";
    echo "Sauvan käyttötarkoitus: $kayttotarkoitus<br>";
    echo "Sauvan pituus: $sauvanPituus cm";
}
?>

<!-- Lomake käyttäjän syötteiden keräämiseksi -->
<form method="post" action="">
    <label for="pituus">Henkilön pituus (cm): </label>
    <input type="number" name="pituus" required><br>

    <label for="kayttotarkoitus">Sauvan käyttötarkoitus: </label>
    <select name="kayttotarkoitus" required>
        <option value="luisteluhiihto">Luisteluhiihto</option>
        <option value="perinteinen">Perinteinen</option>
        <option value="sauvakavely">Sauvakävely</option>
    </select><br>

    <input type="submit" value="Laske Sauvan Pituus">
</form>

</body>
</html>
