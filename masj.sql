-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-03-2025 a las 20:08:24
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
-- Base de datos: `masj`
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
  `idResidente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `alquilerzonascomunes`
--

INSERT INTO `alquilerzonascomunes` (`idAlquilerZonaComun`, `FechaAlquiler`, `CantidadPersonas`, `TotalPago`, `HoraLimite`, `idZonaComun`, `idResidente`) VALUES
(1, '2024-10-01', 5, 20000, '2024-10-01 22:00:00', 1, 1),
(2, '2024-10-02', 10, 30000, '2024-10-02 21:00:00', 2, 2),
(3, '2024-10-03', 15, 45000, '2024-10-03 23:00:00', 3, 5),
(4, '2024-10-04', 8, 25000, '2024-10-04 20:00:00', 4, 6),
(5, '2024-10-05', 12, 36000, '2024-10-05 22:30:00', 5, 7),
(6, '2024-10-06', 20, 60000, '2024-10-06 19:00:00', 1, 8),
(7, '2024-10-07', 25, 75000, '2024-10-07 20:30:00', 2, 9),
(8, '2024-10-08', 7, 21000, '2024-10-08 21:15:00', 3, 11),
(9, '2024-10-09', 30, 90000, '2024-10-09 22:00:00', 4, 12),
(10, '2024-10-10', 4, 12000, '2024-10-10 23:45:00', 5, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apartamentos`
--

CREATE TABLE `apartamentos` (
  `idApartamentos` int(11) NOT NULL,
  `torre` varchar(10) NOT NULL,
  `apto` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `apartamentos`
--

INSERT INTO `apartamentos` (`idApartamentos`, `torre`, `apto`) VALUES
(1, 'Torre 1', 'A1'),
(2, 'Torre 1', 'A2'),
(3, 'Torre 2', 'B1'),
(4, 'Torre 2', 'B2'),
(5, 'Torre 3', 'C1'),
(6, 'Torre 3', 'C2'),
(7, 'Torre 1', 'D1'),
(8, 'Torre 1', 'D2'),
(9, 'Torre 2', 'E1'),
(10, 'Torre 2', 'E2'),
(11, 'Torre 3', 'F1'),
(12, 'Torre 3', 'F2'),
(13, 'Torre 1', 'G1'),
(14, 'Torre 1', 'G2'),
(15, 'Torre 2', 'H1'),
(16, 'Torre 2', 'H2'),
(17, 'Torre 3', 'I1'),
(18, 'Torre 3', 'I2'),
(19, 'Torre 1', 'J1'),
(20, 'Torre 1', 'J2'),
(21, 'Torre 2', 'K1'),
(22, 'Torre 2', 'K2'),
(23, 'Torre 3', 'L1'),
(24, 'Torre 3', 'L2'),
(25, 'Torre 1', 'M1'),
(26, 'Torre 1', 'M2'),
(27, 'Torre 2', 'N1'),
(28, 'Torre 2', 'N2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parqueadero`
--

CREATE TABLE `parqueadero` (
  `idBahia` int(11) NOT NULL,
  `Novedad` text DEFAULT NULL,
  `Estado` enum('Ocupado','Desocupado') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `parqueadero`
--

INSERT INTO `parqueadero` (`idBahia`, `Novedad`, `Estado`) VALUES
(1, 'Ninguna', 'Ocupado'),
(2, 'Ninguna', 'Ocupado'),
(3, 'Ninguna', 'Desocupado'),
(4, 'Mantenimiento', 'Desocupado'),
(5, 'Ninguna', 'Ocupado'),
(6, 'Ninguna', 'Ocupado'),
(7, 'Ninguna', 'Ocupado'),
(8, 'Ninguna', 'Desocupado'),
(9, 'Ninguna', 'Ocupado'),
(10, 'Ninguna', 'Desocupado'),
(11, 'Ninguna', 'Ocupado'),
(12, 'Ninguna', 'Ocupado'),
(13, 'Ninguna', 'Ocupado'),
(14, 'Ninguna', 'Desocupado'),
(15, 'Ninguna', 'Ocupado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quejas`
--

CREATE TABLE `quejas` (
  `idQueja` int(11) NOT NULL,
  `FechaQueja` date NOT NULL,
  `MotivoQueja` text NOT NULL,
  `idResidente` int(11) NOT NULL,
  `EstadoQueja` tinyint(4) NOT NULL,
  `idAdministrador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `quejas`
--

INSERT INTO `quejas` (`idQueja`, `FechaQueja`, `MotivoQueja`, `idResidente`, `EstadoQueja`, `idAdministrador`) VALUES
(1, '2024-10-01', 'Ruidos molestos en la madrugada', 1, 0, 3),
(2, '2024-10-05', 'Falta de limpieza en ?reas comunes', 2, 1, 3),
(3, '2024-10-10', 'Problemas con el agua caliente', 32, 0, 3),
(4, '2024-10-15', 'Mal funcionamiento del ascensor', 15, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `residentes`
--

CREATE TABLE `residentes` (
  `idResidente` int(11) NOT NULL,
  `idApartamento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `residentes`
--

INSERT INTO `residentes` (`idResidente`, `idApartamento`) VALUES
(1, 1),
(2, 2),
(5, 3),
(6, 4),
(7, 5),
(8, 6),
(9, 7),
(11, 8),
(12, 9),
(13, 10),
(15, 11),
(16, 12),
(17, 13),
(18, 14),
(20, 15),
(21, 16),
(22, 17),
(23, 18),
(24, 19),
(25, 20),
(26, 21),
(27, 22),
(29, 23),
(30, 24),
(32, 25),
(33, 26),
(35, 27),
(36, 28);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `PrimerNombre` varchar(25) NOT NULL,
  `SegundoNombre` varchar(25) DEFAULT NULL,
  `PrimerApellido` varchar(25) NOT NULL,
  `SegundoApellido` varchar(30) DEFAULT NULL,
  `NumeroCelular` varchar(15) NOT NULL,
  `CorreoElectronico` varchar(40) NOT NULL,
  `Contrasena` varchar(64) NOT NULL,
  `ConjuntoNombre` varchar(25) NOT NULL,
  `FechaNacimiento` date NOT NULL,
  `Estado` enum('activo','inactivo') NOT NULL,
  `Rol` enum('propietario','arrendatario','guardia','administrador') NOT NULL,
  `TipoDocumento` varchar(10) NOT NULL,
  `NumDocumento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `PrimerNombre`, `SegundoNombre`, `PrimerApellido`, `SegundoApellido`, `NumeroCelular`, `CorreoElectronico`, `Contrasena`, `ConjuntoNombre`, `FechaNacimiento`, `Estado`, `Rol`, `TipoDocumento`, `NumDocumento`) VALUES
(1, 'Juan', 'Carlos', 'Pere', 'Gomez', '3216549870', 'juan@example.com', 'pass123', 'Conjunto Unico', '1985-03-15', 'activo', 'propietario', 'CC', 1234567890),
(2, 'Maria', 'Elena', 'Rodriguez', 'Lopez', '9876543210', 'maria@example.com', 'pass456', 'Conjunto Unico', '1990-05-20', 'activo', 'propietario', 'CC', 2147483647),
(3, 'Luis', '', 'Fernandez', 'Martinez', '1234567890', 'luis@example.com', 'pass789', 'Conjunto Unico', '1982-07-10', 'activo', 'administrador', 'CC', 2147483647),
(4, 'Ana', 'Maria', 'Torres', 'Hernandez', '4567890123', 'ana@example.com', 'pass101', 'Conjunto Unico', '1995-12-01', 'inactivo', 'administrador', 'CC', 2147483647),
(5, 'Carlos', 'Andres', 'Gomez', 'Perez', '6543217890', 'carlos@example.com', 'pass202', 'Conjunto Unico', '1987-01-12', 'activo', 'propietario', 'CC', 2147483647),
(6, 'Sofia', 'Isabel', 'Mendoza', 'Ramirez', '4561237890', 'sofia@example.com', 'pass303', 'Conjunto Unico', '1992-08-20', 'activo', 'propietario', 'CC', 2147483647),
(7, 'Javier', 'Alberto', 'Salazar', 'Hernandez', '3214569870', 'javier@example.com', 'pass404', 'Conjunto Unico', '1980-11-30', 'activo', 'arrendatario', 'CC', 2147483647),
(8, 'Gabriela', 'Fernandez', 'Bermudez', 'Ochoa', '7896541230', 'gabriela@example.com', 'pass505', 'Conjunto Unico', '1991-06-15', 'inactivo', 'propietario', 'CC', 2147483647),
(9, 'Daniel', 'David', 'Cano', 'Rincon', '4567893210', 'daniel@example.com', 'pass606', 'Conjunto Unico', '1984-09-04', 'activo', 'arrendatario', 'CC', 2147483647),
(10, 'Laura', 'Paola', 'Tellez', 'Martinez', '6549873210', 'laura@example.com', 'pass707', 'Conjunto Unico', '1993-02-22', 'inactivo', 'guardia', 'CC', 2147483647),
(11, 'Ricardo', '', 'Jimenez', 'Sanchez', '7893216540', 'ricardo@example.com', 'pass808', 'Conjunto Unico', '1989-12-14', 'activo', 'propietario', 'CC', 2147483647),
(12, 'Valentina', '', 'Castano', 'Cruz', '3219876540', 'valentina@example.com', 'pass909', 'Conjunto Unico', '1994-03-11', 'activo', 'arrendatario', 'CC', 2147483647),
(13, 'Francisco', '', 'Patino', 'Castillo', '6541237890', 'francisco@example.com', 'pass1010', 'Conjunto Unico', '1986-07-01', 'activo', 'arrendatario', 'CC', 2147483647),
(14, 'Isabella', '', 'Figueroa', 'Rivas', '7896543210', 'isabella@example.com', 'pass1111', 'Conjunto Unico', '1995-05-05', 'activo', 'guardia', 'CC', 2147483647),
(15, 'Fernando', '', 'Cordoba', 'Lopez', '1234567890', 'fernando@example.com', 'pass1212', 'Conjunto Unico', '1980-10-10', 'activo', 'propietario', 'CC', 2147483647),
(16, 'Mariana', 'Lucia', 'Ruiz', 'Duarte', '3213213210', 'mariana@example.com', 'pass1313', 'Conjunto Unico', '1987-01-21', 'activo', 'propietario', 'CC', 2147483647),
(17, 'Santiago', '', 'Bravo', 'Reyes', '4564564560', 'santiago@example.com', 'pass1414', 'Conjunto Unico', '1990-04-02', 'activo', 'propietario', 'CC', 2147483647),
(18, 'Camila', '', 'Cruz', 'Martinez', '6546546540', 'camila@example.com', 'pass1515', 'Conjunto Unico', '1983-06-20', 'activo', 'arrendatario', 'CC', 2147483647),
(19, 'Miguel', 'Antonio', 'Perez', 'Hernandez', '7897897890', 'miguel@example.com', 'pass1616', 'Conjunto Unico', '1988-08-18', 'inactivo', 'guardia', 'CC', 2147483647),
(20, 'Natalia', 'Valeria', 'Gomez', 'Perez', '3216547890', 'natalia@example.com', 'pass1717', 'Conjunto Unico', '1992-11-14', 'activo', 'propietario', 'CC', 2147483647),
(21, 'Leonardo', '', 'Quintero', 'Salazar', '4561237890', 'leonardo@example.com', 'pass1818', 'Conjunto Unico', '1985-01-10', 'activo', 'propietario', 'CC', 2147483647),
(22, 'Carolina', '', 'Martinez', 'Rincon', '7894561230', 'carolina@example.com', 'pass1919', 'Conjunto Unico', '1991-09-22', 'activo', 'propietario', 'CC', 2147483647),
(23, 'Oscar', 'Emilio', 'Cordoba', 'Garcia', '3213216540', 'oscar@example.com', 'pass2020', 'Conjunto Unico', '1984-03-30', 'inactivo', 'propietario', 'CC', 2147483647),
(24, 'Tania', '', 'Rios', 'Martinez', '4564563210', 'tania@example.com', 'pass2121', 'Conjunto Unico', '1987-07-05', 'activo', 'arrendatario', 'CC', 2147483647),
(25, 'Emilio', '', 'Cordoba', 'Hernandez', '7897896540', 'emilio@example.com', 'pass2222', 'Conjunto Unico', '1989-02-10', 'activo', 'propietario', 'CC', 2147483647),
(26, 'Maria', 'Fernanda', 'Lopez', 'Vega', '3216547891', 'mariaf@example.com', 'pass2323', 'Conjunto Unico', '1995-03-15', 'activo', 'arrendatario', 'CC', 1234567891),
(27, 'Cristian', '', 'Hernandez', 'Gomez', '6549873210', 'cristian@example.com', 'pass2424', 'Conjunto Unico', '1990-08-25', 'activo', 'arrendatario', 'CC', 2147483647),
(28, 'Evelyn', '', 'Perez', 'Ramirez', '3214569872', 'evelyn@example.com', 'pass2525', 'Conjunto Unico', '1988-05-12', 'activo', 'guardia', 'CC', 2147483647),
(29, 'Sebastian', '', 'Cano', 'Hernandez', '6541237891', 'sebastian@example.com', 'pass2626', 'Conjunto Unico', '1993-04-05', 'activo', 'arrendatario', 'CC', 2147483647),
(30, 'Nicolas', '', 'Bermudez', 'Perez', '7896543212', 'nicolas@example.com', 'pass2727', 'Conjunto Unico', '1982-11-20', 'activo', 'propietario', 'CC', 2147483647),
(31, 'Gina', 'Maria', 'Salazar', 'Sierra', '3211236540', 'gina@example.com', 'pass2828', 'Conjunto Unico', '1985-05-30', 'activo', 'guardia', 'CC', 2147483647),
(32, 'Alejandro', 'Gabriel', 'Cano', 'Pena', '6543211230', 'alejandro@example.com', 'pass2929', 'Conjunto Unico', '1991-02-19', 'activo', 'arrendatario', 'CC', 2147483647),
(33, 'Daniela', '', 'Hurtado', 'Quintero', '9871236540', 'daniela@example.com', 'pass3030', 'Conjunto Unico', '1994-09-05', 'activo', 'propietario', 'CC', 2147483647),
(34, 'Emilia', '', 'Gomez', 'Torres', '4567890120', 'emilia@example.com', 'pass3131', 'Conjunto Unico', '1987-03-15', 'inactivo', 'guardia', 'CC', 2147483647),
(35, 'Ignacio', '', 'Lara', 'Fernandez', '3216547892', 'ignacio@example.com', 'pass3232', 'Conjunto Unico', '1983-07-12', 'activo', 'arrendatario', 'CC', 2147483647),
(36, 'Marta', '', 'Bermudez', 'Salinas', '6549871230', 'marta@example.com', 'pass3333', 'Conjunto Unico', '1990-08-11', 'activo', 'propietario', 'CC', 2147483647),
(37, 'Rafael', '', 'Tellez', 'Martinez', '7893214560', 'rafael@example.com', 'pass3434', 'Conjunto Unico', '1995-04-20', 'activo', 'arrendatario', 'CC', 2147483647),
(38, 'Lucia', '', 'Ordonez', 'Cruz', '3219876543', 'lucia@example.com', 'pass3535', 'Conjunto Unico', '1989-11-25', 'activo', 'guardia', 'CC', 2147483647),
(39, 'Felipe', '', 'Jimenez', 'Lopez', '4561237893', 'felipe@example.com', 'pass3636', 'Conjunto Unico', '1988-06-30', 'inactivo', 'propietario', 'CC', 2147483647),
(40, 'Paola', '', 'Rincon', 'Guzman', '7894567893', 'paola@example.com', 'pass3737', 'Conjunto Unico', '1991-10-10', 'activo', 'arrendatario', 'CC', 2147483647);

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
  `idResidente` int(11) DEFAULT NULL,
  `idVisitante` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`idVehiculo`, `PlacaVehiculo`, `MarcaVehiculo`, `ModeloVehiculo`, `idBahia`, `idResidente`, `idVisitante`) VALUES
(1, 'ABC123', 'Toyota', 'Corolla', 1, 1, NULL),
(2, 'XYZ789', 'Honda', 'Civic', 2, 2, NULL),
(3, 'LMN456', 'Chevrolet', 'Sonic', 5, 5, NULL),
(4, 'OPQ012', 'Nissan', 'Versa', 6, 6, NULL),
(5, 'RST345', 'Ford', 'Focus', 7, 7, NULL),
(6, 'UVW678', 'Hyundai', 'Elantra', 9, 15, NULL),
(7, 'JKL901', 'Kia', 'Rio', 11, 24, NULL),
(8, 'MNO234', 'Mazda', '3', 12, 32, NULL),
(9, 'DEF567', 'Subaru', 'Impreza', 13, 21, NULL),
(10, 'GHI890', 'Volkswagen', 'Jetta', 15, 16, NULL),
(11, 'AAA123', 'Toyota', 'Corolla', 3, NULL, 5),
(12, 'BBB234', 'Honda', 'Civic', 2, NULL, 13),
(13, 'CCC345', 'Chevrolet', 'Sonic', 5, NULL, 10),
(14, 'DDD456', 'Nissan', 'Versa', 6, NULL, 2),
(15, 'EEE567', 'Ford', 'Focus', 7, NULL, 11),
(16, 'FFF678', 'Hyundai', 'Elantra', 9, NULL, 12),
(17, 'GGG789', 'Kia', 'Rio', 11, NULL, 10),
(18, 'HHH890', 'Mazda', '3', 12, NULL, 10),
(19, 'III901', 'Subaru', 'Impreza', 13, NULL, 8),
(20, 'JJJ012', 'Volkswagen', 'Jetta', 15, NULL, 1);

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
  `idResidente` int(11) NOT NULL,
  `idGuardia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `visitante`
--

INSERT INTO `visitante` (`idVisitante`, `NombresVisitante`, `ApellidosVisitante`, `TipoDocumento`, `NumDocumento`, `idResidente`, `idGuardia`) VALUES
(1, 'Carlos', 'Mora', 'CC', 789123456, 1, 14),
(2, 'Sof?a', 'L?pez', 'CC', 456789123, 2, 28),
(3, 'Pedro', 'P?rez', 'CC', 234567891, 1, 14),
(4, 'Luis', 'G?mez', 'CC', 345678912, 22, 28),
(5, 'Natalia', 'Rinc?n', 'CC', 123456789, 24, 14),
(6, 'Diego', 'Sanchez', 'CC', 987654321, 29, 31),
(7, 'Maria', 'Castillo', 'CC', 456123789, 30, 31),
(8, 'Andr?s', 'Torres', 'CC', 321789654, 36, 31),
(9, 'Laura', 'Duarte', 'CC', 654123789, 35, 31),
(10, 'Cristian', 'Garc?a', 'CC', 1234567890, 2, 34),
(11, 'Felipe', 'Jim?nez', 'CC', 2147483647, 6, 38),
(12, 'Gabriela', 'Salazar', 'CC', 2147483647, 9, 38),
(13, 'Isabel', 'Hern?ndez', 'CC', 2147483647, 12, 38),
(14, 'Valentina', 'Mendoza', 'CC', 2147483647, 12, 14),
(15, 'Juli?n', 'Mart?nez', 'CC', 2147483647, 30, 14),
(16, 'Fernando', 'Acu?a', 'CC', 2147483647, 17, 28),
(17, 'Santiago', 'Rivas', 'CC', 2147483647, 20, 28),
(18, 'Camila', 'Cruz', 'CC', 2147483647, 7, 28),
(19, 'Mar?a', 'Alvarado', 'CC', 2147483647, 36, 38),
(20, 'Emilio', 'Salazar', 'CC', 2147483647, 26, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `zonacomun`
--

CREATE TABLE `zonacomun` (
  `idZonaComun` int(11) NOT NULL,
  `TipoZona` varchar(25) NOT NULL,
  `EstadoZona` enum('Disponible','Ocupada') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `zonacomun`
--

INSERT INTO `zonacomun` (`idZonaComun`, `TipoZona`, `EstadoZona`) VALUES
(1, 'Piscina', 'Disponible'),
(2, 'Gimnasio', 'Ocupada'),
(3, 'Sal?n de Eventos', 'Disponible'),
(4, 'Zona Infantil', 'Ocupada'),
(5, 'Terraza', 'Disponible');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alquilerzonascomunes`
--
ALTER TABLE `alquilerzonascomunes`
  ADD PRIMARY KEY (`idAlquilerZonaComun`),
  ADD KEY `fk_AlquilerZonasComunes_ZonaComun1_idx` (`idZonaComun`),
  ADD KEY `fk_AlquilerZonasComunes_Residentes1_idx` (`idResidente`);

--
-- Indices de la tabla `apartamentos`
--
ALTER TABLE `apartamentos`
  ADD PRIMARY KEY (`idApartamentos`);

--
-- Indices de la tabla `parqueadero`
--
ALTER TABLE `parqueadero`
  ADD PRIMARY KEY (`idBahia`);

--
-- Indices de la tabla `quejas`
--
ALTER TABLE `quejas`
  ADD PRIMARY KEY (`idQueja`),
  ADD KEY `fk_Quejas_Residentes1_idx` (`idResidente`);

--
-- Indices de la tabla `residentes`
--
ALTER TABLE `residentes`
  ADD PRIMARY KEY (`idResidente`),
  ADD KEY `fk_Residentes_Apartamentos` (`idApartamento`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `fk_Usuario_Conjunto1_idx` (`ConjuntoNombre`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`idVehiculo`),
  ADD KEY `fk_Vehiculos_Parqueadero1_idx` (`idBahia`),
  ADD KEY `fk_Vehiculos_Residentes1_idx` (`idResidente`);

--
-- Indices de la tabla `visitante`
--
ALTER TABLE `visitante`
  ADD PRIMARY KEY (`idVisitante`),
  ADD KEY `fk_Visitante_Residentes1_idx` (`idResidente`);

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
  MODIFY `idApartamentos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `idVehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
-- Filtros para la tabla `residentes`
--
ALTER TABLE `residentes`
  ADD CONSTRAINT `fk_Residentes_Apartamentos` FOREIGN KEY (`idApartamento`) REFERENCES `apartamentos` (`idApartamentos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Residentes_Usuario` FOREIGN KEY (`idResidente`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
