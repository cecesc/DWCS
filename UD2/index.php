<?php
$titulo= 'Mini Proyecto';
$nombre='Celia';
$ciclo='DAW';
$modulo='DWCS';
$fecha =date('d/m/Y');

?>
<!doctype html>
<html>
    <head><title><?=  $titulo ?></title></head>
    <body><h1><?=  $titulo ?></h1>
        <div>
            <p><?= $nombre . " estudia el ciclo " . $ciclo ."<br/>Hoy, " . $fecha . " está en el módulo " . $modulo ?></p>
            
        </div>
    </body>
</html>