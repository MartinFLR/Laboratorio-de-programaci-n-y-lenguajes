<?php
session_start();
require_once 'CookieManager.php';

// Inicializar con configuración segura y duración 7 días
$cookieManager = new CookieManager(7 * 24 * 3600, '/');

if ($cookieManager->exists('usuario') && $cookieManager->exists('cantidad')) {
    // Incrementar visitas
    $visitas = $cookieManager->getInt('visitas', 0) + 1;
    $cookieManager->set('visitas', (string)$visitas);
} else {
    $visitas = null;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Simon dice</title>
</head>
<body>
    <header>
        <h1>Simon dice!</h1>
    </header>

    <main class="contenedorPrincipal">
    <?php if ($cookieManager->exists('usuario') && $cookieManager->exists('cantidad')): 
        require_once 'CookieManager.php';
        require_once 'gestorJuego.php';

        // Obtenemos y limpiamos las variables para evitar inyección HTML
        $usuario = htmlspecialchars($cookieManager->get('usuario'));
        $cantidad = htmlspecialchars((string)$cookieManager->getInt('cantidad'));

        $gestorJuego = new GestorJuego($cantidad);
        $gestorJuego->generarPantalla();
        ?>
        <p>👋 ¡Bienvenido, <strong><?= $usuario ?></strong>!</p>
        <p>Ingresaste una cantidad de, <strong><?= $visitas ?></strong> veces!</p>
        <p>Seleccionaste <strong><?= $cantidad ?></strong>!</p>
        <p><a href="borrar_cookie.php">¿No sos vos? Hacé clic aquí</a></p>

        <?php else: ?>
            <form method="post" action="validar.php">
                <fieldset>
                    <legend>Ingreso al sistema</legend>

                    <div>
                        <label for="usuario">Nombre:</label>
                        <input type="text" id="usuario" name="usuario" placeholder="Escribe tu nombre" required autocomplete="username">
                    </div>

                    <div>
                        <label for="cantidad">Colores en la secuencia:</label>
                        <input type="number" id="cantidad" name="cantidad" placeholder="Elija una cantidad" required min="1" step="1">
                    </div>

                    <div>
                        <input type="submit" value="Comenzar">
                    </div>
                </fieldset>
            </form>
        <?php endif; ?>
    </main>

    <footer>
        <p>Martín Leonardo Flores</p>
    </footer>
</body>
</html>
