<?php
require_once __DIR__ . '/../baseDatos.php';
require_once __DIR__ . '/../clases/pista.php';

class PistaDAO {

public static function obtenerPorIdPalabra($idPalabra) {
        $conn = Database::getConnection();

        $sql = "SELECT * FROM pistas WHERE idPalabra = ? ORDER BY ordenPista ASC";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            throw new Exception("Error preparando consulta: " . $conn->error);
        }

        $stmt->bind_param("i", $idPalabra);
        $stmt->execute();
        $result = $stmt->get_result();

        $pistas = [];
        while ($row = $result->fetch_assoc()) {
            $pistas[] = new Pista(
                $row['idpista'],
                $row['idPalabra'],
                $row['ordenPista'],
                $row['pista']
            );
        }

        return $pistas;
    }


}