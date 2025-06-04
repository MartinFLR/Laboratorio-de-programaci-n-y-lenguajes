<?php
require_once 'jugador.php';
require_once 'arrayUtils.php';
require_once 'sessionManager.php';
class GestorJuego {
    public const COLORES = ["R", "A", "Y", "V"];
    private SessionManager $SessionManager;
    public Jugador $jugador;
    public int $cantidad;
    public int $turno = 1;
    private array $arraySecuencia = [];
    private array $arrayMostrar = [];
    public array $arraySecreto = [];

    public function __construct(int $cantidad) {
        $this->SessionManager = new SessionManager();
        $this->cantidad = $cantidad;
        if(!$this->SessionManager->get("arraySecuencia") && !$this->SessionManager->get("arrayMostrar")
        && !$this->SessionManager->get("arraySecreto") && !$this->SessionManager->get("jugador")
        ){
            $this->jugador = new Jugador();
            $this->SessionManager->set("jugador",$this->jugador);
            $this->generarArray();
            $this->generarArrayMostrar();
            $this->generarArraySecreto();
        }else{
            $this->arraySecuencia = $this->SessionManager->get("arraySecuencia");
            $this->jugador = $this->SessionManager->get("jugador");
            $this->arrayMostrar = $this->SessionManager->get("arrayMostrar");
            $this->arraySecreto = $this->SessionManager->get("arraySecreto");

        };
    }

    //Tengo que ver si este get esta bien, o si hago directamente publico $cantidad
    public function getVidaActual(): int {
        return $this->jugador->getVida();
    }
    private function generarArray(){
        for($i = 0; $i < $this->cantidad; $i++){
        $valorRandom = ArrayUtils::randomValue(self::COLORES);
        array_push($this->arraySecuencia,$valorRandom);
        };
        $this->SessionManager->set("arraySecuencia",$this->arraySecuencia);
    }

    public function generarArrayMostrar(){
        $this->arrayMostrar = array();
        for($i = 0; $i < $this->turno; $i++){
            array_push($this->arrayMostrar,$this->arraySecuencia[$i]);
        };
            $this->SessionManager->set("arrayMostrar",$this->arrayMostrar);
    }

    public function generarArraySecreto(){
        $this->arraysecreto = array();



        for($i = 0; $i < ($this->turno+1); $i++){
            array_push($this->arraySecreto,$this->arraySecuencia[$i]);
        };
            $this->SessionManager->set("arraySecreto",$this->arraySecreto);
    }

    public function validarRespuesta(String $respuesta):bool{
        $arrayRespuesta = str_split($respuesta);
        if($arrayRespuesta == $this->arraySecreto){
            $this->turno++;
            $this->generarArrayMostrar();
            $this->generarArraySecreto();
            return true;
        }else{
            $this->jugador->restarVida();
            return false;
        }
    }


    public function generarPantallaInit(){
        $arrayToString = ArrayUtils::toString($this->arraySecreto);

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