-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2025 at 03:36 PM
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
  `numero` int(11) NOT NULL,
  `id_propietario` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `apartamento`
--

INSERT INTO `apartamento` (`numero`, `id_propietario`, `created_at`) VALUES
(101, 1, '2025-05-20 16:58:12'),
(101, 3, '2025-05-23 19:43:06'),
(101, 7, '2025-05-24 08:30:06'),
(103, 3, '2025-05-20 17:25:51'),
(103, 8, '2025-05-25 08:28:05'),
(104, 1, '2025-05-23 19:44:11'),
(104, 4, '2025-05-20 17:25:51'),
(105, 5, '2025-05-20 17:25:51'),
(105, 7, '2025-05-23 20:33:17'),
(107, 7, '2025-05-20 17:25:51'),
(108, 5, '2025-05-23 19:55:44'),
(108, 8, '2025-05-20 17:25:51'),
(109, 8, '2025-05-23 19:54:09'),
(109, 9, '2025-05-20 17:25:51'),
(110, 4, '2025-05-23 19:51:22'),
(110, 6, '2025-05-23 19:49:17'),
(110, 10, '2025-05-20 17:25:51'),
(111, 11, '2025-05-20 17:25:51');

-- --------------------------------------------------------

--
-- Table structure for table `cuenta_cobro`
--

CREATE TABLE `cuenta_cobro` (
  `id_cuenta` int(11) NOT NULL,
  `numero_apartamento` int(11) NOT NULL,
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

INSERT INTO `cuenta_cobro` (`id_cuenta`, `numero_apartamento`, `id_estado`, `fecha_generacion`, `valor`, `id_admin`, `created_at`, `updated_at`) VALUES
(161, 101, 2, '2020-11-11', 300000.00, 1, '2025-05-24 17:54:35', '2025-05-24 18:13:25'),
(162, 103, 2, '2020-02-20', 200000.00, 1, '2025-05-24 18:12:51', '2025-05-25 08:27:16'),
(163, 104, 3, '2025-03-20', 320000.00, 1, '2025-05-24 18:13:46', '2025-05-24 18:13:59'),
(164, 103, 2, '2005-02-20', 120000.00, 1, '2025-05-25 08:28:27', '2025-05-25 08:29:37');

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
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_propietario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pago`
--

INSERT INTO `pago` (`id_pago`, `id_cuenta`, `fecha_pago`, `monto_pagado`, `created_at`, `updated_at`, `id_propietario`) VALUES
(18, 163, '2025-05-25', 20000.00, '2025-05-24 18:34:10', '2025-05-24 18:34:10', 1),
(19, 162, '2025-05-25', 30000.00, '2025-05-25 08:08:28', '2025-05-25 08:08:28', 3),
(21, 162, '2025-05-25', 30000.00, '2025-05-25 08:17:05', '2025-05-25 08:17:05', 3),
(22, 162, '2025-05-25', 60000.00, '2025-05-25 08:23:09', '2025-05-25 08:23:09', 3),
(23, 162, '2025-05-25', 80000.00, '2025-05-25 08:27:16', '2025-05-25 08:27:16', 3),
(24, 164, '2025-05-25', 100000.00, '2025-05-25 08:29:17', '2025-05-25 08:29:17', 8),
(25, 164, '2025-05-25', 20000.00, '2025-05-25 08:29:37', '2025-05-25 08:29:37', 8);

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
(3, 'Luis', 'García', 'luis2@con.com', '202cb962ac59075b964b07152d234b70', '2025-05-20 17:25:16', '2025-05-20 17:25:16'),
(4, 'Marta', 'López', 'marta3@con.com', '202cb962ac59075b964b07152d234b70', '2025-05-20 17:25:16', '2025-05-20 17:25:16'),
(5, 'Carlos', 'Ramírez', 'carlos4@con.com', '202cb962ac59075b964b07152d234b70', '2025-05-20 17:25:16', '2025-05-20 17:25:16'),
(6, 'Laura', 'Gómez', 'laura5@con.com', '202cb962ac59075b964b07152d234b70', '2025-05-20 17:25:16', '2025-05-20 17:25:16'),
(7, 'Pedro', 'Díaz', 'pedro6@con.com', '202cb962ac59075b964b07152d234b70', '2025-05-20 17:25:16', '2025-05-20 17:25:16'),
(8, 'Lucía', 'Torres', 'lucia7@con.com', '202cb962ac59075b964b07152d234b70', '2025-05-20 17:25:16', '2025-05-20 17:25:16'),
(9, 'Jorge', 'Rivas', 'jorge8@con.com', '202cb962ac59075b964b07152d234b70', '2025-05-20 17:25:16', '2025-05-20 17:25:16'),
(10, 'Sofía', 'Castro', 'sofia9@con.com', '202cb962ac59075b964b07152d234b70', '2025-05-20 17:25:16', '2025-05-20 17:25:16'),
(11, 'Diego', 'Ortega', 'diego10@con.com', '202cb962ac59075b964b07152d234b70', '2025-05-20 17:25:16', '2025-05-20 17:25:16'),
(13, 'Juan', 'Moreno', '124231235SeSki@gmail.com', 'd9b1d7db4cd6e70935368a1efb10e377', '2025-05-23 19:18:14', '2025-05-23 19:18:14'),
(19, 'carlos', 'moreno', 'ca@con.com', '202cb962ac59075b964b07152d234b70', '2025-05-24 17:09:47', '2025-05-24 17:13:59'),
(20, 'carlos', 'perez', 'ca1@con.com', 'd9b1d7db4cd6e70935368a1efb10e377', '2025-05-24 17:14:32', '2025-05-24 17:14:32'),
(21, 'jaksdjfkas', 'asdfasdf', '10@ms.comasasdfasdfasd', 'd9b1d7db4cd6e70935368a1efb10e377', '2025-05-24 17:19:39', '2025-05-24 17:19:39'),
(22, 'Juan', 'Moreno', 'ju1212@con.com', '202cb962ac59075b964b07152d234b70', '2025-05-24 17:21:04', '2025-05-24 17:21:04');

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
  ADD PRIMARY KEY (`numero`,`id_propietario`),
  ADD KEY `id_propietario` (`id_propietario`);

--
-- Indexes for table `cuenta_cobro`
--
ALTER TABLE `cuenta_cobro`
  ADD PRIMARY KEY (`id_cuenta`),
  ADD KEY `id_apartamento` (`numero_apartamento`),
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
-- AUTO_INCREMENT for table `cuenta_cobro`
--
ALTER TABLE `cuenta_cobro`
  MODIFY `id_cuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pago`
--
ALTER TABLE `pago`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `propietario`
--
ALTER TABLE `propietario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  ADD CONSTRAINT `cuenta_cobro_ibfk_1` FOREIGN KEY (`numero_apartamento`) REFERENCES `apartamento` (`numero`),
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
