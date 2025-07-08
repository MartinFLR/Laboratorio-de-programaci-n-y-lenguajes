<?php
require_once __DIR__ . '/../dao/DAO.php';
header('Content-Type: application/json');

$nombreEmpresa = isset($_GET['nombreEmpresa']) ? trim($_GET['nombreEmpresa']) : "Flecha Bus";
$dia = isset($_GET['dia']) ? trim($_GET['dia']) : "lunes";

$dao = new DAO();

$servicios = DAO::buscarPorFiltros($nombreEmpresa,$dia);

echo json_encode($servicios);
