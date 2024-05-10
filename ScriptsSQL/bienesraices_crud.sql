SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

CREATE DATABASE IF NOT EXISTS `bienesraices_crud` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bienesraices_crud`;

DROP TABLE IF EXISTS `propiedades`;
CREATE TABLE `propiedades` (
  `id` int(11) NOT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `descripcion` longtext DEFAULT NULL,
  `habitaciones` int(1) DEFAULT NULL,
  `wc` int(1) DEFAULT NULL,
  `estacionamiento` int(1) DEFAULT NULL,
  `creado` date DEFAULT NULL,
  `vendedorId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `propiedades` (`id`, `titulo`, `precio`, `imagen`, `descripcion`, `habitaciones`, `wc`, `estacionamiento`, `creado`, `vendedorId`) VALUES
(1, 'Casa en la playa', 1000000.00, '26f4950afc13a771df7bd9c354e02cb6.jpg', 'Una hermosa casa en la playa Una hermosa casa en la playa Una hermosa casa en la playa Una hermosa casa en la playa Una hermosa casa en la playa Una hermosa casa en la playa Una hermosa casa en la playa ', 4, 2, 1, '2024-04-19', 1),
(2, 'Casa en el bosque', 2500000.00, '8060d41dd3dd9f0b2efc4f98982f0034.jpg', 'Una hermosa casa en el bosque Una hermosa casa en el bosque Una hermosa casa en el bosque Una hermosa casa en el bosque Una hermosa casa en el bosque Una hermosa casa en el bosque Una hermosa casa en el bosque Una hermosa casa en el bosque Una hermosa casa en el bosque Una hermosa casa en el bosque Una hermosa casa en el bosque ', 6, 2, 2, '2024-04-19', 2),
(3, 'Casa en la isla', 5000000.00, 'f522807e32cbaa540eb454bc749af0c7.jpg', 'Esta casa queda en la isla más linda que haya visitado nunca Esta casa queda en la isla más linda que haya visitado nunca Esta casa queda en la isla más linda que haya visitado nunca Esta casa queda en la isla más linda que haya visitado nunca Esta casa queda en la isla más linda que haya visitado nunca Esta casa queda en la isla más linda que haya visitado nunca Esta casa queda en la isla más linda que haya visitado nunca ', 9, 4, 3, '2024-04-19', 1),
(4, 'cualquier cosa en realidad', 99999999.99, 'imagen.jpg', 'casa en el lago casa en el lago casa en el lago casa en el lago casa en el lago casa en el lago casa en el lago casa en el lago casa en el lago casa en el lago casa en el lago ', 3, 2, 1, '2024-04-19', 1),
(5, ' cualquier cosa en realidad', 99999999.99, 'imagen.jpg', 'casa en el lago casa en el lago casa en el lago casa en el lago casa en el lago casa en el lago casa en el lago casa en el lago casa en el lago casa en el lago casa en el lago ', 3, 2, 1, '2024-04-19', 1),
(6, ' cualquier cosa en realidad', 99999999.99, 'imagen.jpg', 'casa en el lago casa en el lago casa en el lago casa en el lago casa en el lago casa en el lago casa en el lago casa en el lago casa en el lago casa en el lago casa en el lago ', 3, 2, 1, '2024-04-19', 1),
(9, ' Hermosa casa en la playa ', 1234556.00, '54a420968c579b8cda3fffc93caf2841.jpg', 'Una hermosisisisisisima casaaaaaa Una hermosisisisisisima casaaaaaa Una hermosisisisisisima casaaaaaa Una hermosisisisisisima casaaaaaa Una hermosisisisisisima casaaaaaa Una hermosisisisisisima casaaaaaa Una hermosisisisisisima casaaaaaa Una hermosisisisisisima casaaaaaa Una hermosisisisisisima casaaaaaa ', 3, 2, 1, '2024-04-19', 1),
(10, ' creo que es una casa', 99999999.99, 'a7804097acc24b864f12d7aa8d93b986.jpg', 'creo que es una casa creo que es una casa creo que es una casa creo que es una casa creo que es una casa creo que es una casa creo que es una casa creo que es una casa creo que es una casa creo que es una casa creo que es una casa creo que es una casa creo que es una casa creo que es una casa creo que es una casa creo que es una casa ', 1, 2, 3, '2024-04-20', 1),
(11, ' prueba de creacion', 99999999.99, 'c5c66a3193c15795948e8fcd6d10bb22.jpg', 'Prueba de creacion Prueba de creacion Prueba de creacion Prueba de creacion Prueba de creacion Prueba de creacion Prueba de creacion Prueba de creacion Prueba de creacion Prueba de creacion Prueba de creacion Prueba de creacion `2`2', 2, 2, 2, '2024-04-20', 1);

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` char(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `usuarios` (`id`, `email`, `password`) VALUES
(1, 'correo@correo.com', '$2y$10$bf1DzBRmQzf7cQiLyDWDi.psp61N.DYqfzYt64zcswVfIxC2KN.p6');

DROP TABLE IF EXISTS `vendedores`;
CREATE TABLE `vendedores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `vendedores` (`id`, `nombre`, `apellido`, `telefono`) VALUES
(1, 'Julian', 'Penagos', '3166055323'),
(2, 'Karen', 'Perez', '3131313131');


ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_propiedades_vendedores_idx` (`vendedorId`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `propiedades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `vendedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `propiedades`
  ADD CONSTRAINT `fk_propiedades_vendedores` FOREIGN KEY (`vendedorId`) REFERENCES `vendedores` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
