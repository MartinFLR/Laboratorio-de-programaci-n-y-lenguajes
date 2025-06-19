<?php
require_once 'conexion.php';

// Procesar POST para agregar stock (lo pongo arriba para que se procese antes de mostrar la tabla)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codigo'], $_POST['sucursal'], $_POST['cantidad'])) {
    $codigoPOST = intval($_POST['codigo']);
    $sucursalPOST = trim($_POST['sucursal']);
    $cantidadPOST = intval($_POST['cantidad']);

    if ($codigoPOST > 0 && $sucursalPOST !== '' && $cantidadPOST > 0) {
        $sqlCheck = "SELECT cantidad FROM stockproducto WHERE codigo = ? AND sucursal = ?";
        $stmtCheck = $connection->prepare($sqlCheck);
        $stmtCheck->bind_param("is", $codigoPOST, $sucursalPOST);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();

        if ($resultCheck->num_rows > 0) {
            $row = $resultCheck->fetch_assoc();
            $nuevaCantidad = $row['cantidad'] + $cantidadPOST;

            $sqlUpdate = "UPDATE stockproducto SET cantidad = ?, fechaAlta = NOW() WHERE codigo = ? AND sucursal = ?";
            $stmtUpdate = $connection->prepare($sqlUpdate);
            $stmtUpdate->bind_param("iis", $nuevaCantidad, $codigoPOST, $sucursalPOST);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        } else {
            $sqlInsert = "INSERT INTO stockproducto (codigo, sucursal, cantidad, fechaAlta) VALUES (?, ?, ?, NOW())";
            $stmtInsert = $connection->prepare($sqlInsert);
            $stmtInsert->bind_param("isi", $codigoPOST, $sucursalPOST, $cantidadPOST);
            $stmtInsert->execute();
            $stmtInsert->close();
        }

        $stmtCheck->close();

        // Redirigir para evitar reenvío
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    } else {
        echo "<p style='color:red;'>Datos inválidos para agregar stock.</p>";
    }
}

// Código para mostrar producto y stock (igual que antes)
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

$sqlStock = "
    SELECT sucursal, cantidad, fechaAlta
    FROM stockproducto
    WHERE codigo = ?
";

$stmtStock = $connection->prepare($sqlStock);
$stmtStock->bind_param("i", $id);
$stmtStock->execute();
$resultStock = $stmtStock->get_result();

echo "<h2>" . htmlspecialchars($producto['nombreProducto']) . "</h2>";
echo "<p><strong>Proveedor:</strong> " . htmlspecialchars($producto['proveedor']) . "</p>";
echo "<p><strong>Precio:</strong> $" . htmlspecialchars($producto['precio']) . "</p>";
echo "<p><strong>Stock total:</strong> " . $producto['stock_total'] . "</p>";

echo "<h3>Stock por sucursal</h3>";

if ($resultStock->num_rows > 0) {
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<thead><tr><th>Sucursal</th><th>Cantidad</th><th>Fecha Alta</th><th>Acción</th></tr></thead><tbody>";

    while ($row = $resultStock->fetch_assoc()) {
        $sucursal = htmlspecialchars($row['sucursal']);
        echo "<tr>";
        echo "<td>$sucursal</td>";
        echo "<td>" . htmlspecialchars($row['cantidad']) . "</td>";
        echo "<td>" . htmlspecialchars($row['fechaAlta']) . "</td>";
        echo "<td><button class='btnAgregarStock' data-sucursal='$sucursal'>Agregar Stock</button></td>";
        echo "</tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p>No hay stock registrado en sucursales.</p>";
}

$stmtProducto->close();
$stmtStock->close();
$connection->close();
?>


