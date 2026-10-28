<!--
/*
Crea un formulario que pida:
• Nombre del cliente (texto).
• Cantidad de auriculares (número).
Datos fijos en PHP: precio = 35,50 €; stock = 5.
Si la cantidad es válida y hay stock, muestra nombre, subtotal y total.
Aplica un 10 % de descuento cuando el subtotal sea ≥ 100 €.
Si la cantidad es inválida o supera el stock, muestra un aviso

ORDEN
1. Validar nombre y cantidad
2. Validad entrega, pago y envoltorio
3. Calcular subtotal y descuento de productos.
4. Añadir gastos de envío y envoltorio.
5. Mostrar el desglose y el total
*/
-->
<?php 
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
</body>
</html>