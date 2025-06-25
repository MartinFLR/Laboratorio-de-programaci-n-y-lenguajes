<?php

class Jugador{

    private int $puntaje;


    public function __construct(){
        $this->puntaje = 20;
    }


    public function getPuntaje():int{
        return $this->puntaje;
    }

    public function sumaPuntos(int $puntos){
        $this->puntaje = $this->puntaje + $puntos;
    }

     public function restaPuntos(int $puntos){
        $this->puntaje = $this->puntaje - $puntos;
    }

    public function reiniciar(){
        $this->puntaje = 20;
    }
}