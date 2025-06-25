<?php
require_once __DIR__ . '/../clases/GestionViajes.php';
session_start();

header('Content-Type: application/json');

//Arriesgar es un POST, en el que el usuario me pasa su intento
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($_SESSION['gestor'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Partida no iniciada']);
    exit;
}

if (!isset($data['idEmpresa'])) {
    http_response_code(400);
    echo json_encode(['error' => 'No se envió intento']);
    exit;
}
/** @var GestionViajes */
$gestor = $_SESSION['gestor'];

/** @var Servicio[] */
$servicios = $gestor->buscarEmpresa($data['idEmpresa']);
$_SESSION['gestor'] = $gestor;

$resultados = [];
foreach ($servicios as $servicio) {
    $obj = new stdClass();
    $obj->idServicio = $servicio->getIdServicio();
    $obj->nroServicio = $servicio->getNroServicio();
    $obj->ciudadOrigenServicio = $servicio->getCiudadOrigenServicio();
    $obj->ciudadDestinoServicio = $servicio->getCiudadDestinoServicio();
    $obj->estacionOrigenServicio = $servicio->getEstacionOrigenServicio();
    $obj->estacionDestinoServicio = $servicio->getEstacionDestinoServicio();
    $obj->horaSalidaServicio = $servicio->getHoraSalidaServicio();
    $obj->horaLlegadaServicio = $servicio->getHoraLlegadaServicio();
    $obj->frecuenciaServicio = $servicio->getFrecuenciaServicio();
    $obj->precioServicio = $servicio->getPrecioServicio();
    $obj->idEmpresa = $servicio->getIdEmpresa();
        $resultados[] = $obj;
}

echo json_encode($resultados);