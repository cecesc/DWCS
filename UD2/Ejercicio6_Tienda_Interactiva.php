<!--
Crea un formulario que pida:
• Nombre del cliente (texto).
• Cantidad de auriculares (número).
Datos fijos en PHP: precio = 35,50 €; stock = 5.
Si la cantidad es válida y hay stock, muestra nombre, subtotal y total.
Aplica un 10 % de descuento cuando el subtotal sea ≥ 100 €.
Si la cantidad es inválida o supera el stock, muestra un aviso

PISTAS PARA RESOLVERLO
• Usa method="post" y action="" para enviar al mismo archivo.
• Comprueba $_SERVER['REQUEST_METHOD'] === 'POST'.
• Lee el nombre con $_POST['cliente'] ?? ''.
• Valida la cantidad con filter_input(..., FILTER_VALIDATE_INT).
• Comprueba cantidad > 0 y cantidad <= stock.
• Al imprimir el nombre, utiliza htmlspecialchars(...)


ORDEN
1. Validar nombre y cantidad
2. Validad entrega, pago y envoltorio
3. Calcular subtotal y descuento de productos.
4. Añadir gastos de envío y envoltorio.
5. Mostrar el desglose y el total


EXTRA
Conserva los valores introducidos después de enviar el formulario.
Envío gratuito si el subtotal tras descuento alcanza 90 €.

-->
<?php 
$precio=35.50;
$stock=5;

// Inicializamos las variables vacías para que la primera carga no tenga valores predefinidos por la fuerza
$cliente_input='';
$cantidad_input='';
$entrega_input = '';
$pago_input = '';
$regalo_input = false;

$subtotal=0;
$descuento=0;
$total=0;
$envio = 0;
$coste_regalo = 0;
$subtotal_con_descuento = 0;
$envio_gratis = false;

$error='';
$resultado=false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Recogida de datos
    $cliente_input= $_POST['cliente'] ?? '';
    $cantidad_input= filter_input(INPUT_POST,'cantidad', FILTER_VALIDATE_INT);
    
    $entrega_input = $_POST['entrega'] ?? ''; //Lo que este '' es predeterminado
    $permitidas = ['normal', 'urgente'];

    $pago_input = $_POST['pago'] ?? '';
    
    $regalo_input = isset($_POST['regalo']);

    // 2. Validación de datos
    if (trim($cliente_input) == '') {
        $error = 'Introduce un nombre válido.';
    }elseif ($cantidad_input === false || $cantidad_input === null) {
        $error= 'Introduce una cantidad entera válida.';
    } elseif ($cantidad_input <= 0) {
        $error = 'La cantidad debe ser mayor que cero.';
    } elseif ($cantidad_input > $stock) {
        $error= 'No hay suficiente stock disponible.';
    


    }elseif (!in_array($entrega_input, $permitidas, true)) {
        $error = 'Entrega no válida.';
    } elseif ($pago_input !== "tarjeta" && $pago_input !== "transferencia") {
        $error = 'Selecciona un método de pago válido.';
    
    
    }else {
        // 3. Cálculos
        $subtotal = $cantidad_input * $precio;

        if ($subtotal >= 100) {
            $descuento = $subtotal * 0.10;
        }

        if ($subtotal_con_descuento >= 90) {
            $envio = 0;
            $envio_gratis = true;
        } else {
            if ($entrega_input === 'normal') {
                $envio = 3;
            } elseif ($entrega_input === 'urgente') {
                $envio = 7;
            }
        }


        if ($regalo_input) {
            $coste_regalo = 2;
        }

        $total = $subtotal - $descuento + $envio+ $coste_regalo;
        $resultado = true;
    }
}

?>


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
    <p>Stock disponible: <?php echo $stock ?> unidades</p>

    <form action="" method="post">
    <!-- Nombre: Conserva el texto impreso con echo -->
    <label for="cliente">Nombre:</label><br/>
    <input id="cliente" name="cliente" type="text" value="<?php htmlspecialchars($cliente_input); ?>" required>
    <br/><br/>
    
    <!-- Cantidad: Conserva el número impreso con echo -->
    <label for="cantidad">Cantidad:</label><br/>
    <input id="cantidad" name="cantidad" type="number" min="1" max="<?php echo $stock; ?>" value="<?php echo htmlspecialchars($cantidad_input); ?>" required>
    <br/><br/>

     <!-- Entrega: Comprueba qué opción se seleccionó -->
    <label for="entrega">Entrega:</label><br/>
    <select id="entrega" name="entrega">
        <option value="normal"<?php if ($entrega_input === 'normal') echo 'selected'; ?>>Normal (3 €)</option>
        <option value="urgente"<?php if ($entrega_input === 'urgente') echo 'selected'; ?>>Urgente (7 €)</option>
    </select>
    <br/> <br/>
   
    <!-- Pago: Si está vacío (primera carga) marca tarjeta por defecto; si se envió, recuerda la selección -->
    <label>Método de pago:</label><br/>
    <label>
        <input type="radio" name="pago" value="tarjeta" <?php if ($pago_input === 'tarjeta') echo 'checked'; ?>> Tarjeta
    </label>
    <label>
        <input type="radio" name="pago" value="transferencia" <?php if ($pago_input == 'transferencia') echo 'checked'; ?>> Transferencia
    </label>
    <br/><br/>

    <!-- Regalo: Si se marcó previamente, se añade el atributo checked -->
    <label>Extra:</label><br/>
    <label>
        <input type="checkbox" name="regalo" value="1" <?php if ($regalo_input) echo 'checked'; ?>>Envolver para regalo (+2 €)
    </label>
    <br/><br/>

    <button type="submit">Calcular compra</button>
    </form>

    <hr>

    <?php if(!empty($error)): ?>
         <p style="color: red;"><b>Error:</b> <?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>


     <?php if ($resultado): ?>
        <h2>Resumen del pedido</h2>
        <p><b>Cliente:</b> <?php echo htmlspecialchars($cliente_input); ?></p>
        <p><b>Cantidad:</b> <?php echo $cantidad_input; ?> unidades</p>
        <p><b>Subtotal:</b> <?php echo number_format($subtotal, 2, ',', '.'); ?> €</p>
        
        <?php if ($descuento > 0): ?>
            <p><b>Descuento (10%):</b> -<?php echo number_format($descuento, 2, ',', '.'); ?> €</p>
            <p><b>Subtotal neto:</b> <?php echo number_format($subtotal_con_descuento, 2, ',', '.'); ?> €</p>
        <?php endif; ?>

        <p>
            <b>Gastos de envío (<?php echo ucfirst($entrega_input); ?>):</b> 
            <?php if ($envio_gratis): ?>
                <span style="color: green; font-weight: bold;">0,00 € (¡Promoción Envío Gratuito!)</span>
            <?php else: ?>
                <?php echo number_format($envio, 2, ',', '.'); ?> €
            <?php endif; ?>
        </p>

        <p><b>Método de pago:</b> <?php echo ucfirst($pago_input); ?></p>
        <p><b>Envoltorio de regalo:</b> <?php echo $regalo_input ? "Sí (+2 €)" : "No"; ?></p>
        <p><b>Total a pagar:</b> <?php echo number_format($total, 2, ',', '.'); ?> €</p>
    <?php endif; ?>
</body>
</html>