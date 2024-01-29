<!DOCTYPE html>
<html>
<head>
    <title>PHP ja HTML esimerkki</title>
</head>
<body>


<form method="post" action="">
    <label for="aloitusluku">Syötä aloitusluku:</label>
    <input type="number" id="aloitusluku" name="aloitusluku" required>
    <button type="submit">Lähetä</button>
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") 
    $aloitusluku = $_POST["aloitusluku"];


        
        // Tulosta seuraavat yhdeksän numeroa
        for ($i = 0; $i < 9; $i++) {
            echo ($aloitusluku + $i) . " ";
        }
    
?>

</body>
</html>
