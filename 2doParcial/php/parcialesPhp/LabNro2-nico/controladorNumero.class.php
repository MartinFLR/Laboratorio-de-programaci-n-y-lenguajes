<?php
class controladorNumero{
    private $numero;

    public function __construct($numeroIngresado)
    {
        $this->numero = $numeroIngresado;
    }

    public function getNumero(){
        return $this->numero;
    }

    public function esCentroNumerico(){
        $primeraMitad = 0;
        
        for ($i=1; $i < $this->getNumero(); $i++) { 
            $primeraMitad = $primeraMitad + $i;
        }
        
        $segundaMitad = 0;
        $j = $this->getNumero() + 1;

        while ($segundaMitad < $primeraMitad){
            $segundaMitad += $j;
            $j++;
        }

        return $primeraMitad === $segundaMitad;
    }

    public function mostrarResultados(){
        if($this->esCentroNumerico()){
            echo "El numero: " . $this->getNumero() . " SI es un centro numerico";
        } else {
            echo "El numero: " . $this->getNumero() ." NO es un centro numerico";
        }
    }
}
?>