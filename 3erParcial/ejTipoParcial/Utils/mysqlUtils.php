<?php
class Database {

/*
SELECT        -- qué columnas
FROM          -- de qué tabla
JOIN          -- con qué otra tabla (opcional)
ON            -- cómo se relacionan
WHERE         -- filtros
GROUP BY      -- agrupar
HAVING        -- filtro sobre grupos
ORDER BY      -- ordenamiento
LIMIT         -- cuántos resultados
*/

public static function buscarUltimasCreadas(int $limite) {
    $conn = Database::getConnection();
    $sql = "SELECT * FROM palabras ORDER BY fechaCreacion DESC LIMIT ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        throw new Exception("Error preparando consulta: " . $conn->error);
    }

    $stmt->bind_param("i", $limite);
    $stmt->execute();
    $result = $stmt->get_result();

    $palabras = [];
    while ($row = $result->fetch_assoc()) {
        $palabras[] = new Palabra($row['idPalabra'], $row['palabra'], $row['dificultadPalabra'], $row['acertada']);
    }

    return $palabras;
}

public static function crearPalabra(string $palabra, string $dificultad, int $acertada = 0) {
    $conn = Database::getConnection();
    $sql = "INSERT INTO palabras (palabra, dificultadPalabra, acertada) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) throw new Exception("Error preparando: " . $conn->error);

    $stmt->bind_param("ssi", $palabra, $dificultad, $acertada);
    if ($stmt->execute()) {
        return $conn->insert_id;
    }

    throw new Exception("Error ejecutando: " . $stmt->error);
}


public static function obtenerPalabraPorId(int $id) {
    $conn = Database::getConnection();
    $sql = "SELECT * FROM palabras WHERE idPalabra = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) throw new Exception("Error preparando: " . $conn->error);

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
    return $row ? new Palabra($row['idPalabra'], $row['palabra'], $row['dificultadPalabra'], $row['acertada']) : null;
}

//UPDATE CON JOIN
public static function aumentarAcertadasPorCategoria(string $nombreCategoria): int {
    $conn = Database::getConnection();

    $sql = "UPDATE palabras p
            INNER JOIN categorias c ON p.idCategoria = c.idCategoria
            SET p.acertada = p.acertada + 1
            WHERE c.nombre = ?";

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Error preparando la consulta: " . $conn->error);
    }

    $stmt->bind_param("s", $nombreCategoria);

    if (!$stmt->execute()) {
        throw new Exception("Error ejecutando la consulta: " . $stmt->error);
    }

    return $stmt->affected_rows;
}


public static function obtenerProductoMasCaroPorCategoria(string $nombreCategoria): ?array {
    $conn = Database::getConnection();
    $sql = "SELECT p.nombre, p.precio 
            FROM productos p
            INNER JOIN categorias c ON p.idCategoria = c.idCategoria
            WHERE c.nombre = ?
            ORDER BY p.precio DESC
            LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nombreCategoria);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc() ?: null;
}


public static function obtenerUsuarioConMasAlertas(): ?array {
    $conn = Database::getConnection();
    $sql = "SELECT u.idUsuario, u.nombre, COUNT(a.idAlerta) AS total 
            FROM usuarios u
            JOIN alertas a ON u.idUsuario = a.idUsuario
            GROUP BY u.idUsuario
            ORDER BY total DESC
            LIMIT 1";
    $result = $conn->query($sql);

    return $result->fetch_assoc() ?: null;
}

// Obtener y actualizar valor mínimo
public static function marcarComoMasAntiguo(): bool {
    $conn = Database::getConnection();
    $sql = "UPDATE documentos 
            SET esMasAntiguo = 1 
            WHERE fecha = (SELECT MIN(fecha) FROM documentos)";
    return $conn->query($sql);
}



public static function obtenerPuntajeMaximo(int $idUsuario): ?int {
    $conn = Database::getConnection();
    $sql = "SELECT MAX(puntaje) AS maximo FROM jugadas WHERE idUsuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $row = $result->fetch_assoc();
    return $row['maximo'] !== null ? (int)$row['maximo'] : null;
}



public static function editarPalabra(int $id, string $palabra, string $dificultad, int $acertada) {
    $conn = Database::getConnection();
    $sql = "UPDATE palabras SET palabra = ?, dificultadPalabra = ?, acertada = ? WHERE idPalabra = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) throw new Exception("Error preparando: " . $conn->error);

    $stmt->bind_param("ssii", $palabra, $dificultad, $acertada, $id);
    return $stmt->execute();
}


public static function editarPedidoConProductos(
    int $idPedido,
    string $estado,
    array $productos // array de ['idProducto' => cantidad]
): bool {
    $conn = Database::getConnection();
    $conn->begin_transaction();

    try {
        // Actualizar estado del pedido
        $sqlPedido = "UPDATE pedidos SET estado = ? WHERE idPedido = ?";
        $stmtPedido = $conn->prepare($sqlPedido);
        $stmtPedido->bind_param("si", $estado, $idPedido);
        $stmtPedido->execute();

        // Eliminar productos anteriores
        $sqlDelete = "DELETE FROM pedido_producto WHERE idPedido = ?";
        $stmtDelete = $conn->prepare($sqlDelete);
        $stmtDelete->bind_param("i", $idPedido);
        $stmtDelete->execute();

        // Insertar los nuevos productos
        $sqlInsert = "INSERT INTO pedido_producto (idPedido, idProducto, cantidad) VALUES (?, ?, ?)";
        $stmtInsert = $conn->prepare($sqlInsert);

        foreach ($productos as $idProducto => $cantidad) {
            $stmtInsert->bind_param("iii", $idPedido, $idProducto, $cantidad);
            $stmtInsert->execute();
        }

        $conn->commit();
        return true;

    } catch (Exception $e) {
        $conn->rollback();
        throw new Exception("Error al editar pedido: " . $e->getMessage());
    }
}



public static function eliminarPalabra(int $id) {
    $conn = Database::getConnection();
    $sql = "DELETE FROM palabras WHERE idPalabra = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) throw new Exception("Error preparando: " . $conn->error);

    $stmt->bind_param("i", $id);
    return $stmt->execute();
}


public static function buscarPorTexto(string $busqueda) {
    $conn = Database::getConnection();
    $sql = "SELECT * FROM palabras WHERE palabra LIKE ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) throw new Exception("Error preparando: " . $conn->error);

    $like = "%$busqueda%";
    $stmt->bind_param("s", $like);
    $stmt->execute();

    $result = $stmt->get_result();
    $palabras = [];
    while ($row = $result->fetch_assoc()) {
        $palabras[] = new Palabra($row['idPalabra'], $row['palabra'], $row['dificultadPalabra'], $row['acertada']);
    }

    return $palabras;
}


public static function contarTotalPalabras(): int {
    $conn = Database::getConnection();
    $sql = "SELECT COUNT(*) AS total FROM palabras";
    $stmt = $conn->prepare($sql);

    if (!$stmt) throw new Exception("Error preparando: " . $conn->error);

    $stmt->execute();
    $result = $stmt->get_result();
    return (int) $result->fetch_assoc()['total'];
}

//OFFSET es una cláusula que se usa con LIMIT para saltar una cierta cantidad de filas al realizar una consulta.
public static function buscarPaginado(int $limite, int $offset) {
    $conn = Database::getConnection();
    $sql = "SELECT * FROM palabras LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) throw new Exception("Error preparando: " . $conn->error);

    $stmt->bind_param("ii", $limite, $offset);
    $stmt->execute();

    $result = $stmt->get_result();
    $palabras = [];
    while ($row = $result->fetch_assoc()) {
        $palabras[] = new Palabra($row['idPalabra'], $row['palabra'], $row['dificultadPalabra'], $row['acertada']);
    }

    return $palabras;
}

public static function buscarConCategoria() {
    $conn = Database::getConnection();
    $sql = "SELECT p.*, c.nombre AS categoria 
            FROM palabras p 
            INNER JOIN categorias c ON p.idCategoria = c.idCategoria";

    $stmt = $conn->prepare($sql);
    if (!$stmt) throw new Exception("Error preparando: " . $conn->error);

    $stmt->execute();
    $result = $stmt->get_result();

    $datos = [];
    while ($row = $result->fetch_assoc()) {
        $datos[] = [
            'id' => $row['idPalabra'],
            'palabra' => $row['palabra'],
            'dificultad' => $row['dificultadPalabra'],
            'acertada' => $row['acertada'],
            'categoria' => $row['categoria']
        ];
    }

    return $datos;
}

public static function topPalabrasAcertadas(int $limite): array {
    $conn = Database::getConnection();
    $sql = "SELECT * FROM palabras ORDER BY acertada DESC LIMIT ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) throw new Exception("Error preparando: " . $conn->error);
    $stmt->bind_param("i", $limite);
    $stmt->execute();

    $result = $stmt->get_result();
    $palabras = [];

    while ($row = $result->fetch_assoc()) {
        $palabras[] = new Palabra($row['idPalabra'], $row['palabra'], $row['dificultadPalabra'], $row['acertada']);
    }

    return $palabras;
}

public static function verificarExistencia(string $palabra): bool {
    $conn = Database::getConnection();
    $sql = "SELECT idPalabra FROM palabras WHERE palabra = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) throw new Exception("Error preparando: " . $conn->error);
    $stmt->bind_param("s", $palabra);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->num_rows > 0;
}



public static function buscarPorRangoDeFechas(string $desde, string $hasta) {
    $conn = Database::getConnection();
    $sql = "SELECT * FROM palabras WHERE fechaCreacion BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) throw new Exception("Error preparando: " . $conn->error);
    $stmt->bind_param("ss", $desde, $hasta);
    $stmt->execute();

    $result = $stmt->get_result();
    $palabras = [];

    while ($row = $result->fetch_assoc()) {
        $palabras[] = new Palabra($row['idPalabra'], $row['palabra'], $row['dificultadPalabra'], $row['acertada']);
    }

    return $palabras;
}


public static function buscarUltimaInsertada() {
    $conn = Database::getConnection();
    $sql = "SELECT * FROM palabras ORDER BY idPalabra DESC LIMIT 1";
    $stmt = $conn->prepare($sql);

    if (!$stmt) throw new Exception("Error preparando: " . $conn->error);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    return $row ? new Palabra($row['idPalabra'], $row['palabra'], $row['dificultadPalabra'], $row['acertada']) : null;
}


//DISTINCT sirve para eliminar los duplicados en los resultados de una consulta.
//👉 “Traé solo los valores únicos de la columna dificultadPalabra”
public static function listarDificultadesDisponibles(): array {
    $conn = Database::getConnection();
    $sql = "SELECT DISTINCT dificultadPalabra FROM palabras";
    $stmt = $conn->prepare($sql);

    if (!$stmt) throw new Exception("Error preparando: " . $conn->error);
    $stmt->execute();

    $result = $stmt->get_result();
    $dificultades = [];

    while ($row = $result->fetch_assoc()) {
        $dificultades[] = $row['dificultadPalabra'];
    }

    return $dificultades;
}


}