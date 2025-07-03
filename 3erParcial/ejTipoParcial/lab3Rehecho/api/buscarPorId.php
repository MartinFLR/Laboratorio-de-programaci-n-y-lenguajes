<?php
require_once __DIR__ . '/../dao/DAO.php';
header('Content-Type: application/json');

// Recibir parámetros por GET en vez de leer JSON del body
$idProducto = intval(isset($_GET['idProducto']) ? trim($_GET['idProducto']) : 1);

$dao = new DAO();

$productos = DAO::buscarPorIdProducto($idProducto);

echo json_encode($productos);
