-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-08-2024 a las 06:53:07
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
-- Base de datos: `viveroproyecto`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_delete_Planta` (IN `pId` INT(11))   DELETE FROM planta WHERE id_planta=pId$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_get_Plantas` ()   SELECT * FROM planta$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_insert_Planta` (IN `pNombre` VARCHAR(50), IN `pCientifico` VARCHAR(50), IN `pClima` VARCHAR(5), IN `pDescripcion` TEXT, IN `pPrecio` DOUBLE, IN `pCantidad` INT(11), IN `pImagen` VARCHAR(2000))   INSERT INTO planta (nombre_popular,nombre_cientifico,clima,descripcion,precio,stock,img) VALUES (pNombre,pCientifico,pClima,pDescripcion,pPrecio,pCantidad,pImagen)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pr_update_Planta` (IN `pId` INT(11), IN `pNombre` VARCHAR(50), IN `pCientifico` VARCHAR(50), IN `pClima` VARCHAR(50), IN `pDescripcion` TEXT, IN `pPrecio` INT(11), IN `pCantidad` INT(11), IN `pImagen` VARCHAR(200))   UPDATE planta set 
nombre_popular=pNombre,
nombre_Cientifico=pCientifico,
clima=pClima,
descripcion=pDescripcion,
precio=pPrecio,
stock=pCantidad,
img=pImagen 
WHERE id_planta=pId$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `id_compra` int(11) NOT NULL,
  `id_planta` int(11) NOT NULL,
  `cantidad` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planta`
--

CREATE TABLE `planta` (
  `id_planta` int(11) NOT NULL,
  `nombre_popular` varchar(50) NOT NULL,
  `nombre_cientifico` varchar(50) NOT NULL DEFAULT '',
  `clima` varchar(50) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `img` varchar(2000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `planta`
--

INSERT INTO `planta` (`id_planta`, `nombre_popular`, `nombre_cientifico`, `clima`, `descripcion`, `precio`, `stock`, `img`) VALUES
(1, 'Prueba', 'Pruebac', 'calor', 'una prueba definitiva', 12, 12, ''),
(3, 'Girasol', 'girasol cientifico', 'Caliente', 'Descripcion de girasol', 3000, 50, ''),
(4, 'Prueba3', 'Pruebac', 'frio', 'Test', 34, 34, ''),
(6, 'Rosa', 'rosa', 'Frio', 'Una rosa', 1500, 50, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `username` varchar(200) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `primer_apellido` varchar(50) DEFAULT NULL,
  `segundo_apellido` varchar(50) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `id_rol` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `username` varchar(11) NOT NULL,
  `total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`,`id_planta`),
  ADD KEY `planta` (`id_planta`);

--
-- Indices de la tabla `planta`
--
ALTER TABLE `planta`
  ADD PRIMARY KEY (`id_planta`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`username`),
  ADD KEY `roles` (`id_rol`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `usuario` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `planta`
--
ALTER TABLE `planta`
  MODIFY `id_planta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `planta` FOREIGN KEY (`id_planta`) REFERENCES `planta` (`id_planta`),
  ADD CONSTRAINT `venta` FOREIGN KEY (`id_compra`) REFERENCES `venta` (`id_venta`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `roles` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `usuario` FOREIGN KEY (`username`) REFERENCES `usuario` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
