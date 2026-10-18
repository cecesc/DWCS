/*
Define $precio = 80 y $cantidad = 3.
1. Calcula el subtotal.
2. Si el subtotal es de 200 € o más, aplica un 10 % de descuento.
3. Muestra subtotal, descuento y total final.
Prueba después con otros valores.
Extra: evita mostrar decimales innecesarios usando round()
*/

<?php 
$precio= 80;
$cantidad= 3;
$subtotal=$precio*$cantidad;
$descuento=0.1;
if ($subtotal >=200) {
    $descuento =$subtotal*0.1;
    $total=$subtotal-$descuento;
}else{
    $total=$subtotal;
}; 

echo "$subtotal \n";
echo "$descuento \n";
echo "$total \n";
?>