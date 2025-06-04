<?php
require_once 'gestorJuego.php';
require_once 'cookieManager.php';
require_once 'arrayUtils.php';

$cookieManager = new CookieManager();

$gestorJuego = new GestorJuego($cookieManager->get('cantidad'));
$vidas = $gestorJuego->getVidaActual();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $respuesta = trim($_POST['respuesta']);

    if($gestorJuego->validarRespuesta($respuesta)){
        echo "<form method='post' action='validarJugada.php'>
        
        <div>
            <label for='respuesta'>Ingrese la secuencia</label>
            <input type='text' id='respuesta' name='respuesta' placeholder='Escriba toda la secuencia completa' required>
        </div>
        
        <button id='botonEnviar'>Enviar</button>

        </form>";
    }else{
        echo "
        <h1>PERDISTE UNA VIDA te quedan: $vidas </h1>
        <form method='post' action='validarJugada.php'>
        
        <div>
            <label for='respuesta'>Ingrese la secuencia</label>
            <input type='text' id='respuesta' name='respuesta' placeholder='Escriba toda la secuencia completa' required>
        </div>
        
        <button id='botonEnviar'>Enviar</button>

        </form>";
    }
    $arrayToString = ArrayUtils::toString($gestorJuego->arraySecreto);
    echo "Respuesta correcta: $arrayToString";

}
