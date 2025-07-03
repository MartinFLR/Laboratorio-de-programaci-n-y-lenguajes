<?php
require_once __DIR__ . '/../dao/DAO.php';
header('Content-Type: application/json');

// Recibir parámetros por GET en vez de leer JSON del body
$textoProducto = isset($_GET['textoProducto']) ? trim($_GET['textoProducto']) : "";
$textoUbicacion = isset($_GET['textoUbicacion']) ? trim($_GET['textoUbicacion']) : "";

$dao = new DAO();

$productos = DAO::buscarPorTexto($textoProducto,$textoUbicacion);

echo json_encode($productos);
