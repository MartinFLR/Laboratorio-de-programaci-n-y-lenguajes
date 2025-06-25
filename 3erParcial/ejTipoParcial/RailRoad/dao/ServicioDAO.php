<?php
require_once __DIR__ . '/../baseDatos.php';
require_once __DIR__ . '/../clases/Servicio.php';

class ServicioDAO {

public static function buscarTodasCiudadesOrigen() {
    $conn = Database::getConnection();
    $stmt = $conn->prepare("SELECT DISTINCT ciudadOrigenServicio FROM servicios");
    $stmt->execute();
    $result = $stmt->get_result();
    $ciudades = [];

    while ($row = $result->fetch_assoc()) {
        $ciudades[] = $row['ciudadOrigenServicio'];
    }

    return $ciudades;
}


public static function buscarTodasCiudadesDestino() {
    $conn = Database::getConnection();
    $stmt = $conn->prepare("SELECT DISTINCT ciudadDestinoServicio FROM servicios");
    $stmt->execute();
    $result = $stmt->get_result();
    $ciudades = [];

    while ($row = $result->fetch_assoc()) {
        $ciudades[] = $row['ciudadDestinoServicio'];
    }

    return $ciudades;
}

public static function buscarSegunIdEmpresa($idEmpresa){
    $conn = Database::getConnection();
    $stmt = $conn->prepare(
    "SELECT * FROM servicios AS s 
     JOIN empresas AS e ON s.idEmpresa = e.idEmpresa 
     WHERE s.idEmpresa = ?"
    );

    $stmt->bind_param("i",$idEmpresa);
    $stmt->execute();
    $result = $stmt->get_result();
    $servicios = [];

    while ($row = $result->fetch_assoc()) {
        $servicio = new Servicio(
            $row['idServicio'],
            $row['nroServicio'],
            $row['ciudadOrigenServicio'],
            $row['ciudadDestinoServicio'],
            $row['estacionOrigenServicio'],
            $row['estacionDestinoServicio'],
            $row['horaSalidaServicio'],
            $row['horaLlegadaServicio'],
            $row['frecuenciaServicio'],
            $row['precioServicio'],
            $row['idEmpresa']
        );
        $servicios[] = $servicio;
    }

    return $servicios;
}

public static function buscarSegunFiltrosSeleccionados($ciudadOrigen, $ciudadDestino) {
    $conn = Database::getConnection();

    $query = "SELECT s.*, e.nombreEmpresa, e.paisEmpresa, e.webEmpresa, e.logoEmpresa
              FROM servicios AS s
              JOIN empresas AS e ON s.idEmpresa = e.idEmpresa";

    $params = [];
    $types = [];
    $conditions = [];

    if (!empty($ciudadOrigen)) {
        $conditions[] = "s.ciudadOrigenServicio = ?";
        $params[] = $ciudadOrigen;
        $types[] = "s";
    }

    if (!empty($ciudadDestino)) {
        $conditions[] = "s.ciudadDestinoServicio = ?";
        $params[] = $ciudadDestino;
        $types[] = "s";
    }

    if (!empty($conditions)) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }

    $stmt = $conn->prepare($query);

    if (!empty($params)) {
        $stmt->bind_param(implode("", $types), ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $servicios = [];

    while ($row = $result->fetch_assoc()) {
        // Crear empresa con todos los campos traídos
        $empresa = new Empresa(
            $row['idEmpresa'],
            $row['nombreEmpresa'],
            $row['paisEmpresa'],
            $row['webEmpresa'],
            $row['logoEmpresa']
        );
        // Opcional: si agregaste teléfono en la clase Empresa, agregar aquí también

        // Crear servicio
        $servicio = new Servicio(
            $row['idServicio'],
            $row['nroServicio'],
            $row['ciudadOrigenServicio'],
            $row['ciudadDestinoServicio'],
            $row['estacionOrigenServicio'],
            $row['estacionDestinoServicio'],
            $row['horaSalidaServicio'],
            $row['horaLlegadaServicio'],
            $row['frecuenciaServicio'],
            $row['precioServicio'],
            $row['idEmpresa']
        );

        $servicio->setEmpresa($empresa);

        $servicios[] = $servicio;
    }

    return $servicios;
}
}