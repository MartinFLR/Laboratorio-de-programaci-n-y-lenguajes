<?php
require_once 'gestorJuego.php';
require_once 'CookieManager.php';
require_once 'sessionManager.php';

$cookieManager = new CookieManager(7 * 24 * 3600, '/');
$sessionManager = new SessionManager();


function renderInicioForm(string $error = ''): void {
    $errorHtml = $error ? "<p style='color:red;'>$error</p>" : "";
    echo <<<HTML
    <h2>Iniciar Juego</h2>
    $errorHtml
    <form method="post">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required autofocus>
        <br>
        <label for="cantidad">Cantidad de letras:</label>
        <input type="number" id="cantidad" name="cantidad" min="1" max="20" required>
        <br>
        <button type="submit" name="action" value="iniciar">Iniciar Juego</button>
    </form>
    HTML;
}

function renderJuegoForm(): void {
    echo <<<HTML
    <form method="post">
        <label for="respuesta">Ingrese la secuencia completa:</label>
        <input type="text" id="respuesta" name="respuesta" placeholder="Ej: RAYV" required autofocus>
        <button type="submit" name="action" value="validar">Enviar</button>
    </form>
    HTML;
}

function renderJuegoPantalla(string $usuario, int $visitas, int $cantidad, GestorJuego $gestorJuego, ?string $mensaje = null, bool $correcto = false): void {
    $usuarioEsc = htmlspecialchars($usuario);
    $mensajeHtml = '';
    if ($mensaje !== null) {
        $color = $correcto ? 'green' : 'red';
        $mensajeHtml = "<h2 style='color:$color;'>$mensaje</h2>";
    }

    $letrasMostradas = array_slice($gestorJuego->arraySecreto, 0, $gestorJuego->turno + 1);
    $proximaLetra = $gestorJuego->arraySecreto[$gestorJuego->turno] ?? '-';
    $arrayToString = implode('', $letrasMostradas);

    echo "<!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Simon dice</title></head><body>";
    echo "<header><h1>Simon dice!</h1></header>";
    echo "<main>";
    echo "<p>👋 ¡Bienvenido, <strong>$usuarioEsc</strong>!</p>";
    echo "<p>Ingresaste <strong>$visitas</strong> veces.</p>";
    echo "<p>Seleccionaste <strong>$cantidad</strong> letras.</p>";
    echo "<p><a href='borrar_cookie.php'>¿No sos vos? Hacé clic aquí para reiniciar.</a></p>";
    echo "<h2>Nivel actual: $cantidad</h2>";
    echo $mensajeHtml;
    renderJuegoForm();
    echo "<p><strong>Letra nueva agregada:</strong> $proximaLetra</p>";
    echo "<p><strong>Secuencia actual esperada:</strong> $arrayToString</p>";
    echo "</main></body></html>";
}

// Lectura cookies
$usuario = $cookieManager->get('usuario');
$visitas = $cookieManager->getInt('visitas', 0);

// lectura sessionCantidad
$cantidad = (int) ($sessionManager->get("cantidad") ?? 0);

// Actualizar visitas si usuario y cantidad existen
if ($usuario && $cantidad) {
    $cookieManager->set('visitas', (string)($visitas + 1));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'iniciar') {
        $usuarioInput = trim($_POST['usuario'] ?? '');
        $cantidadInput = intval($_POST['cantidad'] ?? 0);

        if ($usuarioInput === '' || $cantidadInput <= 0) {
            renderInicioForm('Por favor, completa todos los campos correctamente.');
            exit;
        }

        $cookieManager->set('usuario', $usuarioInput);
        $sessionManager->set('cantidad', (int)$cantidadInput);
        $cookieManager->set('visitas', '1');

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    if ($action === 'validar') {
        if (!$usuario || $cantidad <= 0) {
            renderInicioForm('Primero iniciá el juego.');
            exit;
        }

        $gestorJuego = new GestorJuego();
        $respuesta = strtoupper(trim($_POST['respuesta'] ?? ''));

        $correcto = $gestorJuego->validarRespuesta($respuesta);
        $mensaje = $correcto
            ? '¡Correcto! Pasaste al siguiente nivel'
            : "¡Incorrecto! Te quedan: {$gestorJuego->jugador->getVida()} vidas";

        renderJuegoPantalla($usuario, $visitas, $cantidad, $gestorJuego, $mensaje, $correcto);
        exit;
    }
}

// Mostrar inicio si no hay usuario o cantidad válidos
if (!$usuario || $cantidad <= 0) {
    renderInicioForm();
    exit;
}

// Mostrar pantalla del juego
$gestorJuego = new GestorJuego();
renderJuegoPantalla($usuario, $visitas, $cantidad, $gestorJuego);
