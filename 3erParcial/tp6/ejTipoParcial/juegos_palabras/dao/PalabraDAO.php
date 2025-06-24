<?php
require_once __DIR__ . '/../baseDatos.php';
require_once __DIR__ . '/../clases/Palabra.php';

class PalabraDAO {
    public static function buscarTodas() {
        $conn = Database::getConnection();
        $stmt = $conn->prepare("SELECT * FROM palabras");
        $stmt->execute();
        $result = $stmt->get_result();
        $palabras = [];

        while ($row = $result->fetch_assoc()) {
            $palabras[] = new Palabra(
                $row['idPalabra'],
                $row['palabra'],
                $row['dificultadPalabra'],
                $row['acertada']
            );
        }

        return $palabras;
    }


    public static function buscarRandom() {
    $conn = Database::getConnection();
    $stmt = $conn->prepare("SELECT * FROM palabras ORDER BY RAND() LIMIT 1");
    
    if (!$stmt) {
        throw new Exception("Error en la preparación de la consulta: " . $conn->error);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
    if (!$row) {
        return null; // No hay palabras en la tabla
    }

    return new Palabra(
        $row['idPalabra'],
        $row['palabra'],
        $row['dificultadPalabra'],
        $row['acertada']
    );
}


public static function aumentarAcertada(int $idPalabra): bool {
        $conn = Database::getConnection();

        $sql = "UPDATE palabras SET acertada = acertada + 1 WHERE idPalabra = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Error preparando la consulta: " . $conn->error);
        }

        $stmt->bind_param("i", $idPalabra);

        if (!$stmt->execute()) {
            throw new Exception("Error ejecutando la consulta: " . $stmt->error);
        }

        return $stmt->affected_rows > 0;
    }

public static function subirPalabra(Palabra $palabra) {
    $conn = Database::getConnection();

    $sql = "INSERT INTO palabras (palabra, dificultadPalabra, acertada) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        throw new Exception("Error en la preparación de la consulta: " . $conn->error);
    }

    // Nota: bind_param("ssi", ...) porque dificultad es string y acertada int
    //Indica los tipos, po ejemplo aca tengo "string","String","int", ta buenarda
    $stmt->bind_param("ssi", $palabra->getPalabra(), $palabra->getDificultad(), $palabra->getAcertada());
    

    //Ejecuta la consulta con los valores vinculados.
    //Si la ejecución fue exitosa, devuelve el ID auto-incremental generado (el nuevo registro insertado).
    //Si falla, lanza excepción con el error.
    if ($stmt->execute()) {
        return $conn->insert_id;
    } else {
        throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
    }
}



public static function actualizarPalabra(Palabra $palabra) {
    $conn = Database::getConnection();

    $sql = "UPDATE palabras 
            SET palabra = ?, dificultadPalabra = ?, acertada = ?
            WHERE idPalabra = ?";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        throw new Exception("Error preparando la consulta: " . $conn->error);
    }

    // Tipos: palabra (string), dificultad (string), acertada (int), id (int)
    $stmt->bind_param("ssii", $palabra->getPalabra(), $palabra->getDificultad(), $palabra->getAcertada(), $palabra->getId());

    if ($stmt->execute()) {
        return $conn->affected_rows; // Devuelve cuántas filas fueron modificadas
    } else {
        throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
    }
}


}
