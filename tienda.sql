-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 30-05-2019 a las 05:28:05
-- Versión del servidor: 5.7.19
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(7, 'MAZDA'),
(8, 'TOYOTA'),
(9, 'HONDA'),
(10, 'NISSAN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_pedidos`
--

DROP TABLE IF EXISTS `lineas_pedidos`;
CREATE TABLE IF NOT EXISTS `lineas_pedidos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(255) NOT NULL,
  `producto_id` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_linea_pedido` (`pedido_id`),
  KEY `fk_linea_producto` (`producto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(255) NOT NULL,
  `provincia` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `localidad` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `coste` float(10,2) NOT NULL,
  `estado` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pedido_usuario` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(255) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `precio` float(10,2) NOT NULL,
  `stock` int(255) NOT NULL,
  `oferta` varchar(2) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_producto_categoria` (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `categoria_id`, `nombre`, `descripcion`, `precio`, `stock`, `oferta`, `fecha`, `imagen`) VALUES
(35, 7, 'Mazda 3', 'Mazda 3 Negro', 20000.00, 8, NULL, '2019-05-29', 'mazda3negro.jpg'),
(36, 8, 'Toyota Prius', 'Toyota Prius 2018', 34000.00, 25, NULL, '2019-05-30', 'toyota_prius.jpg'),
(37, 9, 'Honda Civic 2016', 'Honda Civic 2016 Rojo', 17000.00, 50, NULL, '2019-05-30', 'honda_civic.jpg'),
(38, 9, 'Honda HR-V', 'Honda HR-V Gris', 45000.00, 12, NULL, '2019-05-30', 'honda_hr.jpg'),
(39, 10, 'Nissan Juke', 'Nissan Juke Blanco', 24100.00, 32, NULL, '2019-05-30', 'nissan_juke.jpg'),
(40, 9, 'Honda Canarias', 'Honda Canarias Rojo', 55000.00, 10, NULL, '2019-05-30', 'honda_canarias.jpg'),
(41, 9, 'Honda City', 'Honda City Blanco', 14500.00, 25, NULL, '2019-05-30', 'honda_city.jpg'),
(42, 7, 'Mazda2', 'Mazda2 2018 Rojo', 21000.00, 55, NULL, '2019-05-30', 'mazda2.jpg'),
(43, 10, 'Nissan Note', 'Nissan Note Gris', 15400.00, 25, NULL, '2019-05-30', 'nissan_note.jpg'),
(44, 8, 'Toyota Yaris', 'Toyota Yaris Rojo', 26000.00, 80, NULL, '2019-05-30', 'toyota_yaris.jpg'),
(45, 8, 'Toyota Hilux', 'Toyota Hilux Blanco', 47000.00, 55, NULL, '2019-05-30', 'toyota_hilux.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `rol` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `rol`, `imagen`) VALUES
(2, 'Admin', 'Admin', 'admin@admin.com', '$2y$04$f/30pMecfwm.bXEMNnKAm.BNNJdlnfhjXHehNc9G9Aj183V2.fQua', 'admin', NULL),
(3, 'alf', 'alf', 'alf@alf.com', '$2y$04$7cC.C.KGaPvUfl3ZrjPJuuP8IXwki175TWSBOhfnyV3R178UwFkYq', 'novato', NULL),
(4, 'jon', 'jon', 'jon@jon.com', '$2y$04$.tZ8KmSoWfbZ0mxXDY1NrOYa5rs/LH5Ow4/NJs11xJ642dJbAez5q', 'novato', NULL),
(5, 'Begoña', 'Garcia', 'bego@bego.com', '$2y$04$2z44/b8up9bixvSBHu5.CuwoI7tteIdm2KGOog68/Ap0jFd8Jlgju', 'novato', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoraciones`
--

DROP TABLE IF EXISTS `valoraciones`;
CREATE TABLE IF NOT EXISTS `valoraciones` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `producto_id` int(255) NOT NULL,
  `usuario_id` int(255) NOT NULL,
  `estrellas` float NOT NULL,
  `comentario` text COLLATE utf8_spanish_ci,
  `fecha` date DEFAULT NULL,
  `aprobada` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_producto_id` (`producto_id`),
  KEY `fk_usuario_id` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `valoraciones`
--

INSERT INTO `valoraciones` (`id`, `producto_id`, `usuario_id`, `estrellas`, `comentario`, `fecha`, `aprobada`) VALUES
(18, 36, 5, 1.2, 'Es un poco caro', '2019-05-30', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lineas_pedidos`
--
ALTER TABLE `lineas_pedidos`
  ADD CONSTRAINT `fk_linea_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `fk_linea_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `valoraciones`
--
ALTER TABLE `valoraciones`
  ADD CONSTRAINT `fk_producto_id` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `fk_usuario_id` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
