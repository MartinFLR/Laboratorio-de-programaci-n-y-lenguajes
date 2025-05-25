<?php          session_start()?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Php</title>

</head>
<body>

    <header>
        <h1>PHP</h1>
    </header>

    <main class="contenedorPrincipal">

    <form method="post" action="validar.php">
            Usuario: <input type="text" name="usuario" required><br>
            Clave: <input type="password" name="clave" required><br>
            <input type="submit" value="Entrar">
    </form>
    </main>
    


    <footer>
        <p>Martín Leonardo Flores</p>
    </footer>
</body>
</html>
