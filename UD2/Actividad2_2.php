<?php
echo "EJERCICIO 2.2.1 \n";
echo "Introduce el número: ";
fscanf(STDIN, "%d", $num);
$suma =0;

for ($i = 1; $i <= 2 * $num - 1; $i += 2) {
    $suma += $i;
}

echo "La suma vale: $suma"; 

?>


<?php 
echo "EJERCICIO 2.2.2 \n";
echo "Introduce el número: ";
fscanf(STDIN, "%d", $n);
$suma =1;
$ter=1;
for ($k = 1; $k <= $n; $k++) {
    $ter = $ter / 2;
    $suma = $suma + $ter;
}
echo "La suma vale: ", $suma;
?>



<?php 
echo "EJERCICIO 2.2.3 \n";
echo "Introduce un número: ";
fscanf(STDIN,"%d", $numero);
echo "Lista de divisores del número: ", $numero, "\n";
for ($i=(int)($numero/ 2); $i >= 2; $i--) { 
    if ($numero % $i == 0) {
        echo $i . "\n";}
}
echo 1 . "\n";
?>


<!DOCTYPE html>
<html lang="gl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tirada de Dado</title>
</head>
<body>
    <h1>EJERCICIO 2.2.4</h1>

    <?php
    $contadorTiradas = 0;

    do {
        $tirada = rand(1, 6);
        $contadorTiradas++; 
        echo "<p class='tirada'>Tirada número $contadorTiradas: Saíu un <strong>$tirada</strong></p>";

    } while ($tirada != 5); 
    ?>

    
    <div class="resultado">
        <p> Conseguido! Necesitáronse un total de <?php echo $contadorTiradas; ?> tiradas para obter o 5.</p>
    </div>

</body>
</html>
