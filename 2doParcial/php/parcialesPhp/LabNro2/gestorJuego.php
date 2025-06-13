<?php
class GestorJuego {
    private array $arrayNumeros;

    public function __construct(int $maxNumber) {
        $this->arrayNumeros = $this->generarSecuencia($maxNumber);
    }

    //Este método es el que usaria para generar un
    //array de tamaño aleatorio
    private function random(int $min = 0, int $max = 100): int {
            return rand($min, $max);
    }


    private function generarSecuencia(int $maxNumber): array {
        $secuencia = [];
        for ($i = 1; $i < $maxNumber; $i++) {
            $secuencia[] = $i;
        }
        return $secuencia;
    }

    //No alcance a implentar que avise
    //que tan lejos esta, no me dio el tiempo
    private function buscoCentro(){
        $numBuscado = 1;
        while (!$this->centroNumerico($numBuscado)){
            $numBuscado++;
        }
        return $numBuscado;
    }

    private function lejania(){

    }

    public function centroNumerico(int $numeroIngresado){
        $sumatoriaArriba = 0;
        $sumatoriaAbajo = 0;
        $numLength = count($this->arrayNumeros);


        for($i=$numeroIngresado; $i < $numLength; $i++){
            $sumatoriaArriba = ($sumatoriaArriba + $this->arrayNumeros[$i]);
        }

        for($j=($numeroIngresado-2); $j > -1; $j--){
            $sumatoriaAbajo = ($sumatoriaAbajo + $this->arrayNumeros[$j]);
        }
        if($sumatoriaAbajo == $sumatoriaArriba){
            return true;
        }else{
            return false;
        }
    }

    //utils para debugear
    public function arrayToString(){
        return implode(",",$this->arrayNumeros);
    }
}