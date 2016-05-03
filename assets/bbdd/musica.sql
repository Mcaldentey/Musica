-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-05-2016 a las 13:57:28
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `musica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `altas`
--

CREATE TABLE `altas` (
  `alta_id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `phone` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `altas`
--

INSERT INTO `altas` (`alta_id`, `user_id`, `fecha`, `phone`) VALUES
(3, 13, '2016-04-25', 660840806),
(4, 13, '2016-04-25', 660840806),
(5, 18, '2016-04-27', 667896541),
(6, 18, '2016-04-28', 667896541),
(7, 18, '2016-04-28', 667896541),
(8, 18, '2016-04-28', 667896541),
(9, 18, '2016-04-28', 667896541),
(10, 18, '2016-04-28', 667896541),
(11, 18, '2016-04-28', 667896541),
(12, 18, '2016-04-28', 667896541),
(13, 18, '2016-04-29', 667896541),
(14, 18, '2016-04-29', 667896541),
(15, 18, '2016-04-29', 667896541),
(16, 18, '2016-04-29', 667896541),
(17, 18, '2016-04-29', 667896541),
(18, 18, '2016-04-29', 667896541),
(19, 18, '2016-04-29', 667896541),
(20, 18, '2016-05-02', 667896541);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bajas`
--

CREATE TABLE `bajas` (
  `baja_id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `phone` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `bajas`
--

INSERT INTO `bajas` (`baja_id`, `user_id`, `fecha`, `phone`) VALUES
(3, 13, '2016-04-25', 660840806),
(4, 13, '2016-04-25', 660840806),
(5, 31, '2016-04-27', 666999852),
(6, 29, '2016-04-27', 654456652),
(19, 18, '2016-04-28', 667896541),
(20, 18, '2016-04-28', 667896541),
(21, 20, '2016-04-28', 666999444),
(22, 20, '2016-04-28', 666999444),
(23, 21, '2016-04-28', 654987321),
(24, 21, '2016-04-28', 654987321),
(25, 22, '2016-04-28', 612345601),
(26, 22, '2016-04-28', 612345601),
(27, 25, '2016-04-28', 666558964),
(28, 25, '2016-04-28', 666558964),
(29, 26, '2016-04-28', 632569856),
(30, 26, '2016-04-28', 632569856),
(31, 27, '2016-04-28', 665566554),
(32, 27, '2016-04-28', 665566554),
(33, 30, '2016-04-28', 635214789),
(34, 30, '2016-04-28', 635214789),
(35, 31, '2016-04-28', 666999852),
(36, 31, '2016-04-28', 666999852),
(37, 18, '2016-04-28', 667896541),
(38, 18, '2016-04-28', 667896541),
(39, 18, '2016-04-28', 667896541),
(40, 18, '2016-04-28', 667896541),
(41, 18, '2016-04-29', 667896541),
(42, 18, '2016-04-29', 667896541),
(43, 18, '2016-04-29', 667896541),
(44, 18, '2016-04-29', 667896541),
(45, 18, '2016-04-29', 667896541),
(46, 18, '2016-04-29', 667896541),
(47, 18, '2016-04-29', 667896541),
(48, 18, '2016-04-29', 667896541),
(49, 19, '2016-04-29', 698745632),
(50, 19, '2016-04-29', 698745632),
(51, 23, '2016-04-29', 698547123),
(52, 23, '2016-04-29', 698547123),
(53, 28, '2016-04-29', 654654654),
(54, 28, '2016-04-29', 654654654),
(55, 24, '2016-04-29', 659825314),
(56, 24, '2016-04-29', 659825314),
(57, 18, '2016-05-02', 667896541),
(58, 24, '2016-05-02', 659825314),
(59, 24, '2016-05-02', 659825314),
(60, 26, '2016-05-02', 632569856),
(61, 26, '2016-05-02', 632569856),
(62, 27, '2016-05-02', 665566554),
(63, 27, '2016-05-02', 665566554),
(64, 28, '2016-05-02', 654654654),
(65, 28, '2016-05-02', 654654654),
(66, 29, '2016-05-02', 654456652),
(67, 29, '2016-05-02', 654456652),
(68, 30, '2016-05-02', 635214789),
(69, 30, '2016-05-02', 635214789),
(70, 31, '2016-05-02', 666999852),
(71, 31, '2016-05-02', 666999852),
(72, 32, '2016-05-02', 987365432),
(73, 32, '2016-05-02', 987365432),
(74, 23, '2016-05-02', 698547123),
(75, 23, '2016-05-02', 698547123),
(76, 24, '2016-05-02', 659825314),
(77, 24, '2016-05-02', 659825314),
(78, 25, '2016-05-02', 666558964),
(79, 25, '2016-05-02', 666558964),
(80, 31, '2016-05-02', 666999852),
(81, 31, '2016-05-02', 666999852),
(82, 32, '2016-05-02', 987365432),
(83, 32, '2016-05-02', 987365432),
(84, 18, '2016-05-02', 667896541),
(85, 18, '2016-05-02', 667896541),
(86, 19, '2016-05-02', 698745632),
(87, 19, '2016-05-02', 698745632),
(88, 21, '2016-05-02', 654987321),
(89, 21, '2016-05-02', 654987321),
(90, 22, '2016-05-02', 612345601),
(91, 22, '2016-05-02', 612345601),
(92, 20, '2016-05-02', 666999444),
(93, 20, '2016-05-02', 666999444),
(94, 26, '2016-05-02', 632569856),
(95, 26, '2016-05-02', 632569856),
(96, 29, '2016-05-02', 654456652),
(97, 29, '2016-05-02', 654456652),
(98, 27, '2016-05-02', 665566554),
(99, 27, '2016-05-02', 665566554),
(100, 18, '2016-05-03', 667896541),
(101, 18, '2016-05-03', 667896541),
(102, 20, '2016-05-03', 666999444),
(103, 20, '2016-05-03', 666999444),
(104, 23, '2016-05-03', 698547123),
(105, 23, '2016-05-03', 698547123),
(106, 24, '2016-05-03', 659825314),
(107, 24, '2016-05-03', 659825314),
(108, 25, '2016-05-03', 666558964),
(109, 25, '2016-05-03', 666558964),
(110, 29, '2016-05-03', 654456652),
(111, 29, '2016-05-03', 654456652),
(112, 30, '2016-05-03', 635214789),
(113, 30, '2016-05-03', 635214789),
(114, 21, '2016-05-03', 654987321),
(115, 21, '2016-05-03', 654987321),
(116, 22, '2016-05-03', 612345601),
(117, 22, '2016-05-03', 612345601),
(118, 27, '2016-05-03', 665566554),
(119, 27, '2016-05-03', 665566554),
(120, 26, '2016-05-03', 632569856),
(121, 26, '2016-05-03', 632569856),
(122, 28, '2016-05-03', 654654654),
(123, 28, '2016-05-03', 654654654),
(124, 19, '2016-05-03', 698745632),
(125, 19, '2016-05-03', 698745632),
(126, 32, '2016-05-03', 987365432),
(127, 32, '2016-05-03', 987365432),
(128, 22, '2016-05-03', 612345601),
(129, 22, '2016-05-03', 612345601),
(130, 24, '2016-05-03', 659825314),
(131, 24, '2016-05-03', 659825314),
(132, 31, '2016-05-03', 666999852),
(133, 31, '2016-05-03', 666999852);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cobros`
--

CREATE TABLE `cobros` (
  `id_cobro` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cobros`
--

INSERT INTO `cobros` (`id_cobro`, `user_id`, `amount`, `fecha`) VALUES
(1, 26, 2, '2016-05-03'),
(2, 28, 2, '2016-05-03'),
(3, 32, 2, '2016-05-03'),
(4, 31, 2, '2016-05-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaccion`
--

CREATE TABLE `transaccion` (
  `transaccion` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `transaccion`
--

INSERT INTO `transaccion` (`transaccion`) VALUES
(4151);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(70) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` int(12) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  `admin` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `phone`, `active`, `admin`) VALUES
(13, 'Mcaldentey', 'macaldenteys@hotmail.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 660840806, 0, 1),
(18, 'Emorales', 'emorales@kitmaker.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 667896541, 1, 0),
(19, 'Scasado', 'scasado@kitmaker.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 698745632, 1, 0),
(20, 'aaa', 'aaa@test.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 666999444, 1, 0),
(21, 'bbb', 'bbb@test.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 654987321, 1, 0),
(22, 'ccc', 'ccc@test.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 612345601, 0, 0),
(23, 'ddd', 'ddd@test.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 698547123, 1, 0),
(24, 'eee', 'eee@test.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 659825314, 0, 0),
(25, 'fff', 'fff@test.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 666558964, 1, 0),
(26, 'ggg', 'ggg@test.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 632569856, 1, 0),
(27, 'hhh', 'hhh@test.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 665566554, 1, 0),
(28, 'iii', 'iii@test.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 654654654, 1, 0),
(29, 'jjj', 'jjj@test.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 654456652, 1, 0),
(30, 'kkk', 'kkk@test.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 635214789, 1, 0),
(31, 'lll', 'lll@test.com', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 666999852, 0, 0),
(32, 'testtest', 'testtestetst', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 987365432, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web_cobro`
--

CREATE TABLE `web_cobro` (
  `transaction` bigint(20) NOT NULL,
  `msisdn` int(12) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `txId` bigint(20) DEFAULT NULL,
  `statusCode` varchar(50) DEFAULT NULL,
  `statusMessage` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `web_cobro`
--

INSERT INTO `web_cobro` (`transaction`, `msisdn`, `amount`, `token`, `user_id`, `fecha`, `txId`, `statusCode`, `statusMessage`) VALUES
(4085, 698745632, 2, '0b7365bd2df41991622b98a9a25b6b45', 19, '2016-05-03', 158086, 'CHARGING_ERROR', 'An error ocurred, please try again.'),
(4087, 654987321, 2, 'c4bd57866a32db13392e6885e3e7e405', 21, '2016-05-03', 158088, 'NO_FUNDS', 'User does not have enough balance.'),
(4089, 612345601, 2, '51d67821c62b98d2123c91b88aa8eb33', 22, '2016-05-03', 158090, 'NO_FUNDS', 'User does not have enough balance.'),
(4092, 632569856, 2, '897d8161353a320dc579ba8c75107107', 26, '2016-05-03', 158093, 'SUCCESS', 'Request processed correctly.'),
(4096, 665566554, 2, '48fcf65286e538f17ef260123c71fad9', 27, '2016-05-03', 158096, 'NO_FUNDS', 'User does not have enough balance.'),
(4098, 654654654, 2, '0f2b90c8a46280b4d9c2f8db00f1dcca', 28, '2016-05-03', 158098, 'SUCCESS', 'Request processed correctly.'),
(4103, 666999852, 2, 'd87f8813de45843723b001d4b4881a23', 31, '2016-05-03', 158102, 'SYSTEM_ERROR', 'An error ocurred. Please try again.'),
(4105, 987365432, 2, '17ce1b458e403232c2c2d950f3e3b6e2', 32, '2016-05-03', 158104, 'SUCCESS', 'Request processed correctly.'),
(4109, 698745632, 2, '506c5ec46e82a9c034cc1446139c9efb', 19, '2016-05-03', 158111, 'SYSTEM_ERROR', 'An error ocurred. Please try again.'),
(4112, 632569856, 2, '53805b6f9ef77ba6553330ff16a1cd1f', 26, '2016-05-03', 158114, 'NO_FUNDS', 'User does not have enough balance.'),
(4114, 654654654, 2, '756d1e615d301d79a9fe8fed22d07b53', 28, '2016-05-03', 158116, 'NO_FUNDS', 'User does not have enough balance.'),
(4116, 666999852, 2, 'ea776ef659afb01404c534ecb7238909', 31, '2016-05-03', 158118, 'SUCCESS', 'Request processed correctly.'),
(4121, 987365432, 2, 'cd2594cd7cd3f060910abc77ce041069', 32, '2016-05-03', 158122, 'SYSTEM_ERROR', 'An error ocurred. Please try again.'),
(4123, 698745632, 2, 'aad73e5f552004231eb95904b796fbbe', 19, '2016-05-03', 158140, 'NO_FUNDS', 'User does not have enough balance.'),
(4124, 666999852, 2, '1a1e2c459b1d32cc67547e3539eed95a', 31, '2016-05-03', 158143, 'DUPLICATED_TR', 'Request transaction already exists.'),
(4126, 987365432, 2, '31e5e5002292deb162a719ebdf3ccd3c', 32, '2016-05-03', 158145, 'NO_FUNDS', 'User does not have enough balance.'),
(4128, 667896541, 2, '086dc9a8fa7aa47de073e41d06d79fbf', 18, '2016-05-03', 158149, 'CHARGING_ERROR', 'An error ocurred, please try again.'),
(4129, 698745632, 2, 'b4cd52d8b1a32c3c12960bf5c95a87b8', 19, '2016-05-03', 158152, 'DUPLICATED_TR', 'Request transaction already exists.'),
(4131, 666999444, 2, 'b88aca8373943129491feb310ad064b6', 20, '2016-05-03', 158154, 'CHARGING_ERROR', 'An error ocurred, please try again.'),
(4132, 654987321, 2, 'af6a7a264f6ecf52d08d299bad0d1c33', 21, '2016-05-03', 158157, 'DUPLICATED_TR', 'Request transaction already exists.'),
(4134, 612345601, 2, '4faef7130e6444b80b2eac259dd55345', 22, '2016-05-03', 158159, 'NO_FUNDS', 'User does not have enough balance.'),
(4135, 698547123, 2, '16fdea12d011e08447c38e69de1f0569', 23, '2016-05-03', 158162, 'DUPLICATED_TR', 'Request transaction already exists.'),
(4137, 659825314, 2, '5db0f3eb7adba820cb1cb694dc6af7c4', 24, '2016-05-03', 158164, 'NO_FUNDS', 'User does not have enough balance.'),
(4138, 666558964, 2, 'd72180d0aa734864582cb5859eac501b', 25, '2016-05-03', 158167, 'DUPLICATED_TR', 'Request transaction already exists.'),
(4140, 632569856, 2, '3e1294efe038ce5704eba743bdb133f0', 26, '2016-05-03', 158169, 'SYSTEM_ERROR', 'An error ocurred. Please try again.'),
(4141, 665566554, 2, 'be6e5f2b1cb179e0a5ecdf535d772421', 27, '2016-05-03', 158172, 'DUPLICATED_TR', 'Request transaction already exists.'),
(4143, 654654654, 2, '36ccdca5b4ba4d688963e898c98d34a7', 28, '2016-05-03', 158175, 'DUPLICATED_TR', 'Request transaction already exists.'),
(4145, 654456652, 2, '668c2e18eb9ae9d90286320ffaa847f9', 29, '2016-05-03', 158178, 'DUPLICATED_TR', 'Request transaction already exists.'),
(4147, 635214789, 2, '059a505e9d4cbc8b286de515e57dd0d1', 30, '2016-05-03', 158181, 'DUPLICATED_TR', 'Request transaction already exists.'),
(4149, 666999852, 2, 'ad22f44b511c6490ac92fa8981596fb8', 31, '2016-05-03', 158183, 'NO_FUNDS', 'User does not have enough balance.'),
(4150, 987365432, 2, '15b848982790f5ed99533e3516c889ca', 32, '2016-05-03', 158186, 'DUPLICATED_TR', 'Request transaction already exists.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web_sms`
--

CREATE TABLE `web_sms` (
  `transaction` bigint(20) NOT NULL,
  `shortcode` varchar(5) DEFAULT NULL,
  `sms_text` text,
  `msisdn` int(12) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `statusCode` varchar(50) DEFAULT NULL,
  `statusMessage` varchar(100) DEFAULT NULL,
  `txId` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `web_sms`
--

INSERT INTO `web_sms` (`transaction`, `shortcode`, `sms_text`, `msisdn`, `user_id`, `fecha`, `statusCode`, `statusMessage`, `txId`) VALUES
(4094, '+34', 'Prueba 1', 632569856, 26, '2016-05-03', 'SUCCESS', 'Request processed correctly.', 158094),
(4100, '+34', 'Prueba 1', 654654654, 28, '2016-05-03', 'SUCCESS', 'Request processed correctly.', 158099),
(4107, '+34', 'Prueba 1', 987365432, 32, '2016-05-03', 'SUCCESS', 'Request processed correctly.', 158105),
(4118, '+34', 'Cobro REALIZADO', 666999852, 31, '2016-05-03', 'SUCCESS', 'Request processed correctly.', 158119);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `web_token`
--

CREATE TABLE `web_token` (
  `transaction` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `txId` bigint(20) DEFAULT NULL,
  `statusCode` varchar(50) DEFAULT NULL,
  `statusMessage` varchar(150) DEFAULT NULL,
  `token` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `web_token`
--

INSERT INTO `web_token` (`transaction`, `user_id`, `fecha`, `txId`, `statusCode`, `statusMessage`, `token`) VALUES
(4081, 19, '2016-05-03', 0, 'TOKEN_SUCCESS', 'Token generated successfully.', '04036e8083a773ad554674520da330ed'),
(4084, 19, '2016-05-03', 158085, 'TOKEN_SUCCESS', 'Token generated successfully.', '0b7365bd2df41991622b98a9a25b6b45'),
(4086, 21, '2016-05-03', 158087, 'TOKEN_SUCCESS', 'Token generated successfully.', 'c4bd57866a32db13392e6885e3e7e405'),
(4088, 22, '2016-05-03', 158089, 'TOKEN_SUCCESS', 'Token generated successfully.', '51d67821c62b98d2123c91b88aa8eb33'),
(4090, 26, '2016-05-03', 158092, 'TOKEN_SUCCESS', 'Token generated successfully.', '897d8161353a320dc579ba8c75107107'),
(4095, 27, '2016-05-03', 158095, 'TOKEN_SUCCESS', 'Token generated successfully.', '48fcf65286e538f17ef260123c71fad9'),
(4097, 28, '2016-05-03', 158097, 'TOKEN_SUCCESS', 'Token generated successfully.', '0f2b90c8a46280b4d9c2f8db00f1dcca'),
(4101, 31, '2016-05-03', 158101, 'TOKEN_SUCCESS', 'Token generated successfully.', 'd87f8813de45843723b001d4b4881a23'),
(4104, 32, '2016-05-03', 158103, 'TOKEN_SUCCESS', 'Token generated successfully.', '17ce1b458e403232c2c2d950f3e3b6e2'),
(4108, 19, '2016-05-03', 158110, 'TOKEN_SUCCESS', 'Token generated successfully.', '506c5ec46e82a9c034cc1446139c9efb'),
(4110, 26, '2016-05-03', 158113, 'TOKEN_SUCCESS', 'Token generated successfully.', '53805b6f9ef77ba6553330ff16a1cd1f'),
(4113, 28, '2016-05-03', 158115, 'TOKEN_SUCCESS', 'Token generated successfully.', '756d1e615d301d79a9fe8fed22d07b53'),
(4115, 31, '2016-05-03', 158117, 'TOKEN_SUCCESS', 'Token generated successfully.', 'ea776ef659afb01404c534ecb7238909'),
(4119, 32, '2016-05-03', 158121, 'TOKEN_SUCCESS', 'Token generated successfully.', 'cd2594cd7cd3f060910abc77ce041069'),
(4122, 19, '2016-05-03', 158139, 'TOKEN_SUCCESS', 'Token generated successfully.', 'aad73e5f552004231eb95904b796fbbe'),
(4123, 31, '2016-05-03', 158142, 'TOKEN_SUCCESS', 'Token generated successfully.', '1a1e2c459b1d32cc67547e3539eed95a'),
(4125, 32, '2016-05-03', 158144, 'TOKEN_SUCCESS', 'Token generated successfully.', '31e5e5002292deb162a719ebdf3ccd3c'),
(4127, 18, '2016-05-03', 158148, 'TOKEN_SUCCESS', 'Token generated successfully.', '086dc9a8fa7aa47de073e41d06d79fbf'),
(4128, 19, '2016-05-03', 158151, 'TOKEN_SUCCESS', 'Token generated successfully.', 'b4cd52d8b1a32c3c12960bf5c95a87b8'),
(4130, 20, '2016-05-03', 158153, 'TOKEN_SUCCESS', 'Token generated successfully.', 'b88aca8373943129491feb310ad064b6'),
(4131, 21, '2016-05-03', 158156, 'TOKEN_SUCCESS', 'Token generated successfully.', 'af6a7a264f6ecf52d08d299bad0d1c33'),
(4133, 22, '2016-05-03', 158158, 'TOKEN_SUCCESS', 'Token generated successfully.', '4faef7130e6444b80b2eac259dd55345'),
(4134, 23, '2016-05-03', 158161, 'TOKEN_SUCCESS', 'Token generated successfully.', '16fdea12d011e08447c38e69de1f0569'),
(4136, 24, '2016-05-03', 158163, 'TOKEN_SUCCESS', 'Token generated successfully.', '5db0f3eb7adba820cb1cb694dc6af7c4'),
(4137, 25, '2016-05-03', 158166, 'TOKEN_SUCCESS', 'Token generated successfully.', 'd72180d0aa734864582cb5859eac501b'),
(4139, 26, '2016-05-03', 158168, 'TOKEN_SUCCESS', 'Token generated successfully.', '3e1294efe038ce5704eba743bdb133f0'),
(4140, 27, '2016-05-03', 158171, 'TOKEN_SUCCESS', 'Token generated successfully.', 'be6e5f2b1cb179e0a5ecdf535d772421'),
(4142, 28, '2016-05-03', 158174, 'TOKEN_SUCCESS', 'Token generated successfully.', '36ccdca5b4ba4d688963e898c98d34a7'),
(4144, 29, '2016-05-03', 158177, 'TOKEN_SUCCESS', 'Token generated successfully.', '668c2e18eb9ae9d90286320ffaa847f9'),
(4146, 30, '2016-05-03', 158180, 'TOKEN_SUCCESS', 'Token generated successfully.', '059a505e9d4cbc8b286de515e57dd0d1'),
(4148, 31, '2016-05-03', 158182, 'TOKEN_SUCCESS', 'Token generated successfully.', 'ad22f44b511c6490ac92fa8981596fb8'),
(4149, 32, '2016-05-03', 158185, 'TOKEN_SUCCESS', 'Token generated successfully.', '15b848982790f5ed99533e3516c889ca');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `altas`
--
ALTER TABLE `altas`
  ADD PRIMARY KEY (`alta_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `bajas`
--
ALTER TABLE `bajas`
  ADD PRIMARY KEY (`baja_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `cobros`
--
ALTER TABLE `cobros`
  ADD PRIMARY KEY (`id_cobro`),
  ADD KEY `id_user` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indices de la tabla `web_cobro`
--
ALTER TABLE `web_cobro`
  ADD PRIMARY KEY (`transaction`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `web_sms`
--
ALTER TABLE `web_sms`
  ADD PRIMARY KEY (`transaction`),
  ADD UNIQUE KEY `txId` (`txId`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `web_token`
--
ALTER TABLE `web_token`
  ADD PRIMARY KEY (`transaction`),
  ADD UNIQUE KEY `txId` (`txId`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `altas`
--
ALTER TABLE `altas`
  MODIFY `alta_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `bajas`
--
ALTER TABLE `bajas`
  MODIFY `baja_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;
--
-- AUTO_INCREMENT de la tabla `cobros`
--
ALTER TABLE `cobros`
  MODIFY `id_cobro` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `altas`
--
ALTER TABLE `altas`
  ADD CONSTRAINT `altas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Filtros para la tabla `bajas`
--
ALTER TABLE `bajas`
  ADD CONSTRAINT `bajas_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `bajas_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Filtros para la tabla `cobros`
--
ALTER TABLE `cobros`
  ADD CONSTRAINT `cobros_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Filtros para la tabla `web_cobro`
--
ALTER TABLE `web_cobro`
  ADD CONSTRAINT `web_cobro_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Filtros para la tabla `web_sms`
--
ALTER TABLE `web_sms`
  ADD CONSTRAINT `web_sms_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Filtros para la tabla `web_token`
--
ALTER TABLE `web_token`
  ADD CONSTRAINT `web_token_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
