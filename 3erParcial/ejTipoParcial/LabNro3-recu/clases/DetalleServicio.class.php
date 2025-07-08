<?php
class DetalleServicio implements JsonSerializable{
    private $asientosSemicama;
    private $precioPasajeSemicama;
    private $asientosCama;
    private $precioPasajeCama;
    private $webEmpresa;
    private $operaLU;
    private $operaMA;
    private $operaMI;
    private $operaJU;
    private $operaVI;
    private $operaSA;
    private $operaDO;

    //s.asientosSemicama, s.precioPasajeSemicama, e.webEmpresa,
    //s.operaLU,s.operaMA,s.operaMI,s.operaJU,s.operaVI,s.operaSA,s.operaDO

    public function __construct(
        $asientosSemicama,
        $precioPasajeSemicama,
        $asientosCama,
        $precioPasajeCama,
        $webEmpresa,
        $operaLU,
        $operaMA,
        $operaMI,
        $operaJU,
        $operaVI,
        $operaSA,
        $operaDO,
        ) {
        $this->asientosSemicama = $asientosSemicama;
        $this->precioPasajeSemicama = $precioPasajeSemicama;
        $this->asientosCama = $asientosCama;
        $this->precioPasajeCama = $precioPasajeCama;
        $this->webEmpresa = $webEmpresa;
        $this->operaLU = $operaLU;
        $this->operaMA = $operaMA;
        $this->operaMI = $operaMI;
        $this->operaJU = $operaJU;
        $this->operaVI = $operaVI;
        $this->operaSA = $operaSA;
        $this->operaDO = $operaDO;
    }

    //Serialiaze
        public function jsonSerialize(): mixed {
        return [
            'asientosSemicama' => $this->asientosSemicama,
            'precioPasajeSemicama' => $this->precioPasajeSemicama,
            'asientosCama' => $this->asientosCama,
            'precioPasajeCama' => $this->precioPasajeCama,
            'webEmpresa' => $this->webEmpresa,
            'operaLU' => $this->operaLU,
            'operaMA' => $this->operaMA,
            'operaMI' => $this->operaMI,
            'operaJU' => $this->operaJU,
            'operaVI' => $this->operaVI,
            'operaSA' => $this->operaSA,
            'operaDO' => $this->operaDO,
        ];
    }
}