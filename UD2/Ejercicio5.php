<!-- 
/*
Crea producto.php con estas variables:
$producto, $precio, $unidades y $stock.
Debe mostrar:
• Nombre del producto.
• Importe total = precio × unidades.
• “Disponible” si hay stock suficiente o “Sin stock suficiente” en caso contrario.
• Si el importe supera 100 €, muestra además “Envío gratuito” 
*/
-->
<?php
$producto = "Pendrive";
$precio = 10;
$unidades = 1;
$stock = 5;
$total = $precio * $unidades;
echo "<h2>$producto</h2>";
echo "<p>Total: $total €</p>";
if ($stock >= $unidades) {
    echo "<p>Disponible</p>";
} else {
    echo "<p>Sin stock suficiente</p>";
}
if ($total > 100) echo "<p>Envío gratuito</p>";
?>