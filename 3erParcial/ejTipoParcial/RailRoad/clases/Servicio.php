<?php
class Servicio {
    private $idServicio;
    private $nroServicio;
    private $ciudadOrigenServicio;
    private $ciudadDestinoServicio;
    private $estacionOrigenServicio;
    private $estacionDestinoServicio;
    private $horaSalidaServicio;
    private $horaLlegadaServicio;
    private $frecuenciaServicio;
    private $precioServicio;
    private $idEmpresa;

    private $empresa; // tipo Empresa


    public function __construct(
        $idServicio,
        $nroServicio,
        $ciudadOrigenServicio,
        $ciudadDestinoServicio,
        $estacionOrigenServicio,
        $estacionDestinoServicio,
        $horaSalidaServicio,
        $horaLlegadaServicio,
        $frecuenciaServicio,
        $precioServicio,
        $idEmpresa
        ) {
        $this->idServicio = $idServicio;
        $this->nroServicio = $nroServicio;
        $this->ciudadOrigenServicio = $ciudadOrigenServicio;
        $this->ciudadDestinoServicio = $ciudadDestinoServicio;
        $this->estacionOrigenServicio = $estacionOrigenServicio;
        $this->estacionDestinoServicio = $estacionDestinoServicio;
        $this->horaSalidaServicio = $horaSalidaServicio;
        $this->horaLlegadaServicio = $horaLlegadaServicio;
        $this->frecuenciaServicio = $frecuenciaServicio;
        $this->precioServicio = $precioServicio;
        $this->idEmpresa = $idEmpresa;
        $this->empresa = null;
    }



    //Getters y setters
    public function getIdServicio(){
        return $this->idServicio;
    }
    public function getNroServicio(){
        return $this->nroServicio;
    }
    public function getCiudadOrigenServicio(){
        return $this->ciudadOrigenServicio;
    }
    public function getCiudadDestinoServicio(){
        return $this->ciudadDestinoServicio;
    }
    public function getEstacionOrigenServicio(){
        return $this->estacionOrigenServicio;
    }
    public function getEstacionDestinoServicio(){
        return $this->estacionDestinoServicio;
    }
    public function getHoraSalidaServicio(){
        return $this->horaSalidaServicio;
    }
    public function getHoraLlegadaServicio(){
        return $this->horaLlegadaServicio;
    }
    public function getFrecuenciaServicio(){
        return $this->frecuenciaServicio;
    }
    public function getPrecioServicio(){
        return $this->precioServicio;
    }
    public function getIdEmpresa(){
        return $this->idEmpresa;
    }




    public function getEmpresa() {
        return $this->empresa;
    }

    public function setEmpresa(Empresa $empresa) {
        $this->empresa = $empresa;
    }

}