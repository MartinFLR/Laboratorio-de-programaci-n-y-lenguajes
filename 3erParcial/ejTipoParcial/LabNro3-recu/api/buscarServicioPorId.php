<?php
require_once __DIR__ . '/../dao/DAO.php';
header('Content-Type: application/json');

$idServicio = intval(trim($_GET['idServicio']));

$dao = new DAO();

$detalleServicio = DAO::buscarPorIdServicio($idServicio);

echo json_encode($detalleServicio);
