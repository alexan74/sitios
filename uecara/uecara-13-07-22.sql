-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.26 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Volcando estructura para tabla uecara.afiliados
CREATE TABLE IF NOT EXISTS `afiliados` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nro_afiliado` int(6) unsigned DEFAULT NULL,
  `nomyape` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_nac` datetime DEFAULT NULL,
  `cuil` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `empresa_id` int(10) unsigned DEFAULT NULL,
  `tipo_empresa_id` int(10) unsigned DEFAULT NULL,
  `tipo_contratacion` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_ingreso_afiliado` datetime DEFAULT NULL,
  `fecha_baja_sindicato` datetime DEFAULT NULL,
  `telefono_empresa` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email_empresa` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `observaciones` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_ingreso_empresa` datetime DEFAULT NULL,
  `categoria_id` int(10) unsigned DEFAULT NULL,
  `retiro_carnet` tinyint(2) DEFAULT '0',
  `baja` tinyint(2) DEFAULT '0',
  `tramite_id` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tipo_empresa_id` (`tipo_empresa_id`),
  KEY `categoria_id` (`categoria_id`),
  KEY `empresa_id` (`empresa_id`),
  CONSTRAINT `FK_afiliados_categorias_empresa` FOREIGN KEY (`categoria_id`) REFERENCES `categorias_empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_afiliados_empresas` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_afiliados_tipos_empresa` FOREIGN KEY (`tipo_empresa_id`) REFERENCES `tipos_empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla uecara.afiliados: ~0 rows (aproximadamente)
INSERT INTO `afiliados` (`id`, `nro_afiliado`, `nomyape`, `fecha_nac`, `cuil`, `telefono`, `direccion`, `email`, `empresa_id`, `tipo_empresa_id`, `tipo_contratacion`, `fecha_ingreso_afiliado`, `fecha_baja_sindicato`, `telefono_empresa`, `email_empresa`, `observaciones`, `fecha_ingreso_empresa`, `categoria_id`, `retiro_carnet`, `baja`, `tramite_id`) VALUES
	(1, 435345, 'tetertreb r te', '1985-05-23 00:00:00', '43534534534', '3453534', 'fgdgsdfgs 4354', 'info@correo.com', 5, 1, 'temporario', '2022-06-09 00:00:00', '2022-06-14 00:00:00', '43534535', 'a@a.com', 'gfdhg hdgf', '2022-06-14 00:00:00', 1, 1, 1, 9);

-- Volcando estructura para tabla uecara.archivos
CREATE TABLE IF NOT EXISTS `archivos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ruta` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tramite_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tramite_id` (`tramite_id`),
  CONSTRAINT `FK_archivos_tramites` FOREIGN KEY (`tramite_id`) REFERENCES `tramites` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla uecara.archivos: ~16 rows (aproximadamente)
INSERT INTO `archivos` (`id`, `nombre`, `ruta`, `tramite_id`) VALUES
	(1, 'ctas bancos.txt', 'D:\\www\\federico\\uecara\\webroot\\uploads\\ctas bancos.txt', 1),
	(3, 'prueba.txt', 'D:\\www\\federico\\uecara\\webroot\\\\uploads\\prueba.txt', 1),
	(4, 'prueba(1).txt', 'D:\\www\\federico\\uecara\\webroot\\\\uploads\\prueba(1).txt', 1),
	(9, 'prueba(1).txt', 'D:\\www\\federico\\uecara\\webroot\\\\uploads\\prueba(1).txt', 2),
	(10, 'prueba.txt', 'D:\\www\\federico\\uecara\\webroot\\\\uploads\\prueba.txt', 2),
	(13, 'agenda.txt', 'D:\\www\\federico\\uecara\\webroot\\\\uploads\\agenda.txt', 1),
	(14, 'celulares.txt', 'D:\\www\\federico\\uecara\\webroot\\\\uploads\\celulares.txt', 2),
	(15, 'accesos sistemas.txt', 'D:\\www\\federico\\uecara\\webroot\\\\uploads\\accesos sistemas.txt', 2),
	(16, 'curso virtual.txt', 'D:\\www\\federico\\uecara\\webroot\\\\uploads\\curso virtual.txt', 2),
	(19, 'agenda.txt', 'D:\\www\\federico\\uecara\\webroot\\\\uploads\\agenda.txt', 4),
	(20, 'celulares.txt', 'D:\\www\\federico\\uecara\\webroot\\\\uploads\\celulares.txt', 4),
	(21, 'ecommerce html.txt', 'D:\\www\\federico\\uecara\\webroot\\\\uploads\\ecommerce html.txt', 5),
	(22, 'ctas bancos.txt', 'D:\\www\\federico\\uecara\\webroot\\\\uploads\\ctas bancos.txt', 6),
	(23, 'curso virtual.txt', 'D:\\www\\federico\\uecara\\webroot\\\\uploads\\curso virtual.txt', 6),
	(25, 'celulares.txt', 'D:\\www\\federico\\uecara\\webroot\\\\uploads\\celulares.txt', 8),
	(26, 'prueba(3).txt', 'D:\\www\\federico\\uecara\\webroot\\\\uploads\\prueba(3).txt', 9);

-- Volcando estructura para tabla uecara.categorias_empresa
CREATE TABLE IF NOT EXISTS `categorias_empresa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `observaciones` text COLLATE utf8_spanish_ci,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla uecara.categorias_empresa: ~28 rows (aproximadamente)
INSERT INTO `categorias_empresa` (`id`, `nombre`, `observaciones`, `activo`) VALUES
	(1, 'Categoria1', 'hghgfh', 1),
	(2, 'Categoria 2', 'fghgdhgdh', 1),
	(3, 'Grupo IV: Personal de Sistemas Informáticos', 'Para el area de Sistemas', 1),
	(4, 'Grupo III:Técnicos', 'Para el area técnica', 1),
	(5, 'Grupo I: Capataces de Obra', 'Para los Capataces de Obra', 1),
	(6, 'Grupo II Administrativos', 'Para los Administrativos', 1),
	(7, 'Grupo V: Personal de Maestranza', '1º Categoría\n2º Categoría', 1),
	(8, 'GRUPO I - CAPATACES DE OBRA - 1era Categoria. Capa', 'GRUPO I - CAPATACES DE OBRA - 1era Categoria. Capataz de Obra', 1),
	(9, 'GRUPO I - CAPATACES DE OBRA - 2da. Categoria. Capa', 'GRUPO I - CAPATACES DE OBRA - 2da. Categoria. Capataz de Tarea, Fase o Especialidad.', 0),
	(10, 'GRUPO I - CAPATACES DE OBRA - 2da. Categoria. Capa', 'GRUPO I - CAPATACES DE OBRA - 2da. Categoria. Capataz de Tarea, Fase o Especialidad.', 1),
	(11, 'GRUPO I - CAPATACES DE OBRA - 3ra.. Categoria: Cap', 'GRUPO I - CAPATACES DE OBRA - 3ra.. Categoria: Capataz de Segunda', 1),
	(12, 'GRUPO II - ADMINISTRATIVOS - 1ra.. Categoria: Anal', 'GRUPO II - ADMINISTRATIVOS - 1ra.. Categoria: Analista Administrativo', 1),
	(13, 'GRUPO II - ADMINISTRATIVOS - 2da.. Categoria: Auxiliar Administrativo', 'GRUPO II - ADMINISTRATIVOS - 2da.. Categoria: Auxiliar Administrativo', 1),
	(14, 'GRUPO II - ADMINISTRATIVOS - 3ra.. Categoria: Ayudante Administrativo', 'GRUPO II - ADMINISTRATIVOS - 3ra.. Categoria: Ayudante Administrativo', 0),
	(15, 'GRUPO II - ADMINISTRATIVOS - 3ra.. Categoria: Ayud', 'GRUPO II - ADMINISTRATIVOS - 3ra.. Categoria: Ayudante Administrativo', 1),
	(16, 'GRUPO II - ADMINISTRATIVOS - 4ta.. Categoria: Ayud', 'GRUPO II - ADMINISTRATIVOS - 4ta.. Categoria: Ayudante Administrativo de Segunda', 0),
	(17, 'GRUPO III - TECNICOS - 1ra.. Categoria: Analista T', 'GRUPO III - TECNICOS - 1ra.. Categoria: Analista Técnico', 1),
	(18, 'GRUPO II - ADMINISTRAIVOS - 3ra.. Categoria: Ayuda', 'GRUPO II - ADMINISTRAIVOS - 3ra.. Categoria: Ayudantes Administrativos', 1),
	(19, 'GRUPO II - ADMINISTRAIVOS - 4ta.. Categoria: Ayuda', 'GRUPO II - ADMINISTRAIVOS - 4ta.. Categoria: Ayudantes Administrativos de Segunda', 1),
	(20, 'GRUPO III - TECNICOS - 1ra.. Categoria: Analista T', 'GRUPO III - TECNICOS - 1ra.. Categoria: Analista Técnico', 1),
	(21, 'GRUPO III - TECNICOS - 2da... Categoria: Auxiliar ', 'GRUPO III - TECNICOS - 2da... Categoria: Auxiliar Técnico', 1),
	(22, 'GRUPO III - TECNICOS - 3ra... Categoria: Ayudante ', 'GRUPO III - TECNICOS - 3ra... Categoria: Ayudante Técnico', 1),
	(23, 'GRUPO III - TECNICOS - 4ta... Categoria: Ayudante ', 'GRUPO III - TECNICOS - 4ta... Categoria: Ayudante Técnico de Segunda', 1),
	(24, 'GRUPO IV - PERSONAL DE SISTEMAS INFORMATICOS - 1ra', 'GRUPO IV - PERSONAL DE SISTEMAS INFORMATICOS - 1ra... Categoria: Analista de Sistemas', 1),
	(25, 'GRUPO IV - PERSONAL DE SISTEMAS INFORMATICOS - 2da', 'GRUPO IV - PERSONAL DE SISTEMAS INFORMATICOS - 2da... Categoria: Técnico de Sistemas de 1ra.', 1),
	(26, 'GRUPO IV - PERSONAL DE SISTEMAS INFORMATICOS - 3ra', 'GRUPO IV - PERSONAL DE SISTEMAS INFORMATICOS - 3ra... Categoria: Técnico de Sistemas de 2da.', 1),
	(27, 'GRUPO V - PERSONAL DE MAESTRANZA, MANT y SERV. AUX', 'GRUPO V - PERSONAL DE MAESTRANZA, MANT y SERV. AUX -  1ra... Categoria: Maestranza de 1ra.', 1),
	(28, 'GRUPO V - PERSONAL DE MAESTRANZA, MANT y SERV. AUX', 'GRUPO V - PERSONAL DE MAESTRANZA, MANT y SERV. AUX -  2da... Categoria: Maestranza de 2da.', 1);

-- Volcando estructura para tabla uecara.empresas
CREATE TABLE IF NOT EXISTS `empresas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cuit` varchar(15) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(255) NOT NULL,
  `denom_social` varchar(255) NOT NULL,
  `calle` varchar(255) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `piso` varchar(20) DEFAULT NULL,
  `dpto` varchar(20) DEFAULT NULL,
  `barrio` varchar(255) DEFAULT NULL,
  `localidad` varchar(255) DEFAULT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `codpos` varchar(20) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tipo_empresa_id` int(10) unsigned DEFAULT NULL,
  `cant_sucurs` int(10) unsigned DEFAULT NULL,
  `total_emp` int(10) unsigned DEFAULT NULL,
  `observaciones` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_empresa_id` (`tipo_empresa_id`),
  CONSTRAINT `FK_empresas_tipos_empresa` FOREIGN KEY (`tipo_empresa_id`) REFERENCES `tipos_empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla uecara.empresas: ~4 rows (aproximadamente)
INSERT INTO `empresas` (`id`, `cuit`, `fecha`, `password`, `denom_social`, `calle`, `numero`, `piso`, `dpto`, `barrio`, `localidad`, `provincia`, `codpos`, `telefono`, `fax`, `email`, `tipo_empresa_id`, `cant_sucurs`, `total_emp`, `observaciones`) VALUES
	(5, '1111111111', '2022-06-13 00:22:57', '$2y$10$BjpreLGnJ.FBwRp1sHsnqOkpZYjtiqDcJ3gVOKtTCsB4O8WVrUhiW', 'empresa 1', 'calle', '1', '1', '1', 'palermo', 'caba', 'caba', '1000', '11111111111', '222222222', 'alexan_kid@hotmail.com', 1, 1, 1, NULL),
	(6, '222222222', '2022-06-13 23:46:59', '$2y$10$BjpreLGnJ.FBwRp1sHsnqOkpZYjtiqDcJ3gVOKtTCsB4O8WVrUhiW', 'dfhgdh', 'fdh', '324', '234', '234', 'fghdf', 'dfh', 'dfh', 'fdhdf', '34242', '32423', 'alexan74@gmail.com', 1, 1, 1, NULL),
	(10, '2323232323', '2022-06-21 20:40:04', '$2y$10$BjpreLGnJ.FBwRp1sHsnqOkpZYjtiqDcJ3gVOKtTCsB4O8WVrUhiW', 'empresa 2', 'nbm', '4353', '345', '345', 'vnc', 'bvcncv', 'cvncvn', '345', '345', '345', 'alexan_kid@hotmail.com', 1, 1, 2, 'observacion empresa 2'),
	(11, '0101010101', '2022-06-25 03:01:26', '$2y$10$p0fShBR.k7sSCe/n6pBfc.IuEvgBgec5MxBN5FdtKojWRSKnySs/S', 'otro', 'otro', '1', '11', '1', 'otro', 'otro', 'otro', '1111', '1111', '1111', 'alejandrogajate@yahoo.com', 1, 1, 1, NULL);

-- Volcando estructura para tabla uecara.nominas
CREATE TABLE IF NOT EXISTS `nominas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `apellido` varchar(50) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `cuota_sindical` tinyint(2) unsigned DEFAULT '0',
  `empresa_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `empresa_id` (`empresa_id`),
  CONSTRAINT `FK_nominas_empresas` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla uecara.nominas: ~7 rows (aproximadamente)
INSERT INTO `nominas` (`id`, `apellido`, `nombre`, `categoria`, `cuota_sindical`, `empresa_id`) VALUES
	(9, 'aaaaa', 'aaaa', 'Categoria1', 0, 5),
	(10, 'bbbb', 'bbbb', 'bbbb', 1, 5),
	(13, 'aaa', 'aaa', 'Categoria1', 1, 6),
	(19, 'aaa1', 'bbb1', '', 0, 10),
	(20, 'aaa2', 'bbb2', NULL, 1, 10),
	(21, 'otro1', 'otro1', 'Categoria1', 0, 11),
	(22, 'otro2', 'otro2', 'Categoria1', 1, 11);

-- Volcando estructura para tabla uecara.perfil
CREATE TABLE IF NOT EXISTS `perfil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_perfil` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nivel` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla uecara.perfil: ~3 rows (aproximadamente)
INSERT INTO `perfil` (`id`, `nombre_perfil`, `nivel`) VALUES
	(1, 'desarrollador', 1000),
	(2, 'admin', 999),
	(3, 'usuario', 998);

-- Volcando estructura para tabla uecara.phinxlog
CREATE TABLE IF NOT EXISTS `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla uecara.phinxlog: ~2 rows (aproximadamente)
INSERT INTO `phinxlog` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
	(20190320212001, 'CreatePerfil', '2022-06-04 01:04:17', '2022-06-04 01:04:18', 0),
	(20190320212002, 'CreateUsers', '2022-06-04 01:04:18', '2022-06-04 01:04:19', 0);

-- Volcando estructura para tabla uecara.tipos_empresa
CREATE TABLE IF NOT EXISTS `tipos_empresa` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `categoria_id` int(10) unsigned DEFAULT NULL,
  `subcategoria_id` int(10) unsigned DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`),
  KEY `subcategoria_id` (`subcategoria_id`),
  CONSTRAINT `FK_tipos_empresa_categorias_empresa` FOREIGN KEY (`categoria_id`) REFERENCES `categorias_empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_tipos_empresa_categorias_empresa_2` FOREIGN KEY (`subcategoria_id`) REFERENCES `categorias_empresa` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla uecara.tipos_empresa: ~0 rows (aproximadamente)
INSERT INTO `tipos_empresa` (`id`, `tipo`, `categoria_id`, `subcategoria_id`, `activo`) VALUES
	(1, 'Tipo1', 1, 1, 1);

-- Volcando estructura para tabla uecara.token
CREATE TABLE IF NOT EXISTS `token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `validez` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla uecara.token: ~0 rows (aproximadamente)
INSERT INTO `token` (`id`, `token`, `user_id`, `created`, `modified`, `validez`) VALUES
	(1, '5yW3lgcYcfmZJPjVF1MGonSw', 1, NULL, NULL, 1440);

-- Volcando estructura para tabla uecara.tramites
CREATE TABLE IF NOT EXISTS `tramites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `empresa_id` int(10) unsigned NOT NULL DEFAULT '0',
  `tipo_tramite` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `observaciones` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `empresa_id` (`empresa_id`),
  CONSTRAINT `FK_tramites_empresas` FOREIGN KEY (`empresa_id`) REFERENCES `empresas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla uecara.tramites: ~7 rows (aproximadamente)
INSERT INTO `tramites` (`id`, `empresa_id`, `tipo_tramite`, `observaciones`, `fecha`) VALUES
	(1, 10, 'Alta de empresa', NULL, NULL),
	(2, 5, 'Subida de Archivos', 'probando.......', '2022-06-24 22:25:21'),
	(4, 6, 'Subida de Archivos', 'prueba dfhgdh', '2022-06-25 02:22:11'),
	(5, 6, 'Modificacion de empresa', 'nuevo archivo mas', '2022-06-25 02:40:27'),
	(6, 11, 'Alta de empresa', 'otro', '2022-06-25 03:01:26'),
	(8, 5, 'Baja de Afiliado', 'prueba baja de afiliado', '2022-07-02 00:18:45'),
	(9, 5, 'Baja de Afiliado', 'probando baja de afiliado - empresa1', '2022-07-05 21:50:24');

-- Volcando estructura para tabla uecara.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  `perfil_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `perfil_id` (`perfil_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Volcando datos para la tabla uecara.users: ~1 rows (aproximadamente)
INSERT INTO `users` (`id`, `email`, `password`, `nombre`, `apellido`, `activo`, `perfil_id`, `created`, `modified`) VALUES
	(1, 'alexan_kid@hotmail.com', '$2y$10$gTuHTWJdczRp4jl10tmE9OS4YwVSdDbspydDcq8o5YEdc7vjwj/oi', 'alex', 'alex111', 1, 2, '2022-06-06 23:58:55', '2022-06-07 11:40:24');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
