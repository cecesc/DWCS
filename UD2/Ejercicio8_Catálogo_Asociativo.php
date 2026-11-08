<!--
EJERCICIO 3 Catálogo asociativo
 Construye un catálogo con 5 productos
 Cada uno debe tener id, nombre, precio y stock
 Muestra una tabla HTML con todos los campos
 Destaca los productos con stock menor que 3
 Calcula el valor total de las existencias


EJERCICIO 4 Filtrar productos
Añade un formulario GET con precio máximo.
Muestra solo los productos con precio <= máximo.
Valida que el valor recibido es numérico y no negativo.
Si falta el filtro, muestra todos los productos.
No necesitas base de datos: lee el catálogo del array


TALLER ADICCIONAL Inventario filtrable
 Amplía el catálogo del ejercicio 3 con la propiedad «categoría».
 Añade dos filtros GET: categoría y precio máximo.
 Muestra el stock total y el valor del inventario filtrado.
 El filtro vacío debe mostrar todos los productos.
 No repitas HTML de filas: utiliza foreach.


Taller · Pistas y casos de prueba
 ¿Qué dos claves nuevas necesita cada registro?
 Si la categoría no está elegida, ¿qué condición puedes omitir?
 Precio máximo 0 y precio máximo negativo no son equivalentes.
 Los valores GET pueden estar ausentes: compruébalos.
 Probar: sin filtros; una categoría; un máximo; ambos filtros

-->




<?php  
// Taller adicional: Ampliamos el catálogo incluyendo la propiedad "categoria"
$catalogo = [
 ["id"=>1, "nombre"=>"Auriculares", "precio"=>35.5, "stock"=>2],
 ["id"=>2, "nombre"=>"Teclado", "precio"=>42.0, "stock"=>5],
 ["id"=>3, "nombre"=>"Ratón", "precio"=>10.0, "stock"=>8],
 ["id"=>4, "nombre"=>"Monitor", "precio"=>68.0, "stock"=>2],
 ["id"=>5, "nombre"=>"PC", "precio"=>99.0, "stock"=>4]
];

$precio_maximo = null;
$categoria_filtrada = '';
$productos_filtrados = $catalogo; // Por defecto si falta el filtro, muestra todos los productos
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // la categoría se recoge solo si existe
    if (isset($_GET['categoria']) && $_GET['categoria'] !== '') {
        $categoria_filtrada = $_GET['categoria'];
    }

    if (isset($_GET['precio_max']) && $_GET['precio_max'] !== '') {
        if (is_numeric($_GET['precio_max']) && $_GET['precio_max'] >= 0) {
            $precio_maximo = (float)$_GET['precio_max'];
        } else {
            $error_msg = "El precio debe ser un número positivo";
        }
    }

    if ($error_msg === "") {
        $productos_filtrados = [];
        foreach ($catalogo as $item) {
            $pasa_categoria = true;
            $pasa_precio = true;

            if ($categoria_filtrada !== '') {
                $pasa_categoria = ($item["categoria"] === $categoria_filtrada);
            }

            if ($precio_maximo !== null) {
                $pasa_precio = ($item["precio"] <= $precio_maximo);
            }

            // Si cumple ambas condiciones, entra en el nuevo catálogo filtrado
            if ($pasa_categoria && $pasa_precio) {
                $productos_filtrados[] = $item;
            }
        }
    } else {
        // Si hay error en el precio se vacía
        $productos_filtrados = [];
    }
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
    <h2>EJERCICIO 3: Catálogo Asociativo</h2>
    <table border="1px solid black" style="border-collapse: collapse">
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Categoría</th>
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
            <td><?= $p["id"] ?></td>
            <td><?= htmlspecialchars($p["nombre"]) ?></td>
            <td><?= htmlspecialchars($p["categoria"]) ?></td>
            <td><?= number_format($p["precio"], 2, ",", ".") ?> €</td>
            <td><?= $p["stock"] ?> </td>
            <td><?= number_format($Vstock, 2, ",", ".") ?> €</td>
        </tr>
        
        <?php endforeach; ?>

        <tr>
            <td><strong>Total</strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><strong><?= number_format($totalPrecioExistencias, 2, ",", ".") ?>€</strong></td>
        </tr>
    </table>

    <br/><br/><hr><br/>


    <h2>EJERCICIO 4 y TALLER: Inventario con filtros</h2>

    <!-- Formulario ampliado con la Categoría y el precio máximo -->
    <form action="" method="GET" style="margin-bottom: 20px;">
        <label for="categoria">Categoría:</label>
        <select name="categoria" id="categoria">
            <option value="">-- Todas --</option>
            <option value="Periféricos" <?= ($categoria_filtrada === 'Periféricos') ? 'selected' : '' ?>>Periféricos</option>
            <option value="Componentes" <?= ($categoria_filtrada === 'Componentes') ? 'selected' : '' ?>>Componentes</option>
        </select>

        <label for="precio_max" style="margin-left: 15px;">Precio máximo:</label>
        <input type="number" step="0.01" min="0" name="precio_max" id="precio_max" 
               value="<?= isset($_GET['precio_max']) ? htmlspecialchars($_GET['precio_max']) : '' ?>">
        
        <button type="submit">Filtrar</button>
        <a href="?">Limpiar</a>
    </form>

    <?php if ($error_msg !== ""): ?>
        <p style="color: red; font-weight: bold;"><?= $error_msg ?></p>
    <?php endif; ?>

    <!-- Tabla que imprime los resultados filtrados -->
    <table border="1px solid black" style="border-collapse: collapse">
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>VTE</th>
        </tr>
        <?php 
        $totalPrecioExistenciasFiltrado = 0;
        $totalStockFiltrado = 0; // Guardará el stock total de los elementos filtrados
        
        foreach ($productos_filtrados as $p): 
            $Vstock = $p["stock"] * $p["precio"]; 
            $totalPrecioExistenciasFiltrado += $Vstock; 
            $totalStockFiltrado += $p["stock"];
        ?>
        <tr <?= ($p["stock"] < 3) ? 'style="background-color: cyan;"' : '' ?>>
            <td><?= $p["id"] ?></td>
            <td><?= htmlspecialchars($p["nombre"]) ?></td>
            <td><?= htmlspecialchars($p["categoria"]) ?></td>
            <td><?= number_format($p["precio"], 2, ",", ".") ?> €</td>
            <td><?= $p["stock"] ?> </td>
            <td><?= number_format($Vstock, 2, ",", ".") ?> €</td>
        </tr>
        <?php endforeach; ?>
        
        <!-- Mostramos totales según el inventario que esté en pantalla -->
        <tr>
            <td><strong>Total Filtrado</strong></td>
            <td></td>
            <td></td>
            <td></td>
            <td><strong><?= $totalStockFiltrado ?></strong></td>
            <td><strong><?= number_format($totalPrecioExistenciasFiltrado, 2, ",", ".") ?>€</strong></td>
        </tr>
    </table>

</body>
</html>
