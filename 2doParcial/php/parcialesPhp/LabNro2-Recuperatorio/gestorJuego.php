<?php
require_once 'jugador.php';
class GestorJuego {

    private int $turno = 1;
    private Jugador $jugador;
    private Jugador $maquina;
    private int $numTirada = 0;
    private bool $juegoFinalizado = false;
    private int $partidasGanadas = 0;
    private int $numeroDadoActual = 0;
    private int $partidasJugadas = 0;
    private String $ganador = "";

    public function __construct(){
        $this->jugador = new Jugador();
        $this->maquina = new Jugador();
    }


    public function tirarDado(){
        $numeroDado = $this->generarNumero();
        $this->numeroDadoActual = $numeroDado;
        $this->numTirada ++;
        //Si es turno jugador
        if($this->turno === 1){
            switch($numeroDado){
            case 1:{
                $this->jugador->sumaPuntos(6);
                $this->maquina->restaPuntos(6);
                break;
            }
            case 2: {
                break;
            }
            case 3:{
                $this->jugador->restaPuntos(2);
                $this->maquina->sumaPuntos(4);
                break;
            }
            case 4:{
                $this->jugador->sumaPuntos(4);
                $this->maquina->restaPuntos(2);
                break;
            }
            case 5:{
                $this->maquina->restaPuntos(3);
                $this->jugador->restaPuntos(3);
                break;
            }
            case 6:{
                $this->jugador->sumaPuntos(1);
                $this->maquina->restaPuntos(3);
                break;
            }
        }
        //turno maquina
        }elseif($this->turno === 2){
            switch($numeroDado){
            case 1:{
                $this->maquina->sumaPuntos(6);
                $this->jugador->restaPuntos(6);
                break;
            }
            case 2: {
                break;
            }
            case 3:{
                $this->maquina->restaPuntos(2);
                $this->jugador->sumaPuntos(4);
                break;
            }
            case 4:{
                $this->maquina->sumaPuntos(4);
                $this->jugador->restaPuntos(2);
                break;
            }
            case 5:{
                $this->jugador->restaPuntos(3);
                $this->maquina->restaPuntos(3);
                break;
            }
            case 6:{
                $this->maquina->sumaPuntos(1);
                $this->jugador->restaPuntos(3);
                break;
            }
        }
    }
    $this->cambioRonda();
}   

    public function cambioRonda(){
        if($this->turno === 1){
            $this->turno = 2;
        }else{
            $this->turno = 1;
        }
    }


    private function generarNumero(): int {
        return rand(0, 6);
    }

    public function retornaNombreTurno():String{
        if($this->turno === 1){
            return "Es tu turno!";
        }
        if($this->turno === 2){
            return "Es el turno de la maquina!";
        }
        return "";
    }

    public function verificarFinal(){
        if($this->maquina->getPuntaje()<= 0){
            $this->juegoFinalizado = true;
            $this->partidasGanadas++;
            $this->partidasJugadas++;
            $this->nuevoJuego();
            $this->ganador = "Haz ganado!";
            return "Haz ganado!";
        }
        if($this->jugador->getPuntaje()<= 0){
            $this->juegoFinalizado = true;
            $this->partidasJugadas++;
            $this->nuevoJuego();
            $this->ganador = "Ha ganado la maquina!";
            return "Haz perdido!";
        }
    }


    public function reiniciarJuegoFinalizado(){
        $this->juegoFinalizado = false;
    }

    public function abandonar(){

    }

    public function nuevoJuego(){
        $this->maquina->reiniciar();
        $this->jugador->reiniciar();
        $this->numTirada = 0;
        $this->juegoFinalizado = false;
    }
    

    public function getJuegoFinalizado(){
        return $this->juegoFinalizado;
    }

    public function getGanador(){
        return $this->ganador;
    }

    public function getPartidasGanadas(){
        return $this->partidasGanadas;
    }

    public function getPartidasJugadas(){
        return $this->partidasJugadas;
    }

    public function setPartidasJugadas(int $partidas){
        $this->partidasJugadas = $partidas;
    }
    
    public function getNumeroDadoActual(){
        return $this->numeroDadoActual;
    }

    public function getPuntajeMaquina(){
        return $this->maquina->getPuntaje();
    }
    public function getPuntajeJugador(){
        return $this->jugador->getPuntaje();
    }

    public function getNumeroTirada(){
        return $this->numTirada;
    }

    public function getTurno(){
        return $this->turno;
    }
}