<?php
class Jugador {
    private int $vidas = 3;

    public function __construct() {
    }

    private function isDead():bool{
        return $this->vidas == 0;
    }

    public function restarVida(){
        $this->vidas --;
    }

    public function getVida(){
        return $this->vidas;
    }
}