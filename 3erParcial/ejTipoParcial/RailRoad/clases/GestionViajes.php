<?php
require_once __DIR__ . '/Empresa.php';
require_once __DIR__ . '/Servicio.php';
require_once __DIR__ . '/../dao/EmpresaDAO.php';
require_once __DIR__ . '/../dao/ServicioDAO.php';

class GestionViajes {
    private $ciudadesOrigen = [];
    private $ciudadesDestino = [];
    private $servicios = [];
    private $serviciosEmpresa = [];

    public function iniciarPagina(){
        $this->ciudadesOrigen = ServicioDAO::buscarTodasCiudadesOrigen();
        $this->ciudadesDestino = ServicioDAO::buscarTodasCiudadesDestino();
    }

    public function filtrar($ciudadOrigen, $ciudadDestino){
        $this->servicios = ServicioDAO::buscarSegunFiltrosSeleccionados($ciudadOrigen,$ciudadDestino);
        return $this->servicios;
    }

    public function buscarEmpresa($idEmpresa){
        $this->serviciosEmpresa = ServicioDAO::buscarSegunIdEmpresa($idEmpresa);
        return $this->serviciosEmpresa;
    }




    //Getters
    public function getCiudadesOrigen(){
        return $this->ciudadesOrigen;
    }
    public function getCiudadesDestino(){
        return $this->ciudadesDestino;
    }

}