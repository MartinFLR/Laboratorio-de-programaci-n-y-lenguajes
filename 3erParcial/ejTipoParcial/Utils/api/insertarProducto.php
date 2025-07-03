<?php
require_once __DIR__ . '/../dao/DAO.php';
header('Content-Type: application/json');

$input = json_decode(file_get_contents("php://input"), true);

$nombre = $input['nombre'];
$precio = $input['precio'];
$ubicacion = $input['ubicacion'];

$dao = new DAO();
$resultado = $dao->insertarProducto($nombre, $precio, $ubicacion);

echo json_encode(['insertado' => $resultado]);



//Y en el dao.php

public static function insertarProducto(string $nombre, float $precio, string $ubicacion): bool {
    $conn = Database::getConnection();
    $sql = "INSERT INTO productos (nombre, precio, ubicacion) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sds", $nombre, $precio, $ubicacion);
    return $stmt->execute();
}
