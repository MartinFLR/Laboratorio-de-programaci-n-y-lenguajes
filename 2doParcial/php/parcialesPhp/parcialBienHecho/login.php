<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre']);

    if (!empty($nombre)) {
        // Guardar usuario en cookie por 30 días
        setcookie('usuario', $nombre, time() + 60*60*24*30, '/');
        
        // Redirigir al juego
        header("Location: index.php");
        exit;
    } else {
        $error = "Debe ingresar un nombre.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        <label for="nombre">Nombre de jugador:</label>
        <input type="text" id="nombre" name="nombre" required>
        <button type="submit">Ingresar</button>
    </form>
</body>
</html>
