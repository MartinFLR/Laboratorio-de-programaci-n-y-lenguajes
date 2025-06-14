<?php
class Jugador {
    private int $intentos;

    public function __construct() {
        $this->intentos = 10;
    }

    public function getIntentos():int{
        return $this->intentos;
    }

    public function setIntentos(int $intentos){
        $this->intentos = $intentos;
    }

    public function restarIntento(){
        $this->intentos = ($this->intentos -1);
        return $this->intentos;
    }
    
}