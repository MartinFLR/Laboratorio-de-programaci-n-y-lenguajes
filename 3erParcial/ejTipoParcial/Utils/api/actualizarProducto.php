<?php
require_once __DIR__ . '/../dao/DAO.php';
header('Content-Type: application/json');

$input = json_decode(file_get_contents("php://input"), true);

$id = intval($input['idProducto']);
$nombre = $input['nombre'];
$precio = $input['precio'];
$ubicacion = $input['ubicacion'];

$dao = new DAO();
$resultado = $dao->actualizarProducto($id, $nombre, $precio, $ubicacion);

echo json_encode(['actualizado' => $resultado]);


//y en el DAO

public static function actualizarProducto(int $id, string $nombre, float $precio, string $ubicacion): bool {
    $conn = Database::getConnection();
    $sql = "UPDATE productos SET nombre = ?, precio = ?, ubicacion = ? WHERE idProducto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdsi", $nombre, $precio, $ubicacion, $id);
    return $stmt->execute();
}
