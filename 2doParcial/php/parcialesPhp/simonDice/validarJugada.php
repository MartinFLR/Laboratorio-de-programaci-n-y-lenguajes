<?php
require_once 'gestorJuego.php';
require_once 'cookieManager.php';
require_once 'arrayUtils.php';

$cookieManager = new CookieManager();
$cantidad = $cookieManager->get('cantidad');

$gestorJuego = new GestorJuego($cantidad);
$vidas = $gestorJuego->getVidaActual();

function renderFormulario(): void {
    echo <<<HTML
    <form method='post' action='validarJugada.php'>
        <div>
            <label for='respuesta'>Ingrese la secuencia</label>
            <input type='text' id='respuesta' name='respuesta' placeholder='Ej: abcd...' required autofocus>
        </div>
        <button id='botonEnviar'>Enviar</button>
    </form>
    HTML;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $respuesta = trim($_POST['respuesta']);

    if ($gestorJuego->validarRespuesta($respuesta)) {
        echo "<h2>¡Correcto! Pasaste al siguiente nivel</h2>";
    } else {
        echo "<h2>¡Incorrecto! Te quedan: $vidas vidas</h2>";
    }

    renderFormulario();

    $letrasMostradas = array_slice($gestorJuego->arraySecreto, 0, $gestorJuego->turno + 1);
    $proximaLetra = $gestorJuego->arraySecreto[$gestorJuego->turno] ?? '-';
    $arrayToString = implode('', $letrasMostradas);

    echo "<p><strong>Letra nueva agregada:</strong> $proximaLetra</p>";
    echo "<p><strong>Secuencia actual esperada:</strong> $arrayToString</p>";
} else {
    renderFormulario();
    $primeraLetra = $gestorJuego->arraySecreto[0];
    echo "<p>Primera letra: <strong>$primeraLetra</strong></p>";
}
