-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-11-2022 a las 21:37:08
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tecnica_pijaos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestion_hospitalaria`
--

CREATE TABLE `gestion_hospitalaria` (
  `ID_HOSPITALIZACION` int(11) NOT NULL,
  `TIPO_DOC_PACIENTE` varchar(3) NOT NULL,
  `NO_DOC_PACIENTE` double NOT NULL,
  `COD_HOSPITAL` int(11) NOT NULL,
  `FEC_INGRESO` datetime NOT NULL,
  `FEC_SALIDA` datetime DEFAULT NULL,
  `FEC_CREACION` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gestion_hospitalaria`
--

INSERT INTO `gestion_hospitalaria` (`ID_HOSPITALIZACION`, `TIPO_DOC_PACIENTE`, `NO_DOC_PACIENTE`, `COD_HOSPITAL`, `FEC_INGRESO`, `FEC_SALIDA`, `FEC_CREACION`) VALUES
(1, 'CC', 1005, 1001, '2022-11-14 15:45:03', '2022-11-15 15:45:03', '2022-11-15 15:45:03'),
(15, 'CE ', 111000, 1002, '2022-11-09 13:00:00', '2022-11-09 18:00:00', '2022-11-19 13:00:24'),
(18, 'CE ', 111000, 1004, '2022-11-16 13:35:00', '2022-11-17 13:35:00', '2022-11-19 13:35:49'),
(19, 'CC ', 1005, 1002, '2022-11-01 16:00:00', '2022-11-03 16:00:00', '2022-11-19 16:00:31'),
(20, 'CC ', 1006, 1004, '2022-11-21 08:16:00', '2022-11-22 08:26:00', '2022-11-21 08:16:48'),
(21, 'TI ', 1000001, 1005, '2022-11-21 09:17:00', '2022-11-21 10:18:00', '2022-11-21 09:17:25'),
(22, 'TI ', 1000001, 1003, '2022-11-01 09:19:00', '2022-11-03 09:19:00', '2022-11-21 09:19:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hospitales`
--

CREATE TABLE `hospitales` (
  `COD_HOSPITAL` int(11) NOT NULL,
  `NOMBRE_HOSPITAL` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `hospitales`
--

INSERT INTO `hospitales` (`COD_HOSPITAL`, `NOMBRE_HOSPITAL`) VALUES
(1001, 'HOSPITAL PRINCIPAL PRUEBAS DE SOFTWARE '),
(1002, 'HOSPITAL DE BAJA COMPLEJIDAD'),
(1003, 'HOSPITAL PRUEBAS DE SOFTWARE '),
(1004, 'CLINICA SEGUNDA PRUEBAS '),
(1005, 'CLINICA PIJAOS SALUD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `TIPO_DOCUMENTO` varchar(3) NOT NULL,
  `NO_DOCUMENTO` double NOT NULL,
  `NOMBRES` varchar(50) NOT NULL,
  `APELLIDOS` varchar(50) NOT NULL,
  `FEC_NACIMIENTO` date NOT NULL,
  `EMAIL` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`TIPO_DOCUMENTO`, `NO_DOCUMENTO`, `NOMBRES`, `APELLIDOS`, `FEC_NACIMIENTO`, `EMAIL`) VALUES
('CC', 1005, 'PACIENTE SOFTWARE', 'PRUEBAS', '2000-11-15', 'PACIENTEPRUEBAS@GMAIL.COM'),
('CC', 1006, 'TEST', 'TEST', '2000-01-01', 'TEST@GMAIL.COM'),
('CE', 111000, 'EXTRANJEROS', 'PRUEBAS', '1985-01-01', 'EXTRANGHERO@GMAIL.COM'),
('TI', 1000001, 'MENOR', 'PRUEBAS', '2007-12-01', 'MENORPRUEBAS123@GMAIL.COM');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `gestion_hospitalaria`
--
ALTER TABLE `gestion_hospitalaria`
  ADD PRIMARY KEY (`ID_HOSPITALIZACION`),
  ADD KEY `NO_DOC_PACIENTE` (`NO_DOC_PACIENTE`),
  ADD KEY `COD_HOSPITAL` (`COD_HOSPITAL`);

--
-- Indices de la tabla `hospitales`
--
ALTER TABLE `hospitales`
  ADD PRIMARY KEY (`COD_HOSPITAL`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`NO_DOCUMENTO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `gestion_hospitalaria`
--
ALTER TABLE `gestion_hospitalaria`
  MODIFY `ID_HOSPITALIZACION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `gestion_hospitalaria`
--
ALTER TABLE `gestion_hospitalaria`
  ADD CONSTRAINT `gestion_hospitalaria_ibfk_1` FOREIGN KEY (`COD_HOSPITAL`) REFERENCES `hospitales` (`COD_HOSPITAL`) ON UPDATE CASCADE,
  ADD CONSTRAINT `gestion_hospitalaria_ibfk_2` FOREIGN KEY (`NO_DOC_PACIENTE`) REFERENCES `pacientes` (`NO_DOCUMENTO`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
