-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-03-2026 a las 09:52:31
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
(1, '06-03-2026', 'Admin', '', 0, NULL, '09833264M', 5712, '09833264M', 'Rechazada', 'NO'),
(252, '2026-03-03', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', '22222222J', 5725, '22222222J', 'Aceptada', 'SI'),
(253, '2026-03-03', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', '09833264M', 5707, '09833264M', 'Aceptada', 'SI'),
(254, '2026-03-03', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', '09833264M', 5695, '09833264M', 'Aceptada', 'SI'),
(255, '2026-03-03', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', '25467239Y', 5689, '09833264M', 'Aceptada', 'SI'),
(256, '2026-03-03', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', '25467239Y', 5661, '11111111H', 'Aceptada', 'SI'),
(257, '2026-03-03', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', '25467239Y', 5667, '11111111H', 'Aceptada', 'SI'),
(258, '2026-03-04', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', NULL, 5692, '09833264M', 'Rechazada', 'NO'),
(259, '2026-03-04', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', NULL, 5690, '09833264M', 'Rechazada', 'NO'),
(260, '2026-03-04', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', '09833264M', 5708, '09833264M', 'Aceptada', 'SI'),
(261, '2026-03-04', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', NULL, 5707, '09833264M', 'Aceptada', 'NO'),
(262, '2026-03-04', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', NULL, 5740, '22222222J', 'Aceptada', 'NO'),
(263, '2026-03-04', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', NULL, 5700, '09833264M', 'Rechazada', 'NO'),
(264, '2026-03-06', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', '22222222J', 5659, '11111111H', 'Aceptada', 'SI'),
(265, '2026-03-06', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', '09833264M', 5697, '09833264M', 'Aceptada', 'SI'),
(266, '2026-03-06', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', '09833264M', 5689, '09833264M', 'Aceptada', 'SI'),
(267, '2026-03-06', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', '09833264M', 5689, '09833264M', 'Aceptada', 'SI'),
(268, '2026-03-06', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', '09833264M', 5689, '09833264M', 'Aceptada', 'SI'),
(269, '2026-03-06', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', '25467239Y', 5689, '09833264M', 'Aceptada', 'SI'),
(270, '2026-03-06', 'admin', 'Sin archivo adjunto', 0, '<a href=\'http://192.168.14.187/reto3/Imagenes/1772800236_tarea_CV_europass_.pdf\' target=\'_blank\' style=\'color:blue; font-weight:bold;\'>Ver Tarea</a>', '11111111H', 5687, '11111111H', 'Aceptada', 'SI'),
(271, '2026-03-06', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', NULL, 5694, '09833264M', 'Rechazada', 'NO'),
(276, 'N/A', 'N/A', 'N/A', 2, 'N/A', '09833264M', 5700, 'N/A', 'Rechazada', 'NO'),
(277, '', '', '', 0, NULL, '09833264M', 5710, 'N/A', 'Rechazada', 'NO'),
(278, '2026-03-06', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', '09833264M', 5689, '09833264M', 'Aceptada', 'SI'),
(279, '2026-03-06', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', '09833264M', 5689, '09833264M', 'Aceptada', 'SI'),
(280, '2026-03-06', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', '09833264M', 5689, '09833264M', 'Aceptada', 'SI'),
(281, '2026-03-06', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', '09833264M', 5689, '09833264M', 'Aceptada', 'SI'),
(282, '2026-03-09', 'admin', '<a href=\'htt\r\n        ĺkjñlkjñkjlkjñlkjlñkjñlkjkljlkjñlkjlñkjklkjhlllkjhkjhkhhkhjhhh7/reto3/Imagenes/1773044846_just_CV_europass_.pdf\' target=\'_blank\' style=\'color:blue; font-weight:bold;\'>Ver Justificante</a>', 0, '<a href=\'http://192.168.14.187/reto3/Imagenes/1773044846_tarea_sostenivilidad_tarea_1.pdf\' target=\'_blank\' style=\'color:blue; font-weight:bold;\'>Ver Tarea</a>', '11111111H', 5659, '11111111H', 'Aceptada', 'SI'),
(283, '2026-03-10', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', '11111111H', 5659, '11111111H', 'Aceptada', 'SI'),
(284, '2026-03-13', 'admin', '<a href=\'htt\r\n        ĺkjñlkjñkjlkjñlkjlñkjñlkjkljlkjñlkjlñkjklkjhlllkjhkjhkhhkhjhhh7/reto3/Imagenes/1773044882_just_adrian.png\' target=\'_blank\' style=\'color:blue; font-weight:bold;\'>Ver Justificante</a>', 0, 'Sin tarea', NULL, 5659, '11111111H', 'Aceptada', 'NO'),
(285, '2026-03-11', 'admin', '<a href=\'htt\r\n        ĺkjñlkjñkjlkjñlkjlñkjñlkjkljlkjñlkjlñkjklkjhlllkjhkjhkhhkhjhhh7/reto3/Imagenes/1773044916_just_Richard_3.webp\' target=\'_blank\' style=\'color:blue; font-weight:bold;\'>Ver Justificante</a>', 0, '<a href=\'http://192.168.14.187/reto3/Imagenes/1773044916_tarea_cromas.png\' target=\'_blank\' style=\'color:blue; font-weight:bold;\'>Ver Tarea</a>', NULL, 5672, '11111111H', 'Aceptada', 'NO'),
(286, '2026-03-13', 'admin', '<a href=\'htt\r\n        ĺkjñlkjñkjlkjñlkjlñkjñlkjkljlkjñlkjlñkjklkjhlllkjhkjhkhhkhjhhh7/reto3/Imagenes/1773044931_just_canvas.png\' target=\'_blank\' style=\'color:blue; font-weight:bold;\'>Ver Justificante</a>', 0, 'Sin tarea', NULL, 5686, '11111111H', 'Aceptada', 'NO'),
(287, '2026-03-10', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', '11111111H', 5669, '11111111H', 'Aceptada', 'SI'),
(288, '2026-03-09', 'admin', '<a href=\'htt\r\n        ĺkjñlkjñkjlkjñlkjlñkjñlkjkljlkjñlkjlñkjklkjhlllkjhkjhkhhkhjhhh7/reto3/Imagenes/1773054755_just_cpifp.png\' target=\'_blank\' style=\'color:blue; font-weight:bold;\'>Ver Justificante</a>', 0, 'Sin tarea', '11111111H', 5664, '11111111H', 'Aceptada', 'SI'),
(289, '2026-03-09', 'admin', '<a href=\'htt\r\n        ĺkjñlkjñkjlkjñlkjlñkjñlkjkljlkjñlkjlñkjklkjhlllkjhkjhkhhkhjhhh7/reto3/Imagenes/1773055225_just_RETO.odt\' target=\'_blank\' style=\'color:blue; font-weight:bold;\'>Ver Justificante</a>', 0, '<a href=\'http://192.168.14.187/reto3/Imagenes/1773055225_tarea_PRACTICAS.odt\' target=\'_blank\' style=\'color:blue; font-weight:bold;\'>Ver Tarea</a>', '09833264M', 5689, '09833264M', 'Aceptada', 'SI'),
(290, '2026-03-09', 'admin', '<a href=\'http://192.168.14.187/reto3/Imagenes/1773055771_just_FOL_snoore_mimimi.odt\' target=\'_blank\' style=\'color:blue; font-weight:bold;\'>Ver Justificante</a>', 0, '<a href=\'http://192.168.14.187/reto3/Imagenes/1773055771_tarea_ChatGPT_Image_6_nov_2025__09_05_34.png\' target=\'_blank\' style=\'color:blue; font-weight:bold;\'>Ver Tarea</a>', '09833264M', 5703, '09833264M', 'Aceptada', 'SI'),
(291, '2026-03-09', 'admin', 'Sin archivo adjunto', 0, 'Sin tarea', NULL, 5754, '25467239Y', 'Aceptada', 'NO'),
(292, '2026-03-10', 'admin', '<a href=\'http://192.168.14.187/reto3/Imagenes/1773138821_just_Captura_desde_2025_09_19_10_07_42.png\' target=\'_blank\' style=\'color:blue; font-weight:bold;\'>Ver Justificante</a>', 0, '<a href=\'http://192.168.14.187/reto3/Imagenes/1773138821_tarea_Captura_desde_2025_09_23_11_22_08.png\' target=\'_blank\' style=\'color:blue; font-weight:bold;\'>Ver Tarea</a>', NULL, 5734, '22222222J', 'Aceptada', 'NO');

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
(5748, 'Digitalización', 'IFC3', '22222222J', 'V6'),
(5749, 'SORE', 'IFC-2', '25467239Y', 'L1'),
(5750, 'SORE', 'IFC-2', '25467239Y', 'L2'),
(5751, 'Hora de permanencia', 'Profesores', '25467239Y', 'L3'),
(5752, 'Hora de permanencia', 'IFC-2', '25467239Y', 'L4'),
(5753, 'FOL', 'IFC-2', '25467239Y', 'L5'),
(5754, 'FOL', 'IFC-2', '25467239Y', 'L6'),
(5755, 'SER', 'IFC-2', '25467239Y', 'M1'),
(5756, 'SER', 'IFC-2', '25467239Y', 'M2'),
(5757, 'SORE', 'IFC-2', '25467239Y', 'M3'),
(5758, 'SORE', 'IFC-2', '25467239Y', 'M4'),
(5759, 'Hora de permanencia', 'IFC-2', '25467239Y', 'M5'),
(5760, 'Hora de permanencia', 'IFC-2', '25467239Y', 'M6'),
(5761, 'Libre', 'IFC-2', '25467239Y', 'X1'),
(5762, 'SER', 'IFC-2', '25467239Y', 'X2'),
(5763, 'Hora de permanencia', 'IFC-2', '25467239Y', 'X3'),
(5764, 'Hora de permanencia', 'IFC-2', '25467239Y', 'X4'),
(5765, 'Seguridad', 'IFC-2', '25467239Y', 'X5'),
(5766, 'Ingles', 'IFC-2', '25467239Y', 'X6'),
(5767, 'Hora de permanencia', 'IFC-2', '25467239Y', 'J1'),
(5768, 'Hora de permanencia', 'IFC-2', '25467239Y', 'J2'),
(5769, 'Ingles', 'IFC-2', '25467239Y', 'J3'),
(5770, 'SORE', 'IFC-2', '25467239Y', 'J4'),
(5771, 'SORE', 'IFC-2', '25467239Y', 'J5'),
(5772, 'SER', 'IFC-2', '25467239Y', 'J6'),
(5773, 'FOL', 'IFC-2', '25467239Y', 'V1'),
(5774, 'FOL', 'IFC-2', '25467239Y', 'V2'),
(5775, 'SER', 'IFC-2', '25467239Y', 'V3'),
(5776, 'Seguridad', 'IFC-2', '25467239Y', 'V4'),
(5777, 'Libre', 'IFC-2', '25467239Y', 'V5'),
(5778, 'Libre', 'IFC-2', '25467239Y', 'V6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `token` varchar(64) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`id`, `dni`, `token`, `expires_at`) VALUES
(1, '09833264M', '8376d0429f4334c8515b55d8ffe25136', '2026-03-09 12:19:16'),
(2, '11111111H', '2607ccfd68cb525e92dea4b690a50afb253afaae293a119b71196a079b1dc8ae', '2026-03-09 12:51:58'),
(3, '11111111H', 'f48e03dcbae5dd9bf9a84ae8f473558107fe1826bfaa4ec6bab3bbfc79851a88', '2026-03-09 13:24:15'),
(4, '11111111H', '934b597d315593ecafdf3f5434793861ba57a0ee408592ebecaa01bf4870e13b', '2026-03-09 13:24:50'),
(5, '25364893X', '53a40e2b346dfe2646ba21764131bee2d890e550087f25015489f7f08c7f4e92', '2026-03-09 13:29:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `dni` varchar(9) NOT NULL,
  `token` varchar(64) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
('25364893X', 'prueba', 'correo', '$2y$10$yqZ8yk6hZ7VnCzrX1Q0CeuuGyi66VxZ/Ia9QtYt9Ryqw/tCD2w7sO', 'user', 'marcoslopezmartinez7@gmail.com', 'bien'),
('25467239Y', 'Adrian', 'Rufat', '$2y$10$0wQNzWdmW7djiCU8wOqK8eBUrjLTuSkqn/2ZfvZy3uFdt113lTSPG', 'admin', 'pepinillo@gmail.com', 'Mecanica'),
('33333333P', 'Saul', 'seguro', '$2y$10$ZubOEt93oa7pe0LKlflF/OWd8GS2Clv7s8UuaCaR91bbWn9D2iHAW', 'user', 'fjsgfgy@gmail.com', 'Electricidad');

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
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id_a` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5779;

--
-- AUTO_INCREMENT de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
