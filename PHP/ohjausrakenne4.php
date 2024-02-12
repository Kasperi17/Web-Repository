<!DOCTYPE html>
<html>
<head>
    <title>PHP ja HTML</title>
</head>
<body>

<?php
$i = 0;

while ($i < 10) {
    $j = 0;

    while ($j <= $i) {
        echo $i;
        $j++;
    }

    echo "<br>";
    $i++;
}
?>

</body>
</html>
