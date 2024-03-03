-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2023 a las 23:21:42
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pt05_elyass_jerari`
--
CREATE DATABASE IF NOT EXISTS `pt05_elyass_jerari` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pt05_elyass_jerari`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articles`
--

INSERT INTO `articles` (`id`, `article`) VALUES
(1, 'Lorem ipsum'),
(2, 'Massa tincidunt nunc pulvinar sapien et ligula ullamcorper.'),
(3, 'Ultrices tincidunt arcu non sodales neque sodales ut.'),
(4, 'Mauris ultrices eros in cursus turpis massa tincidunt dui ut.'),
(5, 'Morbi quis commodo odio aenean. Tincidunt id aliquet risus feugiat in ante metus dictum at.'),
(6, 'Gravida quis blandit turpis cursus in hac habitasse platea dictumst.'),
(7, 'Iaculis eu non diam phasellus vestibulum lorem sed. Phasellus faucibus scelerisque eleifend donec pretium vulputate sapien nec.'),
(8, 'Cursus turpis massa tincidunt dui ut ornare lectus. Dictum fusce ut placerat orci nulla pellentesque dignissim enim sit.'),
(9, 'Massa tincidunt dui ut ornare lectus sit. Eu turpis egestas pretium aenean pharetra magna ac placerat.'),
(10, 'Aenean pharetra magna ac placerat. Sit amet consectetur adipiscing elit ut.'),
(11, 'Quis varius quam quisque id diam vel. Feugiat in ante metus dictum.'),
(12, 'Ornare arcu dui vivamus arcu felis bibendum ut tristique et.'),
(13, 'Usto nec ultrices dui sapien eget mi proin sed libero. Pulvinar sapien et ligula ullamcorper malesuada proin libero.'),
(14, 'Laoreet non curabitur gravida arcu ac tortor. Scelerisque felis imperdiet proin fermentum leo.'),
(15, 'Habitant morbi tristique senectus et netus et. Interdum consectetur libero id faucibus nisl tincidunt eget nullam non.'),
(16, 'Tempus urna et pharetra pharetra massa massa ultricies. Diam ut venenatis tellus in metus vulputate eu.'),
(17, 'Et netus et malesuada fames ac turpis. Libero id faucibus nisl tincidunt eget. Justo donec enim diam vulputate ut pharetra sit amet aliquam.'),
(18, 'Cras fermentum odio eu feugiat pretium. Augue mauris augue neque gravida in fermentum et sollicitudin.'),
(19, 'Pharetra massa massa ultricies mi quis hendrerit dolor magna eget.'),
(20, 'Augue neque gravida in fermentum et sollicitudin. Laoreet suspendisse interdum consectetur libero id faucibus.'),
(21, 'Tellus mauris a diam maecenas. Porttitor lacus luctus accumsan tortor posuere.'),
(22, 'Integer feugiat scelerisque varius morbi enim nunc faucibus. Accumsan tortor posuere ac ut consequat semper.'),
(23, 'Feugiat in ante metus dictum at tempor. Consectetur adipiscing elit pellentesque habitant morbi.'),
(24, 'Integer malesuada nunc vel risus. Non diam phasellus vestibulum lorem sed risus.'),
(25, 'Enim praesent elementum facilisis leo vel fringilla est ullamcorper eget. Feugiat scelerisque varius morbi enim. Ligula ullamcorper malesuada proin libero nunc.'),
(26, 'Adipiscing at in tellus integer feugiat scelerisque varius.'),
(27, 'Placerat in egestas erat imperdiet sed euismod nisi porta. A cras semper auctor neque vitae tempus quam pellentesque nec.'),
(33, 'Lorem ipsum');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

DROP TABLE IF EXISTS `usuaris`;
CREATE TABLE IF NOT EXISTS `usuaris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `token` varchar(190) DEFAULT NULL,
  `google_id` varchar(150) DEFAULT NULL,
  `github_id` varchar(150) DEFAULT NULL,
  `token_creation_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`id`, `username`, `password`, `token`, `google_id`, `github_id`, `token_creation_time`) VALUES
(4, 'elyass909@gmail.com', '$2y$10$KPUqH8FSrv2vu8I.0dKQLuv8lqCJgbrKnqbp5B10dkMud8A.atSlW', '60d1f9de3b73cfae3c985bf031b0294a3c1d13df50407b6b5a2f058d0a8dba10', '', NULL, '2023-11-12 22:04:53'),
(7, '\'elyass909@gmail.com\'', NULL, NULL, '\'116185564387212403809\'', NULL, '2023-11-12 22:04:29'),
(8, '\'e.jerari@sapalomera.cat\'', NULL, NULL, '\'111578038167253596436\'', NULL, '2023-11-12 22:04:29'),
(9, '\'elyasseljerari@institutescolalloretdemar.cat\'', NULL, NULL, '\'109743500783709889769\'', NULL, '2023-11-12 22:04:29');

--
-- Disparadores `usuaris`
--
DROP TRIGGER IF EXISTS `before_update_usuaris`;
DELIMITER $$
CREATE TRIGGER `before_update_usuaris` BEFORE UPDATE ON `usuaris` FOR EACH ROW BEGIN
    IF NEW.token IS NOT NULL THEN
        SET NEW.token_creation_time = IFNULL(NEW.token_creation_time, CURRENT_TIMESTAMP);
    END IF;
END
$$
DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
