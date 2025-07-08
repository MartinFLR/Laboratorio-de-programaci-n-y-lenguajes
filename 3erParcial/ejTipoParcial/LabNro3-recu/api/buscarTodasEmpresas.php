<?php
require_once __DIR__ . '/../dao/DAO.php';
header('Content-Type: application/json');

$dao = new DAO();

$productos = DAO::buscarTodasEmpresas();

echo json_encode($productos);
