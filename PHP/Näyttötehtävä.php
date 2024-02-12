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

<!-- Tähän osioon lisätty kuva -->
<img src="e:\xampp\htdocs\pexels-andrea-piacquadio-3807695.jpg" width="280" height="125" title="Logo of a company" alt="Logo of a company" />

<footer>
    <div id="company-info">
        <p>Mustapään Auto Oy</p>
        <p>Mustat Renkaat</p>
        <p>Kosteenkatu 1, 86300 Oulainen</p>
        <p>Puh. 040-7128158</p>
        <p>Email: myyntimies@mustatrenkaat.net</p>
    </div>
</footer>

<?php
session_start();
$host = "127.0.0.1";
$username = "root";
$password = "";
$database_in_use = "renkaat";



try {
    $connection = new PDO("mysql:host=$host;dbname=$database_in_use", $username, $password);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $Type = $_POST['type'];
        $Size = $_POST['size'];
        if(!empty($Type) && !empty($Size))  {
            $query = "SELECT * FROM Renkaat WHERE Tyyppi LIKE '%".$Type."%' AND Koko LIKE '%".$Size."%'";

            $result = $connection->query($query);

            $result->execute();

            if($result->rowCount() > 0) {
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $Tire = "id: " . $row["RengasID"]. " - Name: " . $row["Merkki"]. " - Model: " . $row["Malli"]. " - Type: " . $row["Tyyppi"]. " - Size: " . $row["Koko"]. " - Price: $ " . $row["Hinta"]. " - Balance: " . $row["Saldo"];
                    echo $Tire . "<br><br>";
                }
            }
        }
        else {
            echo "Information is invalid";
        }
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
</style>
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



</body>
</html>
