<?php
session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>bienvenida</title>

</head>
<body>

    <header>
        <h1>bienvenida</h1>
    </header>

    <main class="contenedorPrincipal">

    <h1>holaaaaa</h1>
    <?php
    $nombre =  $_SESSION['usuario'];

    echo "$nombre";
    ?>
    </main>
    


    <footer>
        <p>Martín Leonardo Flores</p>
    </footer>
</body>
</html>
