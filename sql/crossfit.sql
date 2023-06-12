-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-06-2023 a las 10:35:25
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crossfit`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id_clase` int(11) NOT NULL,
  `Hora` time NOT NULL,
  `Dia` char(10) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id_clase`, `Hora`, `Dia`, `nombre`) VALUES
(1, '08:00:00', 'Lunes', 'Crossfit'),
(2, '10:00:00', 'Lunes', 'Crossfit'),
(3, '11:00:00', 'Lunes', 'OpenBox'),
(4, '12:00:00', 'Lunes', 'OpenBox'),
(5, '13:15:00', 'Lunes', 'Crossfit'),
(6, '17:00:00', 'Lunes', 'Crossfit'),
(8, '18:00:00', 'Lunes', 'Crossfit'),
(9, '18:00:00', 'Lunes', 'OpenBox'),
(10, '19:00:00', 'Lunes', 'Endurance'),
(11, '19:00:00', 'Lunes', 'OpenBox'),
(12, '20:00:00', 'Lunes', 'Crossfit'),
(13, '21:00:00', 'Lunes', 'Crossfit'),
(14, '07:00:00', 'Martes', 'Crossfit'),
(15, '09:45:00', 'Martes', 'Crossfit'),
(16, '11:00:00', 'Martes', 'Crossfit'),
(17, '12:00:00', 'Martes', 'OpenBox'),
(18, '17:00:00', 'Martes', 'Crossfit'),
(19, '17:00:00', 'Martes', 'OpenBox'),
(20, '18:00:00', 'Martes', 'Crossfit'),
(21, '18:00:00', 'Martes', 'Halterofilia'),
(22, '19:00:00', 'Martes', 'Crossfit'),
(23, '19:00:00', 'Martes', 'OpenBox'),
(24, '20:00:00', 'Martes', 'Crossfit'),
(25, '21:00:00', 'Martes', 'Crossfit'),
(26, '08:00:00', 'Miercoles', 'Crossfit'),
(27, '10:00:00', 'Miercoles', 'Crossfit'),
(28, '11:00:00', 'Miercoles', 'OpenBox'),
(29, '12:00:00', 'Miercoles', 'OpenBox'),
(30, '13:15:00', 'Miercoles', 'Crossfit'),
(31, '17:00:00', 'Miercoles', 'Crossfit'),
(32, '17:00:00', 'Miercoles', 'OpenBox'),
(33, '18:00:00', 'Miercoles', 'Endurance'),
(34, '18:00:00', 'Miercoles', 'OpenBox'),
(35, '19:00:00', 'Miercoles', 'Crossfit'),
(36, '19:00:00', 'Miercoles', 'OpenBox'),
(37, '20:00:00', 'Miercoles', 'Crossfit'),
(38, '21:00:00', 'Miercoles', 'Crossfit'),
(39, '07:00:00', 'Jueves', 'Crossfit'),
(40, '09:45:00', 'Jueves', 'Crossfit'),
(42, '11:00:00', 'Jueves', 'Crossfit'),
(43, '12:00:00', 'Jueves', 'OpenBox'),
(44, '17:00:00', 'Jueves', 'Crossfit'),
(45, '17:00:00', 'Jueves', 'OpenBox'),
(46, '18:00:00', 'Jueves', 'Crossfit'),
(47, '18:00:00', 'Jueves', 'OpenBox'),
(48, '19:00:00', 'Jueves', 'Crossfit'),
(49, '19:00:00', 'Jueves', 'OpenBox'),
(50, '20:00:00', 'Jueves', 'Crossfit'),
(51, '21:00:00', 'Jueves', 'Crossfit'),
(52, '08:00:00', 'Viernes', 'Crossfit'),
(53, '10:00:00', 'Viernes', 'Crossfit'),
(54, '11:00:00', 'Viernes', 'OpenBox'),
(55, '12:00:00', 'Viernes', 'OpenBox'),
(56, '13:15:00', 'Viernes', 'Crossfit'),
(57, '17:00:00', 'Viernes', 'Crossfit'),
(58, '17:00:00', 'Viernes', 'OpenBox'),
(59, '18:00:00', 'Viernes', 'Crossfit'),
(60, '18:00:00', 'Viernes', 'OpenBox'),
(61, '19:00:00', 'Viernes', 'Gymnastic'),
(62, '19:00:00', 'Viernes', 'OpenBox'),
(63, '20:00:00', 'Viernes', 'Crossfit'),
(64, '20:00:00', 'Viernes', 'Halterofilia'),
(65, '10:00:00', 'Sábado', 'OpenBox'),
(66, '11:00:00', 'Sábado', 'OpenBox'),
(67, '12:00:00', 'Sábado', 'OpenBox'),
(68, '10:00:00', 'Domingo', 'OpenBox'),
(69, '11:00:00', 'Domingo', 'OpenBox'),
(70, '12:00:00', 'Domingo', 'OpenBox');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` char(60) NOT NULL,
  `telefono` char(9) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `confirmado` tinyint(1) DEFAULT NULL,
  `token` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellido`, `email`, `password`, `telefono`, `admin`, `confirmado`, `token`) VALUES
(1, 'Adrian', 'Relaño', 'admin@crosffit.com', '$2y$10$woA/lYB2knbLXLjDNHIS5uL/5hQPjRP8zQhewplSHgq3HfbPqxTZy', '686597214', 1, 1, NULL),
(40, ' Adrian', 'Relaño Oter', 'adrian.rela.oter@gmail.com', '$2y$10$zjUeW/DhyEwxb/8cBD3HJeBBpQ/NQ.ggTJj6TsuTWZEC6xEKp1vKq', '949856321', 0, 1, ''),
(41, ' jose', 'asd', 'jose@jose.com', '$2y$10$rzQ.zVjy/rk5OeCn.GqHd.oGcGN/RrPDNptimpGoQIucjwPi1xSVS', '674589145', 0, 1, ''),
(42, 'Juan', 'Pérez', 'juanperez@example.com', 'password1', '123456789', 0, 1, 'token1'),
(43, 'María', 'González', 'mariagonzalez@example.com', 'password2', '987654321', 0, 1, 'token2'),
(44, 'Pedro', 'López', 'pedrolopez@example.com', 'password3', '246813579', 0, 1, 'token3'),
(45, 'Ana', 'Sánchez', 'anasanchez@example.com', 'password4', '864209753', 0, 1, 'token4'),
(46, 'Luis', 'Torres', 'luistorres@example.com', 'password5', '135792468', 0, 1, 'token5'),
(47, 'Laura', 'Martínez', 'lauramartinez@example.com', 'password6', '369852147', 0, 1, 'token6'),
(48, 'Carlos', 'Ramírez', 'carlosramirez@example.com', 'password7', '951357246', 0, 1, 'token7'),
(49, 'Sofía', 'Hernández', 'sofiahernandez@example.com', 'password8', '582703916', 0, 1, 'token8'),
(50, 'Jorge', 'Gómez', 'jorgegomez@example.com', 'password9', '123450987', 0, 1, 'token9'),
(51, 'Isabel', 'Vargas', 'isabelvargas@example.com', 'password10', '987650123', 0, 1, 'token10'),
(52, 'Miguel', 'Fernández', 'miguelfernandez@example.com', 'password11', '246813579', 0, 1, 'token11'),
(53, 'Alejandra', 'Castro', 'alejandracastro@example.com', 'password12', '864209753', 0, 1, 'token12'),
(54, 'Fernando', 'Navarro', 'fernandonavarro@example.com', 'password13', '135792468', 0, 1, 'token13'),
(55, 'Gabriela', 'Silva', 'gabrielasilva@example.com', 'password14', '369852147', 0, 1, 'token14'),
(56, 'Andrés', 'Mendoza', 'andresmendoza@example.com', 'password15', '951357246', 0, 1, 'token15'),
(57, ' peina20', 'castillo', 'peina20@gmail.com', '$2y$10$Kp3IlG4pgHkpWVHw9vObTe8g52AGnu0EbH1S2nDF4RqzIanj4m..e', '652154785', 0, 1, ''),
(58, ' Adrian', 'Relaño Oter', 'adrian.oter@gmail.com', '$2y$10$U5lr//siEjL0gdpChnRguuPIPByS38Kfd24Gy.fUS/jLcXPzQskFq', 'ASDF', 0, 0, '6482fe1900e27 ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cupon_cliente`
--

CREATE TABLE `cupon_cliente` (
  `id_cupon` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_bono` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `num_clases` int(11) NOT NULL,
  `fecha_suscripcion` date NOT NULL,
  `fecha_finalizacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cupon_cliente`
--

INSERT INTO `cupon_cliente` (`id_cupon`, `id_client`, `id_bono`, `estado`, `num_clases`, `fecha_suscripcion`, `fecha_finalizacion`) VALUES
(23, 40, 1, 0, 0, '2023-06-01', '2023-07-01'),
(24, 40, 2, 0, 8, '2023-06-01', '2023-06-01'),
(26, 40, 1, 0, 0, '2023-06-02', '2023-07-02'),
(27, 41, 1, 1, 5, '2023-06-02', '2023-07-02'),
(28, 40, 3, 1, 8, '2023-06-03', '2023-07-03'),
(29, 57, 1, 1, 0, '2023-06-06', '2023-07-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicios`
--

CREATE TABLE `ejercicios` (
  `id_ejercicio` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ejercicios`
--

INSERT INTO `ejercicios` (`id_ejercicio`, `nombre`) VALUES
(1, 'Front Squat'),
(2, 'Deadlift'),
(3, 'Floor Press'),
(4, 'Clean and Jerk'),
(5, 'Snatch'),
(6, 'Military Press'),
(7, 'Thruster'),
(8, 'Back Squat'),
(9, 'Powe Clean'),
(10, 'Barbell Row');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `id_mensaje` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `mensaje` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id_mensaje`, `id_client`, `mensaje`) VALUES
(22, 40, 'asas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_cliente` int(11) NOT NULL,
  `id_clase` int(11) NOT NULL,
  `fecha_reserva` date NOT NULL,
  `fecha_actividad` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_cliente`, `id_clase`, `fecha_reserva`, `fecha_actividad`) VALUES
(40, 23, '2023-06-06', '2023-06-06'),
(57, 23, '2023-06-06', '2023-06-06'),
(57, 26, '2023-06-06', '2023-06-07'),
(57, 27, '2023-06-06', '2023-06-07'),
(57, 35, '2023-06-06', '2023-06-07'),
(57, 37, '2023-06-06', '2023-06-07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados`
--

CREATE TABLE `resultados` (
  `id_resultado` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_ejercicio` int(11) NOT NULL,
  `series` int(11) NOT NULL,
  `reps` int(11) NOT NULL,
  `peso` int(11) NOT NULL,
  `RM` int(11) NOT NULL,
  `fecha_realizacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `resultados`
--

INSERT INTO `resultados` (`id_resultado`, `id_cliente`, `id_ejercicio`, `series`, `reps`, `peso`, `RM`, `fecha_realizacion`) VALUES
(7, 40, 8, 2, 3, 60, 66, '2023-06-03'),
(8, 40, 6, 1, 1, 50, 50, '2023-06-03'),
(12, 40, 2, 1, 1, 50, 50, '2023-06-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

CREATE TABLE `tarifas` (
  `id_bono` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` int(11) NOT NULL,
  `num_clases` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tarifas`
--

INSERT INTO `tarifas` (`id_bono`, `nombre`, `precio`, `num_clases`) VALUES
(1, 'Bono 5 Clases', 30, 5),
(2, 'Bono 9 Clases', 60, 9),
(3, 'Bono 13 Clases', 70, 13),
(4, 'Bono 22 Clases', 80, 22);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id_clase`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `cupon_cliente`
--
ALTER TABLE `cupon_cliente`
  ADD PRIMARY KEY (`id_cupon`),
  ADD KEY `id_bono` (`id_bono`),
  ADD KEY `id_client` (`id_client`);

--
-- Indices de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  ADD PRIMARY KEY (`id_ejercicio`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `id_client` (`id_client`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_cliente`,`id_clase`,`fecha_actividad`),
  ADD KEY `id_clase` (`id_clase`);

--
-- Indices de la tabla `resultados`
--
ALTER TABLE `resultados`
  ADD PRIMARY KEY (`id_resultado`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_ejercicio` (`id_ejercicio`);

--
-- Indices de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  ADD PRIMARY KEY (`id_bono`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id_clase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `cupon_cliente`
--
ALTER TABLE `cupon_cliente`
  MODIFY `id_cupon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `ejercicios`
--
ALTER TABLE `ejercicios`
  MODIFY `id_ejercicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  MODIFY `id_mensaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `resultados`
--
ALTER TABLE `resultados`
  MODIFY `id_resultado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  MODIFY `id_bono` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cupon_cliente`
--
ALTER TABLE `cupon_cliente`
  ADD CONSTRAINT `cupon_cliente_ibfk_1` FOREIGN KEY (`id_bono`) REFERENCES `tarifas` (`id_bono`),
  ADD CONSTRAINT `cupon_cliente_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD CONSTRAINT `mensajes_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id_clase`);

--
-- Filtros para la tabla `resultados`
--
ALTER TABLE `resultados`
  ADD CONSTRAINT `resultados_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `resultados_ibfk_2` FOREIGN KEY (`id_ejercicio`) REFERENCES `ejercicios` (`id_ejercicio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
