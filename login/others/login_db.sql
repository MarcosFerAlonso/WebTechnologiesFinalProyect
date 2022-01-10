-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-01-2022 a las 15:27:41
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `login_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `films`
--

CREATE TABLE `films` (
  `films_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `rating` decimal(4,2) NOT NULL,
  `description` mediumtext NOT NULL,
  `image` varchar(100) NOT NULL,
  `trailer` varchar(100) NOT NULL,
  `cost` decimal(4,2) NOT NULL,
  `genre` int(11) NOT NULL,
  `pegi` int(11) NOT NULL,
  `outdated` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `films`
--

INSERT INTO `films` (`films_id`, `title`, `rating`, `description`, `image`, `trailer`, `cost`, `genre`, `pegi`, `outdated`) VALUES
(1, 'Tenet', '7.30', 'An epic action revolving around international espionage, time travel and evolution, in which a secret agent must prevent World War III.', 'web/tenet.jpg', 'https://www.youtube.com/embed/QxhDXmb2O3k', '3.99', 2, 16, 0),
(2, 'The nun', '5.50', 'After the death of a young nun in a Romanian convent, the Vatican sends a nun about to take vows and a priest who is an expert in possessions for an investigation. A terrible confrontation between the world of the living and the world of the dead will occur with his arrival at the convent.', 'web/nun.jpg', 'https://www.youtube.com/embed/pzD9zGcUNrw', '2.99', 4, 18, 1),
(3, 'Shang-Chi: the legend of 10 rings', '8.20', 'Martial arts master Shang-Chi faces the past he believed to have left behind when he is caught up in the web of the mysterious Ten Rings organization.', 'web/shang_chi.jpg', 'https://www.youtube.com/embed/8YjFbMbfXaQ', '4.50', 3, 13, 1),
(11, 'Ghosts Busters: a new mission', '7.20', 'When a single mother and her two children move to a new city, they soon discover that they have a connection to the original Ghostbusters and their grandfather s secret legacy', 'web/ghostbusters.jpg', 'https://www.youtube.com/embed/ahZFCF--uRY', '3.10', 2, 13, 0),
(1000000, 'this is not a film', '1.00', 'this will be preserved to indicate if a payment was done in order to buy premium', 'notimage', 'nottrailer', '4.99', 1, 13, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `film_genre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `genres`
--

INSERT INTO `genres` (`id`, `film_genre`) VALUES
(1, 'Action'),
(2, 'Science-fiction'),
(3, 'Superheroes'),
(4, 'Terror');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `client_id` varchar(15) NOT NULL,
  `type` varchar(10) NOT NULL,
  `cc_number` varchar(24) NOT NULL,
  `cc_date` date NOT NULL,
  `cc_ccv` int(11) NOT NULL,
  `datestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `cc_name` varchar(50) NOT NULL,
  `film_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `payments`
--

INSERT INTO `payments` (`payment_id`, `client_id`, `type`, `cc_number`, `cc_date`, `cc_ccv`, `datestamp`, `cc_name`, `film_id`) VALUES
(18, '1A', 'card', 'q5145111', '2021-12-03', 123, '2021-12-31 13:11:16', 'Manolo', 2),
(19, '1A', 'card', '2Âº313', '2021-12-03', 112, '2021-12-31 13:12:39', 'Manolo', 1000000),
(20, '1A', 'card', '134213', '2021-12-03', 123, '2021-12-31 13:52:28', 'Manolo', 2),
(21, '1A', 'card', '34124', '2021-12-04', 123, '2021-12-31 13:54:13', 'Manolo', 2),
(22, '1A', 'card', '415235', '2021-12-10', 123, '2021-12-31 13:57:22', 'Manolo', 2),
(23, '1A', 'card', '415235', '2021-12-10', 123, '2021-12-31 14:00:04', 'Manolo', 2),
(24, '1A', 'card', '415235', '2021-12-10', 123, '2021-12-31 14:00:25', 'Manolo', 2),
(25, '1A', 'card', '415235', '2021-12-10', 123, '2021-12-31 14:00:43', 'Manolo', 2),
(26, '1A', 'card', '341', '2021-12-03', 123, '2021-12-31 14:01:09', 'Manolo', 2),
(27, '1A', 'card', '3242', '2021-12-11', 123, '2021-12-31 14:12:20', 'Manolo', 2),
(28, '1A', 'card', '3242', '2021-12-11', 123, '2021-12-31 14:12:49', 'Manolo', 2),
(29, '1A', 'card', '3242', '2021-12-11', 123, '2021-12-31 14:12:53', 'Manolo', 2),
(30, '1A', 'card', '3242', '2021-12-11', 123, '2021-12-31 14:13:19', 'Manolo', 2),
(31, '1A', 'card', '3242', '2021-12-11', 123, '2021-12-31 14:14:28', 'Manolo', 2),
(32, '1A', 'card', '3242', '2021-12-11', 123, '2021-12-31 14:14:31', 'Manolo', 2),
(33, '1A', 'card', '3242', '2021-12-11', 123, '2021-12-31 14:14:49', 'Manolo', 2),
(34, '1A', 'card', '13423412', '2021-12-11', 123, '2021-12-31 14:15:31', 'Manolo f', 2),
(35, '1A', 'card', '231321', '2021-12-03', 233, '2021-12-31 14:17:15', 'Manolo ff', 2),
(36, '1A', 'card', '231321', '2021-12-03', 233, '2021-12-31 14:17:28', 'Manolo ff', 2),
(37, '1A', 'card', '231321', '2021-12-03', 233, '2021-12-31 14:17:35', 'Manolo ff', 2),
(38, '1A', 'card', '231321', '2021-12-03', 233, '2021-12-31 14:18:49', 'Manolo ff', 2),
(39, '1A', 'card', '12345', '2021-12-03', 123, '2021-12-31 14:20:18', 'Manolo SD', 1),
(40, '1A', 'card', '12345', '2021-12-03', 123, '2021-12-31 14:21:42', 'Manolo SD', 1),
(41, '1A', 'card', '12345', '2021-12-03', 123, '2021-12-31 14:22:50', 'Manolo SD', 1),
(42, '1A', 'card', '235354', '2021-12-04', 123, '2021-12-31 14:23:08', 'Manolo EL EMJOR', 1),
(43, '1A', 'card', '3142343', '2021-12-02', 123, '2021-12-31 14:24:01', 'MARIANO', 2),
(44, '1A', 'card', '48561345', '2021-12-02', 421, '2021-12-31 14:33:44', 'Manolo mlwdnfkjbalfsjhl', 1),
(45, '7553278', 'card', '134242', '2021-12-03', 343, '2021-12-31 15:09:54', 'Manolo', 2),
(46, '1A', 'card', '1424', '2021-12-03', 123, '2021-12-31 15:50:41', 'ewrewr', 2),
(47, '1A', 'card', '415345', '2022-01-02', 123, '2021-12-31 16:15:53', 'Manolo', 1),
(51, '7553278', 'card', '1234567887654321', '2022-01-07', 123, '2022-01-02 21:32:53', 'fewfw', 11),
(52, '7553278', 'card', '1234567887654321', '2022-01-07', 123, '2022-01-02 21:37:05', 'Manolo ff', 11),
(53, '7553278', 'card', '1234567887654321', '2022-01-07', 123, '2022-01-02 21:37:26', 'fewfw', 11),
(54, '7553278', 'card', '1234567887654321', '2022-01-07', 123, '2022-01-02 21:37:57', 'Manolo', 1),
(55, '7553278', 'card', '1234567887654321', '2022-01-08', 123, '2022-01-02 21:38:29', 'Manolo', 1),
(56, '7553278', 'card', '1234567887654321', '2022-01-07', 123, '2022-01-02 21:38:41', 'Manolo', 11),
(57, '7553278', 'card', '1234567887654321', '2022-01-07', 123, '2022-01-02 21:51:52', 'Manolo', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rented_films`
--

CREATE TABLE `rented_films` (
  `rent_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `starting_date` date NOT NULL DEFAULT current_timestamp(),
  `final_date` date NOT NULL,
  `times_watched` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rented_films`
--

INSERT INTO `rented_films` (`rent_id`, `payment_id`, `starting_date`, `final_date`, `times_watched`) VALUES
(3, 18, '2021-12-31', '2022-01-07', 0),
(4, 44, '2021-12-31', '2022-01-07', 0),
(5, 45, '2021-12-31', '2022-01-07', 3),
(6, 46, '2021-12-31', '2022-01-07', 1),
(7, 47, '2021-12-31', '2022-01-07', 0),
(8, 51, '2022-01-02', '2022-01-09', 0),
(9, 52, '2022-01-02', '2022-01-09', 0),
(10, 53, '2022-01-02', '2022-01-09', 0),
(12, 55, '2022-01-02', '2022-01-09', 3),
(13, 56, '2022-01-02', '2022-01-09', 0),
(14, 57, '2022-01-02', '2022-01-09', 0),
(15, 54, '2022-01-02', '2022-01-09', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `users_id` varchar(15) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(20) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `premium` tinyint(1) NOT NULL DEFAULT 0,
  `banned` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`users_id`, `user_email`, `user_password`, `user_name`, `premium`, `banned`) VALUES
('0', 'thisisyouradmin@gmail.com', 'admin', 'admin', 0, 0),
('1A', 'ola@gmail.com', '1234', 'Ola', 1, 0),
('26633116483958', 'bhbwfe@gmail.com', '1234', 'Pepe', 0, 0),
('7553278', 'marcos.tirachinas@gmail.com', '12345', 'Marcos', 0, 0),
('880482456951732', 'miguel@gmail.com', '1234', 'Miguel2', 0, 0),
('923869714', 'bhbihbsphe@gmail.com', '1234', 'iNVENTED23', 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`films_id`),
  ADD KEY `title` (`title`),
  ADD KEY `rating` (`rating`),
  ADD KEY `genre` (`genre`);

--
-- Indices de la tabla `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `film_genre` (`film_genre`);

--
-- Indices de la tabla `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `film_id` (`film_id`);

--
-- Indices de la tabla `rented_films`
--
ALTER TABLE `rented_films`
  ADD PRIMARY KEY (`rent_id`),
  ADD KEY `payment_id` (`payment_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`),
  ADD UNIQUE KEY `user_email_2` (`user_email`),
  ADD UNIQUE KEY `user_name_2` (`user_name`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `user_email` (`user_email`),
  ADD KEY `user_password` (`user_password`),
  ADD KEY `user_name` (`user_name`),
  ADD KEY `premium` (`premium`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `films`
--
ALTER TABLE `films`
  MODIFY `films_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000001;

--
-- AUTO_INCREMENT de la tabla `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `rented_films`
--
ALTER TABLE `rented_films`
  MODIFY `rent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `films`
--
ALTER TABLE `films`
  ADD CONSTRAINT `films_ibfk_1` FOREIGN KEY (`genre`) REFERENCES `genres` (`id`);

--
-- Filtros para la tabla `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `users` (`users_id`),
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `films` (`films_id`);

--
-- Filtros para la tabla `rented_films`
--
ALTER TABLE `rented_films`
  ADD CONSTRAINT `rented_films_ibfk_1` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`payment_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
