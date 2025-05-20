-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2025 at 12:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `conjunto`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nombre`, `apellido`, `correo`, `clave`, `created_at`, `updated_at`) VALUES
(1, 'Juan', 'Pérez', '10@con.com', '202cb962ac59075b964b07152d234b70', '2025-05-20 16:34:59', '2025-05-20 16:34:59');

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `tr_insert_admin_md5` BEFORE INSERT ON `admin` FOR EACH ROW BEGIN
  SET NEW.clave = MD5(NEW.clave);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `apartamento`
--

CREATE TABLE `apartamento` (
  `id_apartamento` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `id_propietario` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apartamento`
--

INSERT INTO `apartamento` (`id_apartamento`, `numero`, `id_propietario`, `created_at`) VALUES
(1, 101, 1, '2025-05-20 16:58:12'),
(22, 102, 2, '2025-05-20 17:25:51'),
(23, 103, 3, '2025-05-20 17:25:51'),
(24, 104, 4, '2025-05-20 17:25:51'),
(25, 105, 5, '2025-05-20 17:25:51'),
(26, 106, 6, '2025-05-20 17:25:51'),
(27, 107, 7, '2025-05-20 17:25:51'),
(28, 108, 8, '2025-05-20 17:25:51'),
(29, 109, 9, '2025-05-20 17:25:51'),
(30, 110, 10, '2025-05-20 17:25:51'),
(31, 111, 11, '2025-05-20 17:25:51');

-- --------------------------------------------------------

--
-- Table structure for table `cuenta_cobro`
--

CREATE TABLE `cuenta_cobro` (
  `id_cuenta` int(11) NOT NULL,
  `id_apartamento` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `fecha_generacion` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cuenta_cobro`
--

INSERT INTO `cuenta_cobro` (`id_cuenta`, `id_apartamento`, `id_estado`, `fecha_generacion`, `valor`, `id_admin`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-01-01', 30000.00, 1, '2025-05-20 17:15:30', '2025-05-20 17:15:30'),
(104, 1, 1, '2025-05-01', 250000.00, 1, '2025-05-20 17:31:04', '2025-05-20 17:31:04'),
(105, 22, 2, '2025-05-01', 250000.00, 1, '2025-05-20 17:31:04', '2025-05-20 17:31:04'),
(106, 23, 2, '2025-05-01', 250000.00, 1, '2025-05-20 17:31:04', '2025-05-20 17:31:04'),
(107, 24, 3, '2025-05-01', 250000.00, 1, '2025-05-20 17:31:04', '2025-05-20 17:31:04'),
(108, 25, 3, '2025-05-01', 250000.00, 1, '2025-05-20 17:31:04', '2025-05-20 17:31:04'),
(109, 26, 2, '2025-05-01', 250000.00, 1, '2025-05-20 17:31:04', '2025-05-20 17:31:04'),
(110, 27, 1, '2025-05-01', 250000.00, 1, '2025-05-20 17:31:04', '2025-05-20 17:31:04'),
(111, 28, 2, '2025-05-01', 250000.00, 1, '2025-05-20 17:31:04', '2025-05-20 17:31:04'),
(112, 29, 2, '2025-05-01', 250000.00, 1, '2025-05-20 17:31:04', '2025-05-20 17:31:04'),
(113, 30, 1, '2025-05-01', 250000.00, 1, '2025-05-20 17:31:04', '2025-05-20 17:31:04'),
(114, 31, 1, '2025-05-01', 250000.00, 1, '2025-05-20 17:31:04', '2025-05-20 17:31:04');

-- --------------------------------------------------------

--
-- Table structure for table `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `nombre_estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estado`
--

INSERT INTO `estado` (`id_estado`, `nombre_estado`) VALUES
(3, 'EN MORA'),
(2, 'PAGADO'),
(1, 'PENDIENTE');

-- --------------------------------------------------------

--
-- Table structure for table `pago`
--

CREATE TABLE `pago` (
  `id_pago` int(11) NOT NULL,
  `id_cuenta` int(11) NOT NULL,
  `fecha_pago` date NOT NULL,
  `monto_pagado` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `pago`
--
DELIMITER $$
CREATE TRIGGER `tr_prevent_edit_pago` BEFORE UPDATE ON `pago` FOR EACH ROW BEGIN
  SIGNAL SQLSTATE '45000'
  SET MESSAGE_TEXT = 'No está permitido editar registros de pagos.';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `propietario`
--

CREATE TABLE `propietario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `propietario`
--

INSERT INTO `propietario` (`id`, `nombre`, `apellido`, `correo`, `clave`, `created_at`, `updated_at`) VALUES
(1, 'juan', 'moreno', 'ju@con.com', '202cb962ac59075b964b07152d234b70', '2025-05-20 16:57:51', '2025-05-20 16:57:51'),
(2, 'Ana', 'Pérez', 'ana1@con.com', '202cb962ac59075b964b07152d234b70', '2025-05-20 17:25:16', '2025-05-20 17:25:16'),
(3, 'Luis', 'García', 'luis2@con.com', '202cb962ac59075b964b07152d234b70', '2025-05-20 17:25:16', '2025-05-20 17:25:16'),
(4, 'Marta', 'López', 'marta3@con.com', '202cb962ac59075b964b07152d234b70', '2025-05-20 17:25:16', '2025-05-20 17:25:16'),
(5, 'Carlos', 'Ramírez', 'carlos4@con.com', '202cb962ac59075b964b07152d234b70', '2025-05-20 17:25:16', '2025-05-20 17:25:16'),
(6, 'Laura', 'Gómez', 'laura5@con.com', '202cb962ac59075b964b07152d234b70', '2025-05-20 17:25:16', '2025-05-20 17:25:16'),
(7, 'Pedro', 'Díaz', 'pedro6@con.com', '202cb962ac59075b964b07152d234b70', '2025-05-20 17:25:16', '2025-05-20 17:25:16'),
(8, 'Lucía', 'Torres', 'lucia7@con.com', '202cb962ac59075b964b07152d234b70', '2025-05-20 17:25:16', '2025-05-20 17:25:16'),
(9, 'Jorge', 'Rivas', 'jorge8@con.com', '202cb962ac59075b964b07152d234b70', '2025-05-20 17:25:16', '2025-05-20 17:25:16'),
(10, 'Sofía', 'Castro', 'sofia9@con.com', '202cb962ac59075b964b07152d234b70', '2025-05-20 17:25:16', '2025-05-20 17:25:16'),
(11, 'Diego', 'Ortega', 'diego10@con.com', '202cb962ac59075b964b07152d234b70', '2025-05-20 17:25:16', '2025-05-20 17:25:16');

--
-- Triggers `propietario`
--
DELIMITER $$
CREATE TRIGGER `tr_insert_propietario_md5` BEFORE INSERT ON `propietario` FOR EACH ROW BEGIN
  SET NEW.clave = MD5(NEW.clave);
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indexes for table `apartamento`
--
ALTER TABLE `apartamento`
  ADD PRIMARY KEY (`id_apartamento`),
  ADD KEY `id_propietario` (`id_propietario`);

--
-- Indexes for table `cuenta_cobro`
--
ALTER TABLE `cuenta_cobro`
  ADD PRIMARY KEY (`id_cuenta`),
  ADD KEY `id_apartamento` (`id_apartamento`),
  ADD KEY `id_estado` (`id_estado`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`),
  ADD UNIQUE KEY `nombre_estado` (`nombre_estado`);

--
-- Indexes for table `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `id_cuenta` (`id_cuenta`);

--
-- Indexes for table `propietario`
--
ALTER TABLE `propietario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `apartamento`
--
ALTER TABLE `apartamento`
  MODIFY `id_apartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `cuenta_cobro`
--
ALTER TABLE `cuenta_cobro`
  MODIFY `id_cuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pago`
--
ALTER TABLE `pago`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `propietario`
--
ALTER TABLE `propietario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `apartamento`
--
ALTER TABLE `apartamento`
  ADD CONSTRAINT `apartamento_ibfk_1` FOREIGN KEY (`id_propietario`) REFERENCES `propietario` (`id`);

--
-- Constraints for table `cuenta_cobro`
--
ALTER TABLE `cuenta_cobro`
  ADD CONSTRAINT `cuenta_cobro_ibfk_1` FOREIGN KEY (`id_apartamento`) REFERENCES `apartamento` (`id_apartamento`),
  ADD CONSTRAINT `cuenta_cobro_ibfk_2` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`),
  ADD CONSTRAINT `cuenta_cobro_ibfk_3` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`);

--
-- Constraints for table `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `pago_ibfk_1` FOREIGN KEY (`id_cuenta`) REFERENCES `cuenta_cobro` (`id_cuenta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
