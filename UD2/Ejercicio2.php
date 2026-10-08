
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

