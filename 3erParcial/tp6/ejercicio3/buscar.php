<?php
require_once 'conexion.php';

if (isset($_GET['descripcion'])) {
    $descripcion = trim($_GET['descripcion']);
    
    //Preparar la consulta SQL segura (statement preparado)
    $stmt = $connection->prepare("SELECT descripcion, precio FROM productos WHERE descripcion LIKE ?");

    //Construir el patrón para la búsqueda con comodines %
    //Así se busca cualquier descripción que contenga el texto $descripcion en cualquier parte.
    $like = "%$descripcion%";

    //Vincular el parámetro a la consulta preparada
    //Aquí se pasa el parámetro $like con tipo "s" (string) para evitar inyección SQL y que la consulta sea segura.
    $stmt->bind_param("s", $like);

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
            echo "<li><strong>" . htmlspecialchars($row['descripcion']) . "</strong>: $" . $row['precio']. "</li>";
        }
        echo "</ul>";
    } else {
        echo "No se encontraron productos.";
    }

    $stmt->close();
    $connection->close();
}
?>
