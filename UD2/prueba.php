<?php
$nombre='Lucía';
$curso= 2;

echo "<h1>Hola $nombre </h1>";
echo "<p>Curso: {$curso}</p>";

?>
// ; despues de Lucia
// echo "
// $Nombre es en minuscula
// corchetes en $curso























<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Auriculares</title>
</head>

<body>

    <h1>Tienda de Auriculares</h1>

    <p>Precio: <?php echo number_format($precio, 2, ',', '.'); ?> €</p>
    <p>Stock disponible: <?php echo $stock; ?> unidades</p>

    <form action="" method="post">

        <label for="cliente">Nombre:</label><br>
        <input id="cliente" name="cliente" type="text"
            value="<?php echo htmlspecialchars($cliente_input); ?>" required>

        <br>

        <label for="cantidad">Cantidad:</label><br>
        <input id="cantidad" name="cantidad" type="number" min="1"
            value="<?php echo htmlspecialchars((string)$cantidad_input); ?>" required>

        <br>

        <label for="entrega">Entrega:</label><br>

        <select id="entrega" name="entrega">

            <option value="normal"
                <?php if ($entrega_input == 'normal') echo 'selected'; ?>>
                Normal (3 €)
            </option>

            <option value="urgente"
                <?php if ($entrega_input == 'urgente') echo 'selected'; ?>>
                Urgente (7 €)
            </option>

        </select>

        <br><br>

        <label>
            <input type="radio" name="pago" value="tarjeta"
                <?php if ($pago_input == 'tarjeta' || $pago_input == '') echo 'checked'; ?>>
            Tarjeta
        </label>

        <label>
            <input type="radio" name="pago" value="transferencia"
                <?php if ($pago_input == 'transferencia') echo 'checked'; ?>>
            Transferencia
        </label>

        <br><br>

        <label>
            <input type="checkbox" name="regalo" value="1"
                <?php if ($regalo_input) echo 'checked'; ?>>
            Envolver para regalo (+2 €)
        </label>

        <br><br>

        <button type="submit">Calcular compra</button>

    </form>

    <hr>

    <?php if (!empty($error)): ?>

        <p style="color:red;">
            <?php echo htmlspecialchars($error); ?>
        </p>

    <?php endif; ?>


    <?php if ($resultado): ?>

        <h2>Resultado de la compra</h2>

        <p><b>Cliente:</b>
            <?php echo htmlspecialchars($cliente_input); ?>
        </p>

        <p><b>Subtotal:</b>
            <?php echo number_format($subtotal, 2, ',', '.'); ?> €
        </p>

        <p><b>Descuento:</b>
            <?php echo number_format($descuento, 2, ',', '.'); ?> €
        </p>

        <p><b>Entrega:</b>
            <?php echo htmlspecialchars($entrega_input); ?>
        </p>

        <p><b>Gastos de envío:</b>
            <?php echo number_format($envio, 2, ',', '.'); ?> €
        </p>

        <p><b>Pago:</b>
            <?php echo htmlspecialchars($pago_input); ?>
        </p>

        <p><b>Envoltorio de regalo:</b>
            <?php echo $regalo_input ? 'Sí' : 'No'; ?>
        </p>

        <p><b>Coste del regalo:</b>
            <?php echo number_format($coste_regalo, 2, ',', '.'); ?> €
        </p>

        <h3>Total:
            <?php echo number_format($total, 2, ',', '.'); ?> €
        </h3>

    <?php endif; ?>


    <hr>

    <h2>Pruebas de las funciones</h2>

    <h3>Prueba 1</h3>
    <p>2 auriculares, entrega normal, sin regalo.</p>
    <p><b>Subtotal:</b> 71 €</p>
    <p><b>Total:</b> <?php echo number_format($prueba1, 2, ',', '.'); ?> €</p>

    <h3>Prueba 2 - Ana</h3>
    <p>3 auriculares, entrega urgente, con regalo.</p>
    <p><b>Subtotal:</b> 106,50 €</p>
    <p><b>Total:</b> <?php echo number_format($prueba2, 2, ',', '.'); ?> €</p>

    <h3>Prueba 3</h3>
    <p>4 auriculares, entrega normal, con regalo.</p>
    <p><b>Subtotal:</b> 142 €</p>
    <p><b>Total:</b> <?php echo number_format($prueba3, 2, ',', '.'); ?> €</p>

</body>
</html>