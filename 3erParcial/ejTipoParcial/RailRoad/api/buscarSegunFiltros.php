<?php
require_once __DIR__ . '/../clases/GestionViajes.php';
session_start();

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($_SESSION['gestor'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Gestor no encontrado']);
    exit;
}

if (!isset($data['ciudadOrigen']) || !isset($data['ciudadDestino'])) {
    http_response_code(400);
    echo json_encode(['error' => 'No fueron enviados los filtros']);
    exit;
}

/** @var GestionViajes */
$gestor = $_SESSION['gestor'];

/** @var Servicio[] */
$servicios = $gestor->filtrar($data['ciudadOrigen'], $data['ciudadDestino']);
$_SESSION['gestor'] = $gestor;

$resultados = [];
foreach ($servicios as $servicio) {
    $empresa = $servicio->getEmpresa(); // Obtener empresa para incluir info

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

    if ($empresa) {
        $obj->empresa = new stdClass();
        $obj->empresa->id = $empresa->getIdEmpresa();
        $obj->empresa->nombre = $empresa->getNombreEmpresa();
        $obj->empresa->pais = $empresa->getPaisEmpresa();
        $obj->empresa->web = $empresa->getWebEmpresa();
        $obj->empresa->logo = $empresa->getLogoEmpresa();
    }

    $resultados[] = $obj;
}

echo json_encode($resultados);
