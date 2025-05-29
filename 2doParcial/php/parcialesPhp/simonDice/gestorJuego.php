<?php
require_once 'jugador.php';
require_once 'arrayUtils.php';
require_once 'sessionManager.php';
class GestorJuego {
    public const COLORES = ["R", "A", "Y", "V"];
    private SessionManager $SessionManager;
    private Jugador $jugador;
    public int $cantidad;
    public int $turno = 1;
    private array $arraySecuencia = [];
    private array $arrayMostrar = [];

    public function __construct(int $cantidad) {
        $this->SessionManager = new SessionManager();
        $this->jugador = new Jugador();
        
        $this->cantidad = $cantidad;
        if(!$this->SessionManager->get("arraySecuencia") && !$this->SessionManager->get("arrayMostrar")){
            $this->generarArray();
            $this->generarArrayMostrar();
        }else{
            $this->arraySecuencia = $this->SessionManager->get("arraySecuencia");
            $this->arrayMostrar = $this->SessionManager->get("arrayMostrar");
        };
    }

    //Tengo que ver si este get esta bien, o si hago directamente publico $cantidad
    public function getCantidad(): int {
        return $this->cantidad;
    }
    private function generarArray(){
        for($i = 0; $i < $this->cantidad; $i++){
        $valorRandom = ArrayUtils::randomValue(self::COLORES);
        array_push($this->arraySecuencia,$valorRandom);
        };
        $this->SessionManager->set("arraySecuencia",$this->arraySecuencia);
    }

    public function generarArrayMostrar(){
        for($i = 0; $i < $this->turno; $i++){
            array_push($this->arrayMostrar,$this->arraySecuencia[$i]);
        };
            $this->SessionManager->set("arrayMostrar",$this->arrayMostrar);
    }

    public function validarRespuesta(String $respuesta){
        $arrayRespuesta = str_split($respuesta);
        if($arrayRespuesta == $this->arraySecuencia){

        }else{

        }
    }

    public function generarPantalla(){
        $arrayToString = ArrayUtils::toString($this->arrayMostrar);

        echo "<form method='post' action='validarJugada.php'>
        
        <div>
            <label for='respuesta'>Ingrese la secuencia</label>
            <input type='text' id='respuesta' name='respuesta' placeholder='Escriba toda la secuencia completa' required>
        </div>
        
        <button id='botonEnviar'>Enviar</button>

        </form>";


        echo "<div>
        solucion: $arrayToString
    
        
        </div>";
    }

}