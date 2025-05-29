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
}
