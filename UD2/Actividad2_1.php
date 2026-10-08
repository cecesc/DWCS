<?php 
echo"EJERCICIO 2.1.1 \n";
echo "Ingresa tu altura (cm): ";
fscanf(STDIN, "%d", $altura);

$pulgadas= floor($altura/2.54);
$pies=$pulgadas/12;

echo "La altura en pulgadas es: " . number_format($pulgadas, 2) . "\n";
echo "La altura en pies es: " . number_format($pies, 2). "\n";
?>



<?php  
echo"EJERCICIO 2.1.2 \n";
echo "Ingresa un numero: ";
fscanf(STDIN, "%d", $x);
$f=0;

if ($x>0) {
    $f= $x**2;
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
</head>
<body>
    <?php 
        echo "<h1>Resultado</h1>";
        echo "<p>El valor de la funcion es: {$f} </p>"; 
    ?>
</body>
</html>



<?php 
echo"EJERCICIO 2.1.3 \n";
echo "Ingresa tres numeros: ";
fscanf(STDIN, "%d,%d,%d", $a,$b,$c);

$d=($b ** 2)-4 * ($a * $c);
$aa= 2 * $a;
if ($d >=0) {
    $dd= sqrt($d);
    $x1 = (-$b + $dd) / $aa;
    $x2 = (-$b - $dd) / $aa;
    echo "La ecuacion tiene raices reales: $x1, $x2\n";
} else {
    $dd = sqrt(-$d);
    $re = -$b / $aa;
    $im = $dd / $aa;
    echo "La ecuacion tiene raices complejas conjugadas:\n";
    echo "Parte real: $re\n";
    echo "Parte imaginaria: $im\n";
}

?>

