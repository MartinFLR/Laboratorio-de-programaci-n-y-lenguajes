<?php
require_once 'gestorJuego.php';
session_start();

$resultado = $_SESSION['resultado'] ?? 'desconocido';
$mensaje = $_SESSION['mensaje'] ?? 'Juego finalizado';
$cantidad = $_SESSION['cantidad'] ?? 5;
// Limpiar mensaje para no repetir
unset($_SESSION['resultado'], $_SESSION['mensaje']);

// Si se hace POST y se presionó reiniciar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'reiniciar') {
        // Crear una nueva instancia del gestor
        $gestorJuego = new GestorJuego($cantidad); 
        $gestorJuego->reiniciarJuego();

        // Redirigimos al inicio del juego (ajustá el archivo si no es index.php)
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Fin del juego</title>
</head>
<body>
    <h1>Fin del juego</h1>
    <p><?= htmlspecialchars($mensaje) ?></p>
    <form method="post">
        <button type="submit" name="action" value="reiniciar">Reiniciar juego</button>   
    </form>
</body>
</html>
