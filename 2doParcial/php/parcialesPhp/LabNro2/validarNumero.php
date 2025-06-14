<?php
require_once 'functions.php';
require_once 'jugador.php';
require_once 'sessionManager.php';
require_once 'gestorJuego.php';

//Este numero de constructor 
//es el tamaño del array
//No entendi si era aleatorio,
//En todo caso sigue funcionando
//sin importar que numero le pase de
//tamaño de array
//realice las pruebas y funciona correctamente
$gestorJuego = new GestorJuego(50);
$sessionManager = new SessionManager();

function perderVida(Jugador $jugador)
{
    $intentosActuales = $jugador->restarIntento();
    
    echo "<div>";
    echo"<h1>Tu numero NO es un centro numerico, perdiste una vida</h1>";
    echo"<p>Te quedan ";
    echo $intentosActuales;
    echo"vidas </p>";
    echo"</div>";
            ?>
            

            <a href="index.php">Reintentarlo</a>
            
    </form>
<?php
}

function ganar()
{
?>
        <div>
            <h1>Tu numero SI es un centro numerico, Ganaste!</h1>
        </div>
            

    <form name="formReintentar" action="index.php" method="POST">
            <div>
                <button type="submit" name="reintentar">Volver a empezar</button>
            </div>
    </form>
<?php
}

function derrota(SessionManager $sessionManager)
{
    echo "Perdiste!";
    $sessionManager->clearAll();

?>
<?php
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ingreso'])) {
    if ($sessionManager->exists('jugador')){
        $jugador = $sessionManager->get('jugador');
    }else{
        $jugador = new Jugador();
        $sessionManager->set("jugador",$jugador);
    }
    
    $numeroIngresado = intval($_POST['numero']);
    
    if($gestorJuego->centroNumerico($numeroIngresado)){
        ganar();
    }else{

        perderVida($jugador);
        $sessionManager->set("jugador",$jugador);
        if($jugador->getIntentos() === 0){
        derrota($sessionManager);
        }

    }
    exit;
}



?>
