<?php
$variable = "Cesar";
echo  "Bo día, $variable";
echo "<h2>PHP funciona<h2>";
?>




<?php

// Variables por $, siatingue mayusculas y minusculas
// ' Las comillas simples se evaluarán como dichos caracteres
// " Las comillas dobles se evaluarán los caracteres de escape y se expanden con su valor
// {} Se utilizan para poder pegar informacion a la variable
// . sirve para concatenar
// $camelCase -> Las variables siempre en minuscula y segunda en mayuscula
// $ObjectCase -> Los objetos la primera en mayuscula 
// Las constantes se escriben en MAYUSCULAS y no llevan $
// php -l prueba.php en la terminal te dirá los errores

$titulo="Mi primera página";
$nombre='Ana';
$curso=2;
$prueba= 'asumible';

?>
<!doctype html>
<html>
    <head><title><?=  $titulo ?></title></head>
    <body><h1><?=  $titulo ?></h1>
        <div>
            <?php 
            echo "$nombre  estudia {$curso}º de Daw <br/>";
            echo "Esto es ". $prueba; 
            echo "<br/> A las ". date('H:i');
            echo " estara en clase"; 
            echo "<br/> El día ". date('Y-m-d');
            echo " es muy caluroso"; 



            ?>

        </div>
    </body>
</html>

