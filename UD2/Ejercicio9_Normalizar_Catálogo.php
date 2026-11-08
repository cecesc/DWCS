<!--
· Trabaja con una lista de nombres de productos
· Quita espacios sobrantes al principo y al final
· Muestra los nombres ordenados alfabeticamente
· Elimina los nombres duplicados
· Indica cuántos productos distintos quedan
-->


<?php 
$productos = [" Teclado", "Ratón ", "Teclado", "Webcam"];

// 1. Quitar espacios sobrantes al principio y al final
echo  "<b>Quita espacios sobrantes al principo y al final</b> <br><br>";
$productosLimpios=[];
for ($i=0; $i<count($productos) ; $i++) { 
    $productosSinEspacios= trim($productos[$i]);
    echo $productosSinEspacios. "<br>";

    array_push($productosLimpios,trim($productos[$i]));
}
echo "<br><hr>";


// 2. Muestra los nombres ordenados alfabéticamente
echo "<b>Muestra los nombres ordenados alfabeticamente</b> <br><br>";
sort($productosLimpios);

foreach ($productosLimpios as $producto) {
    echo $producto . "<br>";
}
echo "<br><hr>";


// 3. Eliminar los nombres duplicados
echo "<b>Elimina los nombres duplicados</b> <br><br>";
$productosUnicos=array_unique($productosLimpios);
print_r($productosUnicos);
echo "<br><hr>";


// 4. Indica cuántos productos distintos quedan
echo "<b>Indica cuántos productos distintos quedan</b> <br><br>";
$cantidad_distintos = count($productosUnicos);
print_r("Productos no repetidos: ". $cantidad_distintos);
echo "<br><hr>";
?> 