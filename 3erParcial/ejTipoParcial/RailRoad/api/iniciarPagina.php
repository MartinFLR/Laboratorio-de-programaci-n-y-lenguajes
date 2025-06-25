<?php
//aca si o si tiene que estar la session primero
session_start();
require_once __DIR__ . '/../clases/GestionViajes.php';

$gestor = new GestionViajes();
$gestor->iniciarPagina(); 

header('Content-Type: application/json');

$obj = new stdClass;
$obj->ciudadesOrigen = $gestor->getCiudadesOrigen();
$obj->ciudadesDestino = $gestor->getCiudadesDestino();

echo json_encode($obj);
