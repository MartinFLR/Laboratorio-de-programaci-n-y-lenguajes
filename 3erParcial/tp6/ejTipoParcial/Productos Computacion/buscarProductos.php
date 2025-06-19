<?php
require_once 'conexion.php';

//Preparar la consulta SQL segura (statement preparado)
$stmt = $connection->prepare("SELECT codigo, nombreProducto, precio, proveedor FROM producto ");

//Ejecutar la consulta
$stmt->execute();

//Obtener el resultado
//Se obtiene el conjunto de filas resultantes de la consulta.
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<ul>";
    //Por cada fila
    //Se imprime un <li> con la descripción y el precio.
    while ($row = $result->fetch_assoc()) {
        //fetch_assoc() es un método de un objeto resultado
        //que devuelve la siguiente fila del resultado como un array asociativo.
        //devuelve false cuando ya no quedan más filas para leer del resultado de la consulta.
        echo "<li><a href='#' class='producto' data-id='" . $row['codigo'] . "'>" .
            "<strong>" . htmlspecialchars($row['nombreProducto']) . "</strong>: $" . $row['precio'] . $row['proveedor'] .
            "</a></li>";
    }
    echo "</ul>";
} else {
    echo "No se encontraron productos.";
}

$stmt->close();
$connection->close();
