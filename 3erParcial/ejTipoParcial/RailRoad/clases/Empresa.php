<?php
class Empresa {
    private $idEmpresa;
    private $nombreEmpresa;
    private $paisEmpresa;
    private $webEmpresa;
    private $logoEmpresa;

    public function __construct(
        $idEmpresa,
        $nombreEmpresa,
        $paisEmpresa,
        $webEmpresa,
        $logoEmpresa,
        ) {
        $this->idEmpresa = $idEmpresa;
        $this->nombreEmpresa = $nombreEmpresa;
        $this->paisEmpresa = $paisEmpresa;
        $this->webEmpresa = $webEmpresa;
        $this->logoEmpresa = $logoEmpresa;
    }


    //Getters y setters
    public function getIdEmpresa(){
        return $this->idEmpresa;
    }
    public function getNombreEmpresa(){
        return $this->nombreEmpresa;
    }
    public function getPaisEmpresa(){
        return $this->paisEmpresa;
    }
    public function getWebEmpresa(){
        return $this->webEmpresa;
    }
    public function getLogoEmpresa(){
        return $this->logoEmpresa;
    }
}