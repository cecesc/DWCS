<!--
•  Extrae de la tienda 4 funciones: buscarProducto(), calcularSubtotal(), calcularDescuento() y calcularEnvio().
•  Usa parámetros y return: una función no debería imprimir HTML.
•  Prueba importes con y sin descuento, y un producto inexistente.
•  Sustituye cálculos repetidos por llamadas a funciones.
•  Deja la presentación del resumen en la parte HTML.
-->

<?php  
$subtotal= 0;
$total=0;

$catalogo = [
 ["id"=>1, "nombre"=>"Auriculares", "precio"=>35.5, "stock"=>2],
 ["id"=>2, "nombre"=>"Teclado", "precio"=>42.0, "stock"=>5],
 ["id"=>3, "nombre"=>"Ratón", "precio"=>10.0, "stock"=>8],
 ["id"=>4, "nombre"=>"Monitor", "precio"=>68.0, "stock"=>2],
 ["id"=>5, "nombre"=>"PC", "precio"=>99.0, "stock"=>4]
];


function buscarProducto(array $catalogo, int $id): ?array {
    foreach ($catalogo as $producto) {
        if ($producto['id'] == $id) {
            return $producto;
        }
    }
    return null;
}



function calcularSubtotal(float $precio, int $cantidad): ?float {
    return $precio * $cantidad;
}


function calcularDescuento(float $subtotal): ?float {
    if ($subtotal >= 100) {
        return $subtotal * 0.10;
    }

    return 0;
}



function calcularEnvio(string $entrega): ?float {
    if ($entrega == 'normal') {
        return 3;
    } elseif ($entrega == 'urgente') {
        return 7;
    }

    return 0;
}


function calcularTotal(float $subtotal, string $entrega, int $regalo ): ?float{
    $descuento = calcularDescuento($subtotal);
    $envio = calcularEnvio($entrega);
    $coste_regalo = $regalo ? 2 : 0;

    return $subtotal - $descuento + $envio + $coste_regalo;
}


//Pruebas
$producto = buscarProducto($catalogo,4);

if ($producto != null) {
    $subtotal = calcularSubtotal($producto['precio'], 3);
    $descuento = calcularDescuento($subtotal);
    $envio =calcularEnvio('normal');
    $total = calcularTotal($subtotal, 'normal', 0);

}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda</title>
</head>
<body>

<h2>Resumen de compra</h2>

<?php if ($producto != null): ?>

    <p><b>Producto:</b> <?= $producto['nombre'] ?></p>
    <p><b>Precio:</b> <?= $producto['precio'] ?> €</p>
    <p><b>Cantidad:</b> 3</p>
    <p><b>Subtotal:</b> <?= $subtotal ?> €</p>
    <p><b>Descuento:</b> <?= $descuento ?> €</p>
    <p><b>Envío:</b> <?= $envio ?> €</p>
    <p style="border: 1px solid black;"><b>Total:</b> <?= $total ?> €</p>

<?php else: ?>

    <p>Producto inexistente.</p>

<?php endif; ?>

</body>
</html>