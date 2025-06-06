<?php
class CookieManager {
    private int $duration; // duración en segundos
    private string $path;

    public function __construct(int $duration = 604800, string $path = '/') {
        $this->duration = $duration;
        $this->path = $path;
    }

    public function set(string $name, string $value): bool {
        return setcookie($name, $value, time() + $this->duration, $this->path);
    }
    
    public function setUpdated(string $name, string $value): bool {
        $result = setcookie($name, $value, time() + $this->duration, $this->path);
        if ($result) {
            $_COOKIE[$name] = $value;  // Actualiza para la petición actual
        }
        return $result;
    }

    public function increment(string $name): int {
        $currentValue = $this->getInt($name, 0);
        $newValue = $currentValue + 1;
        $this->set($name, (string)$newValue);
        return $newValue;
    }    

    public function get(string $name, $default = null) {
        return $_COOKIE[$name] ?? $default;
    }

    // Método para obtener entero, con validación simple
    public function getInt(string $name, int $default = 0): int {
        if (isset($_COOKIE[$name]) && is_numeric($_COOKIE[$name])) {
            return (int)$_COOKIE[$name];
        }
        return $default;
    }

    public function delete(string $name): bool {
        return setcookie($name, '', time() - 3600, $this->path);
    }

    public function exists(string $name): bool {
        return isset($_COOKIE[$name]);
    }


    //Para estructuras mas complejas
    public function setJson(string $name, $data): bool {
        $json = json_encode($data);
        if ($json === false) {
            return false; // JSON inválido o error
        }
        return $this->set($name, $json);
    }
    
    public function getJson(string $name, $default = null) {
        $value = $this->get($name);
        if ($value === null) {
            return $default;
        }
        $data = json_decode($value, true);
        return $data === null ? $default : $data;
    }


    public function clearAll(): void {
        foreach (array_keys($_COOKIE) as $name) {
            // Borra la cookie (con path)
            setcookie($name, '', time() - 3600, $this->path);
            // Borra de $_COOKIE para la petición actual
            unset($_COOKIE[$name]);
        }
    }

    public function clearAllExceptSession(): void {
        $sessionCookieName = session_name(); // normalmente "PHPSESSID"
        foreach ($_COOKIE as $name => $value) {
            if ($name !== $sessionCookieName) {
                $this->delete($name);
            }
        }
    }
    
    

    public function getBool(string $name, bool $default = false): bool {
        if (!isset($_COOKIE[$name])) {
            return $default;
        }
        $value = strtolower($_COOKIE[$name]);
        if (in_array($value, ['1', 'true', 'yes', 'on'], true)) {
            return true;
        }
        if (in_array($value, ['0', 'false', 'no', 'off'], true)) {
            return false;
        }
        return $default;
    }
    
    //Para comprobar si una cookie tiene un valor específico, por ejemplo para validaciones simples.
    public function hasValue(string $name, string $expectedValue): bool {
        return isset($_COOKIE[$name]) && $_COOKIE[$name] === $expectedValue;
    }
    
    
}
