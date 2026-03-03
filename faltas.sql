-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-03-2026 a las 09:19:54
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `faltas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ausencia`
--

CREATE TABLE `ausencia` (
  `id_a` int(11) NOT NULL,
  `dia_a` varchar(100) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `justificante` mediumtext NOT NULL,
  `hora_a` int(11) NOT NULL,
  `tarea` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `dni_usuario_cubridor` varchar(10) DEFAULT NULL,
  `id_horario` int(11) NOT NULL,
  `dni_generador` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL DEFAULT 'Pendiente',
  `aceptar` varchar(255) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ausencia`
--

INSERT INTO `ausencia` (`id_a`, `dia_a`, `tipo`, `justificante`, `hora_a`, `tarea`, `dni_usuario_cubridor`, `id_horario`, `dni_generador`, `estado`, `aceptar`) VALUES
(252, '2026-03-03', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', NULL, 5725, '22222222J', 'Aceptada', 'NO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hora`
--

CREATE TABLE `hora` (
  `id_hora` varchar(2) NOT NULL,
  `dia` varchar(20) NOT NULL,
  `hora` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hora`
--

INSERT INTO `hora` (`id_hora`, `dia`, `hora`) VALUES
('J1', 'Jueves', '1'),
('J2', 'Jueves', '2'),
('J3', 'Jueves', '3'),
('J4', 'Jueves', '4'),
('J5', 'Jueves', '5'),
('J6', 'Jueves', '6'),
('L1', 'Lunes', '1'),
('L2', 'Lunes', '2'),
('L3', 'Lunes', '3'),
('L4', 'Lunes', '4'),
('L5', 'Lunes', '5'),
('L6', 'Lunes', '6'),
('M1', 'Martes', '1'),
('M2', 'Martes', '2'),
('M3', 'Martess', '3'),
('M4', 'Martes', '4'),
('M5', 'Martes', '5'),
('M6', 'Martes', '6'),
('V1', 'Viernes', '1'),
('V2', 'Viernes', '2'),
('V3', 'Viernes', '3'),
('V4', 'Viernes', '4'),
('V5', 'Viernes', '5'),
('V6', 'Viernes', '6'),
('X1', 'Miercoles', '1'),
('X2', 'Miercoles', '2'),
('X3', 'Miercoles', '3'),
('X4', 'Miercoles', '4'),
('X5', 'Miercoles', '5'),
('X6', 'Miercoles', '6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `id_horario` int(11) NOT NULL,
  `modulo` varchar(50) NOT NULL,
  `aula` varchar(50) NOT NULL,
  `dni_usuario` varchar(10) NOT NULL,
  `id_hora` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`id_horario`, `modulo`, `aula`, `dni_usuario`, `id_hora`) VALUES
(5659, 'redes', 'LMP2', '11111111H', 'L1'),
(5660, 'redes', 'LMP2', '11111111H', 'L2'),
(5661, 'guardia', '', '11111111H', 'L3'),
(5662, 'SORE', 'TIF3', '11111111H', 'L4'),
(5663, 'IPPE', 'pp3', '11111111H', 'L5'),
(5664, 'IPPE', 'pp3', '11111111H', 'L6'),
(5665, 'microchip', 'SMR3', '11111111H', 'M1'),
(5666, 'microchip', 'SMR3', '11111111H', 'M2'),
(5667, 'digitalización', 'RTG5', '11111111H', 'M3'),
(5668, 'Tutoria', 'TIF2', '11111111H', 'M4'),
(5669, 'redes', 'LMP2', '11111111H', 'M5'),
(5670, 'redes', 'LMP2', '11111111H', 'M6'),
(5671, 'Sostenibilidad', '33', '11111111H', 'X1'),
(5672, 'Sostenibilidad', '26', '11111111H', 'X2'),
(5673, 'redes', 'LMP2', '11111111H', 'X3'),
(5674, 'Religión', 'R33', '11111111H', 'X4'),
(5675, 'Inglés', 'TIC2', '11111111H', 'X5'),
(5676, 'Inglés', 'TIC2', '11111111H', 'X6'),
(5677, 'EF', 'JIM3', '11111111H', 'J2'),
(5678, 'guardia', '', '11111111H', 'J2'),
(5679, 'EF', 'JIM3', '11111111H', 'J3'),
(5680, 'redes', 'LMP2', '11111111H', 'J4'),
(5681, 'redes', 'LMP2', '11111111H', 'J5'),
(5682, 'Digitalización', 'PP4', '11111111H', 'J6'),
(5683, 'microchip', 'PP3', '11111111H', 'V1'),
(5684, 'redes', '', '11111111H', 'V2'),
(5685, 'ubuntu', 'TIF3', '11111111H', 'V3'),
(5686, 'ubuntu', 'TIF3', '11111111H', 'V4'),
(5687, 'Inglés', 'TIC2', '11111111H', 'V5'),
(5688, 'redes', '', '11111111H', 'V6'),
(5689, 'M-Clan', '', '09833264M', 'L1'),
(5690, 'Chilaba y Cachimba', '', '09833264M', 'L2'),
(5691, 'Carolina', '', '09833264M', 'L3'),
(5692, 'Quedate a Dormir', '', '09833264M', 'L4'),
(5693, 'Donde rl rio hierve.', '', '09833264M', 'L5'),
(5694, 'Serenade from the Stars.', '', '09833264M', 'L6'),
(5695, 'Extremoduro', '', '09833264M', 'M1'),
(5696, 'Decidi', '', '09833264M', 'M2'),
(5697, 'IV Centenario', '', '09833264M', 'M3'),
(5698, 'Deltoya', '', '09833264M', 'M4'),
(5699, 'Historias Prohibidas', '', '09833264M', 'M5'),
(5700, 'Abreme el pecho y registra', '', '09833264M', 'M6'),
(5701, 'Platero.', '', '09833264M', 'X1'),
(5702, 'Voy a acabar...', '', '09833264M', 'X2'),
(5703, 'DS', '', '09833264M', 'X3'),
(5704, 'ASD', '', '09833264M', 'X4'),
(5705, 'ADS', '', '09833264M', 'X5'),
(5706, 'ASD', '', '09833264M', 'X6'),
(5707, 'ASD', 'A', '09833264M', 'J2'),
(5708, 'ASD', '', '09833264M', 'J2'),
(5709, 'ADS', '', '09833264M', 'J3'),
(5710, 'AD', '', '09833264M', 'J4'),
(5711, 'ADS', '', '09833264M', 'J5'),
(5712, 'ASD', '', '09833264M', 'J6'),
(5713, 'ASD', '', '09833264M', 'V1'),
(5714, 'ASD', '', '09833264M', 'V2'),
(5715, 'ASD', '', '09833264M', 'V3'),
(5716, 'ASD', '', '09833264M', 'V4'),
(5717, 'ASD', '', '09833264M', 'V5'),
(5718, 'ASD', '', '09833264M', 'V6'),
(5719, 'SOM', 'IFC2', '22222222J', 'L1'),
(5720, 'SOM', 'IFC2', '22222222J', 'L2'),
(5721, 'Digitalización', 'IFC1', '22222222J', 'L3'),
(5722, 'Odon', 'SAN3', '22222222J', 'L4'),
(5723, 'Redes', 'IFC2', '22222222J', 'L5'),
(5724, 'Tutoria', 'IFC1', '22222222J', 'L6'),
(5725, 'Redes', 'IFC3', '22222222J', 'M1'),
(5726, 'Digitalización', 'IFC2', '22222222J', 'M2'),
(5727, 'Programación', 'IFC3', '22222222J', 'M3'),
(5728, 'Ofimatica', 'IFC1', '22222222J', 'M4'),
(5729, 'Guardia', '.', '22222222J', 'M5'),
(5730, 'Fol', 'IFC2', '22222222J', 'M6'),
(5731, 'Sostenibilidad', 'IFC3', '22222222J', 'X1'),
(5732, 'Fol', 'IFC2', '22222222J', 'X2'),
(5733, 'Fol', 'IFC2', '22222222J', 'X3'),
(5734, 'Programacion', 'IFC3', '22222222J', 'X4'),
(5735, 'SORE', 'IFC2', '22222222J', 'X5'),
(5736, 'SOM', 'IFC1', '22222222J', 'X6'),
(5737, 'Guardia', '.', '22222222J', 'J2'),
(5738, 'Redes', 'IFC2', '22222222J', 'J2'),
(5739, 'Redes', 'IFC2', '22222222J', 'J3'),
(5740, 'Redes', 'IFC1', '22222222J', 'J4'),
(5741, 'Programación', 'IFC3', '22222222J', 'J5'),
(5742, 'Programación', 'IFC3', '22222222J', 'J6'),
(5743, 'Sostenibilidad', 'IFC3', '22222222J', 'V1'),
(5744, 'SORE', 'IFC2', '22222222J', 'V2'),
(5745, 'SORE', 'IFC2', '22222222J', 'V3'),
(5746, 'Redes', 'IFC1', '22222222J', 'V4'),
(5747, 'Redes', 'IFC1', '22222222J', 'V5'),
(5748, 'Digitalización', 'IFC3', '22222222J', 'V6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `dni` varchar(10) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `contrasena` varchar(10000) NOT NULL DEFAULT 'prueba',
  `rol` varchar(50) NOT NULL,
  `gmail` varchar(255) NOT NULL,
  `familia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`dni`, `nombre`, `apellido`, `contrasena`, `rol`, `gmail`, `familia`) VALUES
('09833264M', 'Daniel', 'Riquelme Royo', '$2y$10$kxysNfLhmFH/Arqdr/Z.E.xwrJcHkS14.q1lcZmbs6fw/pW0azlPq', 'admin', 'riquelmeroyodaniel@gmail.com', 'informatica'),
('11111111H', 'Marcos', 'López', '$2y$10$39ayvai1MnFO9122GfOi5ONGescTisZ7XymjD5NcgMeuKdS1.tBgC', 'admin', 'pepinillo@gmail.com', 'informatica'),
('12365410N', 'Alejandro', 'Albaladejo', '$2y$10$VevHjOAcjvkwY5ukHGC1WebnoscXt.XBlxq8JhNwPzRxZJtJSNnES', 'user', 'aalbaladejo@cpifpbajoaragon.com', 'Infromatica'),
('22222222J', 'Saul', 'Saul', '$2y$10$YUbh.eFdyPiz2MKTR2khu.3Ii1ZUoqX/tTkSTWLh8Rg.dPSXvfhIi', 'admin', 'saulsaul@gmail.com', 'Sanidad'),
('25467239Y', 'Adrian', 'Rufat', '$2y$10$0wQNzWdmW7djiCU8wOqK8eBUrjLTuSkqn/2ZfvZy3uFdt113lTSPG', 'admin', 'pepinillo@gmail.com', 'Mecanica'),
('333BB', 'Saul', 'seguro', '$2y$10$ZubOEt93oa7pe0LKlflF/OWd8GS2Clv7s8UuaCaR91bbWn9D2iHAW', 'user', 'fjsgfgy@gmail.com', 'Electricidad');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ausencia`
--
ALTER TABLE `ausencia`
  ADD PRIMARY KEY (`id_a`),
  ADD KEY `dni_usuario_cubridor` (`dni_usuario_cubridor`),
  ADD KEY `id_horario` (`id_horario`);

--
-- Indices de la tabla `hora`
--
ALTER TABLE `hora`
  ADD PRIMARY KEY (`id_hora`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`id_horario`),
  ADD KEY `dni_usuario` (`dni_usuario`),
  ADD KEY `id_hora` (`id_hora`) USING BTREE;

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ausencia`
--
ALTER TABLE `ausencia`
  MODIFY `id_a` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5749;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ausencia`
--
ALTER TABLE `ausencia`
  ADD CONSTRAINT `ausencia_ibfk_4` FOREIGN KEY (`dni_usuario_cubridor`) REFERENCES `usuario` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ausencia_ibfk_5` FOREIGN KEY (`id_horario`) REFERENCES `horario` (`id_horario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `horario`
--
ALTER TABLE `horario`
  ADD CONSTRAINT `horario_ibfk_1` FOREIGN KEY (`dni_usuario`) REFERENCES `usuario` (`dni`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `horario_ibfk_2` FOREIGN KEY (`id_hora`) REFERENCES `hora` (`id_hora`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
