<?php
class Jugador {
    private int $vidas = 3;

    public function __construct() {
    }

    private function isDead():boolean{
        return $this->vidas == 0;
    }
}