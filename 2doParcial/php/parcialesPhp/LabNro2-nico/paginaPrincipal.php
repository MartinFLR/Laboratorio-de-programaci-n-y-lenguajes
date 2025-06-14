<?php
session_start();

include "controladorNumero.class.php";

if(!isset($_SESSION['usuarioLogueado'])){
    header("Location: index.php");
}

// if($_SERVER['REQUEST_METHOD'] === 'POST'){
//     $controlador = new controladorNumero($_POST['numeroIngresado']);
    
//     if($controlador->esCentroNumerico()){
//         $controlador->mostrarResultados();
//     } else {
//         $_SESSION['intentos'] -- ;
//         $controlador->mostrarResultados();
//     }

//     if($_SESSION ['intentos'] == 0){
//         echo " PERDISTE, JUEGA DE NUEVO";
//     }
// } 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Principal</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h1>Juego Centro Numerico</h1>
    <h2>Bienvenido <?php echo $_SESSION['usuarioLogueado']?></h2>
    <strong>Juego Numero: <?php echo $_COOKIE[$_SESSION['usuarioLogueado']]?></strong>
    <strong>Intentos: <?php echo $_SESSION['intentos']?></strong>

    <form action="#" method="post">
        <label for="ingresoNum">Ingresar Numero: </label> <input type="number" name="numeroIngresado" min="0" required >
        <button type="submit" name="botonEnviar">Enviar</button>
    </form> <br> <br>

    <a href="logout.php">Cerrar Sesion</a>
    <a href="reiniciarJuego.php">Reiniciar Juego</a> <br> <br>

</body>
</html>
<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $controlador = new controladorNumero($_POST['numeroIngresado']);

    if($_SESSION ['intentos'] == 0){
        echo "<strong>  PERDISTE, JUEGA DE NUEVO </strong> <br>";
    }
    
    if($controlador->esCentroNumerico()){
        echo "<strong>  FELICIDADES!!!</strong> <br>";
        $controlador->mostrarResultados();
    } else {
        $_SESSION['intentos'] -- ;
        $controlador->mostrarResultados();
        $_COOKIE[$_SESSION['usuarioLogueado']] ++;
    }

} 

?>