-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-01-2018 a las 00:19:38
-- Versión del servidor: 10.1.22-MariaDB
-- Versión de PHP: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `candidato`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `codigo` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `consulta` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `consultas`
--

INSERT INTO `consultas` (`codigo`, `consulta`, `created_at`, `updated_at`) VALUES
('0001MESAGENERAL', 'SELECT.c*.c*.c*DEPARTAMENTOS.NOMBRE.c*AS.c*DEPARTAMENTO,.c*.c*.c*CIUDADES.NOMBRE.c*.c*.c*.c*.c*.c*AS.c*CIUDAD,.c*.c*.c*PUNTOS_VOTACIONS.DIRECCION,.c*.c*.c*MESAS_VOTACIONS.NUMERO,.c*.c*.c*MESAS_VOTACIONS.ID,.c*.c*.c*USERS.NAME||\'.c*\'||.c*.c*.c*USERS.NAME2||\'.c*\'||.c*.c*.c*USERS.LASTNAME||\'.c*\'||.c*.c*.c*.c*USERS.LASTNAME2.c*NOMBRECOMPLETO.c*FROM.c*.c*.c*DEPARTAMENTOS.c*INNER.c*JOIN.c*CIUDADES.c*ON.c*.c*.c*DEPARTAMENTOS.ID=CIUDADES.ID_DEPARTAMENTO.c*INNER.c*JOIN.c*PUNTOS_VOTACIONS.c*ON.c*.c*.c*CIUDADES.ID=PUNTOS_VOTACIONS.ID_CIUDAD.c*INNER.c*JOIN.c*MESAS_VOTACIONS.c*ON.c*.c*.c*PUNTOS_VOTACIONS.ID=MESAS_VOTACIONS.ID_PUNTO.c*INNER.c*JOIN.c*USERS.c*ON.c*.c*.c*MESAS_VOTACIONS.ID=USERS.ID_MESA.c*WHERE.c*.c*.c*MESAS_VOTACIONS.NUMERO.c*LIKE.c*\'%s$buscar$s%\'.c*OR.c*PUNTOS_VOTACIONS.DIRECCION.c*LIKE.c*\'%s$buscar$s%\'.c*OR.c*CIUDADES.NOMBRE.c*LIKE.c*\'%s$buscar$s%\'.c*OR.c*DEPARTAMENTOS.NOMBRE.c*LIKE.c*\'%s$buscar$s%\'.c*ORDER.c*BY.c*.c*.c*MESAS_VOTACIONS.ID', '2018-01-05 04:58:18', '2018-01-05 04:58:18'),
('0003DEPARTAMENTOS', 'SELECT.c*.c*.c*ID,.c*.c*.c*NOMBRE.c*FROM.c*.c*.c*DEPARTAMENTOS.c*WHERE.c*.c*.c*NOMBRE.c*LIKE.c*\'%s$buscar$s%\'', '2018-01-05 04:42:23', '2018-01-05 04:42:23'),
('0004CIUDADES', 'SELECT.c*.c*.c*CIUDADES.ID,.c*.c*.c*CIUDADES.NOMBRE.c*.c*.c*.c*.c*.c*AS.c*CIUDAD,.c*.c*.c*DEPARTAMENTOS.NOMBRE.c*AS.c*DEPARTAMENTO.c*FROM.c*.c*.c*DEPARTAMENTOS.c*INNER.c*JOIN.c*CIUDADES.c*ON.c*.c*.c*DEPARTAMENTOS.ID.c*=.c*CIUDADES.ID_DEPARTAMENTO.c*WHERE.c*.c*.c*CIUDADES.NOMBRE.c*LIKE.c*\'%s$buscar$s%\'.c*OR.c*DEPARTAMENTOS.NOMBRE.c*LIKE.c*\'%s$buscar$s%\'', '2018-01-05 04:46:57', '2018-01-05 04:46:57'),
('0006ADMINISTRADOR', 'SELECT.c*.c*.c*ID,.c*.c*.c*CASE.c*.c*.c*.c*.c*WHEN.c*TYPE=\'A\'.c*.c*.c*.c*.c*THEN.c*\'ADMINISTRADOR\'.c*.c*.c*.c*.c*ELSE.c*\'VOTANTE\'.c*.c*.c*END.c*TYPE,.c*.c*.c*EMAIL.c*AS.c*CORREO,.c*.c*.c*concat_ws(\'.c*\',NAME,NAME2,LASTNAME,LASTNAME2).c*AS.c*NOMBRES.c*FROM.c*.c*.c*USERS.c*WHERE.c*.c*.c*(.c*.c*.c*.c*.c*NAME.c*LIKE.c*\'%s$buscar$s%\'.c*.c*.c*OR.c*NAME2.c*LIKE.c*\'%s$buscar$s%\'.c*.c*.c*OR.c*LASTNAME.c*LIKE.c*\'%s$buscar$s%\'.c*.c*.c*OR.c*LASTNAME2.c*LIKE.c*\'%s$buscar$s%\'.c*.c*.c*).c*AND.c*TYPE.c*=.c*\'A\'', '2018-01-05 05:13:07', '2018-01-05 05:13:07'),
('0007VOTANTE', 'SELECT.c*.c*.c*ID,.c*.c*.c*CASE.c*.c*.c*.c*.c*WHEN.c*TYPE=\'A\'.c*.c*.c*.c*.c*THEN.c*\'ADMINISTRADOR\'.c*.c*.c*.c*.c*ELSE.c*\'VOTANTE\'.c*.c*.c*END.c*TYPE,.c*.c*.c*EMAIL.c*AS.c*CORREO,.c*.c*.c*concat_ws(\'.c*\',NAME,NAME2,LASTNAME,LASTNAME2).c*AS.c*NOMBRES.c*FROM.c*.c*.c*USERS.c*WHERE.c*.c*.c*(.c*.c*.c*.c*.c*NAME.c*LIKE.c*\'%s$buscar$s%\'.c*.c*.c*OR.c*NAME2.c*LIKE.c*\'%s$buscar$s%\'.c*.c*.c*OR.c*LASTNAME.c*LIKE.c*\'%s$buscar$s%\'.c*.c*.c*OR.c*LASTNAME2.c*LIKE.c*\'%s$buscar$s%\'.c*.c*.c*).c*AND.c*TYPE.c*=.c*\'E\'', '2018-01-05 05:12:49', '2018-01-05 05:12:49'),
('0009REPORTEMESAPUNTO', 'SELECT.c*departamentos.nombre.c*as.c*departamentos,ciudades.nombre.c*as.c*ciudad,.c*concat_ws(\'.c*\',NAME,NAME2,LASTNAME,LASTNAME2).c*as.c*nombre,puntos_votacions.direccion,mesas_votacions.numero.c*FROM.c*departamentos.c*INNER.c*JOIN.c*ciudades.c*ON.c*departamentos.ID=ciudades.id_departamento.c*INNER.c*JOIN.c*puntos_votacions.c*ON.c*ciudades.id=puntos_votacions.id_ciudad.c*.c*INNER.c*JOIN.c*mesas_votacions.c*ON.c*puntos_votacions.ID=mesas_votacions.id_punto.c*.c*INNER.c*JOIN.c*users.c*ON.c*.c*mesas_votacions.id=users.id_mesa.c*WHERE.c*departamentos.id=\'s$departamento$s\'.c*and.c*ciudades.id=\'s$ciudad$s\'.c*and.c*puntos_votacions.id=\'s$punto$s\'.c*order.c*by.c*users.id', '2018-01-07 20:35:16', '2018-01-07 20:35:16'),
('002PUNTOSVOTACION', 'SELECT.c*.c*.c*PUNTOS_VOTACIONS.DIRECCION,.c*.c*.c*PUNTOS_VOTACIONS.ID,.c*.c*.c*IFNULL(PUNTOS_VOTACIONS.NOMBRE,\'\').c*NOMBRE,.c*.c*.c*IFNULL(CIUDADES.NOMBRE,\'\').c*AS.c*CIUDAD.c*FROM.c*.c*.c*CIUDADES.c*INNER.c*JOIN.c*PUNTOS_VOTACIONS.c*ON.c*.c*.c*CIUDADES.ID.c*=.c*PUNTOS_VOTACIONS.ID_CIUDAD.c*WHERE.c*.c*.c*PUNTOS_VOTACIONS.NOMBRE.c*LIKE.c*\'%s$buscar$s%\'.c*OR.c*PUNTOS_VOTACIONS.DIRECCION.c*LIKE.c*\'%s$buscar$s%\'.c*OR.c*CIUDADES.NOMBRE.c*LIKE.c*\'%s$buscar$s%\'', '2018-01-05 04:38:43', '2018-01-05 04:38:43');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`codigo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
