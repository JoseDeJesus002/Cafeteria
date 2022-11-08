-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-10-2022 a las 16:14:16
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cafeteria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `idAlumno` int(11) NOT NULL,
  `matricula` varchar(50) NOT NULL,
  `idCarrera` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`idAlumno`, `matricula`, `idCarrera`) VALUES
(1, '123456789', 1),
(2, '123458788', 4),
(3, '123456789', 4),
(7, '1111111', 5),
(8, '7894', 2),
(9, '', 1),
(10, '4456', 1),
(11, '', 1),
(12, '754125', 4),
(15, '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogocarrera`
--

CREATE TABLE `catalogocarrera` (
  `idCarrera` int(11) NOT NULL,
  `tipoCarrera` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `catalogocarrera`
--

INSERT INTO `catalogocarrera` (`idCarrera`, `tipoCarrera`) VALUES
(1, 'ingenieria de software'),
(2, 'negocios internacionales'),
(3, 'ingenieria financiera'),
(4, 'ingenieria mecanica automotriz'),
(5, 'ingenieria en tecnologias de manufactura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catalogopersona`
--

CREATE TABLE `catalogopersona` (
  `idTipoPersona` int(11) NOT NULL,
  `tipoPersona` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `catalogopersona`
--

INSERT INTO `catalogopersona` (`idTipoPersona`, `tipoPersona`) VALUES
(1, 'alumno'),
(2, 'docente'),
(3, 'trabajador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docente`
--

CREATE TABLE `docente` (
  `idDocente` int(11) NOT NULL,
  `issemym` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `docente`
--

INSERT INTO `docente` (`idDocente`, `issemym`) VALUES
(13, 'CLAVED2'),
(14, 'CLAVED3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idPersona` int(11) NOT NULL,
  `idTipoPersona` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido_paterno` varchar(20) DEFAULT NULL,
  `apellido_materno` varchar(20) DEFAULT NULL,
  `correo` varchar(256) DEFAULT NULL,
  `contrasena` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idPersona`, `idTipoPersona`, `nombre`, `apellido_paterno`, `apellido_materno`, `correo`, `contrasena`) VALUES
(1, 1, 'Jorman Aldrich', 'Morales', 'de Gante', 'jorman@upetecamac.edu.mx', 'contrasena'),
(2, 1, 'Johana', 'Gutierrez', 'de Gante', 'johana@upetecamac.edu.mx', 'contrasena'),
(3, 1, 'Ivan', 'Perez', 'Hernandez', 'iph@upetecamac.edu.mx', 'contrasena'),
(4, 1, 'Ivan', 'Perez', 'Hernandez', 'iph@upetecamac.edu.mx', 'contrasena'),
(5, 1, 'Ivan', 'Perez', 'Gutierrez', 'iph@upetecamac.edu.mx', 'contrasena'),
(6, 1, 'Jorman', 'Perez', 'Sanchez', 'jps@upetecamac.edu.mx', 'contrasena'),
(7, 1, 'Jorman', 'Perez', 'Hernandez', 'jps@upetecamac.edu.mx', 'contrasena'),
(8, 1, 'Jorman', 'Perez', 'Rosas', 'jps_ni@upetecamac.edu.mx', 'contrasena'),
(9, 1, '', '', '', '', ''),
(10, 1, 'Jorman', 'Perez', 'Morales', 'jpm@upetecamac.edu.mx', 'contrasena'),
(11, 1, '', '', '', '', ''),
(12, 1, 'Jorman', 'Jimenez', 'Ruiz', 'jorjimru@upetecamac.edu.mx', 'contrasena'),
(13, 2, 'Jorman', 'de Gante', 'Morales', 'morales@docente.edu', 'contrasena'),
(14, 2, 'Jorman', 'Perez', 'Gutierrez', 'jpg@docente.edu.mx', 'contrasena'),
(15, 1, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE `trabajador` (
  `idTrabajador` int(11) NOT NULL,
  `curp` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`idAlumno`),
  ADD KEY `idCarrera_idx` (`idCarrera`);

--
-- Indices de la tabla `catalogocarrera`
--
ALTER TABLE `catalogocarrera`
  ADD PRIMARY KEY (`idCarrera`);

--
-- Indices de la tabla `catalogopersona`
--
ALTER TABLE `catalogopersona`
  ADD PRIMARY KEY (`idTipoPersona`);

--
-- Indices de la tabla `docente`
--
ALTER TABLE `docente`
  ADD PRIMARY KEY (`idDocente`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idPersona`,`idTipoPersona`),
  ADD KEY `idTipoPersona` (`idTipoPersona`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`idTrabajador`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `idAlumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `catalogocarrera`
--
ALTER TABLE `catalogocarrera`
  MODIFY `idCarrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `docente`
--
ALTER TABLE `docente`
  MODIFY `idDocente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idPersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  MODIFY `idTrabajador` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `alumno_persona` FOREIGN KEY (`idAlumno`) REFERENCES `persona` (`idPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `idCarrera` FOREIGN KEY (`idCarrera`) REFERENCES `catalogocarrera` (`idCarrera`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `docente`
--
ALTER TABLE `docente`
  ADD CONSTRAINT `docente_persona` FOREIGN KEY (`idDocente`) REFERENCES `persona` (`idPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `idTipoPersona` FOREIGN KEY (`idTipoPersona`) REFERENCES `catalogopersona` (`idTipoPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD CONSTRAINT `trabajador_persona` FOREIGN KEY (`idTrabajador`) REFERENCES `persona` (`idPersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
