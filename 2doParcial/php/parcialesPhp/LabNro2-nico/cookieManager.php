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

    public function get(string $name, $default = null) {
        return $_COOKIE[$name] ?? $default;
    }

    // Método para obtener entero, con validación simple.Una versión especializada de get() que obtiene el valor de una cookie como un entero. Incluye una validación para asegurar que el valor de la cookie sea numérico antes de convertirlo. Si no es numérica o no existe, retorna el $default (por defecto es 0).
    public function getInt(string $name, int $default = 0): int {
        if (isset($_COOKIE[$name]) && is_numeric($_COOKIE[$name])) {
            return (int)$_COOKIE[$name];
        }
        return $default;
    }
    // Este método se usa para eliminar una cookie. Lo logra estableciendo la fecha de expiración de la cookie en el pasado (específicamente, una hora atrás de la hora actual)
    public function delete(string $name): bool {
        return setcookie($name, '', time() - 3600, $this->path);
    }
    //Un método simple para verificar si una cookie con un nombre específico existe en el navegador del usuario. Retorna true si existe y false si no.
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

    //Un método útil para eliminar todas las cookies que tu aplicación ha establecido. Itera sobre todas las cookies presentes en la superglobal $_COOKIE y las elimina una por una usando el método delete()
    public function clearAll(): void {
        foreach ($_COOKIE as $name => $value) {
            $this->delete($name);
        }
    }
    
    // Un método inteligente para obtener el valor booleano de una cookie. Es flexible y puede interpretar varias representaciones de "verdadero" ('1', 'true', 'yes', 'on') y "falso" ('0', 'false', 'no', 'off'). Si el valor de la cookie no encaja en ninguna de estas representaciones, retorna el $default (por defecto false)
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
    
    //Para comprobar si una cookie tiene un valor específico, por ejemplo para validaciones simples. Permite verificar si una cookie no solo existe, sino que también tiene un valor específico. Es útil para validaciones rápidas, como confirmar que una cookie de sesión contiene un identificador esperado.
    public function hasValue(string $name, string $expectedValue): bool {
        return isset($_COOKIE[$name]) && $_COOKIE[$name] === $expectedValue;
    }
    
    
}
