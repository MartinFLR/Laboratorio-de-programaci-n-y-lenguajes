<?php
require_once 'jugador.php';
require_once 'arrayUtils.php';

class GestorJuego {
    const COLORES = ["R", "A", "Y", "V"];

    private int $cantidad;
    private array $arraySecuencia = array();

    public function __construct(int $cantidad) {
        $this->cantidad = $cantidad;
    }

    private function generarArray(){

    }

}