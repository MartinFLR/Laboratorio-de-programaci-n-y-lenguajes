<?php

require_once __DIR__ . '/../clases/GestorJuego.php';

session_start();

header('Content-Type: application/json');

if (!isset($_SESSION['gestor'])) {
    http_response_code(400);
    echo json_encode(['error' => 'No hay partida iniciada']);
    exit;
}

$gestor = $_SESSION['gestor'];

$pista = $gestor->darPista();

$_SESSION['gestor'] = $gestor; // Guardar el estado actualizado

//Aca transformo ese objeto en solo el parametro que necesita el front tranca
//Me di cuenta tarde pero aca hay alta data cuchen
//a json_encode le podes pasar un objeto no hay drama, pero los atributos tiene que esta SI O SI
//en publico, sino no te deja, por eso lo armo asi yo aca y no le paso directamente el obj y a la mierda
if ($pista) {
    echo json_encode(['pista' => $pista->getPista()]);
} else {
    echo json_encode(['pista' => null]);
}

//De todas formas safa mas asi podria decirse, porque sino en mi php tendria que hacer un metodo toArray()
