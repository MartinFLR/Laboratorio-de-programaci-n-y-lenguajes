<?php
class Pista {
    private $id;
    private $idPalabra;
    private $ordenPista;
    private $pista;

    public function __construct($id, $idPalabra, $ordenPista, $pista) {
        $this->id = $id;
        $this->idPalabra = $idPalabra;
        $this->ordenPista = $ordenPista;
        $this->pista = $pista;
    }




    //Getters y setters
    public function getId(){
        return $this->id;
    }
    public function getIdPalabra(){
        return $this->idPalabra;
    }
    public function getOrdenPista(){
        return $this->ordenPista;
    }
    public function getPista(){
        return $this->pista;
    }


}