<?php
require_once __DIR__ . '/../clases/GestionViajes.php';
session_start();

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['idEmpresa'])) {
    http_response_code(400);
    echo json_encode(['error' => 'No se envió intento']);
    exit;
}
$gestor = new GestionViajes();

/** @var Servicio[] */
$servicios = $gestor->buscarEmpresa($data['idEmpresa']);

echo json_encode($servicios);