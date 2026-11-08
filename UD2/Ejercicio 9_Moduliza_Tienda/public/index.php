<?php 

require_once __DIR__ . '/../src/funciones.php';
require __DIR__ . '/../src/catalogo.php';




$precio=35.50;
$stock=5;

$cliente_input='';
$cantidad_input='';
$entrega_input = '';
$pago_input = '';
$regalo_input = false;

$subtotal=0;
$total=0;
$envio = 0;
$coste_regalo = 0;

$error='';
$resultado=false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $cliente_input= $_POST['cliente'] ?? '';
    $cantidad_input= filter_input(INPUT_POST,'cantidad', FILTER_VALIDATE_INT);
    
    $entrega_input = $_POST['entrega'] ?? ''; //Lo que este '' es predeterminado
    $permitidas = ['normal', 'urgente'];

    $pago_input = $_POST['pago'] ?? '';
    
    $regalo_input = isset($_POST['regalo']);
    

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
        $error = 'Selecciona un método de pago.';
    
    
    }else {
        $subtotal = $cantidad_input * $precio;
        $descuento = 0;

        if ($subtotal >= 100) {
            $descuento = $subtotal * 0.10;
        }

        if ($entrega_input == 'normal') {
            $envio = 3;
        } elseif ($entrega_input == 'urgente') {
            $envio = 7;
        }

        if ($regalo_input) {
            $coste_regalo = 2;
        }

        $total = $subtotal - $descuento + $envio+ $coste_regalo;
        $resultado = true;
    }
}

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


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Auriculares</title>
</head>
<body>
    <h1>Tienda de Auriculares</h1>
    <p>Precio: <?php echo $precio ?> €</p>
    <p>Stock disponible: <?php echo $stock ?> unidades</p>

    <form action="" method="post">
    <label for="cliente">Nombre:</label><br/>
    <input id="cliente" name="cliente" type="text" value="<?php htmlspecialchars($cliente_input); ?>" required>
    <br/>
    
    <label for="cantidad">Cantidad:</label><br/>
    <input id="cantidad" name="cantidad" type="number" min="1" value="<?php htmlspecialchars($cantidad_input); ?>" required>
    <br/>

    <label for="entrega">Entrega:</label><br/>
    <select id="entrega" name="entrega">
        <option value="normal"<?php if ($entrega_input == 'normal') echo 'selected'; ?>>Normal (3 €)</option>
        <option value="urgente"<?php if ($entrega_input == 'urgente') echo 'selected'; ?>>Urgente (7 €)</option>
    </select>
    <br/>
    <br/>
    <label>
        <input type="radio" name="pago" value="tarjeta" <?php if ($pago_input == 'tarjeta' || $pago_input == '') echo 'checked'; ?>> Tarjeta
    </label>
    <label>
        <input type="radio" name="pago" value="transferencia" <?php if ($pago_input == 'transferencia') echo 'checked'; ?>> Transferencia
    </label>
    <br/>
    <br/>
    <label>
        <input type="checkbox" name="regalo" value="1" <?php if ($regalo_input) echo 'checked'; ?>>Envolver para regalo (+2 €)
    </label>
    <br/><br/>
    <button type="submit">Calcular compra</button>
    </form>
    <hr>
    <?php if(!empty($error)): ?>
        <?php echo $error ?>
    <?php endif; ?>


    <?php if($resultado): ?>
        <p><b>Cliente</b> <?php echo htmlspecialchars($cliente_input); ?></p>
        <p><b>Subtotal:</b> <?php echo $subtotal; ?> €</p>
        <p><b>Entrega:</b> <?php echo htmlspecialchars($entrega_input);?></p>
        <p><b>Gastos de envío:</b> <?php echo $envio; ?> €</p>
        <p><b>Pago:</b> <?php echo htmlspecialchars($pago_input);?></p>
        <p><b>Envoltorio de regalo:</b>
            <?php
            if ($regalo_input) {
                echo 'Sí';
            } else {
                echo 'No';
            }
            ?>
        </p>

        <p><b>Coste del regalo:</b> <?php echo $coste_regalo; ?> €</p>
        <p><b>Total:</b> <?php echo $total; ?> €</p>

    <?php endif; ?>

    <hr>

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