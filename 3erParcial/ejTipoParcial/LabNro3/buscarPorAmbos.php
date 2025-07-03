<?php
require_once __DIR__ . '/clases/Gestor.php';

header('Content-Type: application/json');

$textoProductos = ($_GET['textoProductos']||"");
$textoUbicacion = ($_GET['textoUbicacion']||"");


$gestor = new Gestor();

$productos = DAO::buscarProductosPorAmbos($textoProductos,$textoUbicacion);
                

echo json_encode($productos);
