<!-- //
 Construye un catálogo con 5 productos
 Cada uno debe tener id, nombre, precio y stock
 Muestra una tabla HTML con todos los campos
 Destaca los productos con stock menor que 3
 Calcula el valor total de las existencias
// -->


<!-- // 
Añade un formulario GET con precio máximo.
Muestra solo los productos con precio <= máximo.
Valida que el valor recibido es numérico y no negativo.
Si falta el filtro, muestra todos los productos.
No necesitas base de datos: lee el catálogo del array


// -->
<?php  
$catalogo = [
 ["id"=>1, "nombre"=>"Auriculares", "precio"=>35.5, "stock"=>2],
 ["id"=>2, "nombre"=>"Teclado", "precio"=>42.0, "stock"=>5],
 ["id"=>3, "nombre"=>"Ratón", "precio"=>10.0, "stock"=>8],
 ["id"=>4, "nombre"=>"Monitor", "precio"=>68.0, "stock"=>2],
 ["id"=>5, "nombre"=>"PC", "precio"=>99.0, "stock"=>4]
];



if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $precio_maximo = filter_input(INPUT_GET,'precio', FILTER_VALIDATE_INT);
    
    if (isset($_GET['precio_max']) && is_numeric($_GET['precio_max']) && $_GET['precio_max'] >= 0) {
        $precio_maximo = $_GET['precio_max'];
    }

    if ($precio_maximo > 0) {
        if($precio_maximo !== null){
            $productosMenorPrecioMax=[];
            foreach ($catalogo as $item) {
                if ($item["precio"]<=$precio_maximo) {
                    $productosMenorPrecioMax[]=$item;
                }
            }
        }
    }else{echo "Debe ser positivo";} 
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo Asociativo</title>
</head>
<body>
    <table border="1px solid black" style="border-collapse: collapse">
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>VTE</th>
        </tr>
        <?php $totalPrecioExistencias = 0;
            foreach ($catalogo as $p): 
                $Vstock = $p["stock"] * $p["precio"]; 
                $totalPrecioExistencias += $Vstock; 
            ?>
        <tr <?= ($p["stock"] < 3) ? 'style="background-color: cyan;"' : '' ?>>
            <td><?= htmlspecialchars($p["nombre"]) ?></td>
            <td><?= number_format($p["precio"], 2, ",", ".") ?> €</td>
            <td><?= $p["stock"] ?> </td>
            <td><?= number_format($Vstock, 2, ",", ".") ?> €</td>
        </tr>
        
        <?php endforeach; ?>
        <tr>
            <td>Total</td>
            <td></td>
            <td></td>
            <td><?=  number_format($totalPrecioExistencias, 2, ",", ".") ?>€</td>

        </tr>

    </table>
    <br>
    <br>
    <hr>



    <form action="" method="GET" style="margin-bottom: 20px;">
        <label for="precio_max">Precio máximo:</label>
        <input type="number" step="0.01" min="0" name="precio_max" id="precio_max" 
               value="<?= isset($_GET['precio_max']) ? htmlspecialchars($_GET['precio_max']) : '' ?>">
        <button type="submit">Filtrar</button>
        <a href="?">Limpiar</a>
    </form>

    <table border="1px solid black" style="border-collapse: collapse">
        <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>VTE</th>
        </tr>
        <?php $totalPrecioExistencias = 0;
            foreach ($catalogo as $p): 
                $Vstock = $p["stock"] * $p["precio"]; 
                $totalPrecioExistencias += $Vstock; 
            ?>
        <tr <?= ($p["stock"] < 3) ? 'style="background-color: cyan;"' : '' ;
                ($p["precio"] < $precio_maximo ) ? '' : ''?>>
            <td><?= htmlspecialchars($p["nombre"]) ?></td>
            <td><?= number_format($p["precio"], 2, ",", ".") ?> €</td>
            <td><?= $p["stock"] ?> </td>
            <td><?= number_format($Vstock, 2, ",", ".") ?> €</td>
        </tr>
        
        <?php endforeach; ?>
        <tr>
            <td>Total</td>
            <td></td>
            <td></td>
            <td><?=  number_format($totalPrecioExistencias, 2, ",", ".") ?>€</td>

        </tr>

    </table>
</body>
</html>

<?php  ?>