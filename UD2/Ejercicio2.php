/*
Crea variables para: nombre, edad, ciclo y si estás matriculado/a.
Muestra una ficha con HTML y PHP, por ejemplo:
Nombre: Ana
Edad: 18
Ciclo: DAW
Después cambia solo los valores de las variables y comprueba que la salida se actualiza.
Extra: construye una frase usando concatenación
*/
<?php
$titulo="Mi primera página";
$nombre='Celia';
$edad=21;
$ciclo= 'DWCS';

?>
<!doctype html>
<html>
    <head><title><?=  $titulo ?></title></head>
    <body><h1><?=  $titulo ?></h1>
        <div>
            <?php 
            echo "Nombre: $nombre <br/>";
            echo "Edad: ". $edad . "<br/>"; 
            echo "Ciclo: $ciclo <br/>";
            ?>

        </div>
    </body>
</html>

