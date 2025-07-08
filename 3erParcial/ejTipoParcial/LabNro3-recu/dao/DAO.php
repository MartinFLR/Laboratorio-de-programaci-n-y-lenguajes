<?php
require_once __DIR__ . '/../baseDatos.php';
require_once __DIR__ . '/../clases/Servicio.class.php';
require_once __DIR__ . '/../clases/DetalleServicio.class.php';


class DAO {

public static function buscarTodasEmpresas() {
    $conn = Database::getConnection();
    $stmt = $conn->prepare("SELECT DISTINCT nombreEmpresa FROM empresas");
    $stmt->execute();
    $result = $stmt->get_result();
    $empresas = [];

    while ($row = $result->fetch_assoc()) {
        $empresas[] = $row['nombreEmpresa'];
    }

    return $empresas;
}


public static function buscarPorFiltros(string $empresa, string $dia) {
    $nuevoDia = "";
    switch(strtolower($dia)) {
        case "lunes":     $nuevoDia = "s.operaLU"; break;
        case "martes":    $nuevoDia = "s.operaMA"; break;
        case "miercoles": $nuevoDia = "s.operaMI"; break;
        case "jueves":    $nuevoDia = "s.operaJU"; break;
        case "viernes":   $nuevoDia = "s.operaVI"; break;
        case "sabado":    $nuevoDia = "s.operaSA"; break;
        case "domingo":   $nuevoDia = "s.operaDO"; break;
    }

    $true = "True";
    $conn = Database::getConnection();

    if ($nuevoDia === "") {
        // Solo filtrar por empresa
        $sql = "SELECT s.idServicio, s.ciudadOrigen, s.ciudadDestino, s.horaLlegada, s.horaSalida
                  FROM servicios AS s
                  JOIN empresas AS e ON s.idEmpresa = e.idEmpresa
                  WHERE e.nombreEmpresa = '{$empresa}'";
    } else {
        // Filtrar por empresa O día
        $sql = "SELECT s.idServicio, s.ciudadOrigen, s.ciudadDestino, s.horaLlegada, s.horaSalida
                  FROM servicios AS s
                  JOIN empresas AS e ON s.idEmpresa = e.idEmpresa
                  WHERE e.nombreEmpresa = '{$empresa}' AND {$nuevoDia} = '{$true}'";
    }

    $result = $conn->query($sql);
    $servicios = [];
    while ($row = $result->fetch_assoc()) {
        $servicios[] = new Servicio(
            $row['idServicio'], 
            $row['ciudadOrigen'],
            $row['ciudadDestino'],
            $row['horaSalida'],
            $row['horaLlegada']
        );
    }

    return $servicios;
}


public static function buscarPorIdServicio(int $idServicio) {
    $conn = Database::getConnection();
    $sql = "SELECT s.asientosSemicama, s.precioPasajeSemicama, e.webEmpresa, s.asientosCama, s.precioPasajeCama,
                    s.operaLU,s.operaMA,s.operaMI,s.operaJU,s.operaVI,s.operaSA,s.operaDO
              FROM servicios AS s
              JOIN empresas AS e ON s.idEmpresa = e.idEmpresa
              WHERE s.idServicio = ?";


    $stmt = $conn->prepare($sql);

    if (!$stmt) throw new Exception("Error preparando: " . $conn->error);


    $stmt->bind_param("i", $idServicio);
    $stmt->execute();

    $result = $stmt->get_result();
    $palabras = [];
    while ($row = $result->fetch_assoc()) {
        $palabras[] = new DetalleServicio(
            $row['asientosSemicama'],
            $row['precioPasajeSemicama'],
            $row['asientosCama'],
            $row['precioPasajeCama'],
            $row['webEmpresa'],
            $row['operaLU'],
            $row['operaMA'],
            $row['operaMI'],
            $row['operaJU'],
            $row['operaVI'],
            $row['operaSA'],
            $row['operaDO'],
        );
    }

    return $palabras;
}


}
