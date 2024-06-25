-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2024 a las 03:39:37
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
-- Base de datos: `citas_medicas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `id_cita` int(11) NOT NULL,
  `nombre_paciente` varchar(255) NOT NULL,
  `apellido_paciente` varchar(255) NOT NULL,
  `cedula_paciente` bigint(20) NOT NULL,
  `puesto` int(2) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `nombre_medico` text NOT NULL,
  `apellido_medico` text NOT NULL,
  `especialidad_consulta` varchar(255) NOT NULL,
  `estado_consulta` int(11) NOT NULL,
  `codigo_cita` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `start` date NOT NULL,
  `color` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`id_cita`, `nombre_paciente`, `apellido_paciente`, `cedula_paciente`, `puesto`, `id_medico`, `nombre_medico`, `apellido_medico`, `especialidad_consulta`, `estado_consulta`, `codigo_cita`, `title`, `start`, `color`) VALUES
(75, 'Luis', 'Monasterios', 29890238, 1, 0, 'Evelyn', 'Moore', 'fisiatría', 0, '1-29890238', 'fisiatría-29890238', '2024-06-24', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_de_consulta`
--

CREATE TABLE `estado_de_consulta` (
  `estado_atencion` varchar(50) NOT NULL,
  `estado_consulta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estado_de_consulta`
--

INSERT INTO `estado_de_consulta` (`estado_atencion`, `estado_consulta`) VALUES
('atendido', 1),
('no_atendido', 2),
('no_asistio', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicos`
--

CREATE TABLE `medicos` (
  `id_medico` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `especialidad` text NOT NULL,
  `cargo` text NOT NULL,
  `telf` bigint(100) NOT NULL,
  `atiende` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicos`
--

INSERT INTO `medicos` (`id_medico`, `cedula`, `nombre`, `apellido`, `especialidad`, `cargo`, `telf`, `atiende`) VALUES
(1, 5, 'Ana', 'Martínez', 'Cardiología', 'Doctora', 1222222222, 'nefrología'),
(2, 6, 'Carlos', 'Pérez', 'Medicina interna', 'Doctor', 300, 'endocrinología'),
(3, 7, 'Laura', 'Hernández', 'Psiquiatría', 'Doctora', 300, 'nefrología'),
(4, 8, 'Diego', 'Fernández', 'Neurología', 'Doctor', 300, 'cardiología'),
(5, 9, 'Andrea', 'Mendoza', 'Urología', 'Doctora', 300, 'cardiología'),
(6, 11, 'Jacob', 'Thomas', 'Neurocirugía', 'Jefe', 323232323, 'nefrología'),
(7, 12, 'Charlotte', 'Anderson', 'Medicina interna', 'Médico', 5558887776, 'nutrición'),
(9, 14, 'Ella', 'Williams', 'Hematología y oncología', 'Médico', 5559998887, 'cardiología'),
(10, 15, 'James', 'Clark', 'Reumatología', 'Jefe', 5552223334, 'endocrinología'),
(13, 18, 'Benjamin', 'Harris', 'Oftalmología', 'Médico', 5558889996, 'fisiatría'),
(14, 19, 'Evelyn', 'Moore', 'Oncología radioterápica', 'Jefe', 5551236547, 'fisiatría'),
(15, 20, 'William', 'Martínez', 'Nefrología', 'Médico', 5559876543, 'nutrición'),
(16, 1144, 'Mariana', 'Díaz', 'Oftalmología', 'Doctora', 301, 'endocrinología'),
(17, 1223, 'Angela', 'Ortiz', 'Dermatología', 'Doctora', 301, 'medicina interna'),
(19, 2478, 'Federico', 'Gómez', 'Radiología', 'Doctor', 302, 'endocrinología'),
(20, 8823, 'Inés', 'Ruiz', 'Anestesiología', 'Doctora', 302, 'cardiología'),
(22, 14666, 'Pablo', 'Rodríguez', 'Reumatología', 'Doctor', 301, 'endocrinología'),
(23, 15555, 'Jessica', 'Martín', 'Gastroenterología', 'Doctora', 301, 'nefrología'),
(24, 19998, 'Ramiro', 'Gallego', 'Nefrología', 'Doctor', 301, 'endocrinología'),
(26, 22227, 'Natalia', 'Martínez', 'Nutrición', 'Doctora', 302, 'medicina interna'),
(27, 33330, 'Felipe', 'Robles', 'Odontología', 'Doctor', 303, 'cardiología'),
(28, 88825, 'Ximena', 'Acosta', 'Fisiatría', 'Doctora', 302, 'fisiatría'),
(30, 281111, 'Ignacio', 'Arroyo', 'Podología', 'Doctor', 302, 'nutrición'),
(31, 555529, 'Pilar', 'Pérez', 'Obstetricia', 'Doctora', 303, 'cardiología'),
(32, 21121121, 'Catalina', 'Blanco', 'Otorrinolaringología', 'Doctora', 3032, 'fisiatría'),
(33, 29890238, 'María', 'González', 'Ginecología', 'Doctora', 300, 'medicina interna'),
(34, 29890239, 'Sofía', 'Ramírez', 'Pediatría', 'Doctora', 300, 'medicina interna'),
(41, 13105684, 'José Luis', 'Rodriguez Puma', 'Urólogo', 'R1', 4124351305, 'nutrición');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `cedula` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `apellido` text NOT NULL,
  `telf` int(11) NOT NULL,
  `estado` text NOT NULL,
  `municipio` text NOT NULL,
  `parroquia` text NOT NULL,
  `comunidad` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`cedula`, `nombre`, `apellido`, `telf`, `estado`, `municipio`, `parroquia`, `comunidad`) VALUES

(5963400, 'Milvida De los Ángeles', 'Marcano García', 2147483647, 'Aragua', 'Girardot', 'Las Delicias', 'La Pedrera'),
(29890238, 'Luis José', 'Monasterios Marcano', 2147483647, 'Aragua', 'Girardot', 'Las Delicias', 'La Pedrera');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `cedula` int(11) NOT NULL,
  `trabajador` text NOT NULL,
  `cargo` text NOT NULL,
  `email` text NOT NULL,
  `nombre_usuario` text NOT NULL,
  `contrasena` text NOT NULL,
  `perfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cedula`, `trabajador`, `cargo`, `email`, `nombre_usuario`, `contrasena`, `perfil`) VALUES
(1, 'asdasd', 'asd', 'a', 'admin', 'admin', 1),
(444, 'Luis', 'Director', 'ljmm2k2@gmail.com', 'cedocabar', 'cedocabar', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`id_cita`),
  ADD KEY `estado_consulta` (`estado_consulta`);

--
-- Indices de la tabla `estado_de_consulta`
--
ALTER TABLE `estado_de_consulta`
  ADD PRIMARY KEY (`estado_consulta`);

--
-- Indices de la tabla `medicos`
--
ALTER TABLE `medicos`
  ADD PRIMARY KEY (`id_medico`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD UNIQUE KEY `UNIQUE` (`cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `id_cita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `estado_de_consulta`
--
ALTER TABLE `estado_de_consulta`
  MODIFY `estado_consulta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `medicos`
--
ALTER TABLE `medicos`
  MODIFY `id_medico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
