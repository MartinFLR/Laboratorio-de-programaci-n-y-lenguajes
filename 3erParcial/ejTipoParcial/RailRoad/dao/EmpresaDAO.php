<?php
require_once __DIR__ . '/../baseDatos.php';
require_once __DIR__ . '/../clases/Empresa.php';

class EmpresaDAO {
    public static function obtenerEmpresaPorId($idEmpresa) {
        $conn = Database::getConnection();

        $sql = "SELECT * FROM empresas WHERE idEmpresa = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error preparando consulta: " . $conn->error);
        }

        $stmt->bind_param("i", $idEmpresa);
        $stmt->execute();
        $result = $stmt->get_result();

        $empresa = [];
        while ($row = $result->fetch_assoc()) {
            $empresa[] = new Empresa(
                $row['idEmpresa'],
                $row['nombreEmpresa'],
                $row['paisEmpresa'],
                $row['webEmpresa'],
                $row['logoEmpresa'],
            );
        }

        return $empresa;
    }
}