<?php
/**
 * Clase SqlUtils
 * Métodos que retornan strings con consultas SQL de ejemplo para base de datos de servicios/empresas/ciudades.
 */

class SqlUtils {

    // Consulta para obtener todos los servicios
    public static function obtenerTodosLosServicios(): string {
        return "SELECT * FROM servicio";
    }

    // Consulta para obtener un servicio por id
    public static function obtenerServicioPorId(): string {
        return "SELECT * FROM servicio WHERE idServicio = ?";
    }

    // Consulta para obtener servicios con datos de empresa y ciudades (JOIN)
    public static function obtenerServiciosConDetalles(): string {
        return "
            SELECT s.*, 
                   e.idEmpresa, e.nombreEmpresa,
                   co.idCiudad AS idCiudadOrigen, co.nombre AS nombreCiudadOrigen,
                   cd.idCiudad AS idCiudadDestino, cd.nombre AS nombreCiudadDestino
            FROM servicio s
            JOIN empresa e ON s.idEmpresa = e.idEmpresa
            JOIN ciudad co ON s.ciudadOrigenServicio = co.idCiudad
            JOIN ciudad cd ON s.ciudadDestinoServicio = cd.idCiudad
        ";
    }

    // Consulta para insertar un nuevo servicio
    public static function insertarServicio(): string {
        return "
            INSERT INTO servicio (
                nroServicio, ciudadOrigenServicio, ciudadDestinoServicio, 
                estacionOrigenServicio, estacionDestinoServicio, horaSalidaServicio,
                horaLlegadaServicio, frecuenciaServicio, precioServicio, idEmpresa
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";
    }

    // Consulta para actualizar precio y frecuencia de un servicio
    public static function actualizarServicioPrecioFrecuencia(): string {
        return "
            UPDATE servicio
            SET precioServicio = ?, frecuenciaServicio = ?
            WHERE idServicio = ?
        ";
    }

    // Consulta para eliminar un servicio por id
    public static function eliminarServicioPorId(): string {
        return "DELETE FROM servicio WHERE idServicio = ?";
    }

    // Consulta para obtener todas las empresas
    public static function obtenerTodasLasEmpresas(): string {
        return "SELECT * FROM empresa ORDER BY nombreEmpresa";
    }

    // Consulta para buscar empresas por nombre parcial
    public static function buscarEmpresaPorNombre(): string {
        return "SELECT * FROM empresa WHERE nombreEmpresa LIKE ?";
    }

    // Consulta para obtener ciudades por nombre parcial
    public static function buscarCiudadesPorNombre(): string {
        return "SELECT * FROM ciudad WHERE nombre LIKE ? ORDER BY nombre";
    }

    // Consulta para contar cantidad de servicios por empresa
    public static function contarServiciosPorEmpresa(): string {
        return "
            SELECT e.nombreEmpresa, COUNT(s.idServicio) AS totalServicios
            FROM empresa e
            LEFT JOIN servicio s ON e.idEmpresa = s.idEmpresa
            GROUP BY e.idEmpresa
            ORDER BY totalServicios DESC
        ";
    }

    // Consulta para obtener horarios de salida de un servicio específico
    public static function obtenerHorarioSalidaPorServicio(): string {
        return "SELECT horaSalidaServicio FROM servicio WHERE idServicio = ?";
    }

}
