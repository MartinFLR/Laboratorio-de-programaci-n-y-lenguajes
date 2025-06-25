<?php
require_once 'gestorJuego.php';
$partidasGanadas = 0;
$partidasJugadas = 0;
$ganador = "";

if (isset($_COOKIE['partidas_ganadas'])) {
    $partidasGanadas = intval($_COOKIE['partidas_ganadas']);
}else{
    setcookie('partidas_ganadas', $partidasGanadas, time() + 60*60*24*30, '/');
}

if (isset($_COOKIE['partidas_jugadas'])) {
    $partidasJugadas = intval($_COOKIE['partidas_jugadas']);
}else{
    setcookie('partidas_jugadas', $partidasJugadas, time() + 60*60*24*30, '/');

}

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Recuperar gestor
if (isset($_SESSION['gestor']) && is_string($_SESSION['gestor'])) {
     /** @var GestorJuego $gestor */
    $gestor = unserialize($_SESSION['gestor']);
    $gestor->setPartidasJugadas($partidasJugadas);
    
} else {
    $gestor = new GestorJuego();
    $_SESSION['gestor'] = serialize($gestor);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['tirada'])) {
        //lanza cada jugado de forma alternada el dado

        //Tiro el dado dos veces, asi juega la maquina
        if($gestor->getTurno() === 1){
            $gestor->tirarDado();
            $gestor->verificarFinal();
            if($gestor->getJuegoFinalizado()){
                $ganador = $gestor->getGanador();
                return;
            }else{
                $gestor->tirarDado();
                $gestor->verificarFinal();
                $ganador = $gestor->getGanador();
            }
        $partidasGanadas = $gestor->getPartidasGanadas();
        $partidasJugadas = $gestor->getPartidasJugadas();
        setcookie('partidas_ganadas', $partidasGanadas, time() + 60*60*24*30, '/');
        setcookie('partidas_jugadas', $partidasJugadas, time() + 60*60*24*30, '/');
        }

    } elseif (isset($_POST['nuevoJuego'])) {
        //Inicilializa los puntos de los jugadores en 20 y actualiza el numero del juego
        $gestor->nuevoJuego();
        $partidasJugadas = $gestor->getPartidasJugadas();
        $partidasJugadas++;
        setcookie('partidas_jugadas', $partidasJugadas, time() + 60*60*24*30, '/');
        
    } elseif (isset($_POST['abandonar'])) {
        //Limpia todos los datos del juego actual. no debe tomarse como una partida para el acumulado de partidas
        $gestor->nuevoJuego();
        $partidasJugadas = $gestor->getPartidasJugadas();
        setcookie('partidas_jugadas', $partidasJugadas, time() + 60*60*24*30, '/');
    }

    $_SESSION['gestor'] = serialize($gestor);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juego de Dados</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <h1>Juego de Dados!</h1>
    <p><strong>Partidas ganadas:</strong> <?= $gestor->getPartidasGanadas() ?></p>
    <p><strong>Nro de juego:</strong> <?= $gestor->getPartidasJugadas() ?></p>
    <p><strong>Jugador:</strong> <?= htmlspecialchars($gestor->retornaNombreTurno()) ?></p>
    <p><strong>Puntaje jugador:</strong> <?= $gestor->getPuntajeJugador() ?></p>
    <p><strong>Puntaje maquina:</strong> <?= $gestor->getPuntajeMaquina() ?></p>
    <p><strong>Nro tirada:</strong> <?= $gestor->getNumeroTirada() ?></p>
    <p><strong>El resultado de la tirada de dados es:</strong> <?= $gestor->getNumeroDadoActual() ?></p>


    <?php if (!$gestor->getJuegoFinalizado()): ?>
        <form method="post">
            <label for="tirada">Realice su tirada!</label>
            <button type="submit" id="tirada" name="tirada">Tirar</button>
        </form>

        <form method="post" style="margin-top:10px;">
            <button type="submit" id="nuevoJuego" name="nuevoJuego">Nuevo juego</button>
        </form>

        <form method="post">
            <button type="submit" name="abandonar">Abandonar</button>
        </form>
        

    <?php else: ?>
        <p><strong>Juego finalizado.</strong></p>
        <form method="post">
            <button type="submit" name="nuevoJuego">Nuevo Juego</button>
        </form>
    <?php endif; ?>

</body>
</html>
