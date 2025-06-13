<?php
session_start();

include "cookieManager.php";

$cookie = new CookieManager();

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar</title>
    <link rel="stylesheet" href="estilos.css">
</head>

<body>
    <h1>Login</h1>
    <form action="#" method="POST">
        <label for="usuario">Usuario: </label><input type="text" name="usuarioIngresado">
        <button type="submit" name="botonIngreso">Ingresar</button>
    </form> <br>
    <footer>Nicolas Montiel LPYL 2005</footer>
</body>

</html>

<?php

if (isset($_POST['botonIngreso'])) {
    $usuario = $_POST['usuarioIngresado'];
    if (!isset($_COOKIE[$usuario])) {
        $cookie->set($usuario, 1);
        $_SESSION['cantJuegos'] = 1;
        $_SESSION['intentos'] = 10;
    } else {
        $cantJuegos = $cookie->get($usuario);
        $_SESSION['cantJuegos'] = $cantJuegos;
        $_SESSION['intentos'] = 10;
    }
    $_SESSION['usuarioLogueado'] = $usuario;
    header("Location: paginaPrincipal.php");
    exit;
}
