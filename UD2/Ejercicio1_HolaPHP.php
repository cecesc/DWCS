/*
1. Crea un archivo ejercicio1.php.
2. Muestra un título HTML: “Mi primera página PHP”.
3. Desde PHP, muestra tu nombre y el texto “Estoy aprendiendo PHP”.
4. Añade una segunda salida con echo que muestre una línea separadora.
Extra: prueba qué ocurre si eliminas un punto y coma
*/


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