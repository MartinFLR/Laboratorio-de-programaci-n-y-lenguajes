<?php
class Database {
    private static $conn;

    public static function getConnection() {
        if (!self::$conn) {
            $host = 'localhost';
            $user = 'root';
            $pass = '';
            $db = 'raileurope';
            self::$conn = new mysqli($host, $user, $pass, $db);
            if (self::$conn->connect_error) {
                die("Error: " . self::$conn->connect_error);
            }
        }
        return self::$conn;
    }
}
