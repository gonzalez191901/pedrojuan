-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-06-2025 a las 05:17:14
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pedro_new`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `carr_id` int(11) NOT NULL,
  `carr_descripcion` varchar(255) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`carr_id`, `carr_descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Ingeniería de Sistemas', '0000-00-00', '0000-00-00'),
(2, 'Diseño Gráfico', '0000-00-00', '0000-00-00'),
(3, 'Administración de Empresas', '2025-06-01', '2025-06-01'),
(4, 'Medicina', '2025-06-01', '2025-06-01'),
(5, 'Derecho', '2025-06-01', '2025-06-01'),
(6, 'Otra', '2025-06-01', '2025-06-01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `come_id` int(11) NOT NULL,
  `come_id_user` int(11) NOT NULL,
  `come_comentario` varchar(1000) NOT NULL,
  `come_publ_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`come_id`, `come_id_user`, `come_comentario`, `come_publ_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'comentario', 6, '2025-06-04 02:14:23', '2025-06-04 02:14:23'),
(2, 1, 'fghfhfghfghfgh', 6, '2025-06-04 02:23:13', '2025-06-04 02:23:13'),
(3, 1, 'fghfghg', 1, '2025-06-04 06:32:29', '2025-06-04 06:32:29'),
(4, 1, 'fghfghg', 1, '2025-06-04 06:32:48', '2025-06-04 06:32:48'),
(5, 1, 'fghfghg', 1, '2025-06-04 06:33:00', '2025-06-04 06:33:00'),
(6, 1, 'hola', 6, '2025-06-04 06:33:35', '2025-06-04 06:33:35'),
(7, 1, 'hola', 6, '2025-06-04 06:34:20', '2025-06-04 06:34:20'),
(8, 1, 'hola', 6, '2025-06-04 06:35:53', '2025-06-04 06:35:53'),
(9, 1, 'vfvfvvfvfv', 6, '2025-06-04 06:37:23', '2025-06-04 06:37:23'),
(10, 1, 'hola mundo', 6, '2025-06-04 07:43:57', '2025-06-04 07:43:57'),
(11, 5, 'rtuhyurtyu', 7, '2025-06-07 16:51:19', '2025-06-07 16:51:19'),
(12, 5, 'sdrfsser drge r er', 7, '2025-06-07 16:55:38', '2025-06-07 16:55:38'),
(13, 5, 'dfgerg', 8, '2025-06-07 17:25:05', '2025-06-07 17:25:05'),
(14, 5, 'Lorem', 9, '2025-06-07 17:29:23', '2025-06-07 17:29:23'),
(15, 5, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 9, '2025-06-07 17:29:32', '2025-06-07 17:29:32'),
(22, 1, 'rthrhrt', 3, '2025-06-18 07:15:23', '2025-06-18 07:15:23'),
(23, 1, 'fghjhfghj', 11, '2025-06-18 07:16:19', '2025-06-18 07:16:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_publicacion` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `likes`
--

INSERT INTO `likes` (`id`, `id_usuario`, `id_publicacion`, `created_at`, `updated_at`) VALUES
(12, 1, 1, '2025-06-18 06:29:43', '2025-06-18 06:29:43'),
(13, 1, 9, '2025-06-18 07:13:07', '2025-06-18 07:13:07'),
(14, 1, 3, '2025-06-18 07:15:07', '2025-06-18 07:15:07'),
(15, 1, 11, '2025-06-18 07:16:20', '2025-06-18 07:16:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes_comentarios`
--

CREATE TABLE `likes_comentarios` (
  `id` int(11) NOT NULL,
  `id_comentario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `likes_comentarios`
--

INSERT INTO `likes_comentarios` (`id`, `id_comentario`, `id_usuario`, `created_at`, `updated_at`) VALUES
(2, 16, 1, '2025-06-18 06:58:18', '2025-06-18 06:58:18'),
(3, 15, 1, '2025-06-18 06:58:19', '2025-06-18 06:58:19'),
(4, 14, 1, '2025-06-18 06:58:21', '2025-06-18 06:58:21'),
(5, 17, 1, '2025-06-18 07:10:33', '2025-06-18 07:10:33'),
(6, 20, 1, '2025-06-18 07:14:55', '2025-06-18 07:14:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `publ_id` int(11) NOT NULL,
  `publ_comentario` mediumtext NOT NULL,
  `publ_id_user` int(11) NOT NULL,
  `tittle` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`publ_id`, `publ_comentario`, `publ_id_user`, `tittle`, `created_at`, `updated_at`) VALUES
(1, 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 1, '', '2025-06-01 23:59:17', '2025-06-01 23:59:17'),
(2, 'tghrthg5rtyrty', 1, '', '2025-06-02 04:54:39', '2025-06-02 04:54:39'),
(3, 'primer comentario', 1, '', '2025-06-02 04:55:15', '2025-06-02 04:55:15'),
(4, 'ghjghj', 1, '', '2025-06-02 04:57:07', '2025-06-02 04:57:07'),
(5, 'ggertg', 1, '', '2025-06-02 04:57:26', '2025-06-02 04:57:26'),
(6, 'publicacion hhhh', 1, '', '2025-06-04 06:07:31', '2025-06-04 06:07:31'),
(7, 'Hola Mundo', 5, '', '2025-06-07 16:50:50', '2025-06-07 16:50:50'),
(8, 'tyurtuui', 5, 'tytyty', '2025-06-07 17:15:31', '2025-06-07 17:15:31'),
(9, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 5, 'Titulo Lorem', '2025-06-07 17:29:14', '2025-06-07 17:29:14'),
(10, 'hablale', 1, 'tengo sueño', '2025-06-18 07:15:48', '2025-06-18 07:15:48'),
(11, '34t43t', 1, '34tr34t', '2025-06-18 07:16:07', '2025-06-18 07:16:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `carrera_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `last_name`, `phone`, `fecha_nacimiento`, `username`, `carrera_id`) VALUES
(1, 'oscar', 'gonzalez191901@gmail.com', NULL, '$2y$10$mNalV7WGNcIq7ln1isF2C.0dacnma.hjibNX/0dlvI6yamE3z4ViS', 'bj8QbjmYpfKHeUBzgDFq7xNnrnLinqikCm356M0CH07v8AJfVi178PWtcenK', '2025-06-02 01:59:42', '2025-06-02 01:59:42', '', '', '0000-00-00', '', 0),
(2, 'oscar', 'gonzalez191902@gmail.com', NULL, '$2y$10$oNKYVjgq18Ub2WbC/qJqVujRO6FiKmwCg7XrQff.teMGk622bHqc.', NULL, '2025-06-07 16:36:02', '2025-06-07 16:36:02', 'gonzalez', '042429634345', '1997-08-31', '', 4),
(3, 'oscar', 'gonzalez191903@gmail.com', NULL, '$2y$10$JhwhITud899JeVQFUD1vS.XoiKNzT5/nETVWj/PsAMPpzqSDRQ7/y', NULL, '2025-06-07 16:38:45', '2025-06-07 16:38:45', 'gonzalez', '042429634345', '1997-08-31', '', 3),
(4, 'ertert', 'hhhh@gmail.com', NULL, '$2y$10$iiC8vlAF5YYMStGdJo.zNOak4Bx04G53gk/0oYESNCkLcY6qIItb2', NULL, '2025-06-07 16:40:01', '2025-06-07 16:40:01', 'rtertert', '123123123', '2005-01-01', '', 2),
(5, 'johany', 'Johany321@gmail.com', NULL, '$2y$10$CQZCXK3v/liMLDNW9.Y4Ke7ZHRJcCE9Jahr49AsXwY7fAX5kPcENC', NULL, '2025-06-07 16:50:32', '2025-06-07 16:50:32', 'Mora', '04126585986', '1999-12-03', '', 1),
(6, 'oscar', 'ogonza01@gmail.com', NULL, '$2y$10$dl4HVV6V5NLdKpLRVH4zIeB1OLU6rpiKzXgPCLG1UOA/jjykGeCVm', NULL, '2025-06-17 06:56:53', '2025-06-17 06:56:53', 'gonzalez', '04242963435', '1997-08-31', 'ogonza01', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`carr_id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`come_id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `likes_comentarios`
--
ALTER TABLE `likes_comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`publ_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `carr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `come_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `likes_comentarios`
--
ALTER TABLE `likes_comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `publ_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
