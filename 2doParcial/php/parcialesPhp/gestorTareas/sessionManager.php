<?php
class SessionManager {
    public function __construct() {
        // Asegura que la sesión esté iniciada
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    // Guarda un valor en la sesión
    public function set(string $key, $value): void {
        $_SESSION[$key] = $value;
    }

    // Obtiene un valor de la sesión, o un valor por defecto si no existe
    public function get(string $key, $default = null) {
        return $_SESSION[$key] ?? $default;
    }

    // Verifica si una clave existe en la sesión
    public function exists(string $key): bool {
        return isset($_SESSION[$key]);
    }

    // Elimina una clave específica de la sesión
    public function destroy(string $key): void {
        unset($_SESSION[$key]);
    }

    // Limpia completamente la sesión (opcional)
    public function clearAll(): void {
        $_SESSION = [];
        session_destroy();
    }



    public function setJson(string $key, $value): void {
        $_SESSION[$key] = json_encode($value);
    }

    // Recupera y decodifica un valor JSON guardado en sesión
    public function getJson(string $key, $default = null) {
        if (!isset($_SESSION[$key])) {
            return $default;
        }

        $decoded = json_decode($_SESSION[$key], true);

        // En caso de error de decodificación, retorna el valor por defecto
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $default;
        }

        return $decoded;
    }

}
