-- Crear base de datos
CREATE DATABASE parras;

-- Seleccionar la base de datos
USE parras;

-- Crear tabla de vendedores
CREATE TABLE sellers (
    vendedor_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    telefono VARCHAR(15)
);

-- Crear tabla de propiedades
CREATE TABLE properties (
    propiedad_id INT AUTO_INCREMENT PRIMARY KEY,
    direccion VARCHAR(255) NOT NULL,
    precio DECIMAL(15, 2) NOT NULL,
    fecha_de_venta DATE NOT NULL,
    vendedor_id INT,
    FOREIGN KEY (vendedor_id) REFERENCES sellers(vendedor_id)
);
-- crear tabla de ventas
CREATE TABLE sales (
    propiedad_id INT(11),
    vendedor_id INT(11),
    venta_date DATE,
    PRIMARY KEY (propiedad_id, vendedor_id, venta_date),
    CONSTRAINT fk_propiedad_sales FOREIGN KEY (propiedad_id) REFERENCES properties(propiedad_id),
    CONSTRAINT fk_sellers_sales FOREIGN KEY (vendedor_id) REFERENCES sellers(vendedor_id)
);

-- Insertar un vendedor
INSERT INTO sellers (nombre, email, telefono)
VALUES ('Gaddiel', 'Gaddil_Barrios@Gmail.com', '664-124-83-17');

-- Insertar una propiedad asociada al vendedor
INSERT INTO Properties (direccion, precio, fecha_de_venta, vendedor_id)
VALUES ('New York manhaetan', 2500000.00, '2023-01-15', 1);

SELECT * from sellers