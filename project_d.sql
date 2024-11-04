-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-11-2024 a las 11:22:04
-- Versión del servidor: 5.1.53
-- Versión de PHP: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `project_d`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autos`
--

CREATE TABLE IF NOT EXISTS `autos` (
  `ID_autos` int(11) NOT NULL AUTO_INCREMENT,
  `Color` text NOT NULL,
  `Info` text NOT NULL,
  `ID_categorias` int(11) NOT NULL,
  `Imagen` varchar(250) NOT NULL,
  `Nombre` varchar(250) NOT NULL,
  PRIMARY KEY (`ID_autos`),
  KEY `ID_categorias` (`ID_categorias`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcar la base de datos para la tabla `autos`
--

INSERT INTO `autos` (`ID_autos`, `Color`, `Info`, `ID_categorias`, `Imagen`, `Nombre`) VALUES
(1, 'Blanco con gris', 'muy bonito', 1, 'HondaCi_EK9_TYPER.jpg', 'Honda Civic EK9'),
(2, 'Blanco con Negro', 'Un coche de deriva legendario, que se hizo famoso por su peso ligero y su traccion trasera. El AE86 es conocido por su increible manejo en carreteras de montana.', 2, 'ToyotaTruenoAE86.jpg', 'Toyota Trueno AE86'),
(3, 'Negro', 'Hermoso', 3, 'R32.jpeg', 'Nissan Skyline R32'),
(4, 'Amarillo', 'Con su motor rotativo y su diseno liviano, el RX-7 es una bestia en la carretera, amado por los corredores por su potencia y rendimiento.', 4, 'mazda-rx7.png', 'Mazda RX-7'),
(5, 'Azul', 'Muy bonito', 5, 'low-mileage-1998-subaru-impreza-22b-sti.jpg', 'Subaru Impreza'),
(6, 'Gris', 'Muy Bonito', 6, 'David''s_Mitsubishi_Lancer_Evolution_IV.jpg', 'Mitsubishi Lancer Evolution IV');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE IF NOT EXISTS `cargos` (
  `ID_cargo` int(11) NOT NULL AUTO_INCREMENT,
  `Cargo` text NOT NULL,
  PRIMARY KEY (`ID_cargo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`ID_cargo`, `Cargo`) VALUES
(1, 'admin'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
  `ID_categorias` int(11) NOT NULL AUTO_INCREMENT,
  `Marca` text NOT NULL,
  `Modelo` text NOT NULL,
  `KM` text NOT NULL,
  PRIMARY KEY (`ID_categorias`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcar la base de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`ID_categorias`, `Marca`, `Modelo`, `KM`) VALUES
(1, 'toyota', '2016', '0KM'),
(2, 'Toyota', 'Trueno', '10'),
(3, 'Skyline', 'R32', '100'),
(4, 'Mazda', 'RX7', '200'),
(5, 'Subaru', 'Impreza 22B', '190'),
(6, 'Mitsubishi', 'Lancer Evo IV', '210');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE IF NOT EXISTS `comentarios` (
  `ID_comentario` int(11) NOT NULL AUTO_INCREMENT,
  `comentario` text NOT NULL,
  `ID_usuario` int(11) NOT NULL,
  `ID_autos` int(11) NOT NULL,
  `aprobado` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID_comentario`),
  KEY `ID_usuario` (`ID_usuario`),
  KEY `ID_autos` (`ID_autos`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Volcar la base de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`ID_comentario`, `comentario`, `ID_usuario`, `ID_autos`, `aprobado`) VALUES
(1, 'ejemplo', 1, 1, 1),
(2, '4444', 5, 1, 1),
(11, 'eeeee', 8, 1, 1),
(12, 'muy bueno el auto', 8, 1, 0),
(13, 'precio??', 8, 1, 0),
(14, 'hola?', 8, 1, 0),
(15, 'Excelente!!!', 5, 1, 1),
(17, 'pepe', 5, 1, 0),
(18, 'hola', 5, 1, 0),
(19, 'muy bonito', 5, 1, 1),
(20, 'holass', 8, 1, 1),
(21, 'que bonito', 8, 1, 1),
(22, 'cuenta en ascendencia', 5, 1, 0),
(23, 'dale me gusta', 5, 2, 1),
(24, 'el mejor auto', 5, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `ID_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(25) NOT NULL,
  `Apellido` varchar(25) NOT NULL,
  `Telefono` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Clave` varchar(255) NOT NULL,
  `ID_cargo` int(11) NOT NULL,
  `ID_autos` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_usuario`),
  KEY `ID_cargo` (`ID_cargo`),
  KEY `ID_autos` (`ID_autos`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcar la base de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_usuario`, `Nombre`, `Apellido`, `Telefono`, `Email`, `Clave`, `ID_cargo`, `ID_autos`) VALUES
(1, 'uli', 'choi', '299565656', 'uli@gmail.com', '0', 1, 1),
(3, 'Ana', 'Gonzalez', '987654321', 'ana.gonzalez@example.com', '$2y$10$1234567890qwertyuiopasdfghjkl', 1, NULL),
(4, 'Lucas', 'Alvarez', '299000000', 'Lucas@gmail.com', '$2y$10$0987654321qwertyuiopasdfghjkl', 2, NULL),
(5, 'dd', 'ejee', '29000000', 'ej@gmail.com', '$2UzxXynFZoCg', 2, NULL),
(6, 'ol', 'ppp', '29999000', 'ol@gmail.com', '2222', 2, NULL),
(7, 'Prueba', 'jojoj', '99999', 'prueba@gmail.com', '$2xYQgpGFI/ao', 2, NULL),
(8, 'poe', 'poe', '29992222', 'poe@gmail.com', '$2nNLZKVvzy8c', 2, NULL),
(9, 'admin', 'admin', '2999030303', 'admin@gmail.com', '$2UvSfSF4VHNQ', 1, NULL);

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `autos`
--
ALTER TABLE `autos`
  ADD CONSTRAINT `autos_ibfk_1` FOREIGN KEY (`ID_categorias`) REFERENCES `categorias` (`ID_categorias`);

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`ID_usuario`) REFERENCES `usuarios` (`ID_usuario`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`ID_autos`) REFERENCES `autos` (`ID_autos`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`ID_cargo`) REFERENCES `cargos` (`ID_cargo`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`ID_autos`) REFERENCES `autos` (`ID_autos`);
