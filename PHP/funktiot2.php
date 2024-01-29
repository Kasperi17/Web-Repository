<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summa laskin</title>
</head>
<body>

<?php
function LaskeSumma($luku1, $luku2) {
    $summa = $luku1 + $luku2;
    return $summa;
}


$luku1 = 5;
$luku2 = 10;

echo "Summa ($luku1 + $luku2) on " . LaskeSumma($luku1, $luku2);
?>

</body>
</html>
