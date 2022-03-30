/*
SQLyog Professional v12.5.1 (64 bit)
MySQL - 10.4.22-MariaDB : Database - reactivacion
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`reactivacion` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `reactivacion`;

/*Table structure for table `actividades` */

DROP TABLE IF EXISTS `actividades`;

CREATE TABLE `actividades` (
  `idactividad` int(11) NOT NULL AUTO_INCREMENT,
  `idespecialidad` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `descripcion` varchar(90) DEFAULT NULL,
  `direccion` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`idactividad`),
  CONSTRAINT `fk_actividades_idespecialidad` FOREIGN KEY (`idactividad`) REFERENCES `especialidades` (`idespecialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `actividades` */

insert  into `actividades`(`idactividad`,`idespecialidad`,`fecha`,`hora`,`titulo`,`descripcion`,`direccion`) values 
(1,1,'2022-03-25','08:45:00','Trabajo 1','Descripción opcional','Calle Ica N°58'),
(2,1,'2022-03-27','08:45:00','Trabajo 2','Descripción opcional','Calle Ica N°58');

/*Table structure for table `albunes` */

DROP TABLE IF EXISTS `albunes`;

CREATE TABLE `albunes` (
  `idalbum` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `nombrealbum` varchar(30) NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idalbum`),
  KEY `fk_albunes_idusuario` (`idusuario`),
  CONSTRAINT `fk_albunes_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `albunes` */

insert  into `albunes`(`idalbum`,`idusuario`,`nombrealbum`,`estado`) values 
(1,1,'Perfil',''),
(2,1,'Portada',''),
(3,1,'Publicaciones','');

/*Table structure for table `calificaciones` */

DROP TABLE IF EXISTS `calificaciones`;

CREATE TABLE `calificaciones` (
  `idcalificacion` int(11) NOT NULL AUTO_INCREMENT,
  `idtrabajo` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `puntuacion` tinyint(4) NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idcalificacion`),
  KEY `fk_calificaciones_idtrabajo` (`idtrabajo`),
  KEY `fk_calificaciones_idusuario` (`idusuario`),
  CONSTRAINT `fk_calificaciones_idtrabajo` FOREIGN KEY (`idtrabajo`) REFERENCES `trabajos` (`idtrabajo`),
  CONSTRAINT `fk_calificaciones_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `calificaciones` */

insert  into `calificaciones`(`idcalificacion`,`idtrabajo`,`idusuario`,`puntuacion`,`estado`) values 
(1,1,1,1,''),
(2,1,2,1,'');

/*Table structure for table `comentarios` */

DROP TABLE IF EXISTS `comentarios`;

CREATE TABLE `comentarios` (
  `idcomentario` int(11) NOT NULL AUTO_INCREMENT,
  `idtrabajo` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `comentario` mediumtext NOT NULL,
  `fechacomentado` datetime NOT NULL DEFAULT current_timestamp(),
  `fechamodificado` datetime DEFAULT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idcomentario`),
  KEY `fk_comentarios_idtrabajo` (`idtrabajo`),
  KEY `fk_comentarios_idusuario` (`idusuario`),
  CONSTRAINT `fk_comentarios_idtrabajo` FOREIGN KEY (`idtrabajo`) REFERENCES `trabajos` (`idtrabajo`),
  CONSTRAINT `fk_comentarios_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `comentarios` */

insert  into `comentarios`(`idcomentario`,`idtrabajo`,`idusuario`,`comentario`,`fechacomentado`,`fechamodificado`,`estado`) values 
(1,1,1,'Muy buen trabajo','2022-03-29 21:22:47',NULL,''),
(2,1,2,'Pesimo trabajo','2022-03-29 21:22:47',NULL,'');

/*Table structure for table `empresas` */

DROP TABLE IF EXISTS `empresas`;

CREATE TABLE `empresas` (
  `idempresa` int(11) NOT NULL AUTO_INCREMENT,
  `establecimiento` varchar(30) NOT NULL,
  `ruc` char(11) NOT NULL,
  `ubicacion` varchar(70) NOT NULL,
  `referencia` varchar(70) DEFAULT NULL,
  `latitud` float(10,8) NOT NULL,
  `longitud` float(10,8) NOT NULL,
  PRIMARY KEY (`idempresa`),
  UNIQUE KEY `uk_empresas_ruc` (`ruc`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `empresas` */

insert  into `empresas`(`idempresa`,`establecimiento`,`ruc`,`ubicacion`,`referencia`,`latitud`,`longitud`) values 
(1,'Mecanina pilon motors','12452585696','Calle molina N°25','Pasando la segunda cuadra',-12.06710052,-77.03235626),
(2,'Electricista ZORNOMAZ','12452585626','Urb. Leon de Vivero MZ:13 LT:16 Pueblo Nuevo, 11701','Antes de ',-12.06710052,-77.03235626),
(3,'ABOGADOS CHINCHA','12452582696','C. Lima, Chincha Alta 11702','',-12.06720066,-77.03835297),
(4,'Soldadura ferrrer','12452565696','Chincha baja Litardoo, baja','',-12.08560085,-77.03235626),
(5,'NADIRA Centro Masoterapista','12452580696','15725 ROMA Municipalidad Metropolitana de Lima LIMA, 01','',-12.09560108,-77.03235626);

/*Table structure for table `especialidades` */

DROP TABLE IF EXISTS `especialidades`;

CREATE TABLE `especialidades` (
  `idespecialidad` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `idservicio` int(11) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  PRIMARY KEY (`idespecialidad`),
  KEY `fk_especialidades_idusuario` (`idusuario`),
  KEY `fk_especialidades_idservicio` (`idservicio`),
  CONSTRAINT `fk_especialidades_idservicio` FOREIGN KEY (`idservicio`) REFERENCES `servicios` (`idservicio`),
  CONSTRAINT `fk_especialidades_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `especialidades` */

insert  into `especialidades`(`idespecialidad`,`idusuario`,`idservicio`,`descripcion`) values 
(1,1,1,'Cálculo de secciones de líneas eléctricas'),
(2,1,1,'Electrotecnia'),
(3,1,1,'Riesgo eléctrico'),
(4,1,1,'Tensión eléctrica');

/*Table structure for table `galerias` */

DROP TABLE IF EXISTS `galerias`;

CREATE TABLE `galerias` (
  `idgaleria` int(11) NOT NULL AUTO_INCREMENT,
  `idalbum` int(11) NOT NULL,
  `idtrabajo` int(11) DEFAULT NULL,
  `tipo` char(1) NOT NULL DEFAULT 'F',
  `titulo` varchar(45) NOT NULL,
  `archivo` varchar(100) NOT NULL,
  `fechaalta` datetime NOT NULL DEFAULT current_timestamp(),
  `fechabaja` datetime DEFAULT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idgaleria`),
  KEY `fk_galerias_idalbum` (`idalbum`),
  KEY `fk_galerias_idtrabajo` (`idtrabajo`),
  CONSTRAINT `fk_galerias_idalbum` FOREIGN KEY (`idalbum`) REFERENCES `albunes` (`idalbum`),
  CONSTRAINT `fk_galerias_idtrabajo` FOREIGN KEY (`idtrabajo`) REFERENCES `trabajos` (`idtrabajo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `galerias` */

insert  into `galerias`(`idgaleria`,`idalbum`,`idtrabajo`,`tipo`,`titulo`,`archivo`,`fechaalta`,`fechabaja`,`estado`) values 
(1,1,NULL,'F','Foto de electricista','012555454545448599','2022-03-29 21:20:26',NULL,''),
(2,3,1,'V','Video de electricista','012555454545447852','2022-03-29 21:20:26',NULL,'');

/*Table structure for table `personas` */

DROP TABLE IF EXISTS `personas`;

CREATE TABLE `personas` (
  `idpersona` int(11) NOT NULL AUTO_INCREMENT,
  `apellidos` varchar(40) NOT NULL,
  `nombres` varchar(40) NOT NULL,
  `fechanac` date NOT NULL,
  `telefono` char(11) DEFAULT NULL,
  `tipocalle` char(2) NOT NULL,
  `nombrecalle` varchar(60) NOT NULL,
  `numerocalle` varchar(5) NOT NULL,
  `pisodepa` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `personas` */

insert  into `personas`(`idpersona`,`apellidos`,`nombres`,`fechanac`,`telefono`,`tipocalle`,`nombrecalle`,`numerocalle`,`pisodepa`) values 
(1,'Magallanes Perez','Luis Enrique','1998-05-25','05695674856','AV','Las palmeras','25','5'),
(2,'Hernandez Monterroza','Adriana Carolina','1999-05-14','05695674858','CA','Los Sauces','150','3'),
(3,'Carvajal Vargas','Alexander','1999-05-14','05695674558','JR','Las Lomas','5','2'),
(4,'Blanca Concha','Angelica Maria','1999-05-14','05695604858','PJ','Cartajena','250','3'),
(5,'Ospina Alfonso','Catherine','1999-05-14','05695674858','AV','Prada N°258','255','2');

/*Table structure for table `redessociales` */

DROP TABLE IF EXISTS `redessociales`;

CREATE TABLE `redessociales` (
  `idredsocial` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `redsocial` char(1) NOT NULL,
  `vinculo` mediumtext NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idredsocial`),
  KEY `fk_redessociales_idusuario` (`idusuario`),
  CONSTRAINT `fk_redessociales_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `redessociales` */

insert  into `redessociales`(`idredsocial`,`idusuario`,`redsocial`,`vinculo`,`estado`) values 
(1,1,'I','https://www.instagram.com/?hl=es-la/usuario/luis%enrique',''),
(2,1,'F','https://web.facebook.com/?_rdc=1&_rdr/usuario/login','');

/*Table structure for table `reportes` */

DROP TABLE IF EXISTS `reportes`;

CREATE TABLE `reportes` (
  `idreporte` int(11) NOT NULL AUTO_INCREMENT,
  `idcomentario` int(11) NOT NULL,
  `motivo` varchar(30) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `fotografia` varchar(100) DEFAULT NULL,
  `fechareporte` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idreporte`),
  KEY `fk_reportes_idcomentario` (`idcomentario`),
  CONSTRAINT `fk_reportes_idcomentario` FOREIGN KEY (`idcomentario`) REFERENCES `comentarios` (`idcomentario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `reportes` */

insert  into `reportes`(`idreporte`,`idcomentario`,`motivo`,`descripcion`,`fotografia`,`fechareporte`) values 
(1,2,'Mesaje indebido','Mala calificación del trabajo','011555555959258','2022-03-29 21:23:31');

/*Table structure for table `seguidores` */

DROP TABLE IF EXISTS `seguidores`;

CREATE TABLE `seguidores` (
  `idseguidor` int(11) NOT NULL AUTO_INCREMENT,
  `idfollowing` int(11) NOT NULL,
  `idfollower` int(11) NOT NULL,
  `fechafollower` datetime NOT NULL DEFAULT current_timestamp(),
  `fechabaja` datetime DEFAULT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idseguidor`),
  UNIQUE KEY `uk_seguidores_idfollower` (`idfollowing`,`idfollower`),
  KEY `fk_seguidores_idfollower` (`idfollower`),
  CONSTRAINT `fk_seguidores_idfollower` FOREIGN KEY (`idfollower`) REFERENCES `usuarios` (`idusuario`),
  CONSTRAINT `fk_seguidores_idfollowing` FOREIGN KEY (`idfollowing`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `seguidores` */

insert  into `seguidores`(`idseguidor`,`idfollowing`,`idfollower`,`fechafollower`,`fechabaja`,`estado`) values 
(1,1,2,'2022-03-29 21:06:59',NULL,''),
(2,1,3,'2022-03-29 21:06:59',NULL,'');

/*Table structure for table `servicios` */

DROP TABLE IF EXISTS `servicios`;

CREATE TABLE `servicios` (
  `idservicio` int(11) NOT NULL AUTO_INCREMENT,
  `nombreservicio` varchar(50) NOT NULL,
  PRIMARY KEY (`idservicio`),
  UNIQUE KEY `uk_servicios_nombreservicio` (`nombreservicio`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `servicios` */

insert  into `servicios`(`idservicio`,`nombreservicio`) values 
(3,'Carpintero'),
(4,'Diseñador'),
(1,'Electricista'),
(5,'Programador'),
(2,'Soldador');

/*Table structure for table `trabajos` */

DROP TABLE IF EXISTS `trabajos`;

CREATE TABLE `trabajos` (
  `idtrabajo` int(11) NOT NULL AUTO_INCREMENT,
  `idespecialidad` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `titulo` varchar(40) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `fechapublicado` datetime NOT NULL DEFAULT current_timestamp(),
  `fechamodificado` datetime DEFAULT NULL,
  `fechaeliminado` datetime DEFAULT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idtrabajo`),
  KEY `fk_trabajos_idespecialidad` (`idespecialidad`),
  KEY `fk_trabajos_idusuario` (`idusuario`),
  CONSTRAINT `fk_trabajos_idespecialidad` FOREIGN KEY (`idespecialidad`) REFERENCES `especialidades` (`idespecialidad`),
  CONSTRAINT `fk_trabajos_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `trabajos` */

insert  into `trabajos`(`idtrabajo`,`idespecialidad`,`idusuario`,`titulo`,`descripcion`,`fechapublicado`,`fechamodificado`,`fechaeliminado`,`estado`) values 
(1,1,1,'Servicio de electricista','Trabajo realizado en etc..','2022-03-29 21:11:27',NULL,NULL,''),
(2,2,1,'Electrista de cableado','Trabajo realizado en ..','2022-03-29 21:11:27',NULL,NULL,'');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `idpersona` int(11) NOT NULL,
  `idempresa` int(11) DEFAULT NULL,
  `descripcion` mediumtext DEFAULT NULL,
  `horarioatencion` varchar(50) NOT NULL,
  `nivelusuario` char(1) NOT NULL,
  `rol` char(1) NOT NULL DEFAULT 'U',
  `email` varchar(70) NOT NULL,
  `emailrespaldo` varchar(70) DEFAULT NULL,
  `clave` varchar(80) NOT NULL,
  `fechaalta` datetime NOT NULL DEFAULT current_timestamp(),
  `fechabaja` datetime DEFAULT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `uk_usuarios_email` (`email`),
  UNIQUE KEY `uk_usuarios_emailrespaldo` (`emailrespaldo`),
  KEY `fk_usuarios_idpersona` (`idpersona`),
  KEY `fk_usuarios_idempresa` (`idempresa`),
  CONSTRAINT `fk_usuarios_idempresa` FOREIGN KEY (`idempresa`) REFERENCES `empresas` (`idempresa`),
  CONSTRAINT `fk_usuarios_idpersona` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `usuarios` */

insert  into `usuarios`(`idusuario`,`idpersona`,`idempresa`,`descripcion`,`horarioatencion`,`nivelusuario`,`rol`,`email`,`emailrespaldo`,`clave`,`fechaalta`,`fechabaja`,`estado`) values 
(1,1,NULL,'descripción','Atención de Lunes a Sabado de 08:00 AM a 09:00 PM','','U','Luis@gmail.com',NULL,'12345','2022-03-29 21:05:07',NULL,''),
(2,2,NULL,'descipción','Atención de Lunes a Sabado de 08:00 AM a 09:00 PM','','U','Adriana@gmail.com',NULL,'12345','2022-03-29 21:05:07',NULL,''),
(3,3,1,'Uno de sus profesores en la Universidad de Pensilvania era director ejecutivo de una empresa en Los Gatos, Silicon Valley, dedicada a investigar ultracondensadores electrolíticos destinados a vehículos eléctricos. Elon Musk trabajó un verano en la empresa Pinnacle Research. Esos ultracondensadores tenían una densidad energética muy alta, pero sus componentes químicos eran carísimos y se vendían por miligramos porque había muy pocas minas que los extrajeran. No eran escalables para su producción en masa.11','Atención de Lunes a Viernes de 08:00 AM a 09:00 PM','','U','Alenxander@gmail.com',NULL,'12345','2022-03-29 21:05:07',NULL,'');

/* Procedure structure for procedure `spu_albunes_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_albunes_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_albunes_eliminar`(in _idalbum int)
BEGIN
	update albunes set 
		estado = 0
	where idalbum = _idalbum;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_albunes_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_albunes_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_albunes_listar`()
BEGIN
	select * from albunes;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_albunes_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_albunes_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_albunes_modificar`(
	in _idalbum			int,
	IN _idusuario 	INT,
	IN _nombrealbum VARCHAR(30)
)
BEGIN
	update albunes set 
		idusuario	 	= _idusuario,
		nombrealbum = _nombrealbum
	where idalbum = _idalbum;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_albunes_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_albunes_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_albunes_registrar`(
	in _idusuario 	int,
	in _nombrealbum varchar(30)
)
BEGIN
	insert into albunes (idusuario, nombrealbum) values
		(_idusuario, _nombrealbum);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_galerias_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_galerias_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_galerias_eliminar`(in _idgaleria int)
BEGIN
	UPDATE galerias SET estado = 0
		WHERE idgaleria = _idgaleria;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_galerias_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_galerias_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_galerias_listar`()
BEGIN
	select * from vs_galerias_listar;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_galerias_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_galerias_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_galerias_modificar`(
	in _idgaleria int,
	IN _idalbum 	INT,
	IN _idtrabajo INT,
	IN _tipo 			CHAR(1),
	IN _titulo 		VARCHAR(45),
	IN _archivo 	VARCHAR(100)
)
BEGIN
	update galerias set
		idalbum 	= _idalbum,
		idtrabajo = _idtrabajo,
		tipo 			= _tipo,
		titulo 		= _titulo,
		archivo 	= _archivo
	where idgaleria = _idgaleria;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_galerias_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_galerias_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_galerias_registrar`(
	in _idalbum 	int,
	in _idtrabajo int,
	in _tipo 			char(1),
	in _titulo 		varchar(45),
	in _archivo 	varchar(100)
)
BEGIN
	if _idtrabajo = '' then set _idtrabajo = null; end if;
	
	insert into galerias (idalbum, idtrabajo, tipo, titulo, archivo) values
		(_idalbum, _idtrabajo, _tipo, _titulo, _archivo);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuarios_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuarios_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_eliminar`(in _idusuario int)
BEGIN
	update usuarios set estado = 0 
		where idusuario = _idusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuarios_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuarios_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_listar`()
BEGIN
	SELECT * FROM vs_usuarios_listar
		ORDER BY idusuario DESC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuarios_login` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuarios_login` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_login`(in _email varchar(70))
BEGIN
	select * from vs_usuarios_listar
		where email = _email;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuarios_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuarios_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_modificar`(
	in _idusuario 			int,
	IN _idpersona 			INT,
	IN _idempresa 			INT,
	IN _descripcion 		MEDIUMTEXT,
	IN _horarioatencion VARCHAR(50),
	IN _nivelusuario 		CHAR(1),
	IN _rol 						CHAR(1),
	IN _email 					VARCHAR(70),
	IN _emailrespaldo		VARCHAR(70),
	IN _clave	 					VARCHAR(80)
)
BEGIN
	update usuarios set 
		idpersona 			= _idpersona,
		idempresa 			= _idempresa,
		descripcion 		= _descripcion,
		horarioatencion = _horarioatencion,
		nivelusuario 		= _nivelusuario,
		rol 						= _rol,
		email 					= _email,
		emailrespaldo 	= _emailrespaldo,
		clave 					= _clave
	where idusuario = _idusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuario_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuario_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuario_registrar`(
	in _idpersona 			int,
	in _idempresa 			int,
	in _descripcion 		mediumtext,
	in _horarioatencion varchar(50),
	in _nivelusuario 		char(1),
	in _rol 						char(1),
	in _email 					varchar(70),
	IN _emailrespaldo		VARCHAR(70),
	in _clave	 					varchar(80)
)
begin
	IF _idempresa = '' or _idempresa < 1 then set _idempresa = null; end if;
	IF _descripcion = '' THEN SET _descripcion = NULL; END IF;
	IF _emailrespaldo = '' THEN SET _emailrespaldo = NULL; END IF;

	INSERT INTO usuarios (idpersona, idempresa, descripcion, horarioatencion, nivelusuario, rol, email, emailrespaldo, clave) VALUES 
		(_idpersona, _idempresa, _descripcion, _horarioatencion, _nivelusuario, _rol, _email, _emailrespaldo, _clave);
end */$$
DELIMITER ;

/*Table structure for table `vs_galerias_listar` */

DROP TABLE IF EXISTS `vs_galerias_listar`;

/*!50001 DROP VIEW IF EXISTS `vs_galerias_listar` */;
/*!50001 DROP TABLE IF EXISTS `vs_galerias_listar` */;

/*!50001 CREATE TABLE  `vs_galerias_listar`(
 `idgaleria` int(11) ,
 `nombrealbum` varchar(30) ,
 `idtrabajo` int(11) ,
 `tipo` char(1) ,
 `titulo` varchar(45) ,
 `archivo` varchar(100) ,
 `fechaalta` datetime 
)*/;

/*Table structure for table `vs_usuarios_listar` */

DROP TABLE IF EXISTS `vs_usuarios_listar`;

/*!50001 DROP VIEW IF EXISTS `vs_usuarios_listar` */;
/*!50001 DROP TABLE IF EXISTS `vs_usuarios_listar` */;

/*!50001 CREATE TABLE  `vs_usuarios_listar`(
 `idusuario` int(11) ,
 `apellidos` varchar(40) ,
 `nombres` varchar(40) ,
 `direccion` varchar(76) ,
 `descripcion` mediumtext ,
 `horarioatencion` varchar(50) ,
 `nivelusuario` char(1) ,
 `rol` char(1) ,
 `email` varchar(70) ,
 `emailrespaldo` varchar(70) ,
 `clave` varchar(80) ,
 `establecimiento` varchar(30) ,
 `ruc` char(11) ,
 `ubicacion` varchar(70) ,
 `referencia` varchar(70) ,
 `latitud` float(10,8) ,
 `longitud` float(10,8) 
)*/;

/*View structure for view vs_galerias_listar */

/*!50001 DROP TABLE IF EXISTS `vs_galerias_listar` */;
/*!50001 DROP VIEW IF EXISTS `vs_galerias_listar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vs_galerias_listar` AS select `glr`.`idgaleria` AS `idgaleria`,`alb`.`nombrealbum` AS `nombrealbum`,`glr`.`idtrabajo` AS `idtrabajo`,`glr`.`tipo` AS `tipo`,`glr`.`titulo` AS `titulo`,`glr`.`archivo` AS `archivo`,`glr`.`fechaalta` AS `fechaalta` from (`galerias` `glr` join `albunes` `alb` on(`alb`.`idalbum` = `glr`.`idalbum`)) where `glr`.`estado` = 1 */;

/*View structure for view vs_usuarios_listar */

/*!50001 DROP TABLE IF EXISTS `vs_usuarios_listar` */;
/*!50001 DROP VIEW IF EXISTS `vs_usuarios_listar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vs_usuarios_listar` AS select `usu`.`idusuario` AS `idusuario`,`prs`.`apellidos` AS `apellidos`,`prs`.`nombres` AS `nombres`,concat(`prs`.`tipocalle`,' ',`prs`.`nombrecalle`,' #',`prs`.`numerocalle`,' ',`prs`.`pisodepa`) AS `direccion`,`usu`.`descripcion` AS `descripcion`,`usu`.`horarioatencion` AS `horarioatencion`,`usu`.`nivelusuario` AS `nivelusuario`,`usu`.`rol` AS `rol`,`usu`.`email` AS `email`,`usu`.`emailrespaldo` AS `emailrespaldo`,`usu`.`clave` AS `clave`,`emp`.`establecimiento` AS `establecimiento`,`emp`.`ruc` AS `ruc`,`emp`.`ubicacion` AS `ubicacion`,`emp`.`referencia` AS `referencia`,`emp`.`latitud` AS `latitud`,`emp`.`longitud` AS `longitud` from ((`usuarios` `usu` join `personas` `prs` on(`prs`.`idpersona` = `usu`.`idpersona`)) left join `empresas` `emp` on(`emp`.`idempresa` = `usu`.`idempresa`)) where `usu`.`estado` = 1 */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
