<?php 
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
?>