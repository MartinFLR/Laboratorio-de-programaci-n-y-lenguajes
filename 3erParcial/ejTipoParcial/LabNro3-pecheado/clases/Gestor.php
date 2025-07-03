<?php
require_once __DIR__ . '/../dao/DAO.php';

class Gestor {

    public function filtrar($texto, $tipo = ""){
        switch($tipo){
            case "producto":{
                return DAO::buscarProductosPorParametro($texto);
            }
            case "ubicacion":{
                return DAO::buscarProductosPorUbicacion($texto);
            }
        
        }

    }
}