<?php
require_once __DIR__ . '/../baseDatos.php';
require_once __DIR__ . '/../clases/Producto.class.php';
require_once __DIR__ . '/../clases/Supermercado.class.php';


class DAO {

public static function buscarPorTexto(string $textoProducto, string $textoUbicacion) {
    $conn = Database::getConnection();
    $sql = "SELECT p.id_producto, p.nombre, pre.precio, s.id_supermercado, s.nombre as nombreSupermercado, s.ubicacion
    FROM producto as p
    JOIN precios as pre ON p.id_producto = pre.id_producto
    JOIN supermercado as s ON pre.id_supermercado = s.id_supermercado
    WHERE p.nombre LIKE ? AND s.ubicacion LIKE ? ";

    $stmt = $conn->prepare($sql);

    if (!$stmt) throw new Exception("Error preparando: " . $conn->error);

    $likeProducto = "%$textoProducto%";
    $likeUbicacion = "%$textoUbicacion%";

    $stmt->bind_param("ss", $likeProducto, $likeUbicacion);
    $stmt->execute();

    $result = $stmt->get_result();
    $palabras = [];
    while ($row = $result->fetch_assoc()) {
        $palabras[] = new Producto(
            $row['id_producto'], 
            $row['nombre'],
            $row['precio'],
            $row['id_supermercado'],
            $row['nombreSupermercado'],
            $row['ubicacion'],
        );
    }

    return $palabras;
}

public static function buscarPorIdProducto(int $idProducto) {
    $conn = Database::getConnection();
    $sql = "SELECT s.id_supermercado, s.nombre as nombreSupermercado, pre.precio, s.ubicacion
    FROM producto as p
    JOIN precios as pre ON p.id_producto = pre.id_producto
    JOIN supermercado as s ON pre.id_supermercado = s.id_supermercado
    WHERE p.id_producto = ? 
    ORDER BY pre.precio ASC";

    $stmt = $conn->prepare($sql);

    if (!$stmt) throw new Exception("Error preparando: " . $conn->error);


    $stmt->bind_param("i", $idProducto);
    $stmt->execute();

    $result = $stmt->get_result();
    $palabras = [];
    while ($row = $result->fetch_assoc()) {
        $palabras[] = new Supermercado(
            $row['id_supermercado'],
            $row['nombreSupermercado'],
            $row['precio'],
            $row['ubicacion'],
        );
    }

    return $palabras;
}



}