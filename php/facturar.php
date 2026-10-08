<?php
const IVA = 12;
const LIMITE_DESCUENTO = 150;
const DESCUENTO = 15;

function formatear($valor)
{
    return number_format($valor, 2, ',', '.') . ' $';
}

$descripcion = trim($_POST['descripcion'] ?? '');
$cantidad = $_POST['cantidad'] ?? '';
$precio = $_POST['precio'] ?? '';

$valido = $descripcion !== ''
    && is_numeric($cantidad) && $cantidad > 0
    && is_numeric($precio) && $precio > 0;

if ($valido) {
    $subtotal = $cantidad * $precio;
    $montoIva = $subtotal * IVA / 100;
    $totalVenta = $subtotal + $montoIva;
    $aplicaDescuento = $totalVenta > LIMITE_DESCUENTO;
    $montoDescuento = $aplicaDescuento ? $totalVenta * DESCUENTO / 100 : 0;
    $totalPagar = $totalVenta - $montoDescuento;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <main class="contenedor">
        <h1>Factura</h1>

        <?php if (!$valido): ?>
            <p class="error">Datos incompletos o inválidos. Verifique el formulario.</p>
        <?php else: ?>
            <table>
                <tr>
                    <th>Artículo</th>
                    <td class="monto"><?= htmlspecialchars($descripcion) ?></td>
                </tr>
                <tr>
                    <th>Cantidad</th>
                    <td class="monto"><?= htmlspecialchars($cantidad) ?></td>
                </tr>
                <tr>
                    <th>Precio unitario</th>
                    <td class="monto"><?= formatear($precio) ?></td>
                </tr>
                <tr>
                    <th>Subtotal</th>
                    <td class="monto"><?= formatear($subtotal) ?></td>
                </tr>
                <tr>
                    <th>IVA (<?= IVA ?>%)</th>
                    <td class="monto"><?= formatear($montoIva) ?></td>
                </tr>
                <tr>
                    <th>Total con IVA</th>
                    <td class="monto"><?= formatear($totalVenta) ?></td>
                </tr>
                <tr>
                    <th>Descuento (<?= DESCUENTO ?>%)</th>
                    <td class="monto">
                        <?php if ($aplicaDescuento): ?>
                            Sí aplica: - <?= formatear($montoDescuento) ?>
                        <?php else: ?>
                            No aplica
                        <?php endif; ?>
                    </td>
                </tr>
                <tr class="total">
                    <th>Total a pagar</th>
                    <td class="monto"><?= formatear($totalPagar) ?></td>
                </tr>
            </table>
        <?php endif; ?>

        <a class="boton" href="../index.html">Nueva factura</a>
    </main>
</body>
</html>
