-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-04-2025 a las 06:19:56
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
-- Base de datos: `masjcmy`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerAlquileresParqueaderoVisitantes` ()   BEGIN
                SELECT
                    a.idAlquilerParqueadero,
                    v.NombresVisitante,
                    v.ApellidosVisitante,
                    p.idBahia,
                    a.FechaIngreso,
                    a.TotalPago
                FROM
                    registro_de_parqueadero a
                INNER JOIN
                    Visitante v ON a.idVisitante = v.idVisitante
                INNER JOIN
                    Parqueadero p ON a.idBahia = p.idBahia;
            END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ObtenerCorrespondenciaPorFecha` (IN `fecha_ingreso` DATE)   BEGIN
    SELECT 
        CONCAT(u2.PrimerNombre, ' ', u2.SegundoNombre, ' ', u2.PrimerApellido, ' ', u2.SegundoApellido) AS NombreGuardia,
        c.TipoPaquete, 
        c.FechaIngreso, 
        c.FechaEntrega,
        CONCAT(u1.PrimerNombre, ' ', u1.SegundoNombre, ' ', u1.PrimerApellido, ' ', u1.SegundoApellido) AS NombreResidente
    FROM 
        correspondencia c
    INNER JOIN 
        residentes r ON c.idResidente = r.idResidente
    INNER JOIN 
        usuario u1 ON r.idResidente = u1.idUsuario
    INNER JOIN 
        usuario u2 ON u2.idUsuario = c.idGuardia  
    WHERE 
        c.FechaIngreso BETWEEN DATE_SUB(fecha_ingreso, INTERVAL 1 DAY) AND DATE_ADD(fecha_ingreso, INTERVAL 1 DAY);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquilerzonascomunes`
--

CREATE TABLE `alquilerzonascomunes` (
  `idAlquilerZonaComun` int(11) NOT NULL,
  `FechaAlquiler` date NOT NULL,
  `CantidadPersonas` int(11) DEFAULT NULL,
  `TotalPago` int(11) NOT NULL,
  `HoraLimite` datetime NOT NULL,
  `idZonaComun` int(11) NOT NULL,
  `idResidente` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apartamentos`
--

CREATE TABLE `apartamentos` (
  `idApartamentos` int(11) NOT NULL,
  `torre` varchar(10) NOT NULL,
  `apto` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(18, '2025_03_31_195319_create_alquilerzonascomunes_table', 1),
(19, '2025_03_31_195319_create_apartamentos_table', 1),
(20, '2025_03_31_195319_create_parqueadero_table', 1),
(21, '2025_03_31_195319_create_quejas_table', 1),
(22, '2025_03_31_195319_create_residentes_table', 1),
(23, '2025_03_31_195319_create_sessions_table', 1),
(24, '2025_03_31_195319_create_usuario_table', 1),
(25, '2025_03_31_195319_create_vehiculos_table', 1),
(26, '2025_03_31_195319_create_visitante_table', 1),
(27, '2025_03_31_195319_create_zonacomun_table', 1),
(28, '2025_03_31_195321_create_ObtenerAlquileresParqueaderoVisitantes_proc', 1),
(29, '2025_03_31_195321_create_ObtenerCorrespondenciaPorFecha_proc', 1),
(30, '2025_03_31_195322_add_foreign_keys_to_alquilerzonascomunes_table', 1),
(31, '2025_03_31_195322_add_foreign_keys_to_quejas_table', 1),
(32, '2025_03_31_195322_add_foreign_keys_to_vehiculos_table', 1),
(33, '2025_03_31_195322_add_foreign_keys_to_visitante_table', 1),
(34, '2025_04_05_215412_create_password_reset_tokens_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parqueadero`
--

CREATE TABLE `parqueadero` (
  `idBahia` int(11) NOT NULL,
  `Novedad` text DEFAULT NULL,
  `Estado` enum('Ocupado','Desocupado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quejas`
--

CREATE TABLE `quejas` (
  `idQueja` int(11) NOT NULL,
  `FechaQueja` date NOT NULL,
  `MotivoQueja` text NOT NULL,
  `idResidente` int(10) UNSIGNED NOT NULL,
  `EstadoQueja` tinyint(4) NOT NULL,
  `idAdministrador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `residentes`
--

CREATE TABLE `residentes` (
  `idResidente` int(10) UNSIGNED NOT NULL,
  `idApartamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(10) UNSIGNED NOT NULL,
  `PrimerNombre` varchar(25) NOT NULL,
  `SegundoNombre` varchar(25) DEFAULT NULL,
  `PrimerApellido` varchar(25) NOT NULL,
  `SegundoApellido` varchar(30) DEFAULT NULL,
  `NumeroCelular` varchar(15) NOT NULL,
  `CorreoElectronico` varchar(40) NOT NULL,
  `Contraseña` varchar(64) NOT NULL,
  `ConjuntoNombre` varchar(25) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Estado` enum('activo','inactivo') NOT NULL,
  `Rol` enum('propietario','arrendatario','guardia','administrador') NOT NULL,
  `TipoDocumento` varchar(10) NOT NULL,
  `NumDocumento` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `idVehiculo` int(11) NOT NULL,
  `PlacaVehiculo` varchar(6) NOT NULL,
  `MarcaVehiculo` varchar(15) DEFAULT NULL,
  `ModeloVehiculo` varchar(25) DEFAULT NULL,
  `idBahia` int(11) NOT NULL,
  `idResidente` int(10) UNSIGNED NOT NULL,
  `idVisitante` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitante`
--

CREATE TABLE `visitante` (
  `idVisitante` int(11) NOT NULL,
  `NombresVisitante` varchar(40) NOT NULL,
  `ApellidosVisitante` varchar(40) NOT NULL,
  `TipoDocumento` varchar(10) NOT NULL,
  `NumDocumento` int(11) NOT NULL,
  `idResidente` int(10) UNSIGNED NOT NULL,
  `idGuardia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonacomun`
--

CREATE TABLE `zonacomun` (
  `idZonaComun` int(11) NOT NULL,
  `TipoZona` varchar(25) NOT NULL,
  `EstadoZona` enum('Disponible','Ocupada') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alquilerzonascomunes`
--
ALTER TABLE `alquilerzonascomunes`
  ADD PRIMARY KEY (`idAlquilerZonaComun`),
  ADD KEY `fk_alquilerzonascomunes_zonacomun1_idx` (`idZonaComun`),
  ADD KEY `fk_AlquilerZonasComunes_Residentes1` (`idResidente`);

--
-- Indices de la tabla `apartamentos`
--
ALTER TABLE `apartamentos`
  ADD PRIMARY KEY (`idApartamentos`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `parqueadero`
--
ALTER TABLE `parqueadero`
  ADD PRIMARY KEY (`idBahia`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `quejas`
--
ALTER TABLE `quejas`
  ADD PRIMARY KEY (`idQueja`),
  ADD KEY `fk_Quejas_Residentes1` (`idResidente`);

--
-- Indices de la tabla `residentes`
--
ALTER TABLE `residentes`
  ADD PRIMARY KEY (`idResidente`),
  ADD KEY `fk_residentes_apartamentos` (`idApartamento`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `fk_usuario_conjunto1_idx` (`ConjuntoNombre`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`idVehiculo`),
  ADD KEY `fk_vehiculos_parqueadero1_idx` (`idBahia`),
  ADD KEY `fk_Vehiculos_Residentes1` (`idResidente`);

--
-- Indices de la tabla `visitante`
--
ALTER TABLE `visitante`
  ADD PRIMARY KEY (`idVisitante`),
  ADD KEY `fk_Visitante_Residentes1` (`idResidente`);

--
-- Indices de la tabla `zonacomun`
--
ALTER TABLE `zonacomun`
  ADD PRIMARY KEY (`idZonaComun`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `apartamentos`
--
ALTER TABLE `apartamentos`
  MODIFY `idApartamentos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `idVehiculo` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alquilerzonascomunes`
--
ALTER TABLE `alquilerzonascomunes`
  ADD CONSTRAINT `fk_AlquilerZonasComunes_Residentes1` FOREIGN KEY (`idResidente`) REFERENCES `residentes` (`idResidente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_AlquilerZonasComunes_ZonaComun1` FOREIGN KEY (`idZonaComun`) REFERENCES `zonacomun` (`idZonaComun`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `quejas`
--
ALTER TABLE `quejas`
  ADD CONSTRAINT `fk_Quejas_Residentes1` FOREIGN KEY (`idResidente`) REFERENCES `residentes` (`idResidente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `fk_Vehiculos_Parqueadero1` FOREIGN KEY (`idBahia`) REFERENCES `parqueadero` (`idBahia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Vehiculos_Residentes1` FOREIGN KEY (`idResidente`) REFERENCES `residentes` (`idResidente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `visitante`
--
ALTER TABLE `visitante`
  ADD CONSTRAINT `fk_Visitante_Residentes1` FOREIGN KEY (`idResidente`) REFERENCES `residentes` (`idResidente`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
