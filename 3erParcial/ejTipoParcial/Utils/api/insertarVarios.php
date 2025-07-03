<?php
require_once __DIR__ . '/../dao/DAO.php';
header('Content-Type: application/json');

$input = json_decode(file_get_contents("php://input"), true);
// $input debe ser un array de productos: [{nombre, precio, ubicacion}, ...]

$dao = new DAO();
$resultados = [];

foreach ($input as $prod) {
    $resultados[] = $dao->insertarProducto(
        $prod['nombre'],
        $prod['precio'],
        $prod['ubicacion']
    );
}

echo json_encode(['insertados' => $resultados]);
