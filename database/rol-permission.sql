-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-03-2022 a las 03:03:41
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rol-permission`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permission`
--

INSERT INTO `permission` (`id`, `name`) VALUES
(12, 'DNS'),
(13, 'HTTP'),
(14, 'NAS'),
(15, 'VOIP'),
(16, 'SSL'),
(18, 'FTP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `attribute` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `name`, `attribute`) VALUES
(88, 'ADMINISTRADOR', 'DNS, HTTP, NAS, VOIP, SSL'),
(89, 'VENDEDOR', 'NAS, FTP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `attribute` longtext NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `idrol` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `name`, `lastname`, `attribute`, `email`, `password`, `idrol`, `status`) VALUES
(29, 'JUAN', 'MORALES', 'DNS, HTTP, NAS, VOIP, SSL, FTP', 'morales@morales.com', '$2y$10$BvUCFKuuoY2Hy5cm9BQUD.bEJfpaW2eL00XW56yuPvFHybHCM8F/K', 88, 1),
(30, 'MARIO', 'LOPEZ', 'NAS, VOIP, FTP', 'lopez@lopez.com', '$2y$10$7yVnbuoRNJEBp9rxYl8UjOFZurg9/qlMAN3mXKlHlLjQig7Yu2ETG', 89, 1),
(31, 'DANIEL', 'CLAVIJO', 'DNS, HTTP, NAS, VOIP, SSL', 'clavijo@clavijo.com', '$2y$10$jvcgiPeIZwvmH/zaIpTdiOdFUmuwupkDOxaD2y5C06.FyQZOLp5PC', 88, 1),
(32, 'FERNEY', 'HURTADO', 'DNS, HTTP, NAS, VOIP, SSL', 'hurtado@hurtado.com', '$2y$10$/PcrAicJqKclQrEdc87nlOjvimcqX3YSdT7z/wdZkIyaHju70Pp2G', 88, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idrol` (`idrol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`idrol`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
