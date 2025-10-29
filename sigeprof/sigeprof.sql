-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-10-2025 a las 22:10:24
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
-- Base de datos: `sigeprof`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aprendiz`
--

CREATE TABLE `aprendiz` (
  `id` int(11) NOT NULL,
  `DNI` int(11) NOT NULL,
  `nombre` varchar(28) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `edad` int(11) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `nombre_de_usuario` varchar(20) NOT NULL,
  `contraseña` varchar(15) NOT NULL,
  `fichaID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aprendiz`
--

INSERT INTO `aprendiz` (`id`, `DNI`, `nombre`, `apellido`, `edad`, `correo`, `nombre_de_usuario`, `contraseña`, `fichaID`) VALUES
(2, 1040038403, 'Jose David', 'Cardona', 16, 'josdaxd73@gmail.com', 'JosDa73', 'JosDa733', 1),
(3, 1040038478, 'Andres Julian', 'Lopez', 16, 'andresjulianlopez8@gmail.com', 'Dres11', 'Andres777', 1),
(4, 1040038425, 'Emmanuel', 'Botero', 16, 'boteroemmanuel@gmail.com', 'Emmaxx01', 'Emmaxx01', 1),
(5, 1036933545, 'Juan Jose', 'Roman', 18, 'juanjoytpro@gmail.com', 'xmaz90', 'juanjo1234', 1),
(6, 1036779006, 'Isleny', 'Gil', 37, 'islenygil87@gmail.com', 'isle87', '1040038403', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

CREATE TABLE `ficha` (
  `id` int(11) NOT NULL,
  `numero_de_ficha` varchar(10) NOT NULL,
  `instiID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ficha`
--

INSERT INTO `ficha` (`id`, `numero_de_ficha`, `instiID`) VALUES
(1, '2940505', 1),
(3, '2236774', 2),
(4, '1958352', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichaxtecn`
--

CREATE TABLE `fichaxtecn` (
  `fichaID` int(11) NOT NULL,
  `tecnID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fichaxtecn`
--

INSERT INTO `fichaxtecn` (`fichaID`, `tecnID`) VALUES
(1, 1),
(3, 3),
(4, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE `institucion` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `direccion` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`id`, `nombre`, `direccion`) VALUES
(1, 'I.E Pio XI', 'Cl. 9 #10-59'),
(2, 'I.E Felix Maria Restrepo', 'Cra. 4 #10-44'),
(3, 'I.E Las Palmas', ' Vda. El Penasco, En');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instructor`
--

CREATE TABLE `instructor` (
  `id` int(11) NOT NULL,
  `DNI` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(25) NOT NULL,
  `edad` int(11) NOT NULL,
  `correo` varchar(35) NOT NULL,
  `nombre_de_usuario` varchar(20) NOT NULL,
  `contrasenha` varchar(60) NOT NULL,
  `rol` varchar(15) NOT NULL DEFAULT '''aprendiz''',
  `token` varchar(60) NOT NULL,
  `regdate` datetime NOT NULL DEFAULT current_timestamp(),
  `borndate` date DEFAULT NULL,
  `picture` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL DEFAULT 'profile/blank.png',
  `aboutme` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `instructor`
--

INSERT INTO `instructor` (`id`, `DNI`, `nombre`, `apellido`, `edad`, `correo`, `nombre_de_usuario`, `contrasenha`, `rol`, `token`, `regdate`, `borndate`, `picture`, `aboutme`) VALUES
(1, 1040038403, 'Jose David', 'Cardona', 16, 'josdaxd73@gmail.com', 'JosDa73', '$2y$10$BBLsiJE7osoudY0pYQF7ZeF.5Va1f5zEjNUBcjdG21Jgh8190jYAW', 'instructor', '5096043b2b25356e4fbe5b1a7ed64d35', '2025-05-28 13:54:20', '2008-09-09', 'profile/bslogo.webp', ''),
(3, 1036730582, 'Carlos', 'Castro', 28, 'carloscastro@gmail.com', 'carloskstro', 'carlosk123', 'instructor', '', '2025-05-28 13:54:20', NULL, 'profile/blank.png', ''),
(11, 1040038478, 'Andres', 'Lopez', 16, 'andresjulianlopez8@gmail.com', 'Dres11', '$2y$10$RJwB6m8RhyYLAib.9SOJHeWg2P3mLC1W6GiXqUBq2Gandu6dVf2H2', 'aprendiz', 'e4b57a050248433696cfe24ac4490e52', '2025-05-28 13:54:20', NULL, 'profile/blank.png', ''),
(12, 1426, 'Mauricio', 'Velez', 47, 'mauricio@gmail.com', 'Mauricio', '$2y$10$l.EHp12f39nMuTPAzG7HZedGQ93VCRzuLxsaTERQ9KEQvpbfczMfm', 'instructor', '', '2025-05-28 13:54:20', NULL, 'profile/blank.png', ''),
(13, 1036779006, 'Isleny', 'Gil', 37, 'islenygil87@gmail.com', 'Isle87', '$2y$10$eqTBqulhEd34tzPLeiJZku8aNqwaWr1juXvPHfDygxQ9L9Akpx.nC', 'aprendiz', '', '2025-05-28 13:54:20', NULL, 'profile/blank.png', ''),
(19, 1040038404, 'Not', 'JosDa', 17, 'notjosda@gmail.com', 'NotJosDa', '$2y$10$pUHILBtNhOv.cVr4E/KhheR4i5MnHO5ZRyI9DFr4XXvYzKC5jIJSK', '\'aprendiz\'', '', '2025-09-10 14:25:55', NULL, 'profile/blank.png', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `estado` varchar(15) NOT NULL,
  `enlace` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`id`, `nombre`, `estado`, `enlace`, `foto`) VALUES
(1, 'SIGEPROF', 'En Proceso', NULL, NULL),
(2, 'J&F Inmuebles', 'En Proceso', NULL, NULL),
(3, 'FREEMIND', 'En Proceso', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyexaprend`
--

CREATE TABLE `proyexaprend` (
  `proyeID` int(11) NOT NULL,
  `aprendID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyexaprend`
--

INSERT INTO `proyexaprend` (`proyeID`, `aprendID`) VALUES
(1, 2),
(1, 3),
(2, 4),
(3, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnica`
--

CREATE TABLE `tecnica` (
  `id` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `años` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tecnica`
--

INSERT INTO `tecnica` (`id`, `nombre`, `años`) VALUES
(1, 'Programacion de Software', 27),
(2, 'Programacion de deportes', 35),
(3, 'Asesoria Comercial', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tecnxinstru`
--

CREATE TABLE `tecnxinstru` (
  `tecnID` int(11) NOT NULL,
  `instruID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tecnxinstru`
--

INSERT INTO `tecnxinstru` (`tecnID`, `instruID`) VALUES
(1, 1),
(1, 3),
(1, 12),
(2, 11),
(3, 13);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aprendiz`
--
ALTER TABLE `aprendiz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fichaID` (`fichaID`);

--
-- Indices de la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instiID` (`instiID`);

--
-- Indices de la tabla `fichaxtecn`
--
ALTER TABLE `fichaxtecn`
  ADD PRIMARY KEY (`fichaID`,`tecnID`),
  ADD KEY `tecnID` (`tecnID`);

--
-- Indices de la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `instructor`
--
ALTER TABLE `instructor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proyexaprend`
--
ALTER TABLE `proyexaprend`
  ADD PRIMARY KEY (`proyeID`,`aprendID`),
  ADD KEY `aprendID` (`aprendID`);

--
-- Indices de la tabla `tecnica`
--
ALTER TABLE `tecnica`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tecnxinstru`
--
ALTER TABLE `tecnxinstru`
  ADD PRIMARY KEY (`tecnID`,`instruID`),
  ADD KEY `instruID` (`instruID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aprendiz`
--
ALTER TABLE `aprendiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `ficha`
--
ALTER TABLE `ficha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `instructor`
--
ALTER TABLE `instructor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tecnica`
--
ALTER TABLE `tecnica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aprendiz`
--
ALTER TABLE `aprendiz`
  ADD CONSTRAINT `aprendiz_ibfk_1` FOREIGN KEY (`fichaID`) REFERENCES `ficha` (`id`);

--
-- Filtros para la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD CONSTRAINT `ficha_ibfk_1` FOREIGN KEY (`instiID`) REFERENCES `institucion` (`id`);

--
-- Filtros para la tabla `fichaxtecn`
--
ALTER TABLE `fichaxtecn`
  ADD CONSTRAINT `fichaxtecn_ibfk_1` FOREIGN KEY (`fichaID`) REFERENCES `ficha` (`id`),
  ADD CONSTRAINT `fichaxtecn_ibfk_2` FOREIGN KEY (`tecnID`) REFERENCES `tecnica` (`id`);

--
-- Filtros para la tabla `proyexaprend`
--
ALTER TABLE `proyexaprend`
  ADD CONSTRAINT `proyexaprend_ibfk_1` FOREIGN KEY (`proyeID`) REFERENCES `proyecto` (`id`),
  ADD CONSTRAINT `proyexaprend_ibfk_2` FOREIGN KEY (`aprendID`) REFERENCES `aprendiz` (`id`);

--
-- Filtros para la tabla `tecnxinstru`
--
ALTER TABLE `tecnxinstru`
  ADD CONSTRAINT `tecnxinstru_ibfk_1` FOREIGN KEY (`tecnID`) REFERENCES `tecnica` (`id`),
  ADD CONSTRAINT `tecnxinstru_ibfk_2` FOREIGN KEY (`instruID`) REFERENCES `instructor` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
