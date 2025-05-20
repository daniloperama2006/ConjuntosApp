DROP DATABASE IF EXISTS conjunto;
CREATE DATABASE conjunto;
USE conjunto;

CREATE TABLE propietario (
  id_propietario INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  apellido VARCHAR(100) NOT NULL,
  correo VARCHAR(100) UNIQUE NOT NULL,
  clave VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Trigger: hasheo MD5 antes de insertar clave
DELIMITER $$
CREATE TRIGGER tr_insert_propietario_md5
BEFORE INSERT ON propietario
FOR EACH ROW
BEGIN
  SET NEW.clave = MD5(NEW.clave);
END;
$$
DELIMITER ;

-- Tabla: admin
CREATE TABLE admin (
  id_admin INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  apellido VARCHAR(100) NOT NULL,
  correo VARCHAR(100) UNIQUE NOT NULL,
  clave VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Trigger: hasheo MD5 antes de insertar clave
DELIMITER $$
CREATE TRIGGER tr_insert_admin_md5
BEFORE INSERT ON admin
FOR EACH ROW
BEGIN
  SET NEW.clave = MD5(NEW.clave);
END;
$$
DELIMITER ;

-- Tabla: apartamento
CREATE TABLE apartamento (
  id_apartamento INT AUTO_INCREMENT PRIMARY KEY,
  numero INT NOT NULL,
  bloque INT NOT NULL,
  id_propietario INT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_propietario) REFERENCES propietario(id_propietario)
);

-- Tabla: estado
CREATE TABLE estado (
  id_estado INT AUTO_INCREMENT PRIMARY KEY,
  nombre_estado VARCHAR(45) UNIQUE NOT NULL
);

-- Tabla: cuenta_cobro
CREATE TABLE cuenta_cobro (
  id_cuenta INT AUTO_INCREMENT PRIMARY KEY,
  id_apartamento INT NOT NULL,
  id_estado INT NOT NULL,
  fecha_generacion DATE NOT NULL,
  valor DECIMAL(10,2) NOT NULL,
  id_admin INT NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_apartamento) REFERENCES apartamento(id_apartamento),
  FOREIGN KEY (id_estado) REFERENCES estado(id_estado),
  FOREIGN KEY (id_admin) REFERENCES admin(id_admin)
);

-- Tabla: pago
CREATE TABLE pago (
  id_pago INT AUTO_INCREMENT PRIMARY KEY,
  id_cuenta INT NOT NULL,
  fecha_pago DATE NOT NULL,
  monto_pagado DECIMAL(10,2) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (id_cuenta) REFERENCES cuenta_cobro(id_cuenta)
);

-- Trigger: evitar edición de pagos
DELIMITER $$
CREATE TRIGGER tr_prevent_edit_pago
BEFORE UPDATE ON pago
FOR EACH ROW
BEGIN
  SIGNAL SQLSTATE '45000'
  SET MESSAGE_TEXT = 'No está permitido editar registros de pagos.';
END;
$$
DELIMITER ;

-- Datos iniciales
INSERT INTO estado (nombre_estado) VALUES
('PENDIENTE'), ('PAGADO'), ('EN MORA');
