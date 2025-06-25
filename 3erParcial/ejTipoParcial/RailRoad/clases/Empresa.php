<?php
class Empresa implements JsonSerializable  {
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

    //Serializable
    public function jsonSerialize(): mixed {
        return [
            'idEmpresa' => $this->idEmpresa,
            'nombre'    => $this->nombreEmpresa,
            'pais'      => $this->paisEmpresa,
            'web'       => $this->webEmpresa,
            'logo'      => $this->logoEmpresa,
        ];
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