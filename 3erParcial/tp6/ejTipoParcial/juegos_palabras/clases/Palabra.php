<?php
class Palabra {
    private $id;
    private $palabra;
    private $dificultad;
    private $acertada;

    public function __construct($id, $palabra, $dificultad, $acertada) {
        $this->id = $id;
        $this->palabra = $palabra;
        $this->dificultad = $dificultad;
        $this->acertada = $acertada;
    }

    public function cantidadCaracteres():int {
        return mb_strlen($this->palabra);
    }



    //Getters y setters
    public function getId(){
        return $this->id;
    }
    public function getPalabra(){
        return $this->palabra;
    }
    public function getDificultad(){
        return $this->dificultad;
    }
    public function getAcertada(){
        return $this->acertada;
    }


}