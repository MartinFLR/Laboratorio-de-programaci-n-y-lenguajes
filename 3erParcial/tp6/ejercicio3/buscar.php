<?php
require_once 'conexion.php';

if (isset($_GET['nombre'])) {
    $nombre = trim($_GET['nombre']);

    $stmt = $conn->prepare("SELECT nombre, precio, stock FROM productos WHERE nombre LIKE ?");
    $like = "%$nombre%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li><strong>" . htmlspecialchars($row['nombre']) . "</strong>: $" . $row['precio'] . " | Stock: " . $row['stock'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "No se encontraron productos.";
    }

    $stmt->close();
    $conn->close();
}
?>
