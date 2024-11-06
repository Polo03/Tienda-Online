<?php
class DB {
    private static $host = 'localhost';
    private static $dbName = 'mi_tienda';
    private static $username = 'Carlos'; // Cambia según tu configuración
    private static $password = '123';     // Cambia según tu configuración
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
