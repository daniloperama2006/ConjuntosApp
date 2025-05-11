-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:4040
-- Tiempo de generación: 11-05-2025 a las 19:26:53
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `conjunto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apartamento`
--

CREATE TABLE `apartamento` (
  `id_apartamento` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `bloque` int(11) NOT NULL,
  `id_propietario` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `apartamento`
--

INSERT INTO `apartamento` (`id_apartamento`, `numero`, `bloque`, `id_propietario`, `created_at`) VALUES
(1, 101, 1, 2, '2025-05-07 21:48:07'),
(2, 102, 1, 3, '2025-05-07 21:48:07'),
(3, 201, 2, 5, '2025-05-07 21:48:07'),
(4, 540, 19, 3, '2025-05-10 22:18:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta_cobro`
--

CREATE TABLE `cuenta_cobro` (
  `id_cuenta` int(11) NOT NULL,
  `id_apartamento` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `fecha_generacion` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `id_administrador` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cuenta_cobro`
--

INSERT INTO `cuenta_cobro` (`id_cuenta`, `id_apartamento`, `id_estado`, `fecha_generacion`, `valor`, `id_administrador`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2025-05-01', 150000.00, 1, '2025-05-07 21:48:28', '2025-05-11 00:25:45'),
(2, 2, 2, '2025-04-01', 180000.00, 4, '2025-05-07 21:48:28', '2025-05-07 21:48:28'),
(3, 3, 3, '2025-03-01', 175000.00, 1, '2025-05-07 21:48:28', '2025-05-07 21:48:28'),
(4, 1, 1, '2025-02-01', 150000.00, 4, '2025-05-07 21:48:28', '2025-05-11 09:47:09'),
(5, 2, 1, '2025-05-01', 180000.00, 1, '2025-05-07 21:48:28', '2025-05-07 21:48:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `nombre_estado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `nombre_estado`) VALUES
(3, 'EN MORA'),
(2, 'PAGADO'),
(1, 'PENDIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago`
--

CREATE TABLE `pago` (
  `id_pago` int(11) NOT NULL,
  `id_cuenta` int(11) NOT NULL,
  `fecha_pago` date NOT NULL,
  `monto_pagado` decimal(10,2) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pago`
--

INSERT INTO `pago` (`id_pago`, `id_cuenta`, `fecha_pago`, `monto_pagado`, `created_at`) VALUES
(1, 2, '2025-04-05', 180000.00, '2025-05-07 21:48:43'),
(2, 4, '2025-02-05', 150000.00, '2025-05-07 21:48:43');

--
-- Disparadores `pago`
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
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre_rol`) VALUES
(1, 'ADMIN'),
(2, 'PROPIETARIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `correo`, `clave`, `id_rol`, `created_at`, `updated_at`) VALUES
(1, 'Carlos', 'Ramírez', 'carlos@admin.com', '0192023a7bbd73250516f069df18b500', 1, '2025-05-07 21:47:56', '2025-05-07 21:47:56'),
(2, 'Laura', 'Gómez', 'laura@hogar.com', '58907c27b5ac1ad7289a6a56657b9e90', 2, '2025-05-07 21:47:56', '2025-05-07 21:47:56'),
(3, 'Jorge', 'Mendoza', 'jorge@hogar.com', '5a0f035db329cea241ae3509ad2b824f', 2, '2025-05-07 21:47:56', '2025-05-07 21:47:56'),
(4, 'Ana', 'Silva', 'ana@admin.com', '861af7bb4fd65d383ac33217fc067965', 1, '2025-05-07 21:47:56', '2025-05-07 21:47:56'),
(5, 'Daniela', 'Suárez', 'daniela@hogar.com', '8fc828b696ba1cd92eab8d0a6ffb17d6', 2, '2025-05-07 21:47:56', '2025-05-07 21:47:56');

--
-- Disparadores `usuario`
--
DELIMITER $$
CREATE TRIGGER `tr_insert_usuario_md5` BEFORE INSERT ON `usuario` FOR EACH ROW BEGIN
  SET NEW.clave = MD5(NEW.clave);
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `apartamento`
--
ALTER TABLE `apartamento`
  ADD PRIMARY KEY (`id_apartamento`),
  ADD KEY `fk_apartamento_propietario` (`id_propietario`);

--
-- Indices de la tabla `cuenta_cobro`
--
ALTER TABLE `cuenta_cobro`
  ADD PRIMARY KEY (`id_cuenta`),
  ADD KEY `fk_cuenta_apartamento` (`id_apartamento`),
  ADD KEY `fk_cuenta_estado` (`id_estado`),
  ADD KEY `fk_cuenta_admin` (`id_administrador`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`),
  ADD UNIQUE KEY `nombre_estado` (`nombre_estado`);

--
-- Indices de la tabla `pago`
--
ALTER TABLE `pago`
  ADD PRIMARY KEY (`id_pago`),
  ADD UNIQUE KEY `id_cuenta` (`id_cuenta`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre_rol` (`nombre_rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `fk_usuario_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `apartamento`
--
ALTER TABLE `apartamento`
  MODIFY `id_apartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cuenta_cobro`
--
ALTER TABLE `cuenta_cobro`
  MODIFY `id_cuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pago`
--
ALTER TABLE `pago`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `apartamento`
--
ALTER TABLE `apartamento`
  ADD CONSTRAINT `fk_apartamento_propietario` FOREIGN KEY (`id_propietario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `cuenta_cobro`
--
ALTER TABLE `cuenta_cobro`
  ADD CONSTRAINT `fk_cuenta_admin` FOREIGN KEY (`id_administrador`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `fk_cuenta_apartamento` FOREIGN KEY (`id_apartamento`) REFERENCES `apartamento` (`id_apartamento`),
  ADD CONSTRAINT `fk_cuenta_estado` FOREIGN KEY (`id_estado`) REFERENCES `estado` (`id_estado`);

--
-- Filtros para la tabla `pago`
--
ALTER TABLE `pago`
  ADD CONSTRAINT `fk_pago_cuenta` FOREIGN KEY (`id_cuenta`) REFERENCES `cuenta_cobro` (`id_cuenta`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
