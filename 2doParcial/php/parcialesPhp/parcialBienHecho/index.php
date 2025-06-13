<?php
require_once 'jugador.php';
require_once 'gestorJuego.php';

//antes de sessionStart()


$partidasJugadas = 0;
if (isset($_COOKIE['partidas_jugadas'])) {
    $partidasJugadas = intval($_COOKIE['partidas_jugadas']);
}

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Recuperar jugador
if (isset($_SESSION['jugador']) && is_string($_SESSION['jugador'])) {
    $jugador = unserialize($_SESSION['jugador']);
} else {
    $jugador = new Jugador("Jugador1");
    $_SESSION['jugador'] = serialize($jugador);
}

// Recuperar gestor
if (isset($_SESSION['gestor']) && is_string($_SESSION['gestor'])) {
    $gestor = unserialize($_SESSION['gestor']);
} else {
    $gestor = new GestorJuego($jugador);
    $_SESSION['gestor'] = serialize($gestor);
}

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['numero'])) {
        $numero = intval($_POST['numero']);
        if ($numero > 0) {
            $mensaje = $gestor->intentar($numero);
        } else {
            $mensaje = "Ingresa un número entero positivo.";
        }
    } elseif (isset($_POST['rendirse'])) {
        $jugador->rendirse();
        $mensaje = "Te has rendido. Fin del juego.";

        $partidasJugadas++;
        setcookie('partidas_jugadas', $partidasJugadas, time() + 60 * 60 * 24 * 30, '/');
    } elseif (isset($_POST['reiniciar'])) {
        $jugador->reiniciar();
        $gestor = new GestorJuego($jugador);

        $mensaje = "Juego reiniciado. Comenzando juego #" . $partidasJugadas;

        $partidasJugadas++;
        setcookie('partidas_jugadas', $partidasJugadas, time() + 60*60*24*30, '/');
    }

    $_SESSION['jugador'] = serialize($jugador);
    $_SESSION['gestor'] = serialize($gestor);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Juego Centro Numérico</title>
</head>
<body>
    <h1>Juego Centro Numérico</h1>
    <p><strong>Jugador:</strong> <?= htmlspecialchars($jugador->getNombre()) ?></p>
    <p><strong>Partidas jugadas:</strong> <?= $partidasJugadas ?></p>
    <p><strong>Puntaje:</strong> <?= $gestor->getPuntaje() ?></p>
    <p><strong>Intentos usados:</strong> <?= $gestor->getIntentos() ?></p>
    <p><strong>Números ingresados:</strong> <?= implode(', ', $gestor->getNumerosIngresados()) ?></p>

    <?php if (!$jugador->estaRendido() && !$gestor->juegoFinalizado()): ?>
        <form method="post">
            <label for="numero">Ingresa un número:</label>
            <input type="number" id="numero" name="numero" min="1" required>
            <button type="submit">Intentar</button>
        </form>

        <form method="post" style="margin-top:10px;">
            <button type="submit" name="rendirse">Rendirse</button>
        </form>
    <?php else: ?>
        <p><strong>Juego finalizado.</strong></p>
        <form method="post">
            <button type="submit" name="reiniciar">Nuevo Juego</button>
        </form>
    <?php endif; ?>

    <p style="color:blue; margin-top:15px;"><?= htmlspecialchars($mensaje) ?></p>
</body>
</html>
