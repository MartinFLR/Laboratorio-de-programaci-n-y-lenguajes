<?php
require_once 'conexion.php';

// Mostrar producto y stock
if (!isset($_GET['codigo']) || !is_numeric($_GET['codigo'])) {
    http_response_code(400);
    echo "Falta el parámetro id o no es válido.";
    exit;
}

$id = intval($_GET['codigo']);

$sqlProducto = "
    SELECT 
        p.codigo, 
        p.nombreProducto, 
        p.precio, 
        p.proveedor, 
        COALESCE(SUM(s.cantidad), 0) AS stock_total
    FROM producto p
    LEFT JOIN stockproducto s ON p.codigo = s.codigo
    WHERE p.codigo = ?
    GROUP BY p.codigo, p.nombreProducto, p.precio, p.proveedor
";

$stmtProducto = $connection->prepare($sqlProducto);
$stmtProducto->bind_param("i", $id);
$stmtProducto->execute();
$resultProducto = $stmtProducto->get_result();

if ($resultProducto->num_rows === 0) {
    echo "Producto no encontrado.";
    exit;
}

$producto = $resultProducto->fetch_assoc();

// Lista fija de sucursales
$sucursales = ['Centro', 'Moreno', 'Pueyrredon', 'Rada Tilly', 'Sarmiento', 'Diadema', 'Norte', 'Saveedra', 'Sur'];

// Consultar stock existente para el producto
$sqlStock = "SELECT sucursal, cantidad, fechaAlta FROM stockproducto WHERE codigo = ?";
$stmtStock = $connection->prepare($sqlStock);
$stmtStock->bind_param("i", $id);
$stmtStock->execute();
$resultStock = $stmtStock->get_result();

// Armar array asociativo sucursal => datos stock
$stockPorSucursal = [];
while ($row = $resultStock->fetch_assoc()) {
    $stockPorSucursal[$row['sucursal']] = [
        'cantidad' => $row['cantidad'],
        'fechaAlta' => $row['fechaAlta'],
    ];
}

echo "<h2>" . htmlspecialchars($producto['nombreProducto']) . "</h2>";
echo "<p><strong>Proveedor:</strong> " . htmlspecialchars($producto['proveedor']) . "</p>";
echo "<p><strong>Precio:</strong> $" . htmlspecialchars($producto['precio']) . "</p>";
echo "<p><strong>Stock total:</strong> " . $producto['stock_total'] . "</p>";

echo "<h3>Stock por sucursal</h3>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<thead><tr><th>Sucursal</th><th>Cantidad</th><th>Fecha Alta</th><th>Acción</th></tr></thead><tbody>";

foreach ($sucursales as $sucursal) {
    $cantidad = isset($stockPorSucursal[$sucursal]) ? $stockPorSucursal[$sucursal]['cantidad'] : 0;
    $fechaAlta = isset($stockPorSucursal[$sucursal]) ? $stockPorSucursal[$sucursal]['fechaAlta'] : '-';

    $sucursalHtml = htmlspecialchars($sucursal);
    $cantidadHtml = htmlspecialchars($cantidad);
    $fechaAltaHtml = $fechaAlta !== '-' ? htmlspecialchars($fechaAlta) : '-';

    echo "<tr>";
    echo "<td>$sucursalHtml</td>";
    echo "<td>$cantidadHtml</td>";
    echo "<td>$fechaAltaHtml</td>";
    echo "<td><button class='btnAgregarStock' data-sucursal='$sucursalHtml'>Agregar Stock</button></td>";
    echo "</tr>";
}

echo "</tbody></table>";

$stmtProducto->close();
$stmtStock->close();
$connection->close();
?>
