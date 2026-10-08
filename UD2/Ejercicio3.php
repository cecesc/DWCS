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