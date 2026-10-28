<!-- /* 
EJERCICIO 1
1- Crea catalogo.php con al menos 5 productos
2- Muestra los productos como una lista HTML
3- Añade un sexto producto sin reconstruir todo el array
4- Muestra cuántos productos tiene el catalogo
5- Cambia el nombre de uno de los productos

EJERCICIO 2
1- Crea una array de 5 precios y otro de 5 cantidades
2- Recórrelos con for e imprime número, precio y stock
3- Calcula cuánto valdría todod el inventario
4- Añade un aviso para las unidades con stock menos que 3
*/ -->


<?php
//Ejercicio 1

// 1
$catalogo = [
    "Portátil",
    "Ratón",
    "Teclado",
    "Monitor",
    "Impresora"
];

// 2
$catalogo[] = "Auriculares";

// 3
$catalogo[1] = "Ratón inalámbrico";

// 4
$totalProductos = count($catalogo);




//Ejercicio 2
$precios = [10, 25, 8, 40, 15];
$cantidades = [5, 2, 10, 1, 3];

$total = 0;








?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de productos</title>
</head>
<body>
    <h1>Catálogo de productos</h1>

    <!-- 5 -->
    <ul>
        <?php foreach ($catalogo as $producto): ?>
            <li><?= htmlspecialchars($producto) ?></li>
        <?php endforeach; ?>
    </ul>

    <p>
        Total de productos:
        <strong><?= $totalProductos ?></strong>
    </p>

    <hr>
    <hr>
            
    <p>
        <?php for ($i = 0; $i < 5; $i++) {
            echo "Producto " . ($i + 1);
            echo " - Precio: " . $precios[$i] . "€";
            echo " - Stock: " . $cantidades[$i] . "<br>";

            $total = $total + ($precios[$i] * $cantidades[$i]);

            if ($cantidades[$i] < 3) {
                echo "Poco stock";
                echo "<br>";
            }

             echo "<br>";
        } ?>
    </p>

    <p>Valor total del inventario:<?php echo $total ?> €</p>
</body>
</html>
