<?php
class Jugador {
    private int $vidas = 3;

    public function __construct() {
    }

    private function isDead():bool{
        return $this->vidas == 0;
    }
}