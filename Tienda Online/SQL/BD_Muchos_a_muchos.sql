-- Crear base de datos (opcional)
CREATE DATABASE IF NOT EXISTS mi_tienda;
USE mi_tienda;

-- Tabla Cliente
CREATE TABLE Cliente (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    nickname VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    telefono VARCHAR(15),
    domicilio VARCHAR(100)
);

-- Tabla Producto
CREATE TABLE Producto (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    imagen TEXT
);

-- Tabla intermedia Compra
CREATE TABLE Compra (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    productos TEXT NOT NULL,
    fecha_compra TEXT NOT NULL,
    cantidades TEXT NOT NULL,
    precio_compra INT NOT NULL,

    -- Definir claves foráneas para relacionar Cliente y Producto
    FOREIGN KEY (cliente_id) REFERENCES Cliente(id) ON DELETE CASCADE
);

-- Insertar clientes
INSERT INTO Cliente (nombre, apellido, nickname, password, telefono, domicilio) VALUES
('Carlos', 'González', 'carlosg', 'pass123', '123456789', 'Calle 123'),
('Ana', 'Pérez', 'anap', 'pass456', '987654321', 'Avenida 456'),
('Luis', 'Martínez', 'luism', 'pass789', '555555555', 'Boulevard 789');

-- Insertar productos
INSERT INTO Producto (nombre, descripcion, precio, imagen) VALUES
                                                               ( 'Laptop', 'Laptop de alto rendimiento', 1500.00, '../Recursos/Subidas/laptop.jpg'),
                                                               ( 'Teléfono', 'Smartphone de última generación', 800.00, '../Recursos/Subidas/telefono.jpg'),
                                                               ( 'Tablet', 'Tablet con pantalla HD', 300.00, '../Recursos/Subidas/tablet.jpg'),
                                                               ( 'Auriculares', 'Auriculares inalámbricos', 100.00, '../Recursos/Subidas/auriculares.jpg'),
                                                               ( 'Cámara', 'Cámara profesional', 1200.00, '../Recursos/Subidas/camara.jpg'),
                                                               ( 'Monitor', 'Monitor 4K', 400.00, '../Recursos/Subidas/monitor.jpg'),
                                                               ( 'Teclado', 'Teclado mecánico', 80.00, '../Recursos/Subidas/teclado.jpg'),
                                                               ( 'Mouse', 'Mouse óptico', 25.00, '../Recursos/Subidas/mouse.jpg'),
                                                               ( 'Impresora', 'Impresora multifuncional', 200.00, '../Recursos/Subidas/impresora.jpg'),
                                                               ( 'Parlantes', 'Parlantes Bluetooth', 150.00, '../Recursos/Subidas/parlantes.jpg');

