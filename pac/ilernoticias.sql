-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-02-2024 a las 16:25:17
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ilernoticias`
--
CREATE DATABASE IF NOT EXISTS `ilernoticias` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ilernoticias`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `id` int(11) NOT NULL,
  `id_autor` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `cuerpo` text DEFAULT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rel_iusuarioid_noticiaidautor` (`id_autor`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `rel_iusuarioid_noticiaidautor` FOREIGN KEY (`id_autor`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


/* ELIMINAR ESTO */

INSERT INTO noticia (id_autor, titulo, cuerpo, fecha) VALUES
(1, 'Nuevas actualizaciones en la aplicación móvil', 'Se han implementado nuevas funciones para mejorar la experiencia del usuario.', '2024-04-13'),
(2, 'Descubrimiento científico revoluciona la medicina', 'Investigadores han encontrado una nueva forma de combatir enfermedades crónicas.', '2024-04-12'),
(3, 'El mercado financiero experimenta cambios drásticos', 'Las bolsas de valores de todo el mundo han sufrido un fuerte impacto debido a nuevas regulaciones.', '2024-04-11'),
(1, 'Lanzamiento de nuevo producto tecnológico', 'Una empresa líder en tecnología ha anunciado el lanzamiento de su último dispositivo innovador.', '2024-04-10'),
(3, 'Celebridades se unen para una causa benéfica', 'Varias personalidades famosas han colaborado en un evento para recaudar fondos para organizaciones sin fines de lucro.', '2024-04-09');

DELETE FROM noticia;

INSERT INTO usuario (nombre, email, contrasena) VALUES
('Juan Pérez', 'juan@example.com', 'contraseña123'),
('María García', 'maria@example.com', 'maria123'),
('Carlos López', 'carlos@example.com', 'clave456');


SELECT * FROM noticia ORDER BY titulo DESC;
