<!--
· Reutiliza el array
· Calcula el valor total de existencias
· Muestra importes con dos decimales
· Lista los productos cuyo nombre contenga "a"
· Muestra la fecha del informe y valida un filtro GET
-->

<!-- 
•  Escribe buscarProducto(array $catalogo, int $id).
•  Debe devolver el producto o null si no aparece.
•  Prueba con un identificador existente y otro inexistente.
•  Añade una función puedeComprar(producto, cantidad) que devuelva bool.
-->



<?php  
$catalogo = [
 ["id"=>1, "nombre"=>"Auriculares", "precio"=>35.5, "stock"=>2],
 ["id"=>2, "nombre"=>"Teclado", "precio"=>42.0, "stock"=>5],
 ["id"=>3, "nombre"=>"Ratón", "precio"=>10.0, "stock"=>8],
 ["id"=>4, "nombre"=>"Monitor", "precio"=>68.0, "stock"=>2],
 ["id"=>5, "nombre"=>"PC", "precio"=>99.0, "stock"=>4]
];


// 1. Calcula el valor total de existencias
echo "<b>Calcula el valor total de existencias</b> <br><br>";
$valor_total = 0;

foreach ($catalogo as $producto) {
    $valor_total += $producto['precio'] * $producto['stock'];
}
print_r("El valor total de las existencias es: " . number_format($valor_total,2,',','.') . " €");
echo "<br/><br/><hr>";


// 2. Muestra importes con dos decimales
echo "<b>Muestra importes con dos decimales</b> <br><br>";
foreach ($catalogo as $producto) {

    $valor_producto = $producto['precio'] * $producto['stock'];

    echo "Producto: " . $producto['nombre'] . "<br>";

    echo "Precio: " . number_format($producto['precio'], 2, ',', '.') . " €<br>";

    echo "Valor de existencias: " . number_format($valor_producto, 2, ',', '.') . " €<br><br>";
}

echo "<hr>";


// 3. Lista los productos cuyo nombre contenga "a"
echo "<b>Productos cuyo nombre contiene la letra a</b><br><br>";
foreach ($catalogo as $producto) {
    if (str_contains(($producto['nombre']), 'a')) {
        echo $producto['nombre'] . "<br>";
    }
}
echo "<hr>";


// 4. Muestra la fecha del informe
echo "<b>Fecha del informe</b><br><br>";
echo date("d/m/Y");

echo "<br><hr>";



// 5. Valida un filtro GET
echo "<b>Filtro GET</b><br><br>";
$filtro = filter_input(INPUT_GET, 'nombre');

if ($filtro !== null && $filtro !== false && trim($filtro) != '') {
     echo "Filtro recibido: " . htmlspecialchars($filtro);
} else {
    echo "No se ha introducido ningún filtro.";
}

echo "<br><hr>";




function buscarProducto(array $catalogo, int $id): ?array {
    foreach ($catalogo as $producto) {
        if ($producto['id'] == $id) {
            return $producto;
        }
    }
    return null;
}




function puedeComprar(array $producto, int $cantidad): bool {
    if ($cantidad > 0 && $cantidad <= $producto['stock']) {
        return true;
    }
    return false;
}



echo "<b>Pruebas de buscarProducto()</b><br><br>";

$busqueda1 = buscarProducto($catalogo, 4);
$busqueda2 = buscarProducto($catalogo, 12);

if ($busqueda1 !== null) {
    echo "Producto encontrado: " . $busqueda1['nombre'] . "<br>";
} else {
    echo "Producto no encontrado.<br>";
}


if ($busqueda2 !== null) {
    echo "Producto encontrado: " . $busqueda2['nombre'] . "<br>";
} else {
    echo "Producto no encontrado.<br>";
}


echo "<br><b>Pruebas de puedeComprar()</b><br><br>";

$compra1 = puedeComprar($busqueda1, 1);
$compra2 = puedeComprar($busqueda1, 5);

echo "Comprar 1 unidad: " . ($compra1 ? "Sí se puede comprar" : "No se puede comprar");
echo "<br>";
echo "Comprar 5 unidades: " . ($compra2 ? "Sí se puede comprar" : "No se puede comprar");

?>