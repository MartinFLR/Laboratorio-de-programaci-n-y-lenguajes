<?php
class Persona{
public $nombre;
public $contra;

public function __construct($nombre,$contra){
    $this->nombre = $nombre;
    $this->contra = $contra;
    
}
public function saludar(){
    return "<p>Hola!, {$this->nombre}! bienvenido devuelta! </p>";
}

public function getNombre(){
    return $this->nombre;
}

public function getContra(){
    return $this->contra;
}

};



?>