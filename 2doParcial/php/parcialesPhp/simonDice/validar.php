<?php
require_once 'gestorJuego.php';
require_once 'cookieManager.php';
require_once 'arrayUtils.php';

$cookieManager = new CookieManager(7 * 24 * 3600, '/');

function renderInicioForm($error = '') {
    echo "<h2>Iniciar Juego</h2>";
    if ($error) {
        echo "<p style='color:red;'>$error</p>";
    }
    echo <<<HTML
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

function renderJuegoForm() {
    echo <<<HTML
    <form method="post">
        <label for="respuesta">Ingrese la secuencia completa:</label>
        <input type="text" id="respuesta" name="respuesta" placeholder="Ej: RAYV" required autofocus>
        <button type="submit" name="action" value="validar">Enviar</button>
    </form>
    HTML;
}

$usuario = $cookieManager->get('usuario');
$cantidad = $cookieManager->get('cantidad');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'iniciar') {
        $usuario = trim($_POST['usuario'] ?? '');
        $cantidad = intval($_POST['cantidad'] ?? 0);

        if (empty($usuario) || $cantidad <= 0) {
            renderInicioForm('Por favor, completa todos los campos correctamente.');
            exit;
        }

        $cookieManager->set('usuario', $usuario);
        $cookieManager->set('cantidad', (string)$cantidad);

        // Después de iniciar, recargamos para mostrar el juego
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

    if ($action === 'validar') {
        if (!$usuario || !$cantidad) {
            // Si no está iniciado el juego, pedimos iniciar
            renderInicioForm('Primero iniciá el juego.');
            exit;
        }

        $gestorJuego = new GestorJuego((int)$cantidad);
        $respuesta = strtoupper(trim($_POST['respuesta'] ?? ''));

        if ($gestorJuego->validarRespuesta($respuesta)) {
            echo "<h2>¡Correcto! Pasaste al siguiente nivel</h2>";
        } else {
            echo "<h2>¡Incorrecto! Te quedan: {$gestorJuego->jugador->getVida()} vidas</h2>";
        }

        renderJuegoForm();

        $letrasMostradas = array_slice($gestorJuego->arraySecreto, 0, $gestorJuego->turno + 1);
        $proximaLetra = $gestorJuego->arraySecreto[$gestorJuego->turno] ?? '-';
        $arrayToString = implode('', $letrasMostradas);

        echo "<p><strong>Letra nueva agregada:</strong> $proximaLetra</p>";
        echo "<p><strong>Secuencia actual esperada:</strong> $arrayToString</p>";

        exit;
    }
}

// Si no hay usuario ni cantidad, muestro el formulario de inicio
if (!$usuario || !$cantidad) {
    renderInicioForm();
    exit;
}

// Si ya está iniciado, muestro formulario del juego
echo "<h2>Bienvenido, $usuario!</h2>";
echo "<p>Nivel actual: {$cantidad}</p>";
$gestorJuego = new GestorJuego((int)$cantidad);
renderJuegoForm();

$primeraLetra = $gestorJuego->arraySecreto[0] ?? '-';
echo "<p>Primera letra: <strong>$primeraLetra</strong></p>";
