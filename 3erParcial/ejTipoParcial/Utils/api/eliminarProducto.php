<?php
require_once __DIR__ . '/../dao/DAO.php';
header('Content-Type: application/json');

$idProducto = intval($_GET['idProducto'] ?? 0);

$dao = new DAO();
$resultado = $dao->eliminarProducto($idProducto);

echo json_encode(['eliminado' => $resultado]);


//y en el dao

public function eliminarProducto(int $id): bool {
    $conn = Database::getConnection();
    $sql = "DELETE FROM productos WHERE idProducto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}
