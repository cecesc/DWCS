<!--
• Crea las tres funciones sugeridas
• Añade calcularTotal() con descuento, envio y regalo
• Escribe tres llamadas de prueba con datos fijos
• Incorpora las funciones a compra.php
• Comprueba el caso Ana: total de 104,85 €.

FUNCIONES SUGERIDAS:
CalcularSubtotal(precio, cantidad);
CalcularDescuento(subtotal);
CalcularEnvio(modalidad);
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



    // PRUEBA 1
    $subtotal1 = calcularSubtotal(35.50, 2);
    $descuento1 = calcularDescuento($subtotal1);
    $envio1 = calcularEnvio('normal');
    $total1 = calcularTotal($subtotal1, 'normal', 0);

    // PRUEBA 2: ANA
    $subtotal2 = calcularSubtotal(35.50, 3);
    $descuento2 = calcularDescuento($subtotal2);
    $envio2 = calcularEnvio('urgente');
    $total2 = calcularTotal($subtotal2, 'urgente', 1);

    // PRUEBA 3
    $subtotal3 = calcularSubtotal(35.50, 4);
    $descuento3 = calcularDescuento($subtotal3);
    $envio3 = calcularEnvio('normal');
    $total3 = calcularTotal($subtotal3, 'normal', 1);
?>


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

    <hr/>
    <h2>Pruebas de las funciones</h2>

    <p><b>Prueba 1</b></p>
        <p>Subtotal: <?php echo $subtotal1; ?> €</p>
        <p>Descuento: <?php echo $descuento1; ?> €</p>
        <p>Envío: <?php echo $envio1; ?> €</p>
        <p>Total: <?php echo $total1; ?> €</p>
    <br><br>

    <p><b>Prueba 2</b></p>
        <p>Subtotal: <?php echo $subtotal2; ?> €</p>
        <p>Descuento: <?php echo $descuento2; ?> €</p>
        <p>Envío: <?php echo $envio2; ?> €</p>
        <p>Total: <?php echo $total2; ?> €</p>
    <br><br>

    <p><b>Prueba 3</b></p>
        <p>Subtotal: <?php echo $subtotal3; ?> €</p>
        <p>Descuento: <?php echo $descuento3; ?> €</p>
        <p>Envío: <?php echo $envio3; ?> €</p>
        <p>Total: <?php echo $total3; ?> €</p>
</body>
</html>
