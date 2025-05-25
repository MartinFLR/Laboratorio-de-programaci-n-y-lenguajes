<?php
require_once "persona.php";
class GestorUsuarios{

private Persona $persona;
private  $arrayPersonas = [];

public function __construct(){
    $personita = new Persona("pepe","pepe");
    $this->subirPersona($personita);
}

public function subirPersona(Persona $persona){
    $this->arrayPersonas[] = $persona;
}

public function autenticarPersona($nombre, $contra){
        foreach($this->arrayPersonas as $personaGuardada){
            if($personaGuardada->getNombre() === $nombre && $personaGuardada->getContra() === $contra){
                return true;
            }else{
                return false;
            }
        }
}

}

?>