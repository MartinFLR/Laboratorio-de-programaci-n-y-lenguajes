<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = isset($_POST['codigo']) ? intval($_POST['codigo']) : 0;
    $sucursal = isset($_POST['sucursal']) ? trim($_POST['sucursal']) : '';
    $cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : 0;

    if ($codigo > 0 && $sucursal !== '' && $cantidad > 0) {
        // Verificar si ya existe el stock para ese producto y sucursal
        $sqlCheck = "SELECT cantidad FROM stockproducto WHERE codigo = ? AND sucursal = ?";
        $stmtCheck = $connection->prepare($sqlCheck);
        $stmtCheck->bind_param("is", $codigo, $sucursal);
        $stmtCheck->execute();
        $resultCheck = $stmtCheck->get_result();

        if ($resultCheck->num_rows > 0) {
            $row = $resultCheck->fetch_assoc();
            $nuevaCantidad = $row['cantidad'] + $cantidad;

            $sqlUpdate = "UPDATE stockproducto SET cantidad = ?, fechaAlta = NOW() WHERE codigo = ? AND sucursal = ?";
            $stmtUpdate = $connection->prepare($sqlUpdate);
            $stmtUpdate->bind_param("iis", $nuevaCantidad, $codigo, $sucursal);
            $stmtUpdate->execute();
            $stmtUpdate->close();
        } else {
            $sqlInsert = "INSERT INTO stockproducto (codigo, sucursal, cantidad, fechaAlta) VALUES (?, ?, ?, NOW())";
            $stmtInsert = $connection->prepare($sqlInsert);
            $stmtInsert->bind_param("isi", $codigo, $sucursal, $cantidad);
            $stmtInsert->execute();
            $stmtInsert->close();
        }

        $stmtCheck->close();

        http_response_code(200);
        echo "Stock agregado correctamente";
    } else {
        http_response_code(400);
        echo "Datos inválidos";
    }
} else {
    http_response_code(405);
    echo "Método no permitido";
}
