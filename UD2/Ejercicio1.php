<?php
$titulo="Mi primera página PHP";
$nombre='Celia';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>$titulo</title>
</head>
<body>
    <h1><?=  $titulo ?></h1>
    <div>
            <?php 
            echo "$nombre  , Mi primera página PHP";
            echo "<hr/>"; 

            ?>
    </div>
</body>
</html>