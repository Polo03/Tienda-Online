<?php
class db {
    private static $host = 'localhost';
    private static $dbName = 'pruebas';
    private static $username = 'root'; // Cambia según tu configuración
    private static $password = '';     // Cambia según tu configuración
    private static $conn = null;

    public static function getConnection() {
        if (self::$conn === null) {
            try {
                self::$conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbName, self::$username, self::$password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Error de conexión: " . $e->getMessage();
            }
        }
        return self::$conn;
    }
}
?>
