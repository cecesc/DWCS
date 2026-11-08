<!--
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
 -->


<?php
//EJERCICIO 1

// 1- Crea catalogo.php con al menos 5 productos
$catalogo = [
    "Portátil",
    "Ratón",
    "Teclado",
    "Monitor",
    "Impresora"
];

// 3- Añade un sexto producto sin reconstruir todo el array
$catalogo[] = "Auriculares";


// 4- Muestra cuántos productos tiene el catalogo
$totalProductos = count($catalogo);

// 5- Cambia el nombre de uno de los productos
$catalogo[1] = "Ratón inalámbrico";



//EJERCICIO 2

// 1- Crea una array de 5 precios y otro de 5 cantidades
$precios = [10, 25, 8, 40, 15];
$cantidades = [5, 2, 10, 1, 3];

$totalInventario = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de productos</title>
    <style>
        .aviso-stock {
            color: #e06662e6;
            font-weight: bold;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <h1>Catálogo de productos</h1>

    <!-- 2- Muestra los productos como una lista HTML -->
    <ul>
        <?php foreach ($catalogo as $producto): ?>
            <li><?= htmlspecialchars($producto) ?></li>
        <?php endforeach; ?>
    </ul>

    <!-- 4- Muestra cuántos productos tiene el catalogo -->
    <p>
        Total de productos:
        <strong><?= $totalProductos ?></strong>
    </p>

    <hr>
    <hr>

    <h2>Inventario y Existencias</h2>
     <!-- 2- Recórrelos con for e imprime número, precio y stock -->
    <ul>
        <?php for ($i = 0; $i < count($precios); $i++): 
            // 3- Calcula cuánto valdría todo el inventario
            $totalInventario += ($precios[$i] * $cantidades[$i]);
        ?>
            <li>
                <strong>Producto <?= ($i + 1) ?></strong> — 
                Precio: <?= $precios[$i] ?>€ | 
                Stock: <?= $cantidades[$i] ?> unidades
                
                <!-- 4- Añade un aviso para las unidades con stock menos que 3 -->
                <?php if ($cantidades[$i] < 3): ?>
                    <span class="aviso-stock"> ¡Poco stock!</span>
                <?php endif; ?>
            </li>
        <?php endfor; ?>
    </ul>

    <!-- 3- Muestra el cálculo total del inventario -->
    <p>Valor total del inventario: <strong><?= $totalInventario ?> €</strong></p>

</body>
</html>
