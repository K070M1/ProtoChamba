/*
SQLyog Professional v12.5.1 (64 bit)
MySQL - 10.4.24-MariaDB : Database - reactivacion
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
  `descripcion` varchar(150) DEFAULT NULL,
  `direccion` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`idactividad`),
  CONSTRAINT `fk_act_idespecialidad` FOREIGN KEY (`idactividad`) REFERENCES `especialidades` (`idespecialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `actividades` */

insert  into `actividades`(`idactividad`,`idespecialidad`,`fecha`,`hora`,`titulo`,`descripcion`,`direccion`) values 
(1,1,'2022-03-25','08:45:00','Trabajo 1','Descripción opcional','Calle Ica N°58'),
(2,1,'2022-03-27','08:45:00','Trabajo 2','Descripción opcional','Calle Ica N°58');

/*Table structure for table `albumes` */

DROP TABLE IF EXISTS `albumes`;

CREATE TABLE `albumes` (
  `idalbum` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `nombrealbum` varchar(30) NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idalbum`),
  UNIQUE KEY `uk_alb_nombrealbum` (`idusuario`,`nombrealbum`),
  CONSTRAINT `fk_alb_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `albumes` */

insert  into `albumes`(`idalbum`,`idusuario`,`nombrealbum`,`estado`) values 
(1,1,'Perfil',''),
(2,1,'Portada',''),
(3,1,'Publicaciones',''),
(7,2,'Perfil','');

/*Table structure for table `calificaciones` */

DROP TABLE IF EXISTS `calificaciones`;

CREATE TABLE `calificaciones` (
  `idcalificacion` int(11) NOT NULL AUTO_INCREMENT,
  `idtrabajo` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `puntuacion` tinyint(4) NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idcalificacion`),
  KEY `fk_cal_idtrabajo` (`idtrabajo`),
  KEY `fk_cal_idusuario` (`idusuario`),
  CONSTRAINT `fk_cal_idtrabajo` FOREIGN KEY (`idtrabajo`) REFERENCES `trabajos` (`idtrabajo`),
  CONSTRAINT `fk_cal_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `calificaciones` */

insert  into `calificaciones`(`idcalificacion`,`idtrabajo`,`idusuario`,`puntuacion`,`estado`) values 
(1,1,1,1,''),
(2,1,2,1,''),
(3,1,2,4,'');

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
  KEY `fk_com_idtrabajo` (`idtrabajo`),
  KEY `fk_com_idusuario` (`idusuario`),
  CONSTRAINT `fk_com_idtrabajo` FOREIGN KEY (`idtrabajo`) REFERENCES `trabajos` (`idtrabajo`),
  CONSTRAINT `fk_com_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `comentarios` */

insert  into `comentarios`(`idcomentario`,`idtrabajo`,`idusuario`,`comentario`,`fechacomentado`,`fechamodificado`,`estado`) values 
(1,1,1,'Muy buen trabajo','2022-04-02 18:18:20',NULL,''),
(2,1,2,'Pesimo trabajo','2022-04-02 18:18:20',NULL,'');

/*Table structure for table `departamentos` */

DROP TABLE IF EXISTS `departamentos`;

CREATE TABLE `departamentos` (
  `iddepartamento` varchar(2) NOT NULL,
  `departamento` varchar(45) NOT NULL,
  PRIMARY KEY (`iddepartamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `departamentos` */

insert  into `departamentos`(`iddepartamento`,`departamento`) values 
('01','Amazonas'),
('02','Áncash'),
('03','Apurímac'),
('04','Arequipa'),
('05','Ayacucho'),
('06','Cajamarca'),
('07','Callao'),
('08','Cusco'),
('09','Huancavelica'),
('10','Huánuco'),
('11','Ica'),
('12','Junín'),
('13','La Libertad'),
('14','Lambayeque'),
('15','Lima'),
('16','Loreto'),
('17','Madre de Dios'),
('18','Moquegua'),
('19','Pasco'),
('20','Piura'),
('21','Puno'),
('22','San Martín'),
('23','Tacna'),
('24','Tumbes'),
('25','Ucayali');

/*Table structure for table `distritos` */

DROP TABLE IF EXISTS `distritos`;

CREATE TABLE `distritos` (
  `iddistrito` varchar(6) NOT NULL,
  `distrito` varchar(45) DEFAULT NULL,
  `idprovincia` varchar(4) DEFAULT NULL,
  `iddepartamento` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`iddistrito`),
  KEY `fk_idprovincia_dis` (`idprovincia`),
  KEY `fk_iddepartamento_dis` (`iddepartamento`),
  CONSTRAINT `fk_iddepartamento_dis` FOREIGN KEY (`iddepartamento`) REFERENCES `departamentos` (`iddepartamento`),
  CONSTRAINT `fk_idprovincia_dis` FOREIGN KEY (`idprovincia`) REFERENCES `provincias` (`idprovincia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `distritos` */

insert  into `distritos`(`iddistrito`,`distrito`,`idprovincia`,`iddepartamento`) values 
('010101','Chachapoyas','0101','01'),
('010102','Asunción','0101','01'),
('010103','Balsas','0101','01'),
('010104','Cheto','0101','01'),
('010105','Chiliquin','0101','01'),
('010106','Chuquibamba','0101','01'),
('010107','Granada','0101','01'),
('010108','Huancas','0101','01'),
('010109','La Jalca','0101','01'),
('010110','Leimebamba','0101','01'),
('010111','Levanto','0101','01'),
('010112','Magdalena','0101','01'),
('010113','Mariscal Castilla','0101','01'),
('010114','Molinopampa','0101','01'),
('010115','Montevideo','0101','01'),
('010116','Olleros','0101','01'),
('010117','Quinjalca','0101','01'),
('010118','San Francisco de Daguas','0101','01'),
('010119','San Isidro de Maino','0101','01'),
('010120','Soloco','0101','01'),
('010121','Sonche','0101','01'),
('010201','Bagua','0102','01'),
('010202','Aramango','0102','01'),
('010203','Copallin','0102','01'),
('010204','El Parco','0102','01'),
('010205','Imaza','0102','01'),
('010206','La Peca','0102','01'),
('010301','Jumbilla','0103','01'),
('010302','Chisquilla','0103','01'),
('010303','Churuja','0103','01'),
('010304','Corosha','0103','01'),
('010305','Cuispes','0103','01'),
('010306','Florida','0103','01'),
('010307','Jazan','0103','01'),
('010308','Recta','0103','01'),
('010309','San Carlos','0103','01'),
('010310','Shipasbamba','0103','01'),
('010311','Valera','0103','01'),
('010312','Yambrasbamba','0103','01'),
('010401','Nieva','0104','01'),
('010402','El Cenepa','0104','01'),
('010403','Río Santiago','0104','01'),
('010501','Lamud','0105','01'),
('010502','Camporredondo','0105','01'),
('010503','Cocabamba','0105','01'),
('010504','Colcamar','0105','01'),
('010505','Conila','0105','01'),
('010506','Inguilpata','0105','01'),
('010507','Longuita','0105','01'),
('010508','Lonya Chico','0105','01'),
('010509','Luya','0105','01'),
('010510','Luya Viejo','0105','01'),
('010511','María','0105','01'),
('010512','Ocalli','0105','01'),
('010513','Ocumal','0105','01'),
('010514','Pisuquia','0105','01'),
('010515','Providencia','0105','01'),
('010516','San Cristóbal','0105','01'),
('010517','San Francisco de Yeso','0105','01'),
('010518','San Jerónimo','0105','01'),
('010519','San Juan de Lopecancha','0105','01'),
('010520','Santa Catalina','0105','01'),
('010521','Santo Tomas','0105','01'),
('010522','Tingo','0105','01'),
('010523','Trita','0105','01'),
('010601','San Nicolás','0106','01'),
('010602','Chirimoto','0106','01'),
('010603','Cochamal','0106','01'),
('010604','Huambo','0106','01'),
('010605','Limabamba','0106','01'),
('010606','Longar','0106','01'),
('010607','Mariscal Benavides','0106','01'),
('010608','Milpuc','0106','01'),
('010609','Omia','0106','01'),
('010610','Santa Rosa','0106','01'),
('010611','Totora','0106','01'),
('010612','Vista Alegre','0106','01'),
('010701','Bagua Grande','0107','01'),
('010702','Cajaruro','0107','01'),
('010703','Cumba','0107','01'),
('010704','El Milagro','0107','01'),
('010705','Jamalca','0107','01'),
('010706','Lonya Grande','0107','01'),
('010707','Yamon','0107','01'),
('020101','Huaraz','0201','02'),
('020102','Cochabamba','0201','02'),
('020103','Colcabamba','0201','02'),
('020104','Huanchay','0201','02'),
('020105','Independencia','0201','02'),
('020106','Jangas','0201','02'),
('020107','La Libertad','0201','02'),
('020108','Olleros','0201','02'),
('020109','Pampas Grande','0201','02'),
('020110','Pariacoto','0201','02'),
('020111','Pira','0201','02'),
('020112','Tarica','0201','02'),
('020201','Aija','0202','02'),
('020202','Coris','0202','02'),
('020203','Huacllan','0202','02'),
('020204','La Merced','0202','02'),
('020205','Succha','0202','02'),
('020301','Llamellin','0203','02'),
('020302','Aczo','0203','02'),
('020303','Chaccho','0203','02'),
('020304','Chingas','0203','02'),
('020305','Mirgas','0203','02'),
('020306','San Juan de Rontoy','0203','02'),
('020401','Chacas','0204','02'),
('020402','Acochaca','0204','02'),
('020501','Chiquian','0205','02'),
('020502','Abelardo Pardo Lezameta','0205','02'),
('020503','Antonio Raymondi','0205','02'),
('020504','Aquia','0205','02'),
('020505','Cajacay','0205','02'),
('020506','Canis','0205','02'),
('020507','Colquioc','0205','02'),
('020508','Huallanca','0205','02'),
('020509','Huasta','0205','02'),
('020510','Huayllacayan','0205','02'),
('020511','La Primavera','0205','02'),
('020512','Mangas','0205','02'),
('020513','Pacllon','0205','02'),
('020514','San Miguel de Corpanqui','0205','02'),
('020515','Ticllos','0205','02'),
('020601','Carhuaz','0206','02'),
('020602','Acopampa','0206','02'),
('020603','Amashca','0206','02'),
('020604','Anta','0206','02'),
('020605','Ataquero','0206','02'),
('020606','Marcara','0206','02'),
('020607','Pariahuanca','0206','02'),
('020608','San Miguel de Aco','0206','02'),
('020609','Shilla','0206','02'),
('020610','Tinco','0206','02'),
('020611','Yungar','0206','02'),
('020701','San Luis','0207','02'),
('020702','San Nicolás','0207','02'),
('020703','Yauya','0207','02'),
('020801','Casma','0208','02'),
('020802','Buena Vista Alta','0208','02'),
('020803','Comandante Noel','0208','02'),
('020804','Yautan','0208','02'),
('020901','Corongo','0209','02'),
('020902','Aco','0209','02'),
('020903','Bambas','0209','02'),
('020904','Cusca','0209','02'),
('020905','La Pampa','0209','02'),
('020906','Yanac','0209','02'),
('020907','Yupan','0209','02'),
('021001','Huari','0210','02'),
('021002','Anra','0210','02'),
('021003','Cajay','0210','02'),
('021004','Chavin de Huantar','0210','02'),
('021005','Huacachi','0210','02'),
('021006','Huacchis','0210','02'),
('021007','Huachis','0210','02'),
('021008','Huantar','0210','02'),
('021009','Masin','0210','02'),
('021010','Paucas','0210','02'),
('021011','Ponto','0210','02'),
('021012','Rahuapampa','0210','02'),
('021013','Rapayan','0210','02'),
('021014','San Marcos','0210','02'),
('021015','San Pedro de Chana','0210','02'),
('021016','Uco','0210','02'),
('021101','Huarmey','0211','02'),
('021102','Cochapeti','0211','02'),
('021103','Culebras','0211','02'),
('021104','Huayan','0211','02'),
('021105','Malvas','0211','02'),
('021201','Caraz','0212','02'),
('021202','Huallanca','0212','02'),
('021203','Huata','0212','02'),
('021204','Huaylas','0212','02'),
('021205','Mato','0212','02'),
('021206','Pamparomas','0212','02'),
('021207','Pueblo Libre','0212','02'),
('021208','Santa Cruz','0212','02'),
('021209','Santo Toribio','0212','02'),
('021210','Yuracmarca','0212','02'),
('021301','Piscobamba','0213','02'),
('021302','Casca','0213','02'),
('021303','Eleazar Guzmán Barron','0213','02'),
('021304','Fidel Olivas Escudero','0213','02'),
('021305','Llama','0213','02'),
('021306','Llumpa','0213','02'),
('021307','Lucma','0213','02'),
('021308','Musga','0213','02'),
('021401','Ocros','0214','02'),
('021402','Acas','0214','02'),
('021403','Cajamarquilla','0214','02'),
('021404','Carhuapampa','0214','02'),
('021405','Cochas','0214','02'),
('021406','Congas','0214','02'),
('021407','Llipa','0214','02'),
('021408','San Cristóbal de Rajan','0214','02'),
('021409','San Pedro','0214','02'),
('021410','Santiago de Chilcas','0214','02'),
('021501','Cabana','0215','02'),
('021502','Bolognesi','0215','02'),
('021503','Conchucos','0215','02'),
('021504','Huacaschuque','0215','02'),
('021505','Huandoval','0215','02'),
('021506','Lacabamba','0215','02'),
('021507','Llapo','0215','02'),
('021508','Pallasca','0215','02'),
('021509','Pampas','0215','02'),
('021510','Santa Rosa','0215','02'),
('021511','Tauca','0215','02'),
('021601','Pomabamba','0216','02'),
('021602','Huayllan','0216','02'),
('021603','Parobamba','0216','02'),
('021604','Quinuabamba','0216','02'),
('021701','Recuay','0217','02'),
('021702','Catac','0217','02'),
('021703','Cotaparaco','0217','02'),
('021704','Huayllapampa','0217','02'),
('021705','Llacllin','0217','02'),
('021706','Marca','0217','02'),
('021707','Pampas Chico','0217','02'),
('021708','Pararin','0217','02'),
('021709','Tapacocha','0217','02'),
('021710','Ticapampa','0217','02'),
('021801','Chimbote','0218','02'),
('021802','Cáceres del Perú','0218','02'),
('021803','Coishco','0218','02'),
('021804','Macate','0218','02'),
('021805','Moro','0218','02'),
('021806','Nepeña','0218','02'),
('021807','Samanco','0218','02'),
('021808','Santa','0218','02'),
('021809','Nuevo Chimbote','0218','02'),
('021901','Sihuas','0219','02'),
('021902','Acobamba','0219','02'),
('021903','Alfonso Ugarte','0219','02'),
('021904','Cashapampa','0219','02'),
('021905','Chingalpo','0219','02'),
('021906','Huayllabamba','0219','02'),
('021907','Quiches','0219','02'),
('021908','Ragash','0219','02'),
('021909','San Juan','0219','02'),
('021910','Sicsibamba','0219','02'),
('022001','Yungay','0220','02'),
('022002','Cascapara','0220','02'),
('022003','Mancos','0220','02'),
('022004','Matacoto','0220','02'),
('022005','Quillo','0220','02'),
('022006','Ranrahirca','0220','02'),
('022007','Shupluy','0220','02'),
('022008','Yanama','0220','02'),
('030101','Abancay','0301','03'),
('030102','Chacoche','0301','03'),
('030103','Circa','0301','03'),
('030104','Curahuasi','0301','03'),
('030105','Huanipaca','0301','03'),
('030106','Lambrama','0301','03'),
('030107','Pichirhua','0301','03'),
('030108','San Pedro de Cachora','0301','03'),
('030109','Tamburco','0301','03'),
('030201','Andahuaylas','0302','03'),
('030202','Andarapa','0302','03'),
('030203','Chiara','0302','03'),
('030204','Huancarama','0302','03'),
('030205','Huancaray','0302','03'),
('030206','Huayana','0302','03'),
('030207','Kishuara','0302','03'),
('030208','Pacobamba','0302','03'),
('030209','Pacucha','0302','03'),
('030210','Pampachiri','0302','03'),
('030211','Pomacocha','0302','03'),
('030212','San Antonio de Cachi','0302','03'),
('030213','San Jerónimo','0302','03'),
('030214','San Miguel de Chaccrampa','0302','03'),
('030215','Santa María de Chicmo','0302','03'),
('030216','Talavera','0302','03'),
('030217','Tumay Huaraca','0302','03'),
('030218','Turpo','0302','03'),
('030219','Kaquiabamba','0302','03'),
('030220','José María Arguedas','0302','03'),
('030301','Antabamba','0303','03'),
('030302','El Oro','0303','03'),
('030303','Huaquirca','0303','03'),
('030304','Juan Espinoza Medrano','0303','03'),
('030305','Oropesa','0303','03'),
('030306','Pachaconas','0303','03'),
('030307','Sabaino','0303','03'),
('030401','Chalhuanca','0304','03'),
('030402','Capaya','0304','03'),
('030403','Caraybamba','0304','03'),
('030404','Chapimarca','0304','03'),
('030405','Colcabamba','0304','03'),
('030406','Cotaruse','0304','03'),
('030407','Ihuayllo','0304','03'),
('030408','Justo Apu Sahuaraura','0304','03'),
('030409','Lucre','0304','03'),
('030410','Pocohuanca','0304','03'),
('030411','San Juan de Chacña','0304','03'),
('030412','Sañayca','0304','03'),
('030413','Soraya','0304','03'),
('030414','Tapairihua','0304','03'),
('030415','Tintay','0304','03'),
('030416','Toraya','0304','03'),
('030417','Yanaca','0304','03'),
('030501','Tambobamba','0305','03'),
('030502','Cotabambas','0305','03'),
('030503','Coyllurqui','0305','03'),
('030504','Haquira','0305','03'),
('030505','Mara','0305','03'),
('030506','Challhuahuacho','0305','03'),
('030601','Chincheros','0306','03'),
('030602','Anco_Huallo','0306','03'),
('030603','Cocharcas','0306','03'),
('030604','Huaccana','0306','03'),
('030605','Ocobamba','0306','03'),
('030606','Ongoy','0306','03'),
('030607','Uranmarca','0306','03'),
('030608','Ranracancha','0306','03'),
('030609','Rocchacc','0306','03'),
('030610','El Porvenir','0306','03'),
('030611','Los Chankas','0306','03'),
('030701','Chuquibambilla','0307','03'),
('030702','Curpahuasi','0307','03'),
('030703','Gamarra','0307','03'),
('030704','Huayllati','0307','03'),
('030705','Mamara','0307','03'),
('030706','Micaela Bastidas','0307','03'),
('030707','Pataypampa','0307','03'),
('030708','Progreso','0307','03'),
('030709','San Antonio','0307','03'),
('030710','Santa Rosa','0307','03'),
('030711','Turpay','0307','03'),
('030712','Vilcabamba','0307','03'),
('030713','Virundo','0307','03'),
('030714','Curasco','0307','03'),
('040101','Arequipa','0401','04'),
('040102','Alto Selva Alegre','0401','04'),
('040103','Cayma','0401','04'),
('040104','Cerro Colorado','0401','04'),
('040105','Characato','0401','04'),
('040106','Chiguata','0401','04'),
('040107','Jacobo Hunter','0401','04'),
('040108','La Joya','0401','04'),
('040109','Mariano Melgar','0401','04'),
('040110','Miraflores','0401','04'),
('040111','Mollebaya','0401','04'),
('040112','Paucarpata','0401','04'),
('040113','Pocsi','0401','04'),
('040114','Polobaya','0401','04'),
('040115','Quequeña','0401','04'),
('040116','Sabandia','0401','04'),
('040117','Sachaca','0401','04'),
('040118','San Juan de Siguas','0401','04'),
('040119','San Juan de Tarucani','0401','04'),
('040120','Santa Isabel de Siguas','0401','04'),
('040121','Santa Rita de Siguas','0401','04'),
('040122','Socabaya','0401','04'),
('040123','Tiabaya','0401','04'),
('040124','Uchumayo','0401','04'),
('040125','Vitor','0401','04'),
('040126','Yanahuara','0401','04'),
('040127','Yarabamba','0401','04'),
('040128','Yura','0401','04'),
('040129','José Luis Bustamante Y Rivero','0401','04'),
('040201','Camaná','0402','04'),
('040202','José María Quimper','0402','04'),
('040203','Mariano Nicolás Valcárcel','0402','04'),
('040204','Mariscal Cáceres','0402','04'),
('040205','Nicolás de Pierola','0402','04'),
('040206','Ocoña','0402','04'),
('040207','Quilca','0402','04'),
('040208','Samuel Pastor','0402','04'),
('040301','Caravelí','0403','04'),
('040302','Acarí','0403','04'),
('040303','Atico','0403','04'),
('040304','Atiquipa','0403','04'),
('040305','Bella Unión','0403','04'),
('040306','Cahuacho','0403','04'),
('040307','Chala','0403','04'),
('040308','Chaparra','0403','04'),
('040309','Huanuhuanu','0403','04'),
('040310','Jaqui','0403','04'),
('040311','Lomas','0403','04'),
('040312','Quicacha','0403','04'),
('040313','Yauca','0403','04'),
('040401','Aplao','0404','04'),
('040402','Andagua','0404','04'),
('040403','Ayo','0404','04'),
('040404','Chachas','0404','04'),
('040405','Chilcaymarca','0404','04'),
('040406','Choco','0404','04'),
('040407','Huancarqui','0404','04'),
('040408','Machaguay','0404','04'),
('040409','Orcopampa','0404','04'),
('040410','Pampacolca','0404','04'),
('040411','Tipan','0404','04'),
('040412','Uñon','0404','04'),
('040413','Uraca','0404','04'),
('040414','Viraco','0404','04'),
('040501','Chivay','0405','04'),
('040502','Achoma','0405','04'),
('040503','Cabanaconde','0405','04'),
('040504','Callalli','0405','04'),
('040505','Caylloma','0405','04'),
('040506','Coporaque','0405','04'),
('040507','Huambo','0405','04'),
('040508','Huanca','0405','04'),
('040509','Ichupampa','0405','04'),
('040510','Lari','0405','04'),
('040511','Lluta','0405','04'),
('040512','Maca','0405','04'),
('040513','Madrigal','0405','04'),
('040514','San Antonio de Chuca','0405','04'),
('040515','Sibayo','0405','04'),
('040516','Tapay','0405','04'),
('040517','Tisco','0405','04'),
('040518','Tuti','0405','04'),
('040519','Yanque','0405','04'),
('040520','Majes','0405','04'),
('040601','Chuquibamba','0406','04'),
('040602','Andaray','0406','04'),
('040603','Cayarani','0406','04'),
('040604','Chichas','0406','04'),
('040605','Iray','0406','04'),
('040606','Río Grande','0406','04'),
('040607','Salamanca','0406','04'),
('040608','Yanaquihua','0406','04'),
('040701','Mollendo','0407','04'),
('040702','Cocachacra','0407','04'),
('040703','Dean Valdivia','0407','04'),
('040704','Islay','0407','04'),
('040705','Mejia','0407','04'),
('040706','Punta de Bombón','0407','04'),
('040801','Cotahuasi','0408','04'),
('040802','Alca','0408','04'),
('040803','Charcana','0408','04'),
('040804','Huaynacotas','0408','04'),
('040805','Pampamarca','0408','04'),
('040806','Puyca','0408','04'),
('040807','Quechualla','0408','04'),
('040808','Sayla','0408','04'),
('040809','Tauria','0408','04'),
('040810','Tomepampa','0408','04'),
('040811','Toro','0408','04'),
('050101','Ayacucho','0501','05'),
('050102','Acocro','0501','05'),
('050103','Acos Vinchos','0501','05'),
('050104','Carmen Alto','0501','05'),
('050105','Chiara','0501','05'),
('050106','Ocros','0501','05'),
('050107','Pacaycasa','0501','05'),
('050108','Quinua','0501','05'),
('050109','San José de Ticllas','0501','05'),
('050110','San Juan Bautista','0501','05'),
('050111','Santiago de Pischa','0501','05'),
('050112','Socos','0501','05'),
('050113','Tambillo','0501','05'),
('050114','Vinchos','0501','05'),
('050115','Jesús Nazareno','0501','05'),
('050116','Andrés Avelino Cáceres Dorregaray','0501','05'),
('050201','Cangallo','0502','05'),
('050202','Chuschi','0502','05'),
('050203','Los Morochucos','0502','05'),
('050204','María Parado de Bellido','0502','05'),
('050205','Paras','0502','05'),
('050206','Totos','0502','05'),
('050301','Sancos','0503','05'),
('050302','Carapo','0503','05'),
('050303','Sacsamarca','0503','05'),
('050304','Santiago de Lucanamarca','0503','05'),
('050401','Huanta','0504','05'),
('050402','Ayahuanco','0504','05'),
('050403','Huamanguilla','0504','05'),
('050404','Iguain','0504','05'),
('050405','Luricocha','0504','05'),
('050406','Santillana','0504','05'),
('050407','Sivia','0504','05'),
('050408','Llochegua','0504','05'),
('050409','Canayre','0504','05'),
('050410','Uchuraccay','0504','05'),
('050411','Pucacolpa','0504','05'),
('050412','Chaca','0504','05'),
('050501','San Miguel','0505','05'),
('050502','Anco','0505','05'),
('050503','Ayna','0505','05'),
('050504','Chilcas','0505','05'),
('050505','Chungui','0505','05'),
('050506','Luis Carranza','0505','05'),
('050507','Santa Rosa','0505','05'),
('050508','Tambo','0505','05'),
('050509','Samugari','0505','05'),
('050510','Anchihuay','0505','05'),
('050511','Oronccoy','0505','05'),
('050601','Puquio','0506','05'),
('050602','Aucara','0506','05'),
('050603','Cabana','0506','05'),
('050604','Carmen Salcedo','0506','05'),
('050605','Chaviña','0506','05'),
('050606','Chipao','0506','05'),
('050607','Huac-Huas','0506','05'),
('050608','Laramate','0506','05'),
('050609','Leoncio Prado','0506','05'),
('050610','Llauta','0506','05'),
('050611','Lucanas','0506','05'),
('050612','Ocaña','0506','05'),
('050613','Otoca','0506','05'),
('050614','Saisa','0506','05'),
('050615','San Cristóbal','0506','05'),
('050616','San Juan','0506','05'),
('050617','San Pedro','0506','05'),
('050618','San Pedro de Palco','0506','05'),
('050619','Sancos','0506','05'),
('050620','Santa Ana de Huaycahuacho','0506','05'),
('050621','Santa Lucia','0506','05'),
('050701','Coracora','0507','05'),
('050702','Chumpi','0507','05'),
('050703','Coronel Castañeda','0507','05'),
('050704','Pacapausa','0507','05'),
('050705','Pullo','0507','05'),
('050706','Puyusca','0507','05'),
('050707','San Francisco de Ravacayco','0507','05'),
('050708','Upahuacho','0507','05'),
('050801','Pausa','0508','05'),
('050802','Colta','0508','05'),
('050803','Corculla','0508','05'),
('050804','Lampa','0508','05'),
('050805','Marcabamba','0508','05'),
('050806','Oyolo','0508','05'),
('050807','Pararca','0508','05'),
('050808','San Javier de Alpabamba','0508','05'),
('050809','San José de Ushua','0508','05'),
('050810','Sara Sara','0508','05'),
('050901','Querobamba','0509','05'),
('050902','Belén','0509','05'),
('050903','Chalcos','0509','05'),
('050904','Chilcayoc','0509','05'),
('050905','Huacaña','0509','05'),
('050906','Morcolla','0509','05'),
('050907','Paico','0509','05'),
('050908','San Pedro de Larcay','0509','05'),
('050909','San Salvador de Quije','0509','05'),
('050910','Santiago de Paucaray','0509','05'),
('050911','Soras','0509','05'),
('051001','Huancapi','0510','05'),
('051002','Alcamenca','0510','05'),
('051003','Apongo','0510','05'),
('051004','Asquipata','0510','05'),
('051005','Canaria','0510','05'),
('051006','Cayara','0510','05'),
('051007','Colca','0510','05'),
('051008','Huamanquiquia','0510','05'),
('051009','Huancaraylla','0510','05'),
('051010','Hualla','0510','05'),
('051011','Sarhua','0510','05'),
('051012','Vilcanchos','0510','05'),
('051101','Vilcas Huaman','0511','05'),
('051102','Accomarca','0511','05'),
('051103','Carhuanca','0511','05'),
('051104','Concepción','0511','05'),
('051105','Huambalpa','0511','05'),
('051106','Independencia','0511','05'),
('051107','Saurama','0511','05'),
('051108','Vischongo','0511','05'),
('060101','Cajamarca','0601','06'),
('060102','Asunción','0601','06'),
('060103','Chetilla','0601','06'),
('060104','Cospan','0601','06'),
('060105','Encañada','0601','06'),
('060106','Jesús','0601','06'),
('060107','Llacanora','0601','06'),
('060108','Los Baños del Inca','0601','06'),
('060109','Magdalena','0601','06'),
('060110','Matara','0601','06'),
('060111','Namora','0601','06'),
('060112','San Juan','0601','06'),
('060201','Cajabamba','0602','06'),
('060202','Cachachi','0602','06'),
('060203','Condebamba','0602','06'),
('060204','Sitacocha','0602','06'),
('060301','Celendín','0603','06'),
('060302','Chumuch','0603','06'),
('060303','Cortegana','0603','06'),
('060304','Huasmin','0603','06'),
('060305','Jorge Chávez','0603','06'),
('060306','José Gálvez','0603','06'),
('060307','Miguel Iglesias','0603','06'),
('060308','Oxamarca','0603','06'),
('060309','Sorochuco','0603','06'),
('060310','Sucre','0603','06'),
('060311','Utco','0603','06'),
('060312','La Libertad de Pallan','0603','06'),
('060401','Chota','0604','06'),
('060402','Anguia','0604','06'),
('060403','Chadin','0604','06'),
('060404','Chiguirip','0604','06'),
('060405','Chimban','0604','06'),
('060406','Choropampa','0604','06'),
('060407','Cochabamba','0604','06'),
('060408','Conchan','0604','06'),
('060409','Huambos','0604','06'),
('060410','Lajas','0604','06'),
('060411','Llama','0604','06'),
('060412','Miracosta','0604','06'),
('060413','Paccha','0604','06'),
('060414','Pion','0604','06'),
('060415','Querocoto','0604','06'),
('060416','San Juan de Licupis','0604','06'),
('060417','Tacabamba','0604','06'),
('060418','Tocmoche','0604','06'),
('060419','Chalamarca','0604','06'),
('060501','Contumaza','0605','06'),
('060502','Chilete','0605','06'),
('060503','Cupisnique','0605','06'),
('060504','Guzmango','0605','06'),
('060505','San Benito','0605','06'),
('060506','Santa Cruz de Toledo','0605','06'),
('060507','Tantarica','0605','06'),
('060508','Yonan','0605','06'),
('060601','Cutervo','0606','06'),
('060602','Callayuc','0606','06'),
('060603','Choros','0606','06'),
('060604','Cujillo','0606','06'),
('060605','La Ramada','0606','06'),
('060606','Pimpingos','0606','06'),
('060607','Querocotillo','0606','06'),
('060608','San Andrés de Cutervo','0606','06'),
('060609','San Juan de Cutervo','0606','06'),
('060610','San Luis de Lucma','0606','06'),
('060611','Santa Cruz','0606','06'),
('060612','Santo Domingo de la Capilla','0606','06'),
('060613','Santo Tomas','0606','06'),
('060614','Socota','0606','06'),
('060615','Toribio Casanova','0606','06'),
('060701','Bambamarca','0607','06'),
('060702','Chugur','0607','06'),
('060703','Hualgayoc','0607','06'),
('060801','Jaén','0608','06'),
('060802','Bellavista','0608','06'),
('060803','Chontali','0608','06'),
('060804','Colasay','0608','06'),
('060805','Huabal','0608','06'),
('060806','Las Pirias','0608','06'),
('060807','Pomahuaca','0608','06'),
('060808','Pucara','0608','06'),
('060809','Sallique','0608','06'),
('060810','San Felipe','0608','06'),
('060811','San José del Alto','0608','06'),
('060812','Santa Rosa','0608','06'),
('060901','San Ignacio','0609','06'),
('060902','Chirinos','0609','06'),
('060903','Huarango','0609','06'),
('060904','La Coipa','0609','06'),
('060905','Namballe','0609','06'),
('060906','San José de Lourdes','0609','06'),
('060907','Tabaconas','0609','06'),
('061001','Pedro Gálvez','0610','06'),
('061002','Chancay','0610','06'),
('061003','Eduardo Villanueva','0610','06'),
('061004','Gregorio Pita','0610','06'),
('061005','Ichocan','0610','06'),
('061006','José Manuel Quiroz','0610','06'),
('061007','José Sabogal','0610','06'),
('061101','San Miguel','0611','06'),
('061102','Bolívar','0611','06'),
('061103','Calquis','0611','06'),
('061104','Catilluc','0611','06'),
('061105','El Prado','0611','06'),
('061106','La Florida','0611','06'),
('061107','Llapa','0611','06'),
('061108','Nanchoc','0611','06'),
('061109','Niepos','0611','06'),
('061110','San Gregorio','0611','06'),
('061111','San Silvestre de Cochan','0611','06'),
('061112','Tongod','0611','06'),
('061113','Unión Agua Blanca','0611','06'),
('061201','San Pablo','0612','06'),
('061202','San Bernardino','0612','06'),
('061203','San Luis','0612','06'),
('061204','Tumbaden','0612','06'),
('061301','Santa Cruz','0613','06'),
('061302','Andabamba','0613','06'),
('061303','Catache','0613','06'),
('061304','Chancaybaños','0613','06'),
('061305','La Esperanza','0613','06'),
('061306','Ninabamba','0613','06'),
('061307','Pulan','0613','06'),
('061308','Saucepampa','0613','06'),
('061309','Sexi','0613','06'),
('061310','Uticyacu','0613','06'),
('061311','Yauyucan','0613','06'),
('070101','Callao','0701','07'),
('070102','Bellavista','0701','07'),
('070103','Carmen de la Legua Reynoso','0701','07'),
('070104','La Perla','0701','07'),
('070105','La Punta','0701','07'),
('070106','Ventanilla','0701','07'),
('070107','Mi Perú','0701','07'),
('080101','Cusco','0801','08'),
('080102','Ccorca','0801','08'),
('080103','Poroy','0801','08'),
('080104','San Jerónimo','0801','08'),
('080105','San Sebastian','0801','08'),
('080106','Santiago','0801','08'),
('080107','Saylla','0801','08'),
('080108','Wanchaq','0801','08'),
('080201','Acomayo','0802','08'),
('080202','Acopia','0802','08'),
('080203','Acos','0802','08'),
('080204','Mosoc Llacta','0802','08'),
('080205','Pomacanchi','0802','08'),
('080206','Rondocan','0802','08'),
('080207','Sangarara','0802','08'),
('080301','Anta','0803','08'),
('080302','Ancahuasi','0803','08'),
('080303','Cachimayo','0803','08'),
('080304','Chinchaypujio','0803','08'),
('080305','Huarocondo','0803','08'),
('080306','Limatambo','0803','08'),
('080307','Mollepata','0803','08'),
('080308','Pucyura','0803','08'),
('080309','Zurite','0803','08'),
('080401','Calca','0804','08'),
('080402','Coya','0804','08'),
('080403','Lamay','0804','08'),
('080404','Lares','0804','08'),
('080405','Pisac','0804','08'),
('080406','San Salvador','0804','08'),
('080407','Taray','0804','08'),
('080408','Yanatile','0804','08'),
('080501','Yanaoca','0805','08'),
('080502','Checca','0805','08'),
('080503','Kunturkanki','0805','08'),
('080504','Langui','0805','08'),
('080505','Layo','0805','08'),
('080506','Pampamarca','0805','08'),
('080507','Quehue','0805','08'),
('080508','Tupac Amaru','0805','08'),
('080601','Sicuani','0806','08'),
('080602','Checacupe','0806','08'),
('080603','Combapata','0806','08'),
('080604','Marangani','0806','08'),
('080605','Pitumarca','0806','08'),
('080606','San Pablo','0806','08'),
('080607','San Pedro','0806','08'),
('080608','Tinta','0806','08'),
('080701','Santo Tomas','0807','08'),
('080702','Capacmarca','0807','08'),
('080703','Chamaca','0807','08'),
('080704','Colquemarca','0807','08'),
('080705','Livitaca','0807','08'),
('080706','Llusco','0807','08'),
('080707','Quiñota','0807','08'),
('080708','Velille','0807','08'),
('080801','Espinar','0808','08'),
('080802','Condoroma','0808','08'),
('080803','Coporaque','0808','08'),
('080804','Ocoruro','0808','08'),
('080805','Pallpata','0808','08'),
('080806','Pichigua','0808','08'),
('080807','Suyckutambo','0808','08'),
('080808','Alto Pichigua','0808','08'),
('080901','Santa Ana','0809','08'),
('080902','Echarate','0809','08'),
('080903','Huayopata','0809','08'),
('080904','Maranura','0809','08'),
('080905','Ocobamba','0809','08'),
('080906','Quellouno','0809','08'),
('080907','Kimbiri','0809','08'),
('080908','Santa Teresa','0809','08'),
('080909','Vilcabamba','0809','08'),
('080910','Pichari','0809','08'),
('080911','Inkawasi','0809','08'),
('080912','Villa Virgen','0809','08'),
('080913','Villa Kintiarina','0809','08'),
('080914','Megantoni','0809','08'),
('081001','Paruro','0810','08'),
('081002','Accha','0810','08'),
('081003','Ccapi','0810','08'),
('081004','Colcha','0810','08'),
('081005','Huanoquite','0810','08'),
('081006','Omachaç','0810','08'),
('081007','Paccaritambo','0810','08'),
('081008','Pillpinto','0810','08'),
('081009','Yaurisque','0810','08'),
('081101','Paucartambo','0811','08'),
('081102','Caicay','0811','08'),
('081103','Challabamba','0811','08'),
('081104','Colquepata','0811','08'),
('081105','Huancarani','0811','08'),
('081106','Kosñipata','0811','08'),
('081201','Urcos','0812','08'),
('081202','Andahuaylillas','0812','08'),
('081203','Camanti','0812','08'),
('081204','Ccarhuayo','0812','08'),
('081205','Ccatca','0812','08'),
('081206','Cusipata','0812','08'),
('081207','Huaro','0812','08'),
('081208','Lucre','0812','08'),
('081209','Marcapata','0812','08'),
('081210','Ocongate','0812','08'),
('081211','Oropesa','0812','08'),
('081212','Quiquijana','0812','08'),
('081301','Urubamba','0813','08'),
('081302','Chinchero','0813','08'),
('081303','Huayllabamba','0813','08'),
('081304','Machupicchu','0813','08'),
('081305','Maras','0813','08'),
('081306','Ollantaytambo','0813','08'),
('081307','Yucay','0813','08'),
('090101','Huancavelica','0901','09'),
('090102','Acobambilla','0901','09'),
('090103','Acoria','0901','09'),
('090104','Conayca','0901','09'),
('090105','Cuenca','0901','09'),
('090106','Huachocolpa','0901','09'),
('090107','Huayllahuara','0901','09'),
('090108','Izcuchaca','0901','09'),
('090109','Laria','0901','09'),
('090110','Manta','0901','09'),
('090111','Mariscal Cáceres','0901','09'),
('090112','Moya','0901','09'),
('090113','Nuevo Occoro','0901','09'),
('090114','Palca','0901','09'),
('090115','Pilchaca','0901','09'),
('090116','Vilca','0901','09'),
('090117','Yauli','0901','09'),
('090118','Ascensión','0901','09'),
('090119','Huando','0901','09'),
('090201','Acobamba','0902','09'),
('090202','Andabamba','0902','09'),
('090203','Anta','0902','09'),
('090204','Caja','0902','09'),
('090205','Marcas','0902','09'),
('090206','Paucara','0902','09'),
('090207','Pomacocha','0902','09'),
('090208','Rosario','0902','09'),
('090301','Lircay','0903','09'),
('090302','Anchonga','0903','09'),
('090303','Callanmarca','0903','09'),
('090304','Ccochaccasa','0903','09'),
('090305','Chincho','0903','09'),
('090306','Congalla','0903','09'),
('090307','Huanca-Huanca','0903','09'),
('090308','Huayllay Grande','0903','09'),
('090309','Julcamarca','0903','09'),
('090310','San Antonio de Antaparco','0903','09'),
('090311','Santo Tomas de Pata','0903','09'),
('090312','Secclla','0903','09'),
('090401','Castrovirreyna','0904','09'),
('090402','Arma','0904','09'),
('090403','Aurahua','0904','09'),
('090404','Capillas','0904','09'),
('090405','Chupamarca','0904','09'),
('090406','Cocas','0904','09'),
('090407','Huachos','0904','09'),
('090408','Huamatambo','0904','09'),
('090409','Mollepampa','0904','09'),
('090410','San Juan','0904','09'),
('090411','Santa Ana','0904','09'),
('090412','Tantara','0904','09'),
('090413','Ticrapo','0904','09'),
('090501','Churcampa','0905','09'),
('090502','Anco','0905','09'),
('090503','Chinchihuasi','0905','09'),
('090504','El Carmen','0905','09'),
('090505','La Merced','0905','09'),
('090506','Locroja','0905','09'),
('090507','Paucarbamba','0905','09'),
('090508','San Miguel de Mayocc','0905','09'),
('090509','San Pedro de Coris','0905','09'),
('090510','Pachamarca','0905','09'),
('090511','Cosme','0905','09'),
('090601','Huaytara','0906','09'),
('090602','Ayavi','0906','09'),
('090603','Córdova','0906','09'),
('090604','Huayacundo Arma','0906','09'),
('090605','Laramarca','0906','09'),
('090606','Ocoyo','0906','09'),
('090607','Pilpichaca','0906','09'),
('090608','Querco','0906','09'),
('090609','Quito-Arma','0906','09'),
('090610','San Antonio de Cusicancha','0906','09'),
('090611','San Francisco de Sangayaico','0906','09'),
('090612','San Isidro','0906','09'),
('090613','Santiago de Chocorvos','0906','09'),
('090614','Santiago de Quirahuara','0906','09'),
('090615','Santo Domingo de Capillas','0906','09'),
('090616','Tambo','0906','09'),
('090701','Pampas','0907','09'),
('090702','Acostambo','0907','09'),
('090703','Acraquia','0907','09'),
('090704','Ahuaycha','0907','09'),
('090705','Colcabamba','0907','09'),
('090706','Daniel Hernández','0907','09'),
('090707','Huachocolpa','0907','09'),
('090709','Huaribamba','0907','09'),
('090710','Ñahuimpuquio','0907','09'),
('090711','Pazos','0907','09'),
('090713','Quishuar','0907','09'),
('090714','Salcabamba','0907','09'),
('090715','Salcahuasi','0907','09'),
('090716','San Marcos de Rocchac','0907','09'),
('090717','Surcubamba','0907','09'),
('090718','Tintay Puncu','0907','09'),
('090719','Quichuas','0907','09'),
('090720','Andaymarca','0907','09'),
('090721','Roble','0907','09'),
('090722','Pichos','0907','09'),
('090723','Santiago de Tucuma','0907','09'),
('100101','Huanuco','1001','10'),
('100102','Amarilis','1001','10'),
('100103','Chinchao','1001','10'),
('100104','Churubamba','1001','10'),
('100105','Margos','1001','10'),
('100106','Quisqui (Kichki)','1001','10'),
('100107','San Francisco de Cayran','1001','10'),
('100108','San Pedro de Chaulan','1001','10'),
('100109','Santa María del Valle','1001','10'),
('100110','Yarumayo','1001','10'),
('100111','Pillco Marca','1001','10'),
('100112','Yacus','1001','10'),
('100113','San Pablo de Pillao','1001','10'),
('100201','Ambo','1002','10'),
('100202','Cayna','1002','10'),
('100203','Colpas','1002','10'),
('100204','Conchamarca','1002','10'),
('100205','Huacar','1002','10'),
('100206','San Francisco','1002','10'),
('100207','San Rafael','1002','10'),
('100208','Tomay Kichwa','1002','10'),
('100301','La Unión','1003','10'),
('100307','Chuquis','1003','10'),
('100311','Marías','1003','10'),
('100313','Pachas','1003','10'),
('100316','Quivilla','1003','10'),
('100317','Ripan','1003','10'),
('100321','Shunqui','1003','10'),
('100322','Sillapata','1003','10'),
('100323','Yanas','1003','10'),
('100401','Huacaybamba','1004','10'),
('100402','Canchabamba','1004','10'),
('100403','Cochabamba','1004','10'),
('100404','Pinra','1004','10'),
('100501','Llata','1005','10'),
('100502','Arancay','1005','10'),
('100503','Chavín de Pariarca','1005','10'),
('100504','Jacas Grande','1005','10'),
('100505','Jircan','1005','10'),
('100506','Miraflores','1005','10'),
('100507','Monzón','1005','10'),
('100508','Punchao','1005','10'),
('100509','Puños','1005','10'),
('100510','Singa','1005','10'),
('100511','Tantamayo','1005','10'),
('100601','Rupa-Rupa','1006','10'),
('100602','Daniel Alomía Robles','1006','10'),
('100603','Hermílio Valdizan','1006','10'),
('100604','José Crespo y Castillo','1006','10'),
('100605','Luyando','1006','10'),
('100606','Mariano Damaso Beraun','1006','10'),
('100607','Pucayacu','1006','10'),
('100608','Castillo Grande','1006','10'),
('100609','Pueblo Nuevo','1006','10'),
('100610','Santo Domingo de Anda','1006','10'),
('100701','Huacrachuco','1007','10'),
('100702','Cholon','1007','10'),
('100703','San Buenaventura','1007','10'),
('100704','La Morada','1007','10'),
('100705','Santa Rosa de Alto Yanajanca','1007','10'),
('100801','Panao','1008','10'),
('100802','Chaglla','1008','10'),
('100803','Molino','1008','10'),
('100804','Umari','1008','10'),
('100901','Puerto Inca','1009','10'),
('100902','Codo del Pozuzo','1009','10'),
('100903','Honoria','1009','10'),
('100904','Tournavista','1009','10'),
('100905','Yuyapichis','1009','10'),
('101001','Jesús','1010','10'),
('101002','Baños','1010','10'),
('101003','Jivia','1010','10'),
('101004','Queropalca','1010','10'),
('101005','Rondos','1010','10'),
('101006','San Francisco de Asís','1010','10'),
('101007','San Miguel de Cauri','1010','10'),
('101101','Chavinillo','1011','10'),
('101102','Cahuac','1011','10'),
('101103','Chacabamba','1011','10'),
('101104','Aparicio Pomares','1011','10'),
('101105','Jacas Chico','1011','10'),
('101106','Obas','1011','10'),
('101107','Pampamarca','1011','10'),
('101108','Choras','1011','10'),
('110101','Ica','1101','11'),
('110102','La Tinguiña','1101','11'),
('110103','Los Aquijes','1101','11'),
('110104','Ocucaje','1101','11'),
('110105','Pachacutec','1101','11'),
('110106','Parcona','1101','11'),
('110107','Pueblo Nuevo','1101','11'),
('110108','Salas','1101','11'),
('110109','San José de Los Molinos','1101','11'),
('110110','San Juan Bautista','1101','11'),
('110111','Santiago','1101','11'),
('110112','Subtanjalla','1101','11'),
('110113','Tate','1101','11'),
('110114','Yauca del Rosario','1101','11'),
('110201','Chincha Alta','1102','11'),
('110202','Alto Laran','1102','11'),
('110203','Chavin','1102','11'),
('110204','Chincha Baja','1102','11'),
('110205','El Carmen','1102','11'),
('110206','Grocio Prado','1102','11'),
('110207','Pueblo Nuevo','1102','11'),
('110208','San Juan de Yanac','1102','11'),
('110209','San Pedro de Huacarpana','1102','11'),
('110210','Sunampe','1102','11'),
('110211','Tambo de Mora','1102','11'),
('110301','Nasca','1103','11'),
('110302','Changuillo','1103','11'),
('110303','El Ingenio','1103','11'),
('110304','Marcona','1103','11'),
('110305','Vista Alegre','1103','11'),
('110401','Palpa','1104','11'),
('110402','Llipata','1104','11'),
('110403','Río Grande','1104','11'),
('110404','Santa Cruz','1104','11'),
('110405','Tibillo','1104','11'),
('110501','Pisco','1105','11'),
('110502','Huancano','1105','11'),
('110503','Humay','1105','11'),
('110504','Independencia','1105','11'),
('110505','Paracas','1105','11'),
('110506','San Andrés','1105','11'),
('110507','San Clemente','1105','11'),
('110508','Tupac Amaru Inca','1105','11'),
('120101','Huancayo','1201','12'),
('120104','Carhuacallanga','1201','12'),
('120105','Chacapampa','1201','12'),
('120106','Chicche','1201','12'),
('120107','Chilca','1201','12'),
('120108','Chongos Alto','1201','12'),
('120111','Chupuro','1201','12'),
('120112','Colca','1201','12'),
('120113','Cullhuas','1201','12'),
('120114','El Tambo','1201','12'),
('120116','Huacrapuquio','1201','12'),
('120117','Hualhuas','1201','12'),
('120119','Huancan','1201','12'),
('120120','Huasicancha','1201','12'),
('120121','Huayucachi','1201','12'),
('120122','Ingenio','1201','12'),
('120124','Pariahuanca','1201','12'),
('120125','Pilcomayo','1201','12'),
('120126','Pucara','1201','12'),
('120127','Quichuay','1201','12'),
('120128','Quilcas','1201','12'),
('120129','San Agustín','1201','12'),
('120130','San Jerónimo de Tunan','1201','12'),
('120132','Saño','1201','12'),
('120133','Sapallanga','1201','12'),
('120134','Sicaya','1201','12'),
('120135','Santo Domingo de Acobamba','1201','12'),
('120136','Viques','1201','12'),
('120201','Concepción','1202','12'),
('120202','Aco','1202','12'),
('120203','Andamarca','1202','12'),
('120204','Chambara','1202','12'),
('120205','Cochas','1202','12'),
('120206','Comas','1202','12'),
('120207','Heroínas Toledo','1202','12'),
('120208','Manzanares','1202','12'),
('120209','Mariscal Castilla','1202','12'),
('120210','Matahuasi','1202','12'),
('120211','Mito','1202','12'),
('120212','Nueve de Julio','1202','12'),
('120213','Orcotuna','1202','12'),
('120214','San José de Quero','1202','12'),
('120215','Santa Rosa de Ocopa','1202','12'),
('120301','Chanchamayo','1203','12'),
('120302','Perene','1203','12'),
('120303','Pichanaqui','1203','12'),
('120304','San Luis de Shuaro','1203','12'),
('120305','San Ramón','1203','12'),
('120306','Vitoc','1203','12'),
('120401','Jauja','1204','12'),
('120402','Acolla','1204','12'),
('120403','Apata','1204','12'),
('120404','Ataura','1204','12'),
('120405','Canchayllo','1204','12'),
('120406','Curicaca','1204','12'),
('120407','El Mantaro','1204','12'),
('120408','Huamali','1204','12'),
('120409','Huaripampa','1204','12'),
('120410','Huertas','1204','12'),
('120411','Janjaillo','1204','12'),
('120412','Julcán','1204','12'),
('120413','Leonor Ordóñez','1204','12'),
('120414','Llocllapampa','1204','12'),
('120415','Marco','1204','12'),
('120416','Masma','1204','12'),
('120417','Masma Chicche','1204','12'),
('120418','Molinos','1204','12'),
('120419','Monobamba','1204','12'),
('120420','Muqui','1204','12'),
('120421','Muquiyauyo','1204','12'),
('120422','Paca','1204','12'),
('120423','Paccha','1204','12'),
('120424','Pancan','1204','12'),
('120425','Parco','1204','12'),
('120426','Pomacancha','1204','12'),
('120427','Ricran','1204','12'),
('120428','San Lorenzo','1204','12'),
('120429','San Pedro de Chunan','1204','12'),
('120430','Sausa','1204','12'),
('120431','Sincos','1204','12'),
('120432','Tunan Marca','1204','12'),
('120433','Yauli','1204','12'),
('120434','Yauyos','1204','12'),
('120501','Junin','1205','12'),
('120502','Carhuamayo','1205','12'),
('120503','Ondores','1205','12'),
('120504','Ulcumayo','1205','12'),
('120601','Satipo','1206','12'),
('120602','Coviriali','1206','12'),
('120603','Llaylla','1206','12'),
('120604','Mazamari','1206','12'),
('120605','Pampa Hermosa','1206','12'),
('120606','Pangoa','1206','12'),
('120607','Río Negro','1206','12'),
('120608','Río Tambo','1206','12'),
('120609','Vizcatan del Ene','1206','12'),
('120701','Tarma','1207','12'),
('120702','Acobamba','1207','12'),
('120703','Huaricolca','1207','12'),
('120704','Huasahuasi','1207','12'),
('120705','La Unión','1207','12'),
('120706','Palca','1207','12'),
('120707','Palcamayo','1207','12'),
('120708','San Pedro de Cajas','1207','12'),
('120709','Tapo','1207','12'),
('120801','La Oroya','1208','12'),
('120802','Chacapalpa','1208','12'),
('120803','Huay-Huay','1208','12'),
('120804','Marcapomacocha','1208','12'),
('120805','Morococha','1208','12'),
('120806','Paccha','1208','12'),
('120807','Santa Bárbara de Carhuacayan','1208','12'),
('120808','Santa Rosa de Sacco','1208','12'),
('120809','Suitucancha','1208','12'),
('120810','Yauli','1208','12'),
('120901','Chupaca','1209','12'),
('120902','Ahuac','1209','12'),
('120903','Chongos Bajo','1209','12'),
('120904','Huachac','1209','12'),
('120905','Huamancaca Chico','1209','12'),
('120906','San Juan de Iscos','1209','12'),
('120907','San Juan de Jarpa','1209','12'),
('120908','Tres de Diciembre','1209','12'),
('120909','Yanacancha','1209','12'),
('130101','Trujillo','1301','13'),
('130102','El Porvenir','1301','13'),
('130103','Florencia de Mora','1301','13'),
('130104','Huanchaco','1301','13'),
('130105','La Esperanza','1301','13'),
('130106','Laredo','1301','13'),
('130107','Moche','1301','13'),
('130108','Poroto','1301','13'),
('130109','Salaverry','1301','13'),
('130110','Simbal','1301','13'),
('130111','Victor Larco Herrera','1301','13'),
('130201','Ascope','1302','13'),
('130202','Chicama','1302','13'),
('130203','Chocope','1302','13'),
('130204','Magdalena de Cao','1302','13'),
('130205','Paijan','1302','13'),
('130206','Rázuri','1302','13'),
('130207','Santiago de Cao','1302','13'),
('130208','Casa Grande','1302','13'),
('130301','Bolívar','1303','13'),
('130302','Bambamarca','1303','13'),
('130303','Condormarca','1303','13'),
('130304','Longotea','1303','13'),
('130305','Uchumarca','1303','13'),
('130306','Ucuncha','1303','13'),
('130401','Chepen','1304','13'),
('130402','Pacanga','1304','13'),
('130403','Pueblo Nuevo','1304','13'),
('130501','Julcan','1305','13'),
('130502','Calamarca','1305','13'),
('130503','Carabamba','1305','13'),
('130504','Huaso','1305','13'),
('130601','Otuzco','1306','13'),
('130602','Agallpampa','1306','13'),
('130604','Charat','1306','13'),
('130605','Huaranchal','1306','13'),
('130606','La Cuesta','1306','13'),
('130608','Mache','1306','13'),
('130610','Paranday','1306','13'),
('130611','Salpo','1306','13'),
('130613','Sinsicap','1306','13'),
('130614','Usquil','1306','13'),
('130701','San Pedro de Lloc','1307','13'),
('130702','Guadalupe','1307','13'),
('130703','Jequetepeque','1307','13'),
('130704','Pacasmayo','1307','13'),
('130705','San José','1307','13'),
('130801','Tayabamba','1308','13'),
('130802','Buldibuyo','1308','13'),
('130803','Chillia','1308','13'),
('130804','Huancaspata','1308','13'),
('130805','Huaylillas','1308','13'),
('130806','Huayo','1308','13'),
('130807','Ongon','1308','13'),
('130808','Parcoy','1308','13'),
('130809','Pataz','1308','13'),
('130810','Pias','1308','13'),
('130811','Santiago de Challas','1308','13'),
('130812','Taurija','1308','13'),
('130813','Urpay','1308','13'),
('130901','Huamachuco','1309','13'),
('130902','Chugay','1309','13'),
('130903','Cochorco','1309','13'),
('130904','Curgos','1309','13'),
('130905','Marcabal','1309','13'),
('130906','Sanagoran','1309','13'),
('130907','Sarin','1309','13'),
('130908','Sartimbamba','1309','13'),
('131001','Santiago de Chuco','1310','13'),
('131002','Angasmarca','1310','13'),
('131003','Cachicadan','1310','13'),
('131004','Mollebamba','1310','13'),
('131005','Mollepata','1310','13'),
('131006','Quiruvilca','1310','13'),
('131007','Santa Cruz de Chuca','1310','13'),
('131008','Sitabamba','1310','13'),
('131101','Cascas','1311','13'),
('131102','Lucma','1311','13'),
('131103','Marmot','1311','13'),
('131104','Sayapullo','1311','13'),
('131201','Viru','1312','13'),
('131202','Chao','1312','13'),
('131203','Guadalupito','1312','13'),
('140101','Chiclayo','1401','14'),
('140102','Chongoyape','1401','14'),
('140103','Eten','1401','14'),
('140104','Eten Puerto','1401','14'),
('140105','José Leonardo Ortiz','1401','14'),
('140106','La Victoria','1401','14'),
('140107','Lagunas','1401','14'),
('140108','Monsefu','1401','14'),
('140109','Nueva Arica','1401','14'),
('140110','Oyotun','1401','14'),
('140111','Picsi','1401','14'),
('140112','Pimentel','1401','14'),
('140113','Reque','1401','14'),
('140114','Santa Rosa','1401','14'),
('140115','Saña','1401','14'),
('140116','Cayalti','1401','14'),
('140117','Patapo','1401','14'),
('140118','Pomalca','1401','14'),
('140119','Pucala','1401','14'),
('140120','Tuman','1401','14'),
('140201','Ferreñafe','1402','14'),
('140202','Cañaris','1402','14'),
('140203','Incahuasi','1402','14'),
('140204','Manuel Antonio Mesones Muro','1402','14'),
('140205','Pitipo','1402','14'),
('140206','Pueblo Nuevo','1402','14'),
('140301','Lambayeque','1403','14'),
('140302','Chochope','1403','14'),
('140303','Illimo','1403','14'),
('140304','Jayanca','1403','14'),
('140305','Mochumi','1403','14'),
('140306','Morrope','1403','14'),
('140307','Motupe','1403','14'),
('140308','Olmos','1403','14'),
('140309','Pacora','1403','14'),
('140310','Salas','1403','14'),
('140311','San José','1403','14'),
('140312','Tucume','1403','14'),
('150101','Lima','1501','15'),
('150102','Ancón','1501','15'),
('150103','Ate','1501','15'),
('150104','Barranco','1501','15'),
('150105','Breña','1501','15'),
('150106','Carabayllo','1501','15'),
('150107','Chaclacayo','1501','15'),
('150108','Chorrillos','1501','15'),
('150109','Cieneguilla','1501','15'),
('150110','Comas','1501','15'),
('150111','El Agustino','1501','15'),
('150112','Independencia','1501','15'),
('150113','Jesús María','1501','15'),
('150114','La Molina','1501','15'),
('150115','La Victoria','1501','15'),
('150116','Lince','1501','15'),
('150117','Los Olivos','1501','15'),
('150118','Lurigancho','1501','15'),
('150119','Lurin','1501','15'),
('150120','Magdalena del Mar','1501','15'),
('150121','Pueblo Libre','1501','15'),
('150122','Miraflores','1501','15'),
('150123','Pachacamac','1501','15'),
('150124','Pucusana','1501','15'),
('150125','Puente Piedra','1501','15'),
('150126','Punta Hermosa','1501','15'),
('150127','Punta Negra','1501','15'),
('150128','Rímac','1501','15'),
('150129','San Bartolo','1501','15'),
('150130','San Borja','1501','15'),
('150131','San Isidro','1501','15'),
('150132','San Juan de Lurigancho','1501','15'),
('150133','San Juan de Miraflores','1501','15'),
('150134','San Luis','1501','15'),
('150135','San Martín de Porres','1501','15'),
('150136','San Miguel','1501','15'),
('150137','Santa Anita','1501','15'),
('150138','Santa María del Mar','1501','15'),
('150139','Santa Rosa','1501','15'),
('150140','Santiago de Surco','1501','15'),
('150141','Surquillo','1501','15'),
('150142','Villa El Salvador','1501','15'),
('150143','Villa María del Triunfo','1501','15'),
('150201','Barranca','1502','15'),
('150202','Paramonga','1502','15'),
('150203','Pativilca','1502','15'),
('150204','Supe','1502','15'),
('150205','Supe Puerto','1502','15'),
('150301','Cajatambo','1503','15'),
('150302','Copa','1503','15'),
('150303','Gorgor','1503','15'),
('150304','Huancapon','1503','15'),
('150305','Manas','1503','15'),
('150401','Canta','1504','15'),
('150402','Arahuay','1504','15'),
('150403','Huamantanga','1504','15'),
('150404','Huaros','1504','15'),
('150405','Lachaqui','1504','15'),
('150406','San Buenaventura','1504','15'),
('150407','Santa Rosa de Quives','1504','15'),
('150501','San Vicente de Cañete','1505','15'),
('150502','Asia','1505','15'),
('150503','Calango','1505','15'),
('150504','Cerro Azul','1505','15'),
('150505','Chilca','1505','15'),
('150506','Coayllo','1505','15'),
('150507','Imperial','1505','15'),
('150508','Lunahuana','1505','15'),
('150509','Mala','1505','15'),
('150510','Nuevo Imperial','1505','15'),
('150511','Pacaran','1505','15'),
('150512','Quilmana','1505','15'),
('150513','San Antonio','1505','15'),
('150514','San Luis','1505','15'),
('150515','Santa Cruz de Flores','1505','15'),
('150516','Zúñiga','1505','15'),
('150601','Huaral','1506','15'),
('150602','Atavillos Alto','1506','15'),
('150603','Atavillos Bajo','1506','15'),
('150604','Aucallama','1506','15'),
('150605','Chancay','1506','15'),
('150606','Ihuari','1506','15'),
('150607','Lampian','1506','15'),
('150608','Pacaraos','1506','15'),
('150609','San Miguel de Acos','1506','15'),
('150610','Santa Cruz de Andamarca','1506','15'),
('150611','Sumbilca','1506','15'),
('150612','Veintisiete de Noviembre','1506','15'),
('150701','Matucana','1507','15'),
('150702','Antioquia','1507','15'),
('150703','Callahuanca','1507','15'),
('150704','Carampoma','1507','15'),
('150705','Chicla','1507','15'),
('150706','Cuenca','1507','15'),
('150707','Huachupampa','1507','15'),
('150708','Huanza','1507','15'),
('150709','Huarochiri','1507','15'),
('150710','Lahuaytambo','1507','15'),
('150711','Langa','1507','15'),
('150712','Laraos','1507','15'),
('150713','Mariatana','1507','15'),
('150714','Ricardo Palma','1507','15'),
('150715','San Andrés de Tupicocha','1507','15'),
('150716','San Antonio','1507','15'),
('150717','San Bartolomé','1507','15'),
('150718','San Damian','1507','15'),
('150719','San Juan de Iris','1507','15'),
('150720','San Juan de Tantaranche','1507','15'),
('150721','San Lorenzo de Quinti','1507','15'),
('150722','San Mateo','1507','15'),
('150723','San Mateo de Otao','1507','15'),
('150724','San Pedro de Casta','1507','15'),
('150725','San Pedro de Huancayre','1507','15'),
('150726','Sangallaya','1507','15'),
('150727','Santa Cruz de Cocachacra','1507','15'),
('150728','Santa Eulalia','1507','15'),
('150729','Santiago de Anchucaya','1507','15'),
('150730','Santiago de Tuna','1507','15'),
('150731','Santo Domingo de Los Olleros','1507','15'),
('150732','Surco','1507','15'),
('150801','Huacho','1508','15'),
('150802','Ambar','1508','15'),
('150803','Caleta de Carquin','1508','15'),
('150804','Checras','1508','15'),
('150805','Hualmay','1508','15'),
('150806','Huaura','1508','15'),
('150807','Leoncio Prado','1508','15'),
('150808','Paccho','1508','15'),
('150809','Santa Leonor','1508','15'),
('150810','Santa María','1508','15'),
('150811','Sayan','1508','15'),
('150812','Vegueta','1508','15'),
('150901','Oyon','1509','15'),
('150902','Andajes','1509','15'),
('150903','Caujul','1509','15'),
('150904','Cochamarca','1509','15'),
('150905','Navan','1509','15'),
('150906','Pachangara','1509','15'),
('151001','Yauyos','1510','15'),
('151002','Alis','1510','15'),
('151003','Allauca','1510','15'),
('151004','Ayaviri','1510','15'),
('151005','Azángaro','1510','15'),
('151006','Cacra','1510','15'),
('151007','Carania','1510','15'),
('151008','Catahuasi','1510','15'),
('151009','Chocos','1510','15'),
('151010','Cochas','1510','15'),
('151011','Colonia','1510','15'),
('151012','Hongos','1510','15'),
('151013','Huampara','1510','15'),
('151014','Huancaya','1510','15'),
('151015','Huangascar','1510','15'),
('151016','Huantan','1510','15'),
('151017','Huañec','1510','15'),
('151018','Laraos','1510','15'),
('151019','Lincha','1510','15'),
('151020','Madean','1510','15'),
('151021','Miraflores','1510','15'),
('151022','Omas','1510','15'),
('151023','Putinza','1510','15'),
('151024','Quinches','1510','15'),
('151025','Quinocay','1510','15'),
('151026','San Joaquín','1510','15'),
('151027','San Pedro de Pilas','1510','15'),
('151028','Tanta','1510','15'),
('151029','Tauripampa','1510','15'),
('151030','Tomas','1510','15'),
('151031','Tupe','1510','15'),
('151032','Viñac','1510','15'),
('151033','Vitis','1510','15'),
('160101','Iquitos','1601','16'),
('160102','Alto Nanay','1601','16'),
('160103','Fernando Lores','1601','16'),
('160104','Indiana','1601','16'),
('160105','Las Amazonas','1601','16'),
('160106','Mazan','1601','16'),
('160107','Napo','1601','16'),
('160108','Punchana','1601','16'),
('160110','Torres Causana','1601','16'),
('160112','Belén','1601','16'),
('160113','San Juan Bautista','1601','16'),
('160201','Yurimaguas','1602','16'),
('160202','Balsapuerto','1602','16'),
('160205','Jeberos','1602','16'),
('160206','Lagunas','1602','16'),
('160210','Santa Cruz','1602','16'),
('160211','Teniente Cesar López Rojas','1602','16'),
('160301','Nauta','1603','16'),
('160302','Parinari','1603','16'),
('160303','Tigre','1603','16'),
('160304','Trompeteros','1603','16'),
('160305','Urarinas','1603','16'),
('160401','Ramón Castilla','1604','16'),
('160402','Pebas','1604','16'),
('160403','Yavari','1604','16'),
('160404','San Pablo','1604','16'),
('160501','Requena','1605','16'),
('160502','Alto Tapiche','1605','16'),
('160503','Capelo','1605','16'),
('160504','Emilio San Martín','1605','16'),
('160505','Maquia','1605','16'),
('160506','Puinahua','1605','16'),
('160507','Saquena','1605','16'),
('160508','Soplin','1605','16'),
('160509','Tapiche','1605','16'),
('160510','Jenaro Herrera','1605','16'),
('160511','Yaquerana','1605','16'),
('160601','Contamana','1606','16'),
('160602','Inahuaya','1606','16'),
('160603','Padre Márquez','1606','16'),
('160604','Pampa Hermosa','1606','16'),
('160605','Sarayacu','1606','16'),
('160606','Vargas Guerra','1606','16'),
('160701','Barranca','1607','16'),
('160702','Cahuapanas','1607','16'),
('160703','Manseriche','1607','16'),
('160704','Morona','1607','16'),
('160705','Pastaza','1607','16'),
('160706','Andoas','1607','16'),
('160801','Putumayo','1608','16'),
('160802','Rosa Panduro','1608','16'),
('160803','Teniente Manuel Clavero','1608','16'),
('160804','Yaguas','1608','16'),
('170101','Tambopata','1701','17'),
('170102','Inambari','1701','17'),
('170103','Las Piedras','1701','17'),
('170104','Laberinto','1701','17'),
('170201','Manu','1702','17'),
('170202','Fitzcarrald','1702','17'),
('170203','Madre de Dios','1702','17'),
('170204','Huepetuhe','1702','17'),
('170301','Iñapari','1703','17'),
('170302','Iberia','1703','17'),
('170303','Tahuamanu','1703','17'),
('180101','Moquegua','1801','18'),
('180102','Carumas','1801','18'),
('180103','Cuchumbaya','1801','18'),
('180104','Samegua','1801','18'),
('180105','San Cristóbal','1801','18'),
('180106','Torata','1801','18'),
('180201','Omate','1802','18'),
('180202','Chojata','1802','18'),
('180203','Coalaque','1802','18'),
('180204','Ichuña','1802','18'),
('180205','La Capilla','1802','18'),
('180206','Lloque','1802','18'),
('180207','Matalaque','1802','18'),
('180208','Puquina','1802','18'),
('180209','Quinistaquillas','1802','18'),
('180210','Ubinas','1802','18'),
('180211','Yunga','1802','18'),
('180301','Ilo','1803','18'),
('180302','El Algarrobal','1803','18'),
('180303','Pacocha','1803','18'),
('190101','Chaupimarca','1901','19'),
('190102','Huachon','1901','19'),
('190103','Huariaca','1901','19'),
('190104','Huayllay','1901','19'),
('190105','Ninacaca','1901','19'),
('190106','Pallanchacra','1901','19'),
('190107','Paucartambo','1901','19'),
('190108','San Francisco de Asís de Yarusyacan','1901','19'),
('190109','Simon Bolívar','1901','19'),
('190110','Ticlacayan','1901','19'),
('190111','Tinyahuarco','1901','19'),
('190112','Vicco','1901','19'),
('190113','Yanacancha','1901','19'),
('190201','Yanahuanca','1902','19'),
('190202','Chacayan','1902','19'),
('190203','Goyllarisquizga','1902','19'),
('190204','Paucar','1902','19'),
('190205','San Pedro de Pillao','1902','19'),
('190206','Santa Ana de Tusi','1902','19'),
('190207','Tapuc','1902','19'),
('190208','Vilcabamba','1902','19'),
('190301','Oxapampa','1903','19'),
('190302','Chontabamba','1903','19'),
('190303','Huancabamba','1903','19'),
('190304','Palcazu','1903','19'),
('190305','Pozuzo','1903','19'),
('190306','Puerto Bermúdez','1903','19'),
('190307','Villa Rica','1903','19'),
('190308','Constitución','1903','19'),
('200101','Piura','2001','20'),
('200104','Castilla','2001','20'),
('200105','Catacaos','2001','20'),
('200107','Cura Mori','2001','20'),
('200108','El Tallan','2001','20'),
('200109','La Arena','2001','20'),
('200110','La Unión','2001','20'),
('200111','Las Lomas','2001','20'),
('200114','Tambo Grande','2001','20'),
('200115','Veintiseis de Octubre','2001','20'),
('200201','Ayabaca','2002','20'),
('200202','Frias','2002','20'),
('200203','Jilili','2002','20'),
('200204','Lagunas','2002','20'),
('200205','Montero','2002','20'),
('200206','Pacaipampa','2002','20'),
('200207','Paimas','2002','20'),
('200208','Sapillica','2002','20'),
('200209','Sicchez','2002','20'),
('200210','Suyo','2002','20'),
('200301','Huancabamba','2003','20'),
('200302','Canchaque','2003','20'),
('200303','El Carmen de la Frontera','2003','20'),
('200304','Huarmaca','2003','20'),
('200305','Lalaquiz','2003','20'),
('200306','San Miguel de El Faique','2003','20'),
('200307','Sondor','2003','20'),
('200308','Sondorillo','2003','20'),
('200401','Chulucanas','2004','20'),
('200402','Buenos Aires','2004','20'),
('200403','Chalaco','2004','20'),
('200404','La Matanza','2004','20'),
('200405','Morropon','2004','20'),
('200406','Salitral','2004','20'),
('200407','San Juan de Bigote','2004','20'),
('200408','Santa Catalina de Mossa','2004','20'),
('200409','Santo Domingo','2004','20'),
('200410','Yamango','2004','20'),
('200501','Paita','2005','20'),
('200502','Amotape','2005','20'),
('200503','Arenal','2005','20'),
('200504','Colan','2005','20'),
('200505','La Huaca','2005','20'),
('200506','Tamarindo','2005','20'),
('200507','Vichayal','2005','20'),
('200601','Sullana','2006','20'),
('200602','Bellavista','2006','20'),
('200603','Ignacio Escudero','2006','20'),
('200604','Lancones','2006','20'),
('200605','Marcavelica','2006','20'),
('200606','Miguel Checa','2006','20'),
('200607','Querecotillo','2006','20'),
('200608','Salitral','2006','20'),
('200701','Pariñas','2007','20'),
('200702','El Alto','2007','20'),
('200703','La Brea','2007','20'),
('200704','Lobitos','2007','20'),
('200705','Los Organos','2007','20'),
('200706','Mancora','2007','20'),
('200801','Sechura','2008','20'),
('200802','Bellavista de la Unión','2008','20'),
('200803','Bernal','2008','20'),
('200804','Cristo Nos Valga','2008','20'),
('200805','Vice','2008','20'),
('200806','Rinconada Llicuar','2008','20'),
('210101','Puno','2101','21'),
('210102','Acora','2101','21'),
('210103','Amantani','2101','21'),
('210104','Atuncolla','2101','21'),
('210105','Capachica','2101','21'),
('210106','Chucuito','2101','21'),
('210107','Coata','2101','21'),
('210108','Huata','2101','21'),
('210109','Mañazo','2101','21'),
('210110','Paucarcolla','2101','21'),
('210111','Pichacani','2101','21'),
('210112','Plateria','2101','21'),
('210113','San Antonio','2101','21'),
('210114','Tiquillaca','2101','21'),
('210115','Vilque','2101','21'),
('210201','Azángaro','2102','21'),
('210202','Achaya','2102','21'),
('210203','Arapa','2102','21'),
('210204','Asillo','2102','21'),
('210205','Caminaca','2102','21'),
('210206','Chupa','2102','21'),
('210207','José Domingo Choquehuanca','2102','21'),
('210208','Muñani','2102','21'),
('210209','Potoni','2102','21'),
('210210','Saman','2102','21'),
('210211','San Anton','2102','21'),
('210212','San José','2102','21'),
('210213','San Juan de Salinas','2102','21'),
('210214','Santiago de Pupuja','2102','21'),
('210215','Tirapata','2102','21'),
('210301','Macusani','2103','21'),
('210302','Ajoyani','2103','21'),
('210303','Ayapata','2103','21'),
('210304','Coasa','2103','21'),
('210305','Corani','2103','21'),
('210306','Crucero','2103','21'),
('210307','Ituata','2103','21'),
('210308','Ollachea','2103','21'),
('210309','San Gaban','2103','21'),
('210310','Usicayos','2103','21'),
('210401','Juli','2104','21'),
('210402','Desaguadero','2104','21'),
('210403','Huacullani','2104','21'),
('210404','Kelluyo','2104','21'),
('210405','Pisacoma','2104','21'),
('210406','Pomata','2104','21'),
('210407','Zepita','2104','21'),
('210501','Ilave','2105','21'),
('210502','Capazo','2105','21'),
('210503','Pilcuyo','2105','21'),
('210504','Santa Rosa','2105','21'),
('210505','Conduriri','2105','21'),
('210601','Huancane','2106','21'),
('210602','Cojata','2106','21'),
('210603','Huatasani','2106','21'),
('210604','Inchupalla','2106','21'),
('210605','Pusi','2106','21'),
('210606','Rosaspata','2106','21'),
('210607','Taraco','2106','21'),
('210608','Vilque Chico','2106','21'),
('210701','Lampa','2107','21'),
('210702','Cabanilla','2107','21'),
('210703','Calapuja','2107','21'),
('210704','Nicasio','2107','21'),
('210705','Ocuviri','2107','21'),
('210706','Palca','2107','21'),
('210707','Paratia','2107','21'),
('210708','Pucara','2107','21'),
('210709','Santa Lucia','2107','21'),
('210710','Vilavila','2107','21'),
('210801','Ayaviri','2108','21'),
('210802','Antauta','2108','21'),
('210803','Cupi','2108','21'),
('210804','Llalli','2108','21'),
('210805','Macari','2108','21'),
('210806','Nuñoa','2108','21'),
('210807','Orurillo','2108','21'),
('210808','Santa Rosa','2108','21'),
('210809','Umachiri','2108','21'),
('210901','Moho','2109','21'),
('210902','Conima','2109','21'),
('210903','Huayrapata','2109','21'),
('210904','Tilali','2109','21'),
('211001','Putina','2110','21'),
('211002','Ananea','2110','21'),
('211003','Pedro Vilca Apaza','2110','21'),
('211004','Quilcapuncu','2110','21'),
('211005','Sina','2110','21'),
('211101','Juliaca','2111','21'),
('211102','Cabana','2111','21'),
('211103','Cabanillas','2111','21'),
('211104','Caracoto','2111','21'),
('211105','San Miguel','2111','21'),
('211201','Sandia','2112','21'),
('211202','Cuyocuyo','2112','21'),
('211203','Limbani','2112','21'),
('211204','Patambuco','2112','21'),
('211205','Phara','2112','21'),
('211206','Quiaca','2112','21'),
('211207','San Juan del Oro','2112','21'),
('211208','Yanahuaya','2112','21'),
('211209','Alto Inambari','2112','21'),
('211210','San Pedro de Putina Punco','2112','21'),
('211301','Yunguyo','2113','21'),
('211302','Anapia','2113','21'),
('211303','Copani','2113','21'),
('211304','Cuturapi','2113','21'),
('211305','Ollaraya','2113','21'),
('211306','Tinicachi','2113','21'),
('211307','Unicachi','2113','21'),
('220101','Moyobamba','2201','22'),
('220102','Calzada','2201','22'),
('220103','Habana','2201','22'),
('220104','Jepelacio','2201','22'),
('220105','Soritor','2201','22'),
('220106','Yantalo','2201','22'),
('220201','Bellavista','2202','22'),
('220202','Alto Biavo','2202','22'),
('220203','Bajo Biavo','2202','22'),
('220204','Huallaga','2202','22'),
('220205','San Pablo','2202','22'),
('220206','San Rafael','2202','22'),
('220301','San José de Sisa','2203','22'),
('220302','Agua Blanca','2203','22'),
('220303','San Martín','2203','22'),
('220304','Santa Rosa','2203','22'),
('220305','Shatoja','2203','22'),
('220401','Saposoa','2204','22'),
('220402','Alto Saposoa','2204','22'),
('220403','El Eslabón','2204','22'),
('220404','Piscoyacu','2204','22'),
('220405','Sacanche','2204','22'),
('220406','Tingo de Saposoa','2204','22'),
('220501','Lamas','2205','22'),
('220502','Alonso de Alvarado','2205','22'),
('220503','Barranquita','2205','22'),
('220504','Caynarachi','2205','22'),
('220505','Cuñumbuqui','2205','22'),
('220506','Pinto Recodo','2205','22'),
('220507','Rumisapa','2205','22'),
('220508','San Roque de Cumbaza','2205','22'),
('220509','Shanao','2205','22'),
('220510','Tabalosos','2205','22'),
('220511','Zapatero','2205','22'),
('220601','Juanjuí','2206','22'),
('220602','Campanilla','2206','22'),
('220603','Huicungo','2206','22'),
('220604','Pachiza','2206','22'),
('220605','Pajarillo','2206','22'),
('220701','Picota','2207','22'),
('220702','Buenos Aires','2207','22'),
('220703','Caspisapa','2207','22'),
('220704','Pilluana','2207','22'),
('220705','Pucacaca','2207','22'),
('220706','San Cristóbal','2207','22'),
('220707','San Hilarión','2207','22'),
('220708','Shamboyacu','2207','22'),
('220709','Tingo de Ponasa','2207','22'),
('220710','Tres Unidos','2207','22'),
('220801','Rioja','2208','22'),
('220802','Awajun','2208','22'),
('220803','Elías Soplin Vargas','2208','22'),
('220804','Nueva Cajamarca','2208','22'),
('220805','Pardo Miguel','2208','22'),
('220806','Posic','2208','22'),
('220807','San Fernando','2208','22'),
('220808','Yorongos','2208','22'),
('220809','Yuracyacu','2208','22'),
('220901','Tarapoto','2209','22'),
('220902','Alberto Leveau','2209','22'),
('220903','Cacatachi','2209','22'),
('220904','Chazuta','2209','22'),
('220905','Chipurana','2209','22'),
('220906','El Porvenir','2209','22'),
('220907','Huimbayoc','2209','22'),
('220908','Juan Guerra','2209','22'),
('220909','La Banda de Shilcayo','2209','22'),
('220910','Morales','2209','22'),
('220911','Papaplaya','2209','22'),
('220912','San Antonio','2209','22'),
('220913','Sauce','2209','22'),
('220914','Shapaja','2209','22'),
('221001','Tocache','2210','22'),
('221002','Nuevo Progreso','2210','22'),
('221003','Polvora','2210','22'),
('221004','Shunte','2210','22'),
('221005','Uchiza','2210','22'),
('230101','Tacna','2301','23'),
('230102','Alto de la Alianza','2301','23'),
('230103','Calana','2301','23'),
('230104','Ciudad Nueva','2301','23'),
('230105','Inclan','2301','23'),
('230106','Pachia','2301','23'),
('230107','Palca','2301','23'),
('230108','Pocollay','2301','23'),
('230109','Sama','2301','23'),
('230110','Coronel Gregorio Albarracín Lanchipa','2301','23'),
('230111','La Yarada los Palos','2301','23'),
('230201','Candarave','2302','23'),
('230202','Cairani','2302','23'),
('230203','Camilaca','2302','23'),
('230204','Curibaya','2302','23'),
('230205','Huanuara','2302','23'),
('230206','Quilahuani','2302','23'),
('230301','Locumba','2303','23'),
('230302','Ilabaya','2303','23'),
('230303','Ite','2303','23'),
('230401','Tarata','2304','23'),
('230402','Héroes Albarracín','2304','23'),
('230403','Estique','2304','23'),
('230404','Estique-Pampa','2304','23'),
('230405','Sitajara','2304','23'),
('230406','Susapaya','2304','23'),
('230407','Tarucachi','2304','23'),
('230408','Ticaco','2304','23'),
('240101','Tumbes','2401','24'),
('240102','Corrales','2401','24'),
('240103','La Cruz','2401','24'),
('240104','Pampas de Hospital','2401','24'),
('240105','San Jacinto','2401','24'),
('240106','San Juan de la Virgen','2401','24'),
('240201','Zorritos','2402','24'),
('240202','Casitas','2402','24'),
('240203','Canoas de Punta Sal','2402','24'),
('240301','Zarumilla','2403','24'),
('240302','Aguas Verdes','2403','24'),
('240303','Matapalo','2403','24'),
('240304','Papayal','2403','24'),
('250101','Calleria','2501','25'),
('250102','Campoverde','2501','25'),
('250103','Iparia','2501','25'),
('250104','Masisea','2501','25'),
('250105','Yarinacocha','2501','25'),
('250106','Nueva Requena','2501','25'),
('250107','Manantay','2501','25'),
('250201','Raymondi','2502','25'),
('250202','Sepahua','2502','25'),
('250203','Tahuania','2502','25'),
('250204','Yurua','2502','25'),
('250301','Padre Abad','2503','25'),
('250302','Irazola','2503','25'),
('250303','Curimana','2503','25'),
('250304','Neshuya','2503','25'),
('250305','Alexander Von Humboldt','2503','25'),
('250401','Purus','2504','25');

/*Table structure for table `especialidades` */

DROP TABLE IF EXISTS `especialidades`;

CREATE TABLE `especialidades` (
  `idespecialidad` int(11) NOT NULL AUTO_INCREMENT,
  `idservicio` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `tarifa` decimal(7,2) NOT NULL,
  PRIMARY KEY (`idespecialidad`),
  KEY `fk_esp_idservicio` (`idservicio`),
  KEY `fk_esp_idusuario` (`idusuario`),
  CONSTRAINT `fk_esp_idservicio` FOREIGN KEY (`idservicio`) REFERENCES `servicios` (`idservicio`),
  CONSTRAINT `fk_esp_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `especialidades` */

insert  into `especialidades`(`idespecialidad`,`idservicio`,`idusuario`,`descripcion`,`tarifa`) values 
(1,1,1,'Cálculo de secciones de líneas eléctricas',85.25),
(2,1,1,'Electrotecnia',180.20),
(3,1,1,'Riesgo eléctrico',85.00),
(4,1,1,'Tensión eléctrica',540.00);

/*Table structure for table `establecimientos` */

DROP TABLE IF EXISTS `establecimientos`;

CREATE TABLE `establecimientos` (
  `idestablecimiento` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `establecimiento` varchar(30) NOT NULL,
  `ruc` char(11) NOT NULL,
  `tipocalle` char(2) NOT NULL,
  `nombrecalle` varchar(60) NOT NULL,
  `numerocalle` varchar(5) DEFAULT NULL,
  `referencia` varchar(80) DEFAULT NULL,
  `latitud` float(10,8) NOT NULL,
  `longitud` float(10,8) NOT NULL,
  `iddistrito` varchar(6) NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idestablecimiento`),
  UNIQUE KEY `uk_est_ruc` (`ruc`),
  KEY `fk_est_idusuario` (`idusuario`),
  KEY `fk_est_iddistrito` (`iddistrito`),
  CONSTRAINT `fk_est_iddistrito` FOREIGN KEY (`iddistrito`) REFERENCES `distritos` (`iddistrito`),
  CONSTRAINT `fk_est_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `establecimientos` */

insert  into `establecimientos`(`idestablecimiento`,`idusuario`,`establecimiento`,`ruc`,`tipocalle`,`nombrecalle`,`numerocalle`,`referencia`,`latitud`,`longitud`,`iddistrito`,`estado`) values 
(1,1,'Mecanina pilon motors','12452585696','CA','Molina','25','Pasando la segunda cuadra',-12.06710052,-77.03235626,'010110',''),
(2,2,'Electricista ZORNOMAZ','12452585626','UR','Leon de Vivero','52','Antes de ',-12.06710052,-77.03235626,'010115',''),
(3,3,'ABOGADOS CHINCHA','12452582696','UR','Las palmeras','82','',-12.06720066,-77.03835297,'010120','');

/*Table structure for table `foros` */

DROP TABLE IF EXISTS `foros`;

CREATE TABLE `foros` (
  `idforo` int(11) NOT NULL AUTO_INCREMENT,
  `idtousuario` int(11) NOT NULL,
  `idfromusuario` int(11) NOT NULL,
  `consulta` mediumtext NOT NULL,
  `fechaconsulta` datetime NOT NULL DEFAULT current_timestamp(),
  `fechaeliminado` datetime DEFAULT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idforo`),
  UNIQUE KEY `uk_for_idtousuario` (`idtousuario`,`idfromusuario`),
  KEY `fk_for_idfromusuario` (`idfromusuario`),
  CONSTRAINT `fk_for_idfromusuario` FOREIGN KEY (`idfromusuario`) REFERENCES `usuarios` (`idusuario`),
  CONSTRAINT `fk_for_idtousuario` FOREIGN KEY (`idtousuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `foros` */

/*Table structure for table `galerias` */

DROP TABLE IF EXISTS `galerias`;

CREATE TABLE `galerias` (
  `idgaleria` int(11) NOT NULL AUTO_INCREMENT,
  `idalbum` int(11) DEFAULT NULL,
  `idusuario` int(11) NOT NULL,
  `idtrabajo` int(11) DEFAULT NULL,
  `tipo` char(1) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `archivo` varchar(100) NOT NULL,
  `fechaalta` datetime NOT NULL DEFAULT current_timestamp(),
  `fechabaja` datetime DEFAULT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idgaleria`),
  KEY `fk_gal_idalbum` (`idalbum`),
  KEY `fk_gal_idusuario` (`idusuario`),
  KEY `fk_gal_idtrabajo` (`idtrabajo`),
  CONSTRAINT `fk_gal_idalbum` FOREIGN KEY (`idalbum`) REFERENCES `albumes` (`idalbum`),
  CONSTRAINT `fk_gal_idtrabajo` FOREIGN KEY (`idtrabajo`) REFERENCES `trabajos` (`idtrabajo`),
  CONSTRAINT `fk_gal_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `galerias` */

insert  into `galerias`(`idgaleria`,`idalbum`,`idusuario`,`idtrabajo`,`tipo`,`titulo`,`archivo`,`fechaalta`,`fechabaja`,`estado`) values 
(1,1,1,NULL,'F','Foto de electricista','012555454545448599','2022-04-02 18:18:02',NULL,''),
(2,3,1,1,'V','Video de electricista','012555454545447852','2022-04-02 18:18:02',NULL,''),
(3,NULL,2,NULL,'F','Foto de prueba','5454484087874818','2022-04-02 22:05:41',NULL,''),
(4,2,2,NULL,'F','Titulo','5454484087874818','2022-04-02 22:07:19',NULL,'');

/*Table structure for table `personas` */

DROP TABLE IF EXISTS `personas`;

CREATE TABLE `personas` (
  `idpersona` int(11) NOT NULL AUTO_INCREMENT,
  `iddistrito` varchar(6) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `nombres` varchar(40) NOT NULL,
  `fechanac` date NOT NULL,
  `telefono` char(11) DEFAULT NULL,
  `tipocalle` char(2) NOT NULL,
  `nombrecalle` varchar(60) NOT NULL,
  `numerocalle` varchar(5) DEFAULT NULL,
  `pisodepa` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`idpersona`),
  KEY `fk_per_iddistrito` (`iddistrito`),
  CONSTRAINT `fk_per_iddistrito` FOREIGN KEY (`iddistrito`) REFERENCES `distritos` (`iddistrito`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `personas` */

insert  into `personas`(`idpersona`,`iddistrito`,`apellidos`,`nombres`,`fechanac`,`telefono`,`tipocalle`,`nombrecalle`,`numerocalle`,`pisodepa`) values 
(1,'010117','Magallanes Perez','Luis Enrique','1998-05-25','05695674856','AV','Las palmeras','25','5'),
(2,'010118','Hernandez Monterroza','Adriana Carolina','1999-05-14','05695674858','CA','Los Sauces','150','3'),
(3,'010119','Carvajal Vargas','Alexander','1999-05-14','05695674558','JR','Las Lomas','5','2'),
(4,'010120','Blanca Concha','Angelica Maria','1999-05-14','05695604858','PJ','Cartajena','250','3'),
(5,'010121','Ospina Alfonso','Catherine','1999-05-14','05695674858','AV','Prada N°258','255','2');

/*Table structure for table `provincias` */

DROP TABLE IF EXISTS `provincias`;

CREATE TABLE `provincias` (
  `idprovincia` varchar(4) NOT NULL,
  `provincia` varchar(45) NOT NULL,
  `iddepartamento` varchar(2) NOT NULL,
  PRIMARY KEY (`idprovincia`),
  KEY `fk_iddepartamento_pro` (`iddepartamento`),
  CONSTRAINT `fk_iddepartamento_pro` FOREIGN KEY (`iddepartamento`) REFERENCES `departamentos` (`iddepartamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `provincias` */

insert  into `provincias`(`idprovincia`,`provincia`,`iddepartamento`) values 
('0101','Chachapoyas','01'),
('0102','Bagua','01'),
('0103','Bongará','01'),
('0104','Condorcanqui','01'),
('0105','Luya','01'),
('0106','Rodríguez de Mendoza','01'),
('0107','Utcubamba','01'),
('0201','Huaraz','02'),
('0202','Aija','02'),
('0203','Antonio Raymondi','02'),
('0204','Asunción','02'),
('0205','Bolognesi','02'),
('0206','Carhuaz','02'),
('0207','Carlos Fermín Fitzcarrald','02'),
('0208','Casma','02'),
('0209','Corongo','02'),
('0210','Huari','02'),
('0211','Huarmey','02'),
('0212','Huaylas','02'),
('0213','Mariscal Luzuriaga','02'),
('0214','Ocros','02'),
('0215','Pallasca','02'),
('0216','Pomabamba','02'),
('0217','Recuay','02'),
('0218','Santa','02'),
('0219','Sihuas','02'),
('0220','Yungay','02'),
('0301','Abancay','03'),
('0302','Andahuaylas','03'),
('0303','Antabamba','03'),
('0304','Aymaraes','03'),
('0305','Cotabambas','03'),
('0306','Chincheros','03'),
('0307','Grau','03'),
('0401','Arequipa','04'),
('0402','Camaná','04'),
('0403','Caravelí','04'),
('0404','Castilla','04'),
('0405','Caylloma','04'),
('0406','Condesuyos','04'),
('0407','Islay','04'),
('0408','La Uniòn','04'),
('0501','Huamanga','05'),
('0502','Cangallo','05'),
('0503','Huanca Sancos','05'),
('0504','Huanta','05'),
('0505','La Mar','05'),
('0506','Lucanas','05'),
('0507','Parinacochas','05'),
('0508','Pàucar del Sara Sara','05'),
('0509','Sucre','05'),
('0510','Víctor Fajardo','05'),
('0511','Vilcas Huamán','05'),
('0601','Cajamarca','06'),
('0602','Cajabamba','06'),
('0603','Celendín','06'),
('0604','Chota','06'),
('0605','Contumazá','06'),
('0606','Cutervo','06'),
('0607','Hualgayoc','06'),
('0608','Jaén','06'),
('0609','San Ignacio','06'),
('0610','San Marcos','06'),
('0611','San Miguel','06'),
('0612','San Pablo','06'),
('0613','Santa Cruz','06'),
('0701','Prov. Const. del Callao','07'),
('0801','Cusco','08'),
('0802','Acomayo','08'),
('0803','Anta','08'),
('0804','Calca','08'),
('0805','Canas','08'),
('0806','Canchis','08'),
('0807','Chumbivilcas','08'),
('0808','Espinar','08'),
('0809','La Convención','08'),
('0810','Paruro','08'),
('0811','Paucartambo','08'),
('0812','Quispicanchi','08'),
('0813','Urubamba','08'),
('0901','Huancavelica','09'),
('0902','Acobamba','09'),
('0903','Angaraes','09'),
('0904','Castrovirreyna','09'),
('0905','Churcampa','09'),
('0906','Huaytará','09'),
('0907','Tayacaja','09'),
('1001','Huánuco','10'),
('1002','Ambo','10'),
('1003','Dos de Mayo','10'),
('1004','Huacaybamba','10'),
('1005','Huamalíes','10'),
('1006','Leoncio Prado','10'),
('1007','Marañón','10'),
('1008','Pachitea','10'),
('1009','Puerto Inca','10'),
('1010','Lauricocha ','10'),
('1011','Yarowilca ','10'),
('1101','Ica ','11'),
('1102','Chincha ','11'),
('1103','Nasca ','11'),
('1104','Palpa ','11'),
('1105','Pisco ','11'),
('1201','Huancayo ','12'),
('1202','Concepción ','12'),
('1203','Chanchamayo ','12'),
('1204','Jauja ','12'),
('1205','Junín ','12'),
('1206','Satipo ','12'),
('1207','Tarma ','12'),
('1208','Yauli ','12'),
('1209','Chupaca ','12'),
('1301','Trujillo ','13'),
('1302','Ascope ','13'),
('1303','Bolívar ','13'),
('1304','Chepén ','13'),
('1305','Julcán ','13'),
('1306','Otuzco ','13'),
('1307','Pacasmayo ','13'),
('1308','Pataz ','13'),
('1309','Sánchez Carrión ','13'),
('1310','Santiago de Chuco ','13'),
('1311','Gran Chimú ','13'),
('1312','Virú ','13'),
('1401','Chiclayo ','14'),
('1402','Ferreñafe ','14'),
('1403','Lambayeque ','14'),
('1501','Lima ','15'),
('1502','Barranca ','15'),
('1503','Cajatambo ','15'),
('1504','Canta ','15'),
('1505','Cañete ','15'),
('1506','Huaral ','15'),
('1507','Huarochirí ','15'),
('1508','Huaura ','15'),
('1509','Oyón ','15'),
('1510','Yauyos ','15'),
('1601','Maynas ','16'),
('1602','Alto Amazonas ','16'),
('1603','Loreto ','16'),
('1604','Mariscal Ramón Castilla ','16'),
('1605','Requena ','16'),
('1606','Ucayali ','16'),
('1607','Datem del Marañón ','16'),
('1608','Putumayo','16'),
('1701','Tambopata ','17'),
('1702','Manu ','17'),
('1703','Tahuamanu ','17'),
('1801','Mariscal Nieto ','18'),
('1802','General Sánchez Cerro ','18'),
('1803','Ilo ','18'),
('1901','Pasco ','19'),
('1902','Daniel Alcides Carrión ','19'),
('1903','Oxapampa ','19'),
('2001','Piura ','20'),
('2002','Ayabaca ','20'),
('2003','Huancabamba ','20'),
('2004','Morropón ','20'),
('2005','Paita ','20'),
('2006','Sullana ','20'),
('2007','Talara ','20'),
('2008','Sechura ','20'),
('2101','Puno ','21'),
('2102','Azángaro ','21'),
('2103','Carabaya ','21'),
('2104','Chucuito ','21'),
('2105','El Collao ','21'),
('2106','Huancané ','21'),
('2107','Lampa ','21'),
('2108','Melgar ','21'),
('2109','Moho ','21'),
('2110','San Antonio de Putina ','21'),
('2111','San Román ','21'),
('2112','Sandia ','21'),
('2113','Yunguyo ','21'),
('2201','Moyobamba ','22'),
('2202','Bellavista ','22'),
('2203','El Dorado ','22'),
('2204','Huallaga ','22'),
('2205','Lamas ','22'),
('2206','Mariscal Cáceres ','22'),
('2207','Picota ','22'),
('2208','Rioja ','22'),
('2209','San Martín ','22'),
('2210','Tocache ','22'),
('2301','Tacna ','23'),
('2302','Candarave ','23'),
('2303','Jorge Basadre ','23'),
('2304','Tarata ','23'),
('2401','Tumbes ','24'),
('2402','Contralmirante Villar ','24'),
('2403','Zarumilla ','24'),
('2501','Coronel Portillo ','25'),
('2502','Atalaya ','25'),
('2503','Padre Abad ','25'),
('2504','Purús','25');

/*Table structure for table `redessociales` */

DROP TABLE IF EXISTS `redessociales`;

CREATE TABLE `redessociales` (
  `idredsocial` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `redsocial` char(1) NOT NULL,
  `vinculo` mediumtext NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idredsocial`),
  KEY `fk_reds_idusuario` (`idusuario`),
  CONSTRAINT `fk_reds_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
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
  KEY `fk_rep_idcomentario` (`idcomentario`),
  CONSTRAINT `fk_rep_idcomentario` FOREIGN KEY (`idcomentario`) REFERENCES `comentarios` (`idcomentario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `reportes` */

insert  into `reportes`(`idreporte`,`idcomentario`,`motivo`,`descripcion`,`fotografia`,`fechareporte`) values 
(1,2,'Mesaje indebido','Mala calificación del trabajo','011555555959258','2022-04-02 18:18:28');

/*Table structure for table `seguidores` */

DROP TABLE IF EXISTS `seguidores`;

CREATE TABLE `seguidores` (
  `idseguidor` int(11) NOT NULL AUTO_INCREMENT,
  `idfollowing` int(11) NOT NULL,
  `idfollower` int(11) NOT NULL,
  `fechaseguido` datetime NOT NULL DEFAULT current_timestamp(),
  `fechaeliminado` datetime DEFAULT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idseguidor`),
  UNIQUE KEY `uk_seg_idfollower` (`idfollowing`,`idfollower`),
  KEY `fk_seg_idfollower` (`idfollower`),
  CONSTRAINT `fk_seg_idfollower` FOREIGN KEY (`idfollower`) REFERENCES `usuarios` (`idusuario`),
  CONSTRAINT `fk_seg_idfollowing` FOREIGN KEY (`idfollowing`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `seguidores` */

insert  into `seguidores`(`idseguidor`,`idfollowing`,`idfollower`,`fechaseguido`,`fechaeliminado`,`estado`) values 
(1,1,2,'2022-04-02 18:13:41',NULL,''),
(2,1,3,'2022-04-02 18:13:41',NULL,'');

/*Table structure for table `servicios` */

DROP TABLE IF EXISTS `servicios`;

CREATE TABLE `servicios` (
  `idservicio` int(11) NOT NULL AUTO_INCREMENT,
  `nombreservicio` varchar(50) NOT NULL,
  PRIMARY KEY (`idservicio`),
  UNIQUE KEY `uk_ser_nombreservicio` (`nombreservicio`)
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
  KEY `fk_trab_idespecialidad` (`idespecialidad`),
  KEY `fk_trab_idusuario` (`idusuario`),
  CONSTRAINT `fk_trab_idespecialidad` FOREIGN KEY (`idespecialidad`) REFERENCES `especialidades` (`idespecialidad`),
  CONSTRAINT `fk_trab_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `trabajos` */

insert  into `trabajos`(`idtrabajo`,`idespecialidad`,`idusuario`,`titulo`,`descripcion`,`fechapublicado`,`fechamodificado`,`fechaeliminado`,`estado`) values 
(1,1,1,'Servicio de electricista','Trabajo realizado en etc..','2022-04-02 18:15:52',NULL,NULL,''),
(2,2,1,'Electrista de cableado','Trabajo realizado en ..','2022-04-02 18:15:52',NULL,NULL,'');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `idpersona` int(11) NOT NULL,
  `descripcion` mediumtext DEFAULT NULL,
  `horarioatencion` varchar(80) DEFAULT NULL,
  `nivelusuario` char(1) NOT NULL DEFAULT 'E',
  `rol` char(1) NOT NULL DEFAULT 'U',
  `email` varchar(70) NOT NULL,
  `emailrespaldo` varchar(70) DEFAULT NULL,
  `clave` varchar(80) NOT NULL,
  `fechaalta` datetime NOT NULL DEFAULT current_timestamp(),
  `fechabaja` datetime DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `uk_usu_email` (`email`),
  UNIQUE KEY `uk_usu_idpersoba` (`idpersona`,`idusuario`),
  UNIQUE KEY `uk_usu_idpersona` (`idpersona`),
  UNIQUE KEY `uk_usu_emailrespaldo` (`emailrespaldo`),
  CONSTRAINT `fk_usu_idpersona` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `usuarios` */

insert  into `usuarios`(`idusuario`,`idpersona`,`descripcion`,`horarioatencion`,`nivelusuario`,`rol`,`email`,`emailrespaldo`,`clave`,`fechaalta`,`fechabaja`,`estado`) values 
(1,1,'descripción','Atención de Lunes a Sabado de 08:00 AM a 09:00 PM','E','U','Luis@gmail.com',NULL,'12345','2022-04-02 17:52:45',NULL,'1'),
(2,2,'descipción','Atención de Lunes a Sabado de 08:00 AM a 09:00 PM','E','U','Adriana@gmail.com',NULL,'12345','2022-04-02 17:52:45',NULL,'1'),
(3,3,'Albañil','Miercoles y Viernes','E','A','Alex@gmail.com','alex2@gmail.com','12345','2022-04-02 17:52:45',NULL,'1'),
(7,4,'Excelente en su area','Lunes a sabado de 8:00 Am a 6:00 PM','E','U','angelica@gmail.com',NULL,'124563','2022-04-02 18:39:39',NULL,'1');

/* Procedure structure for procedure `spu_albumes_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_albumes_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_albumes_eliminar`(IN _idalbum INT)
BEGIN
	UPDATE albumes SET 
		estado = 0
	WHERE idalbum = _idalbum;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_albumes_getdata` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_albumes_getdata` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_albumes_getdata`(IN _idalbum INT)
BEGIN
	SELECT * FROM albumes 
		WHERE idalbum = _idalbum AND estado = 1;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_albumes_listar_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_albumes_listar_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_albumes_listar_usuario`(IN _idusuario INT)
BEGIN
	SELECT * FROM albumes 
		WHERE idusuario = _idusuario AND estado = 1;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_albumes_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_albumes_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_albumes_modificar`(
	IN _idalbum			INT,
	IN _nombrealbum VARCHAR(30)
)
BEGIN
	UPDATE albumes SET 
		nombrealbum = _nombrealbum
	WHERE idalbum = _idalbum;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_albumes_predeterminados` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_albumes_predeterminados` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_albumes_predeterminados`(
	IN _idusuario 	INT
)
BEGIN
	INSERT INTO albumes (idusuario, nombrealbum) VALUES
		(_idusuario, 'Perfil');
	INSERT INTO albumes (idusuario, nombrealbum) VALUES
		(_idusuario, 'Portada');
	INSERT INTO albumes (idusuario, nombrealbum) VALUES
		(_idusuario, 'Publicaciones');
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_albumes_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_albumes_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_albumes_registrar`(
	IN _idusuario 	INT,
	IN _nombrealbum VARCHAR(30)
)
BEGIN
	INSERT INTO albumes (idusuario, nombrealbum) VALUES
		(_idusuario, _nombrealbum);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_albunes_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_albunes_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_albunes_eliminar`(IN _idalbum INT)
BEGIN
	UPDATE albunes SET 
		estado = 0
	WHERE idalbum = _idalbum;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_calificaciones_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_calificaciones_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_calificaciones_eliminar`(IN _idcalificacion INT)
BEGIN 
	UPDATE calificaciones SET estado = 0
		WHERE idcalificacion = _idcalificacion;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_calificaciones_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_calificaciones_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_calificaciones_modificar`(
	IN _idcalificacion 	INT,
	IN _puntuacion			TINYINT 
)
BEGIN 
	UPDATE calificaciones SET 
		puntuacion = _puntuacion
	WHERE idcalificacion = _idcalificacion;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_calificaciones_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_calificaciones_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_calificaciones_registrar`(
	IN _idtrabajo		INT,
	IN _idusuario		INT,
	IN _puntuacion	TINYINT 
)
BEGIN 
	INSERT INTO calificaciones (idtrabajo , idusuario , puntuacion) VALUES
		(_idtrabajo , _idusuario , _puntuacion);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_comentarios_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_comentarios_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_comentarios_eliminar`(IN _idcomentario INT)
BEGIN 
	UPDATE comentarios SET estado = 0
		WHERE idtrabajo = _idtrabajo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_comentarios_listar_trabajo` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_comentarios_listar_trabajo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_comentarios_listar_trabajo`(in _idtrabajo int)
BEGIN
	SELECT * FROM vs_comentarios_listar
		where idtrabajo = _idtrabajo
		ORDER BY idcomentario DESC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_comentarios_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_comentarios_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_comentarios_modificar`(
	IN _idcomentario INT,
	IN _comentario	MEDIUMTEXT
)
BEGIN 
	UPDATE comentarios SET
		comentario 			= _comentario,
		fechamodificado = now()
	WHERE idcomentario = _idcomentario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_comentarios_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_comentarios_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_comentarios_registrar`(
	IN _idtrabajo		INT,
	IN _idusuario		INT,
	IN _comentario	MEDIUMTEXT
)
BEGIN 
	INSERT INTO comentarios (idtrabajo , idusuario , comentario ) VALUES 
		(_idtrabajo , _idusuario,_comentario);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_departamentos_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_departamentos_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_departamentos_listar`()
BEGIN
	SELECT * FROM departamentos;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_distritos_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_distritos_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_distritos_listar`(IN _idprovincia VARCHAR(4))
BEGIN
	SELECT * FROM distritos WHERE idprovincia = _idprovincia;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_eliminar_actividades` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_eliminar_actividades` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_eliminar_actividades`(IN _idactividad INT)
BEGIN
	DELETE FROM actividades WHERE idactividad = _idactividad;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_email_verifi` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_email_verifi` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_email_verifi`(
	IN _email VARCHAR(70)
)
BEGIN
	SELECT COUNT(*) FROM usuarios WHERE email = _email;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_especialidades_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_especialidades_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_especialidades_listar`()
BEGIN
   SELECT * FROM vs_especialidades_listar;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_especialidades_listar_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_especialidades_listar_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_especialidades_listar_usuario`(in _idusuario int)
BEGIN
   SELECT idespecialidad, idusuario, idservicio, descripcion
      FROM especialidades
      where idusuario = _idusuario
      ORDER BY idespecialidad DESC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_especialidades_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_especialidades_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_especialidades_modificar`(
    IN _idespecialidad	INT,
    IN _idusuario				INT,
    IN _idservicio			INT,
    IN _descripcion			MEDIUMTEXT,
    IN _tarifa					DECIMAL(7,2)
)
BEGIN 
    UPDATE especialidades SET
       idusuario 		= _idusuario, 
       idservicio 	= _idservicio,
       descripcion 	= _descripcion,
       tarifa 			= _tarifa
    WHERE idespecialidad = _idespecialidad;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_especialidades_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_especialidades_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_especialidades_registrar`(
    IN _idusuario		INT,
    IN _idservicio	INT,
    IN _descripcion	MEDIUMTEXT,
    in _tarifa			decimal(7,2)
)
BEGIN
   INSERT INTO especialidades (idusuario, idservicio, descripcion, tarifa)
      VALUES (_idusuario, _idservicio, _descripcion, _tarifa);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_establecimientos_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_establecimientos_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_establecimientos_eliminar`(IN _idestablecimiento INT)
BEGIN
	UPDATE establecimientos SET
		estado = 0
	WHERE idestablecimiento = _idestablecimiento;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_establecimientos_getdata` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_establecimientos_getdata` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_establecimientos_getdata`(IN _idestablecimiento INT)
BEGIN
	SELECT * FROM establecimientos WHERE idestablecimiento = _idestablecimiento;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_establecimientos_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_establecimientos_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_establecimientos_modificar`(
	IN _idestablecimiento INT,
	IN _idusuario 				INT,
	IN _iddistrito 				VARCHAR(6),
	IN _establecimiento		VARCHAR(30),
	IN _ruc								CHAR(11),
	IN _tipocalle 				CHAR(2),
	IN _nombrecalle 			VARCHAR(60),
	IN _numerocalle 			VARCHAR(5),
	IN _referencia				VARCHAR(80),
	IN _latitud						FLOAT(10, 8),
	IN _longitud					FLOAT(10, 8)
)
BEGIN
	UPDATE establecimientos SET
		idusuario 			= _idusuario,
		iddistrito 			= _iddistrito,
		establecimiento = _establecimiento,
		ruc							= _ruc,
		tipocalle				= _tipocalle,
		nombrecalle			= _nombrecalle,
		numerocalle			= _numerocalle,
		referencia			= _referencia,
		latitud					= _latitud,
		longitud				= _longitud
	WHERE idestablecimiento 	= _idestablecimiento;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_establecimientos_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_establecimientos_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_establecimientos_registrar`(
	IN _idusuario 				int,
	in _iddistrito 				varchar(6),
	IN _establecimiento		VARCHAR(30),
	IN _ruc								CHAR(11),
	in _tipocalle 				CHAR(2),
	in _nombrecalle 			VARCHAR(60),
	in _numerocalle 			VARCHAR(5),
	IN _referencia				VARCHAR(80),
	IN _latitud						FLOAT(10, 8),
	IN _longitud					FLOAT(10, 8)
)
BEGIN
	IF _numerocalle = '' THEN SET _numerocalle = NULL; END IF;
	IF _referencia = '' THEN SET _referencia = NULL; END IF;
	INSERT INTO establecimientos (idusuario, iddistrito, establecimiento, ruc, tipocalle, nombrecalle, numerocalle, referencia, latitud, longitud)
		VALUES (_idusuario, _iddistrito, _establecimiento, _ruc, _tipocalle, _nombrecalle, _numerocalle, _referencia, _latitud, _longitud);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_filtrar_actividad` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_filtrar_actividad` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_filtrar_actividad`(IN _idusuario INT)
BEGIN
	SELECT * FROM vs_listar_actividades WHERE idusuario = _idusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_filtrar_actividad_fecha` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_filtrar_actividad_fecha` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_filtrar_actividad_fecha`(
	IN _idusuario 	INT,
	IN _fechainicio DATE,
	IN _fechafin		DATE
)
BEGIN
	SELECT * FROM vs_listar_actividades 
		WHERE idusuario = _idusuario AND 
			fecha BETWEEN _fechainicio AND _fechafin;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_filtrar_reportes_fecha` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_filtrar_reportes_fecha` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_filtrar_reportes_fecha`(
	IN _fechainicio DATE, 
	IN _fechafin 		DATE
)
BEGIN
	SELECT * FROM vs_listar_reportes 
		WHERE fechareporte BETWEEN _fechainicio AND _fechafin;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_filtrar_reportes_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_filtrar_reportes_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_filtrar_reportes_usuario`(
	IN _nombres 	VARCHAR(40), 
	IN _apellidos VARCHAR(40)
)
BEGIN
	SELECT * FROM vs_listar_reportes 
		WHERE usuario LIKE CONCAT('%',_apellidos,'%') OR 
					usuario LIKE  CONCAT('%',_nombres,'%');
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_foros_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_foros_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_foros_eliminar`(
	IN  _idforo	INT
)
BEGIN
	UPDATE foros SET 
		estado = 0
		WHERE idforo = _idforo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_foros_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_foros_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_foros_modificar`(
	IN _idforo			INT,
	IN _consulta		MEDIUMTEXT
)
BEGIN
	UPDATE foros SET
		consulta = _consulta
	WHERE idforo = _idforo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_foros_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_foros_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_foros_registrar`(
	IN _idtousuario		INT,
	IN _idfromusuario	INT,
	IN _consulta 			MEDIUMTEXT
)
BEGIN 
	INSERT INTO foros (idtousuario, idfromusuario, consulta)
		VALUES(_idtousuario, _idfromusuario, _consulta);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_galerias_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_galerias_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_galerias_eliminar`(IN _idgaleria INT)
BEGIN
	UPDATE galerias SET estado = 0
		WHERE idgaleria = _idgaleria;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_galerias_getdata` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_galerias_getdata` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_galerias_getdata`(IN _idgaleria INT)
BEGIN
	SELECT * FROM vs_galerias_listar WHERE idgaleria = _idgaleria;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_galerias_listar_album` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_galerias_listar_album` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_galerias_listar_album`(IN _idalbum INT)
BEGIN
	SELECT * FROM vs_galerias_listar WHERE idalbum = _idalbum;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_galerias_listar_trabajo` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_galerias_listar_trabajo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_galerias_listar_trabajo`(IN _idtrabajo INT)
BEGIN
	SELECT * FROM vs_galerias_listar WHERE idtrabajo = _idtrabajo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_galerias_listar_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_galerias_listar_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_galerias_listar_usuario`(in _idusuario int)
BEGIN
	SELECT * FROM vs_galerias_listar where idusuario = _idusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_galerias_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_galerias_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_galerias_modificar`(
	IN _idgaleria INT,
	IN _idalbum 	INT,
	IN _titulo 		VARCHAR(45)
)
BEGIN
	IF _idalbum = '' THEN SET _idalbum = NULL; END IF;
	
	UPDATE galerias SET
		idalbum 	= _idalbum,
		titulo 		= _titulo
	WHERE idgaleria = _idgaleria;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_galerias_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_galerias_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_galerias_registrar`(
	IN _idalbum 	INT,
	in _idusuario int,
	IN _idtrabajo INT,
	IN _tipo 			CHAR(1),
	IN _titulo 		VARCHAR(45),
	IN _archivo 	VARCHAR(100)
)
BEGIN
	IF _idalbum = '' THEN SET _idalbum = NULL; END IF;
	IF _idtrabajo = '' THEN SET _idtrabajo = NULL; END IF;
	
	INSERT INTO galerias (idalbum, idusuario, idtrabajo, tipo, titulo, archivo) VALUES
		(_idalbum, _idusuario, _idtrabajo, _tipo, _titulo, _archivo);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_grafico_niveles_usu` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_grafico_niveles_usu` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_grafico_niveles_usu`()
BEGIN
	SELECT nivelusuario , COUNT(idusuario) AS 'totalusuario'
		FROM usuarios
	GROUP BY nivelusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_grafico_popular` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_grafico_popular` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_grafico_popular`()
BEGIN
	SELECT SER.nombreservicio, SUM(puntuacion)AS'calificación'
		FROM calificaciones CAL
		INNER JOIN trabajos TRA ON TRA.idtrabajo = CAL.idtrabajo
		INNER JOIN especialidades ESP ON ESP.idespecialidad = TRA.idespecialidad
		INNER JOIN servicios SER ON SER.idservicio = ESP.idservicio
	GROUP BY SER.nombreservicio;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_grafico_reportes` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_grafico_reportes` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_grafico_reportes`()
BEGIN
	SELECT MONTHNAME(fechareporte)AS 'mes', COUNT(idreporte)AS 'reportes'
		FROM reportes
	GROUP BY MONTHNAME(fechareporte)
	ORDER BY MONTH(fechareporte) ASC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_grafico_reportes_year` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_grafico_reportes_year` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_grafico_reportes_year`()
BEGIN
	SELECT YEAR(fechareporte) AS 'year', COUNT(idreporte)AS 'reportes'
		FROM reportes
	GROUP BY YEAR(fechareporte)
	ORDER BY 1 ASC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_listar_actividades` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_listar_actividades` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_listar_actividades`()
BEGIN
	SELECT * FROM vs_listar_actividades;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_listar_fotos` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_listar_fotos` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_listar_fotos`(
	IN _idtrabajo INT
)
BEGIN 
	SELECT GAL.idgaleria ,ALB.nombrealbum,GAL.tipo,GAL.titulo,GAL.archivo
		FROM galerias GAL
		INNER JOIN albunes ALB ON ALB.idalbum = GAL.idalbum
		WHERE idtrabajo = _idtrabajo; 
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_listar_reportes` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_listar_reportes` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_listar_reportes`()
BEGIN
	SELECT * FROM vs_listar_reportes;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_modificar_actividades` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_modificar_actividades` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_modificar_actividades`(	
	IN _idactividad			INT,
	IN _idespecialidad 	INT,
	IN _fecha 					DATETIME,
	IN _hora 						TIME,
	IN _titulo					VARCHAR(45),
	IN _descripcion			VARCHAR(150),
	IN _direccion				VARCHAR(80)
)
BEGIN
	UPDATE actividades SET 	
		idespecialidad 	= _idespecialidad, 
		fecha 					= _fecha, 
		hora 						= _hora,
		titulo 					= _titulo, 
		descripcion 		= _descripcion, 
		direccion 			= _direccion
	WHERE idactividad = _idactividad;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_personas_getdata` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_personas_getdata` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_personas_getdata`(IN _idpersona INT)
BEGIN
	SELECT * FROM personas WHERE idpersona = _idpersona;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_personas_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_personas_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_personas_modificar`(
	IN _idpersona 		INT,
	IN _iddistrito 		VARCHAR(6),
	IN _apellidos			VARCHAR(40),
	IN _nombres				VARCHAR(40), 
	IN _fechanac			DATE,
	IN _telefono			CHAR(11),
	IN _tipocalle 		CHAR(2),	
	IN _nombrecalle 	VARCHAR(60),
	IN _numerocalle 	VARCHAR(5),
	IN _pisodepa  		VARCHAR(5)
)
BEGIN
	IF _telefono = ''  THEN SET _telefono  = NULL; END IF;
	IF _numerocalle = ''  THEN SET _numerocalle  = NULL; END IF;
	IF _pisodepa = '' THEN SET _pisodepa = NULL; END IF;
	
	UPDATE personas SET
		iddistrito 	= _iddistriro,
		apellidos 	= _apellidos, 
		nombres 		= _nombres, 
		fechanac 		= _fechanac,
		telefono 		= _telefono,
		tipocalle 	= _tipocalle,
		nombrecalle = _nombrecalle,
		numerocalle = _numerocalle,
		pisodepa 		= _pisodepa
	WHERE idpersona = _idpersona; 
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_personas_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_personas_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_personas_registrar`(
	IN _iddistrito 	VARCHAR(6),
	IN _apellidos		VARCHAR(40),
	IN _nombres			VARCHAR(40), 
	IN _fechanac		DATE,
	IN _telefono		CHAR(11),
	IN _tipocalle 	CHAR(2),	
	IN _nombrecalle VARCHAR(60),
	IN _numerocalle VARCHAR(5),
	IN _pisodepa  	VARCHAR(5)
)
BEGIN
	IF _telefono = ''  THEN SET _telefono  = NULL; END IF;
	IF _numerocalle = ''  THEN SET _numerocalle  = NULL; END IF;
	IF _pisodepa = '' THEN SET _pisodepa = NULL; END IF;
	
	INSERT INTO personas (iddistrito, apellidos, nombres, fechanac, telefono, tipocalle, nombrecalle, numerocalle, pisodepa)
		VALUES (_iddistrito, _apellidos, _nombres, _fechanac, _telefono, _tipocalle, _nombrecalle, _numerocalle, _pisodepa);
		
	SELECT LAST_INSERT_ID();
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_provincias_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_provincias_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_provincias_listar`(in _iddepartamento	VARCHAR(2))
BEGIN
	SELECT * FROM provincias where iddepartamento = _iddepartamento;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_redessociales_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_redessociales_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_redessociales_eliminar`(
	IN _idredsocial INT
)
BEGIN
	DELETE FROM redessociaes WHERE idredsocial = _idredsocial;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_redessociales_filtrar_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_redessociales_filtrar_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_redessociales_filtrar_usuario`(IN _idusuario int)
BEGIN
	SELECT 	RDS.idredsocial, USU.idusuario,
					PER.nombres, PER.apellidos,
					RDS.redsocial, RDS.vinculo 
		FROM redessociales RDS
		INNER JOIN usuarios USU ON USU.idusuario = RDS.idusuario
		INNER JOIN personas PER ON PER.idpersona = USU.idpersona
		WHERE USU.idusuario = _idusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_redessociales_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_redessociales_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_redessociales_modificar`(
	IN _idredsocial		INT,
	IN _redsocial			CHAR(1),
	IN _vinculo				MEDIUMTEXT
)
BEGIN
	UPDATE productos SET
		redsocial = _redsocial,
		 vinculo  = _vinculo
	WHERE idredsocial = _idredsocial;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_redessociales_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_redessociales_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_redessociales_registrar`(
	IN _idusuario	INT,
	IN _redsocial	CHAR(1), -- F = Facebook, I = Instagram, W = Whatsapp, T = Twitter, Y = Youtube, K = Tik Tok
	IN _vinculo	MEDIUMTEXT
)
BEGIN 
	INSERT INTO redessociales (idusuario, redsocial, vinculo)
		VALUES(_idusuario, _redsocial, _vinculo);
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_registrar_actividades` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_registrar_actividades` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_registrar_actividades`(
	IN _idespecialidad 	INT,
	IN _fecha 					DATETIME,
	IN _hora 						TIME,
	IN _titulo					VARCHAR(45),
	IN _descripcion			VARCHAR(150),
	IN _direccion				VARCHAR(80)
)
BEGIN 
	INSERT INTO actividades (idespecialidad, fecha, hora, titulo, descripcion, direccion) VALUES
	(_idespecialidad, _idespecialidad, _fecha, _hora, _titulo, _descripcion, _direccion);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_reportes_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_reportes_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_reportes_registrar`(
	in _idcomentario int,
	in _motivo 			 varchar(30),
	in _descripcion	 mediumtext,
	in _fotografia 	 varchar(100)
)
BEGIN
if _fotografia = '' then set _fotografia = null; end if;
INSERT INTO reportes (idcomentario, motivo, descripcion, fotografia)
	values(_idcomentario, _motivo, _descripcion, _fotografia);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_seguidores_conteo` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_seguidores_conteo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_seguidores_conteo`(IN _idusuario INT)
BEGIN
	SELECT COUNT(idfollowing) AS 'totalseguidores'
	 FROM seguidores 
	WHERE idfollowing = _idusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_seguidores_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_seguidores_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_seguidores_listar`(IN _idusuario INT)
BEGIN 
	SELECT  SEG.idfollower, PER.nombres, PER.apellidos, SEG.fechaseguido
		FROM seguidores SEG
		INNER JOIN usuarios USU ON USU.idusuario = SEG.idfollower
		INNER JOIN personas PER ON PER.idpersona = USU.idpersona
	WHERE idfollowing = _idusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_seguidos_conteo` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_seguidos_conteo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_seguidos_conteo`(IN _idusuario INT)
BEGIN
	SELECT COUNT(idfollower) AS 'totalseguidos'
	 FROM seguidores 
	WHERE idfollower = _idusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_seguidos_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_seguidos_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_seguidos_listar`(IN _idusuario INT)
BEGIN 
	SELECT SEG.idfollowing, PER.nombres, PER.apellidos, SEG.fechaseguido, SEG.estado
		FROM seguidores SEG
		INNER JOIN usuarios USU ON USU.idusuario = SEG.idfollowing
		INNER JOIN personas PER ON PER.idpersona = USU.idpersona
	WHERE idfollower = _idusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_seguidos_listar_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_seguidos_listar_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_seguidos_listar_usuario`(IN _idusuario INT)
BEGIN
SELECT * FROM seguidores WHERE idfollower = _idusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_servicios_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_servicios_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_servicios_listar`()
BEGIN
   SELECT idservicio, nombreservicio
      FROM servicios
      ORDER BY idservicio DESC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_servicios_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_servicios_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_servicios_modificar`(
    IN _idservicio        INT,
    IN _nombreservicio    VARCHAR(50)
)
BEGIN 
    UPDATE servicios SET
       nombreservicio = _nombreservicio
    WHERE idservicio = _idservicio;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_servicios_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_servicios_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_servicios_registrar`(
    IN _nombreservicio VARCHAR(50)
)
BEGIN
   INSERT INTO servicios (nombreservicio)
      VALUES (_nombreservicio);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_total_calificaciones_trabajo` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_total_calificaciones_trabajo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_total_calificaciones_trabajo`(
	IN _idtrabajo INT
)
BEGIN 
	SELECT CALI.idcalificacion,CONCAT (PERS.nombres , ' ', PERS.apellidos) AS 'usuario', idtrabajo , 
				 SUM(CALI.puntuacion) AS 'totalpuntuacion', COUNT(*) AS 'totalpersona'
		FROM calificaciones CALI
		INNER JOIN usuarios USU ON USU.idusuario = CALI.idusuario
		INNER JOIN personas PERS ON PERS.idpersona = USU.idpersona
		WHERE idtrabajo = _idtrabajo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_trabajos_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_trabajos_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_trabajos_eliminar`(IN _idtrabajo INT)
BEGIN 
	UPDATE trabajos SET estado = 0
		WHERE idtrabajo = _idtrabajo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_trabajos_listar_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_trabajos_listar_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_trabajos_listar_usuario`(in _idusuario int)
BEGIN
	SELECT * FROM vs_trabajos_listar
		where idusuario = _idusuario
		ORDER BY idtrabajo DESC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_trabajos_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_trabajos_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_trabajos_modificar`(	
	IN _idtrabajo				INT ,
	IN _idespecialidad	INT ,
	IN _idusuario				INT ,
	IN _titulo					VARCHAR(40),
	IN _descripcion			MEDIUMTEXT
)
BEGIN 
	UPDATE trabajos SET 
		idespecialidad = _idespecialidad,
		idusuario 		 = _idusuario,
		titulo				 = _titulo,
		descripcion		 = _descripcion
	WHERE idtrabajo = _idtrabajo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_trabajos_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_trabajos_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_trabajos_registrar`(
	IN _idespecialidad	INT ,
	IN _idusuario				INT ,
	IN _titulo					VARCHAR(40),
	IN _descripcion			MEDIUMTEXT
)
BEGIN 
	INSERT INTO trabajos (idespecialidad , idusuario, titulo ,descripcion) VALUES
		(_idespecialidad , _idusuario , _titulo , _descripcion);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuarios_edit_rol` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuarios_edit_rol` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_edit_rol`(
	in _idusuario int,
	in _rol 			char(1)
)
begin
	update usuarios set rol = _rol 
		where idusuario = _idusuario;
end */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuarios_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuarios_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_eliminar`(IN _idusuario INT)
BEGIN
	UPDATE usuarios SET estado = 0 
		WHERE idusuario = _idusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuarios_filtrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuarios_filtrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_filtrar`(
	IN _idservicio 		 INT,
	in _iddepartamento varchar(2)
)
BEGIN
		SELECT * FROM vs_usuarios_servicio
			where idservicio = _idservicio or iddepartamento = _iddepartamento;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuarios_filtrar_rol` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuarios_filtrar_rol` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_filtrar_rol`(in _rol char(1))
BEGIN
	SELECT * FROM vs_usuarios_listar
		where rol = _rol;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuarios_getdata` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuarios_getdata` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_getdata`(IN _idusuario INT)
BEGIN
	SELECT * FROM vs_usuarios_listar
		WHERE idusuario = _idusuario;
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

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_login`(IN _email VARCHAR(70))
BEGIN
	select * from usuarios
		WHERE email = _email;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuarios_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuarios_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_modificar`(
	IN _idusuario 			INT,
	IN _idpersona 			INT,
	IN _descripcion 		MEDIUMTEXT,
	IN _horarioatencion VARCHAR(80),
	IN _email 					VARCHAR(70),
	IN _emailrespaldo		VARCHAR(70),
	IN _clave	 					VARCHAR(80)
)
BEGIN
	IF _descripcion = '' THEN SET _descripcion = NULL; END IF;
	IF _emailrespaldo = '' THEN SET _emailrespaldo = NULL; END IF;
	
	UPDATE usuarios SET 
		idpersona 			= _idpersona,
		descripcion 		= _descripcion,
		horarioatencion = _horarioatencion,
		email 					= _email,
		emailrespaldo 	= _emailrespaldo,
		clave 					= _clave
	WHERE idusuario = _idusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuarios_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuarios_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_registrar`(
	IN _idpersona 			INT,
	IN _descripcion 		MEDIUMTEXT,
	IN _horarioatencion VARCHAR(80),
	IN _email 					VARCHAR(70),
	IN _emailrespaldo		VARCHAR(70),
	IN _clave	 					VARCHAR(80)
)
BEGIN
	IF _descripcion = '' THEN SET _descripcion = NULL; END IF;
	IF _emailrespaldo = '' THEN SET _emailrespaldo = NULL; END IF;
	IF _horarioatencion = '' THEN SET _horarioatencion = NULL; END IF;
	INSERT INTO usuarios (idpersona, descripcion, horarioatencion, email, emailrespaldo, clave) VALUES 
		(_idpersona, _descripcion, _horarioatencion, _email, _emailrespaldo, _clave);
	
	SELECT LAST_INSERT_ID();
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuarios_search` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuarios_search` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_search`(IN _search varchar(40))
BEGIN
	SELECT * FROM vs_usuarios_listar
		WHERE nombres like concat('%', _search, '%') or 
					apellidos like concat('%', _search, '%');
END */$$
DELIMITER ;

/*Table structure for table `vs_calificaciones_listar` */

DROP TABLE IF EXISTS `vs_calificaciones_listar`;

/*!50001 DROP VIEW IF EXISTS `vs_calificaciones_listar` */;
/*!50001 DROP TABLE IF EXISTS `vs_calificaciones_listar` */;

/*!50001 CREATE TABLE  `vs_calificaciones_listar`(
 `idcalificacion` int(11) ,
 `idtrabajo` int(11) ,
 `titulotrabajo` varchar(40) ,
 `idpersona` int(11) ,
 `apellidos` varchar(40) ,
 `nombres` varchar(40) ,
 `puntuacion` tinyint(4) 
)*/;

/*Table structure for table `vs_comentarios_listar` */

DROP TABLE IF EXISTS `vs_comentarios_listar`;

/*!50001 DROP VIEW IF EXISTS `vs_comentarios_listar` */;
/*!50001 DROP TABLE IF EXISTS `vs_comentarios_listar` */;

/*!50001 CREATE TABLE  `vs_comentarios_listar`(
 `idcomentario` int(11) ,
 `idtrabajo` int(11) ,
 `titulotrabajo` varchar(40) ,
 `apellidos` varchar(40) ,
 `nombres` varchar(40) ,
 `comentario` mediumtext ,
 `fechacomentado` datetime 
)*/;

/*Table structure for table `vs_especialidades_listar` */

DROP TABLE IF EXISTS `vs_especialidades_listar`;

/*!50001 DROP VIEW IF EXISTS `vs_especialidades_listar` */;
/*!50001 DROP TABLE IF EXISTS `vs_especialidades_listar` */;

/*!50001 CREATE TABLE  `vs_especialidades_listar`(
 `idespecialidad` int(11) ,
 `idusuario` int(11) ,
 `datosusuario` varchar(81) ,
 `nombreservicio` varchar(50) ,
 `telefono` char(11) ,
 `email` varchar(70) 
)*/;

/*Table structure for table `vs_galerias_listar` */

DROP TABLE IF EXISTS `vs_galerias_listar`;

/*!50001 DROP VIEW IF EXISTS `vs_galerias_listar` */;
/*!50001 DROP TABLE IF EXISTS `vs_galerias_listar` */;

/*!50001 CREATE TABLE  `vs_galerias_listar`(
 `idgaleria` int(11) ,
 `idalbum` int(11) ,
 `nombrealbum` varchar(30) ,
 `idusuario` int(11) ,
 `apellidos` varchar(40) ,
 `nombres` varchar(40) ,
 `idtrabajo` int(11) ,
 `titulo` varchar(40) ,
 `tipo` char(1) ,
 `nombrefoto` varchar(45) ,
 `archivo` varchar(100) ,
 `fechaalta` datetime 
)*/;

/*Table structure for table `vs_listar_actividades` */

DROP TABLE IF EXISTS `vs_listar_actividades`;

/*!50001 DROP VIEW IF EXISTS `vs_listar_actividades` */;
/*!50001 DROP TABLE IF EXISTS `vs_listar_actividades` */;

/*!50001 CREATE TABLE  `vs_listar_actividades`(
 `ID` int(11) ,
 `idusuario` int(11) ,
 `idservicio` int(11) ,
 `nombreservicio` varchar(50) ,
 `idespecialidad` int(11) ,
 `especialidad` mediumtext ,
 `fecha` date ,
 `hora` time ,
 `titulo` varchar(45) ,
 `descripcion` varchar(150) ,
 `direccion` varchar(80) 
)*/;

/*Table structure for table `vs_listar_reportes` */

DROP TABLE IF EXISTS `vs_listar_reportes`;

/*!50001 DROP VIEW IF EXISTS `vs_listar_reportes` */;
/*!50001 DROP TABLE IF EXISTS `vs_listar_reportes` */;

/*!50001 CREATE TABLE  `vs_listar_reportes`(
 `idreporte` int(11) ,
 `idcomentario` int(11) ,
 `usuario` varchar(81) ,
 `motivo` varchar(30) ,
 `descripcion` mediumtext ,
 `fechareporte` datetime ,
 `fotografia` varchar(100) 
)*/;

/*Table structure for table `vs_personas_listar` */

DROP TABLE IF EXISTS `vs_personas_listar`;

/*!50001 DROP VIEW IF EXISTS `vs_personas_listar` */;
/*!50001 DROP TABLE IF EXISTS `vs_personas_listar` */;

/*!50001 CREATE TABLE  `vs_personas_listar`(
 `idpersona` int(11) ,
 `apellidos` varchar(40) ,
 `nombres` varchar(40) ,
 `fechanac` date ,
 `telefono` char(11) ,
 `direccion` varchar(86) ,
 `iddistrito` varchar(6) ,
 `distrito` varchar(45) ,
 `idprovincia` varchar(4) ,
 `provincia` varchar(45) ,
 `iddepartamento` varchar(2) ,
 `departamento` varchar(45) 
)*/;

/*Table structure for table `vs_trabajos_listar` */

DROP TABLE IF EXISTS `vs_trabajos_listar`;

/*!50001 DROP VIEW IF EXISTS `vs_trabajos_listar` */;
/*!50001 DROP TABLE IF EXISTS `vs_trabajos_listar` */;

/*!50001 CREATE TABLE  `vs_trabajos_listar`(
 `idtrabajo` int(11) ,
 `idusuario` int(11) ,
 `idpersona` int(11) ,
 `apellidos` varchar(40) ,
 `nombres` varchar(40) ,
 `trabajorealizar` varchar(40) ,
 `descripcion` mediumtext 
)*/;

/*Table structure for table `vs_usuarios_listar` */

DROP TABLE IF EXISTS `vs_usuarios_listar`;

/*!50001 DROP VIEW IF EXISTS `vs_usuarios_listar` */;
/*!50001 DROP TABLE IF EXISTS `vs_usuarios_listar` */;

/*!50001 CREATE TABLE  `vs_usuarios_listar`(
 `idusuario` int(11) ,
 `idpersona` int(11) ,
 `apellidos` varchar(40) ,
 `nombres` varchar(40) ,
 `iddepartamento` varchar(2) ,
 `departamento` varchar(45) ,
 `idprovincia` varchar(4) ,
 `provincia` varchar(45) ,
 `iddistrito` varchar(6) ,
 `distrito` varchar(45) ,
 `direccion` varchar(86) ,
 `descripcion` mediumtext ,
 `horarioatencion` varchar(80) ,
 `rol` char(1) ,
 `email` varchar(70) ,
 `emailrespaldo` varchar(70) ,
 `clave` varchar(80) ,
 `idestablecimiento` int(11) ,
 `establecimiento` varchar(30) ,
 `ruc` char(11) ,
 `ubicacion` varchar(80) ,
 `referencia` varchar(80) ,
 `latitud` float(10,8) ,
 `longitud` float(10,8) ,
 `fechaalta` datetime ,
 `estado` char(1) 
)*/;

/*View structure for view vs_calificaciones_listar */

/*!50001 DROP TABLE IF EXISTS `vs_calificaciones_listar` */;
/*!50001 DROP VIEW IF EXISTS `vs_calificaciones_listar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vs_calificaciones_listar` AS select `cali`.`idcalificacion` AS `idcalificacion`,`trab`.`idtrabajo` AS `idtrabajo`,`trab`.`titulo` AS `titulotrabajo`,`pers`.`idpersona` AS `idpersona`,`pers`.`apellidos` AS `apellidos`,`pers`.`nombres` AS `nombres`,`cali`.`puntuacion` AS `puntuacion` from (((`calificaciones` `cali` join `trabajos` `trab` on(`trab`.`idtrabajo` = `cali`.`idtrabajo`)) join `usuarios` `usu` on(`usu`.`idusuario` = `cali`.`idusuario`)) left join `personas` `pers` on(`pers`.`idpersona` = `usu`.`idpersona`)) where `cali`.`estado` = 1 */;

/*View structure for view vs_comentarios_listar */

/*!50001 DROP TABLE IF EXISTS `vs_comentarios_listar` */;
/*!50001 DROP VIEW IF EXISTS `vs_comentarios_listar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vs_comentarios_listar` AS select `com`.`idcomentario` AS `idcomentario`,`trab`.`idtrabajo` AS `idtrabajo`,`trab`.`titulo` AS `titulotrabajo`,`pers`.`apellidos` AS `apellidos`,`pers`.`nombres` AS `nombres`,`com`.`comentario` AS `comentario`,`com`.`fechacomentado` AS `fechacomentado` from (((`comentarios` `com` join `trabajos` `trab` on(`trab`.`idtrabajo` = `com`.`idtrabajo`)) join `usuarios` `usu` on(`usu`.`idusuario` = `com`.`idusuario`)) left join `personas` `pers` on(`pers`.`idpersona` = `usu`.`idpersona`)) where `trab`.`estado` = 1 */;

/*View structure for view vs_especialidades_listar */

/*!50001 DROP TABLE IF EXISTS `vs_especialidades_listar` */;
/*!50001 DROP VIEW IF EXISTS `vs_especialidades_listar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vs_especialidades_listar` AS select `esp`.`idespecialidad` AS `idespecialidad`,`usu`.`idusuario` AS `idusuario`,concat(`pers`.`nombres`,' ',`pers`.`apellidos`) AS `datosusuario`,`srv`.`nombreservicio` AS `nombreservicio`,`pers`.`telefono` AS `telefono`,`usu`.`email` AS `email` from (((`especialidades` `esp` join `servicios` `srv` on(`srv`.`idservicio` = `esp`.`idservicio`)) join `usuarios` `usu` on(`usu`.`idusuario` = `esp`.`idusuario`)) join `personas` `pers` on(`pers`.`idpersona` = `usu`.`idpersona`)) group by `usu`.`idusuario` */;

/*View structure for view vs_galerias_listar */

/*!50001 DROP TABLE IF EXISTS `vs_galerias_listar` */;
/*!50001 DROP VIEW IF EXISTS `vs_galerias_listar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vs_galerias_listar` AS select `glr`.`idgaleria` AS `idgaleria`,`alb`.`idalbum` AS `idalbum`,`alb`.`nombrealbum` AS `nombrealbum`,`vul`.`idusuario` AS `idusuario`,`vul`.`apellidos` AS `apellidos`,`vul`.`nombres` AS `nombres`,`tbj`.`idtrabajo` AS `idtrabajo`,`tbj`.`titulo` AS `titulo`,`glr`.`tipo` AS `tipo`,`glr`.`titulo` AS `nombrefoto`,`glr`.`archivo` AS `archivo`,`glr`.`fechaalta` AS `fechaalta` from (((`galerias` `glr` left join `albumes` `alb` on(`alb`.`idalbum` = `glr`.`idalbum`)) join `vs_usuarios_listar` `vul` on(`vul`.`idusuario` = `glr`.`idusuario`)) left join `trabajos` `tbj` on(`tbj`.`idtrabajo` = `glr`.`idtrabajo`)) where `glr`.`estado` = 1 */;

/*View structure for view vs_listar_actividades */

/*!50001 DROP TABLE IF EXISTS `vs_listar_actividades` */;
/*!50001 DROP VIEW IF EXISTS `vs_listar_actividades` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vs_listar_actividades` AS select `act`.`idactividad` AS `ID`,`esp`.`idusuario` AS `idusuario`,`ser`.`idservicio` AS `idservicio`,`ser`.`nombreservicio` AS `nombreservicio`,`esp`.`idespecialidad` AS `idespecialidad`,`esp`.`descripcion` AS `especialidad`,`act`.`fecha` AS `fecha`,`act`.`hora` AS `hora`,`act`.`titulo` AS `titulo`,`act`.`descripcion` AS `descripcion`,`act`.`direccion` AS `direccion` from ((`especialidades` `esp` join `actividades` `act` on(`esp`.`idespecialidad` = `act`.`idespecialidad`)) join `servicios` `ser` on(`ser`.`idservicio` = `esp`.`idservicio`)) */;

/*View structure for view vs_listar_reportes */

/*!50001 DROP TABLE IF EXISTS `vs_listar_reportes` */;
/*!50001 DROP VIEW IF EXISTS `vs_listar_reportes` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vs_listar_reportes` AS select `rep`.`idreporte` AS `idreporte`,`com`.`idcomentario` AS `idcomentario`,concat(`prs`.`nombres`,' ',`prs`.`apellidos`) AS `usuario`,`rep`.`motivo` AS `motivo`,`rep`.`descripcion` AS `descripcion`,`rep`.`fechareporte` AS `fechareporte`,`rep`.`fotografia` AS `fotografia` from (((`comentarios` `com` join `reportes` `rep` on(`rep`.`idcomentario` = `com`.`idcomentario`)) join `usuarios` `usu` on(`usu`.`idusuario` = `com`.`idusuario`)) join `personas` `prs` on(`prs`.`idpersona` = `usu`.`idusuario`)) */;

/*View structure for view vs_personas_listar */

/*!50001 DROP TABLE IF EXISTS `vs_personas_listar` */;
/*!50001 DROP VIEW IF EXISTS `vs_personas_listar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vs_personas_listar` AS select `prs`.`idpersona` AS `idpersona`,`prs`.`apellidos` AS `apellidos`,`prs`.`nombres` AS `nombres`,`prs`.`fechanac` AS `fechanac`,`prs`.`telefono` AS `telefono`,concat(case when `prs`.`tipocalle` like 'CA' then 'Calle' when `prs`.`tipocalle` like 'AV' then 'Avenida' when `prs`.`tipocalle` like 'UR' then 'Urbanización' when `prs`.`tipocalle` like 'PJ' then 'Pasaje' when `prs`.`tipocalle` like 'JR' then 'Jirón' end,' ',`prs`.`nombrecalle`,' #',`prs`.`numerocalle`,' ',`prs`.`pisodepa`) AS `direccion`,`dst`.`iddistrito` AS `iddistrito`,`dst`.`distrito` AS `distrito`,`prv`.`idprovincia` AS `idprovincia`,`prv`.`provincia` AS `provincia`,`dpt`.`iddepartamento` AS `iddepartamento`,`dpt`.`departamento` AS `departamento` from (((`personas` `prs` join `distritos` `dst` on(`dst`.`iddistrito` = `prs`.`iddistrito`)) join `provincias` `prv` on(`prv`.`idprovincia` = `dst`.`idprovincia`)) join `departamentos` `dpt` on(`dpt`.`iddepartamento` = `prv`.`iddepartamento`)) */;

/*View structure for view vs_trabajos_listar */

/*!50001 DROP TABLE IF EXISTS `vs_trabajos_listar` */;
/*!50001 DROP VIEW IF EXISTS `vs_trabajos_listar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vs_trabajos_listar` AS select `tbj`.`idtrabajo` AS `idtrabajo`,`usu`.`idusuario` AS `idusuario`,`pers`.`idpersona` AS `idpersona`,`pers`.`apellidos` AS `apellidos`,`pers`.`nombres` AS `nombres`,`tbj`.`titulo` AS `trabajorealizar`,`tbj`.`descripcion` AS `descripcion` from (`galerias` `gal` left join ((`trabajos` `tbj` join `usuarios` `usu` on(`usu`.`idusuario` = `tbj`.`idusuario`)) left join `personas` `pers` on(`pers`.`idpersona` = `usu`.`idpersona`)) on(`gal`.`idgaleria` = `tbj`.`idtrabajo`)) where `tbj`.`estado` = 1 */;

/*View structure for view vs_usuarios_listar */

/*!50001 DROP TABLE IF EXISTS `vs_usuarios_listar` */;
/*!50001 DROP VIEW IF EXISTS `vs_usuarios_listar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vs_usuarios_listar` AS select `usu`.`idusuario` AS `idusuario`,`vpl`.`idpersona` AS `idpersona`,`vpl`.`apellidos` AS `apellidos`,`vpl`.`nombres` AS `nombres`,`vpl`.`iddepartamento` AS `iddepartamento`,`vpl`.`departamento` AS `departamento`,`vpl`.`idprovincia` AS `idprovincia`,`vpl`.`provincia` AS `provincia`,`vpl`.`iddistrito` AS `iddistrito`,`vpl`.`distrito` AS `distrito`,`vpl`.`direccion` AS `direccion`,`usu`.`descripcion` AS `descripcion`,`usu`.`horarioatencion` AS `horarioatencion`,`usu`.`rol` AS `rol`,`usu`.`email` AS `email`,`usu`.`emailrespaldo` AS `emailrespaldo`,`usu`.`clave` AS `clave`,`est`.`idestablecimiento` AS `idestablecimiento`,`est`.`establecimiento` AS `establecimiento`,`est`.`ruc` AS `ruc`,concat(case when `est`.`tipocalle` like 'CA' then 'Calle' when `est`.`tipocalle` like 'AV' then 'Avenida' when `est`.`tipocalle` like 'UR' then 'Urbanización' when `est`.`tipocalle` like 'PJ' then 'Pasaje' when `est`.`tipocalle` like 'JR' then 'Jirón' end,' ',`est`.`nombrecalle`,' #',`est`.`numerocalle`) AS `ubicacion`,`est`.`referencia` AS `referencia`,`est`.`latitud` AS `latitud`,`est`.`longitud` AS `longitud`,`usu`.`fechaalta` AS `fechaalta`,`usu`.`estado` AS `estado` from ((`usuarios` `usu` join `vs_personas_listar` `vpl` on(`vpl`.`idpersona` = `usu`.`idpersona`)) left join `establecimientos` `est` on(`est`.`idusuario` = `usu`.`idusuario`)) where `usu`.`estado` = 1 */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
=======
/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.24-MariaDB : Database - reactivacion
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
  `descripcion` varchar(150) DEFAULT NULL,
  `direccion` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`idactividad`),
  CONSTRAINT `fk_act_idespecialidad` FOREIGN KEY (`idactividad`) REFERENCES `especialidades` (`idespecialidad`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `actividades` */

insert  into `actividades`(`idactividad`,`idespecialidad`,`fecha`,`hora`,`titulo`,`descripcion`,`direccion`) values 
(1,1,'2022-03-25','08:45:00','Trabajo 1','Descripción opcional','Calle Ica N°58'),
(2,1,'2022-03-27','08:45:00','Trabajo 2','Descripción opcional','Calle Ica N°58');

/*Table structure for table `albumes` */

DROP TABLE IF EXISTS `albumes`;

CREATE TABLE `albumes` (
  `idalbum` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `nombrealbum` varchar(30) NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idalbum`),
  UNIQUE KEY `uk_alb_nombrealbum` (`idusuario`,`nombrealbum`),
  CONSTRAINT `fk_alb_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `albumes` */

insert  into `albumes`(`idalbum`,`idusuario`,`nombrealbum`,`estado`) values 
(1,1,'Perfil',''),
(2,1,'Portada',''),
(3,1,'Publicaciones',''),
(7,2,'Perfil','');

/*Table structure for table `calificaciones` */

DROP TABLE IF EXISTS `calificaciones`;

CREATE TABLE `calificaciones` (
  `idcalificacion` int(11) NOT NULL AUTO_INCREMENT,
  `idtrabajo` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `puntuacion` tinyint(4) NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idcalificacion`),
  KEY `fk_cal_idtrabajo` (`idtrabajo`),
  KEY `fk_cal_idusuario` (`idusuario`),
  CONSTRAINT `fk_cal_idtrabajo` FOREIGN KEY (`idtrabajo`) REFERENCES `trabajos` (`idtrabajo`),
  CONSTRAINT `fk_cal_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `calificaciones` */

insert  into `calificaciones`(`idcalificacion`,`idtrabajo`,`idusuario`,`puntuacion`,`estado`) values 
(1,1,1,1,''),
(2,1,2,1,''),
(3,1,2,4,'');

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
  KEY `fk_com_idtrabajo` (`idtrabajo`),
  KEY `fk_com_idusuario` (`idusuario`),
  CONSTRAINT `fk_com_idtrabajo` FOREIGN KEY (`idtrabajo`) REFERENCES `trabajos` (`idtrabajo`),
  CONSTRAINT `fk_com_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `comentarios` */

insert  into `comentarios`(`idcomentario`,`idtrabajo`,`idusuario`,`comentario`,`fechacomentado`,`fechamodificado`,`estado`) values 
(1,1,1,'Muy buen trabajo','2022-04-02 18:18:20',NULL,''),
(2,1,2,'Pesimo trabajo','2022-04-02 18:18:20',NULL,'');

/*Table structure for table `departamentos` */

DROP TABLE IF EXISTS `departamentos`;

CREATE TABLE `departamentos` (
  `iddepartamento` varchar(2) NOT NULL,
  `departamento` varchar(45) NOT NULL,
  PRIMARY KEY (`iddepartamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `departamentos` */

insert  into `departamentos`(`iddepartamento`,`departamento`) values 
('01','Amazonas'),
('02','Áncash'),
('03','Apurímac'),
('04','Arequipa'),
('05','Ayacucho'),
('06','Cajamarca'),
('07','Callao'),
('08','Cusco'),
('09','Huancavelica'),
('10','Huánuco'),
('11','Ica'),
('12','Junín'),
('13','La Libertad'),
('14','Lambayeque'),
('15','Lima'),
('16','Loreto'),
('17','Madre de Dios'),
('18','Moquegua'),
('19','Pasco'),
('20','Piura'),
('21','Puno'),
('22','San Martín'),
('23','Tacna'),
('24','Tumbes'),
('25','Ucayali');

/*Table structure for table `distritos` */

DROP TABLE IF EXISTS `distritos`;

CREATE TABLE `distritos` (
  `iddistrito` varchar(6) NOT NULL,
  `distrito` varchar(45) DEFAULT NULL,
  `idprovincia` varchar(4) DEFAULT NULL,
  `iddepartamento` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`iddistrito`),
  KEY `fk_idprovincia_dis` (`idprovincia`),
  KEY `fk_iddepartamento_dis` (`iddepartamento`),
  CONSTRAINT `fk_iddepartamento_dis` FOREIGN KEY (`iddepartamento`) REFERENCES `departamentos` (`iddepartamento`),
  CONSTRAINT `fk_idprovincia_dis` FOREIGN KEY (`idprovincia`) REFERENCES `provincias` (`idprovincia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `distritos` */

insert  into `distritos`(`iddistrito`,`distrito`,`idprovincia`,`iddepartamento`) values 
('010101','Chachapoyas','0101','01'),
('010102','Asunción','0101','01'),
('010103','Balsas','0101','01'),
('010104','Cheto','0101','01'),
('010105','Chiliquin','0101','01'),
('010106','Chuquibamba','0101','01'),
('010107','Granada','0101','01'),
('010108','Huancas','0101','01'),
('010109','La Jalca','0101','01'),
('010110','Leimebamba','0101','01'),
('010111','Levanto','0101','01'),
('010112','Magdalena','0101','01'),
('010113','Mariscal Castilla','0101','01'),
('010114','Molinopampa','0101','01'),
('010115','Montevideo','0101','01'),
('010116','Olleros','0101','01'),
('010117','Quinjalca','0101','01'),
('010118','San Francisco de Daguas','0101','01'),
('010119','San Isidro de Maino','0101','01'),
('010120','Soloco','0101','01'),
('010121','Sonche','0101','01'),
('010201','Bagua','0102','01'),
('010202','Aramango','0102','01'),
('010203','Copallin','0102','01'),
('010204','El Parco','0102','01'),
('010205','Imaza','0102','01'),
('010206','La Peca','0102','01'),
('010301','Jumbilla','0103','01'),
('010302','Chisquilla','0103','01'),
('010303','Churuja','0103','01'),
('010304','Corosha','0103','01'),
('010305','Cuispes','0103','01'),
('010306','Florida','0103','01'),
('010307','Jazan','0103','01'),
('010308','Recta','0103','01'),
('010309','San Carlos','0103','01'),
('010310','Shipasbamba','0103','01'),
('010311','Valera','0103','01'),
('010312','Yambrasbamba','0103','01'),
('010401','Nieva','0104','01'),
('010402','El Cenepa','0104','01'),
('010403','Río Santiago','0104','01'),
('010501','Lamud','0105','01'),
('010502','Camporredondo','0105','01'),
('010503','Cocabamba','0105','01'),
('010504','Colcamar','0105','01'),
('010505','Conila','0105','01'),
('010506','Inguilpata','0105','01'),
('010507','Longuita','0105','01'),
('010508','Lonya Chico','0105','01'),
('010509','Luya','0105','01'),
('010510','Luya Viejo','0105','01'),
('010511','María','0105','01'),
('010512','Ocalli','0105','01'),
('010513','Ocumal','0105','01'),
('010514','Pisuquia','0105','01'),
('010515','Providencia','0105','01'),
('010516','San Cristóbal','0105','01'),
('010517','San Francisco de Yeso','0105','01'),
('010518','San Jerónimo','0105','01'),
('010519','San Juan de Lopecancha','0105','01'),
('010520','Santa Catalina','0105','01'),
('010521','Santo Tomas','0105','01'),
('010522','Tingo','0105','01'),
('010523','Trita','0105','01'),
('010601','San Nicolás','0106','01'),
('010602','Chirimoto','0106','01'),
('010603','Cochamal','0106','01'),
('010604','Huambo','0106','01'),
('010605','Limabamba','0106','01'),
('010606','Longar','0106','01'),
('010607','Mariscal Benavides','0106','01'),
('010608','Milpuc','0106','01'),
('010609','Omia','0106','01'),
('010610','Santa Rosa','0106','01'),
('010611','Totora','0106','01'),
('010612','Vista Alegre','0106','01'),
('010701','Bagua Grande','0107','01'),
('010702','Cajaruro','0107','01'),
('010703','Cumba','0107','01'),
('010704','El Milagro','0107','01'),
('010705','Jamalca','0107','01'),
('010706','Lonya Grande','0107','01'),
('010707','Yamon','0107','01'),
('020101','Huaraz','0201','02'),
('020102','Cochabamba','0201','02'),
('020103','Colcabamba','0201','02'),
('020104','Huanchay','0201','02'),
('020105','Independencia','0201','02'),
('020106','Jangas','0201','02'),
('020107','La Libertad','0201','02'),
('020108','Olleros','0201','02'),
('020109','Pampas Grande','0201','02'),
('020110','Pariacoto','0201','02'),
('020111','Pira','0201','02'),
('020112','Tarica','0201','02'),
('020201','Aija','0202','02'),
('020202','Coris','0202','02'),
('020203','Huacllan','0202','02'),
('020204','La Merced','0202','02'),
('020205','Succha','0202','02'),
('020301','Llamellin','0203','02'),
('020302','Aczo','0203','02'),
('020303','Chaccho','0203','02'),
('020304','Chingas','0203','02'),
('020305','Mirgas','0203','02'),
('020306','San Juan de Rontoy','0203','02'),
('020401','Chacas','0204','02'),
('020402','Acochaca','0204','02'),
('020501','Chiquian','0205','02'),
('020502','Abelardo Pardo Lezameta','0205','02'),
('020503','Antonio Raymondi','0205','02'),
('020504','Aquia','0205','02'),
('020505','Cajacay','0205','02'),
('020506','Canis','0205','02'),
('020507','Colquioc','0205','02'),
('020508','Huallanca','0205','02'),
('020509','Huasta','0205','02'),
('020510','Huayllacayan','0205','02'),
('020511','La Primavera','0205','02'),
('020512','Mangas','0205','02'),
('020513','Pacllon','0205','02'),
('020514','San Miguel de Corpanqui','0205','02'),
('020515','Ticllos','0205','02'),
('020601','Carhuaz','0206','02'),
('020602','Acopampa','0206','02'),
('020603','Amashca','0206','02'),
('020604','Anta','0206','02'),
('020605','Ataquero','0206','02'),
('020606','Marcara','0206','02'),
('020607','Pariahuanca','0206','02'),
('020608','San Miguel de Aco','0206','02'),
('020609','Shilla','0206','02'),
('020610','Tinco','0206','02'),
('020611','Yungar','0206','02'),
('020701','San Luis','0207','02'),
('020702','San Nicolás','0207','02'),
('020703','Yauya','0207','02'),
('020801','Casma','0208','02'),
('020802','Buena Vista Alta','0208','02'),
('020803','Comandante Noel','0208','02'),
('020804','Yautan','0208','02'),
('020901','Corongo','0209','02'),
('020902','Aco','0209','02'),
('020903','Bambas','0209','02'),
('020904','Cusca','0209','02'),
('020905','La Pampa','0209','02'),
('020906','Yanac','0209','02'),
('020907','Yupan','0209','02'),
('021001','Huari','0210','02'),
('021002','Anra','0210','02'),
('021003','Cajay','0210','02'),
('021004','Chavin de Huantar','0210','02'),
('021005','Huacachi','0210','02'),
('021006','Huacchis','0210','02'),
('021007','Huachis','0210','02'),
('021008','Huantar','0210','02'),
('021009','Masin','0210','02'),
('021010','Paucas','0210','02'),
('021011','Ponto','0210','02'),
('021012','Rahuapampa','0210','02'),
('021013','Rapayan','0210','02'),
('021014','San Marcos','0210','02'),
('021015','San Pedro de Chana','0210','02'),
('021016','Uco','0210','02'),
('021101','Huarmey','0211','02'),
('021102','Cochapeti','0211','02'),
('021103','Culebras','0211','02'),
('021104','Huayan','0211','02'),
('021105','Malvas','0211','02'),
('021201','Caraz','0212','02'),
('021202','Huallanca','0212','02'),
('021203','Huata','0212','02'),
('021204','Huaylas','0212','02'),
('021205','Mato','0212','02'),
('021206','Pamparomas','0212','02'),
('021207','Pueblo Libre','0212','02'),
('021208','Santa Cruz','0212','02'),
('021209','Santo Toribio','0212','02'),
('021210','Yuracmarca','0212','02'),
('021301','Piscobamba','0213','02'),
('021302','Casca','0213','02'),
('021303','Eleazar Guzmán Barron','0213','02'),
('021304','Fidel Olivas Escudero','0213','02'),
('021305','Llama','0213','02'),
('021306','Llumpa','0213','02'),
('021307','Lucma','0213','02'),
('021308','Musga','0213','02'),
('021401','Ocros','0214','02'),
('021402','Acas','0214','02'),
('021403','Cajamarquilla','0214','02'),
('021404','Carhuapampa','0214','02'),
('021405','Cochas','0214','02'),
('021406','Congas','0214','02'),
('021407','Llipa','0214','02'),
('021408','San Cristóbal de Rajan','0214','02'),
('021409','San Pedro','0214','02'),
('021410','Santiago de Chilcas','0214','02'),
('021501','Cabana','0215','02'),
('021502','Bolognesi','0215','02'),
('021503','Conchucos','0215','02'),
('021504','Huacaschuque','0215','02'),
('021505','Huandoval','0215','02'),
('021506','Lacabamba','0215','02'),
('021507','Llapo','0215','02'),
('021508','Pallasca','0215','02'),
('021509','Pampas','0215','02'),
('021510','Santa Rosa','0215','02'),
('021511','Tauca','0215','02'),
('021601','Pomabamba','0216','02'),
('021602','Huayllan','0216','02'),
('021603','Parobamba','0216','02'),
('021604','Quinuabamba','0216','02'),
('021701','Recuay','0217','02'),
('021702','Catac','0217','02'),
('021703','Cotaparaco','0217','02'),
('021704','Huayllapampa','0217','02'),
('021705','Llacllin','0217','02'),
('021706','Marca','0217','02'),
('021707','Pampas Chico','0217','02'),
('021708','Pararin','0217','02'),
('021709','Tapacocha','0217','02'),
('021710','Ticapampa','0217','02'),
('021801','Chimbote','0218','02'),
('021802','Cáceres del Perú','0218','02'),
('021803','Coishco','0218','02'),
('021804','Macate','0218','02'),
('021805','Moro','0218','02'),
('021806','Nepeña','0218','02'),
('021807','Samanco','0218','02'),
('021808','Santa','0218','02'),
('021809','Nuevo Chimbote','0218','02'),
('021901','Sihuas','0219','02'),
('021902','Acobamba','0219','02'),
('021903','Alfonso Ugarte','0219','02'),
('021904','Cashapampa','0219','02'),
('021905','Chingalpo','0219','02'),
('021906','Huayllabamba','0219','02'),
('021907','Quiches','0219','02'),
('021908','Ragash','0219','02'),
('021909','San Juan','0219','02'),
('021910','Sicsibamba','0219','02'),
('022001','Yungay','0220','02'),
('022002','Cascapara','0220','02'),
('022003','Mancos','0220','02'),
('022004','Matacoto','0220','02'),
('022005','Quillo','0220','02'),
('022006','Ranrahirca','0220','02'),
('022007','Shupluy','0220','02'),
('022008','Yanama','0220','02'),
('030101','Abancay','0301','03'),
('030102','Chacoche','0301','03'),
('030103','Circa','0301','03'),
('030104','Curahuasi','0301','03'),
('030105','Huanipaca','0301','03'),
('030106','Lambrama','0301','03'),
('030107','Pichirhua','0301','03'),
('030108','San Pedro de Cachora','0301','03'),
('030109','Tamburco','0301','03'),
('030201','Andahuaylas','0302','03'),
('030202','Andarapa','0302','03'),
('030203','Chiara','0302','03'),
('030204','Huancarama','0302','03'),
('030205','Huancaray','0302','03'),
('030206','Huayana','0302','03'),
('030207','Kishuara','0302','03'),
('030208','Pacobamba','0302','03'),
('030209','Pacucha','0302','03'),
('030210','Pampachiri','0302','03'),
('030211','Pomacocha','0302','03'),
('030212','San Antonio de Cachi','0302','03'),
('030213','San Jerónimo','0302','03'),
('030214','San Miguel de Chaccrampa','0302','03'),
('030215','Santa María de Chicmo','0302','03'),
('030216','Talavera','0302','03'),
('030217','Tumay Huaraca','0302','03'),
('030218','Turpo','0302','03'),
('030219','Kaquiabamba','0302','03'),
('030220','José María Arguedas','0302','03'),
('030301','Antabamba','0303','03'),
('030302','El Oro','0303','03'),
('030303','Huaquirca','0303','03'),
('030304','Juan Espinoza Medrano','0303','03'),
('030305','Oropesa','0303','03'),
('030306','Pachaconas','0303','03'),
('030307','Sabaino','0303','03'),
('030401','Chalhuanca','0304','03'),
('030402','Capaya','0304','03'),
('030403','Caraybamba','0304','03'),
('030404','Chapimarca','0304','03'),
('030405','Colcabamba','0304','03'),
('030406','Cotaruse','0304','03'),
('030407','Ihuayllo','0304','03'),
('030408','Justo Apu Sahuaraura','0304','03'),
('030409','Lucre','0304','03'),
('030410','Pocohuanca','0304','03'),
('030411','San Juan de Chacña','0304','03'),
('030412','Sañayca','0304','03'),
('030413','Soraya','0304','03'),
('030414','Tapairihua','0304','03'),
('030415','Tintay','0304','03'),
('030416','Toraya','0304','03'),
('030417','Yanaca','0304','03'),
('030501','Tambobamba','0305','03'),
('030502','Cotabambas','0305','03'),
('030503','Coyllurqui','0305','03'),
('030504','Haquira','0305','03'),
('030505','Mara','0305','03'),
('030506','Challhuahuacho','0305','03'),
('030601','Chincheros','0306','03'),
('030602','Anco_Huallo','0306','03'),
('030603','Cocharcas','0306','03'),
('030604','Huaccana','0306','03'),
('030605','Ocobamba','0306','03'),
('030606','Ongoy','0306','03'),
('030607','Uranmarca','0306','03'),
('030608','Ranracancha','0306','03'),
('030609','Rocchacc','0306','03'),
('030610','El Porvenir','0306','03'),
('030611','Los Chankas','0306','03'),
('030701','Chuquibambilla','0307','03'),
('030702','Curpahuasi','0307','03'),
('030703','Gamarra','0307','03'),
('030704','Huayllati','0307','03'),
('030705','Mamara','0307','03'),
('030706','Micaela Bastidas','0307','03'),
('030707','Pataypampa','0307','03'),
('030708','Progreso','0307','03'),
('030709','San Antonio','0307','03'),
('030710','Santa Rosa','0307','03'),
('030711','Turpay','0307','03'),
('030712','Vilcabamba','0307','03'),
('030713','Virundo','0307','03'),
('030714','Curasco','0307','03'),
('040101','Arequipa','0401','04'),
('040102','Alto Selva Alegre','0401','04'),
('040103','Cayma','0401','04'),
('040104','Cerro Colorado','0401','04'),
('040105','Characato','0401','04'),
('040106','Chiguata','0401','04'),
('040107','Jacobo Hunter','0401','04'),
('040108','La Joya','0401','04'),
('040109','Mariano Melgar','0401','04'),
('040110','Miraflores','0401','04'),
('040111','Mollebaya','0401','04'),
('040112','Paucarpata','0401','04'),
('040113','Pocsi','0401','04'),
('040114','Polobaya','0401','04'),
('040115','Quequeña','0401','04'),
('040116','Sabandia','0401','04'),
('040117','Sachaca','0401','04'),
('040118','San Juan de Siguas','0401','04'),
('040119','San Juan de Tarucani','0401','04'),
('040120','Santa Isabel de Siguas','0401','04'),
('040121','Santa Rita de Siguas','0401','04'),
('040122','Socabaya','0401','04'),
('040123','Tiabaya','0401','04'),
('040124','Uchumayo','0401','04'),
('040125','Vitor','0401','04'),
('040126','Yanahuara','0401','04'),
('040127','Yarabamba','0401','04'),
('040128','Yura','0401','04'),
('040129','José Luis Bustamante Y Rivero','0401','04'),
('040201','Camaná','0402','04'),
('040202','José María Quimper','0402','04'),
('040203','Mariano Nicolás Valcárcel','0402','04'),
('040204','Mariscal Cáceres','0402','04'),
('040205','Nicolás de Pierola','0402','04'),
('040206','Ocoña','0402','04'),
('040207','Quilca','0402','04'),
('040208','Samuel Pastor','0402','04'),
('040301','Caravelí','0403','04'),
('040302','Acarí','0403','04'),
('040303','Atico','0403','04'),
('040304','Atiquipa','0403','04'),
('040305','Bella Unión','0403','04'),
('040306','Cahuacho','0403','04'),
('040307','Chala','0403','04'),
('040308','Chaparra','0403','04'),
('040309','Huanuhuanu','0403','04'),
('040310','Jaqui','0403','04'),
('040311','Lomas','0403','04'),
('040312','Quicacha','0403','04'),
('040313','Yauca','0403','04'),
('040401','Aplao','0404','04'),
('040402','Andagua','0404','04'),
('040403','Ayo','0404','04'),
('040404','Chachas','0404','04'),
('040405','Chilcaymarca','0404','04'),
('040406','Choco','0404','04'),
('040407','Huancarqui','0404','04'),
('040408','Machaguay','0404','04'),
('040409','Orcopampa','0404','04'),
('040410','Pampacolca','0404','04'),
('040411','Tipan','0404','04'),
('040412','Uñon','0404','04'),
('040413','Uraca','0404','04'),
('040414','Viraco','0404','04'),
('040501','Chivay','0405','04'),
('040502','Achoma','0405','04'),
('040503','Cabanaconde','0405','04'),
('040504','Callalli','0405','04'),
('040505','Caylloma','0405','04'),
('040506','Coporaque','0405','04'),
('040507','Huambo','0405','04'),
('040508','Huanca','0405','04'),
('040509','Ichupampa','0405','04'),
('040510','Lari','0405','04'),
('040511','Lluta','0405','04'),
('040512','Maca','0405','04'),
('040513','Madrigal','0405','04'),
('040514','San Antonio de Chuca','0405','04'),
('040515','Sibayo','0405','04'),
('040516','Tapay','0405','04'),
('040517','Tisco','0405','04'),
('040518','Tuti','0405','04'),
('040519','Yanque','0405','04'),
('040520','Majes','0405','04'),
('040601','Chuquibamba','0406','04'),
('040602','Andaray','0406','04'),
('040603','Cayarani','0406','04'),
('040604','Chichas','0406','04'),
('040605','Iray','0406','04'),
('040606','Río Grande','0406','04'),
('040607','Salamanca','0406','04'),
('040608','Yanaquihua','0406','04'),
('040701','Mollendo','0407','04'),
('040702','Cocachacra','0407','04'),
('040703','Dean Valdivia','0407','04'),
('040704','Islay','0407','04'),
('040705','Mejia','0407','04'),
('040706','Punta de Bombón','0407','04'),
('040801','Cotahuasi','0408','04'),
('040802','Alca','0408','04'),
('040803','Charcana','0408','04'),
('040804','Huaynacotas','0408','04'),
('040805','Pampamarca','0408','04'),
('040806','Puyca','0408','04'),
('040807','Quechualla','0408','04'),
('040808','Sayla','0408','04'),
('040809','Tauria','0408','04'),
('040810','Tomepampa','0408','04'),
('040811','Toro','0408','04'),
('050101','Ayacucho','0501','05'),
('050102','Acocro','0501','05'),
('050103','Acos Vinchos','0501','05'),
('050104','Carmen Alto','0501','05'),
('050105','Chiara','0501','05'),
('050106','Ocros','0501','05'),
('050107','Pacaycasa','0501','05'),
('050108','Quinua','0501','05'),
('050109','San José de Ticllas','0501','05'),
('050110','San Juan Bautista','0501','05'),
('050111','Santiago de Pischa','0501','05'),
('050112','Socos','0501','05'),
('050113','Tambillo','0501','05'),
('050114','Vinchos','0501','05'),
('050115','Jesús Nazareno','0501','05'),
('050116','Andrés Avelino Cáceres Dorregaray','0501','05'),
('050201','Cangallo','0502','05'),
('050202','Chuschi','0502','05'),
('050203','Los Morochucos','0502','05'),
('050204','María Parado de Bellido','0502','05'),
('050205','Paras','0502','05'),
('050206','Totos','0502','05'),
('050301','Sancos','0503','05'),
('050302','Carapo','0503','05'),
('050303','Sacsamarca','0503','05'),
('050304','Santiago de Lucanamarca','0503','05'),
('050401','Huanta','0504','05'),
('050402','Ayahuanco','0504','05'),
('050403','Huamanguilla','0504','05'),
('050404','Iguain','0504','05'),
('050405','Luricocha','0504','05'),
('050406','Santillana','0504','05'),
('050407','Sivia','0504','05'),
('050408','Llochegua','0504','05'),
('050409','Canayre','0504','05'),
('050410','Uchuraccay','0504','05'),
('050411','Pucacolpa','0504','05'),
('050412','Chaca','0504','05'),
('050501','San Miguel','0505','05'),
('050502','Anco','0505','05'),
('050503','Ayna','0505','05'),
('050504','Chilcas','0505','05'),
('050505','Chungui','0505','05'),
('050506','Luis Carranza','0505','05'),
('050507','Santa Rosa','0505','05'),
('050508','Tambo','0505','05'),
('050509','Samugari','0505','05'),
('050510','Anchihuay','0505','05'),
('050511','Oronccoy','0505','05'),
('050601','Puquio','0506','05'),
('050602','Aucara','0506','05'),
('050603','Cabana','0506','05'),
('050604','Carmen Salcedo','0506','05'),
('050605','Chaviña','0506','05'),
('050606','Chipao','0506','05'),
('050607','Huac-Huas','0506','05'),
('050608','Laramate','0506','05'),
('050609','Leoncio Prado','0506','05'),
('050610','Llauta','0506','05'),
('050611','Lucanas','0506','05'),
('050612','Ocaña','0506','05'),
('050613','Otoca','0506','05'),
('050614','Saisa','0506','05'),
('050615','San Cristóbal','0506','05'),
('050616','San Juan','0506','05'),
('050617','San Pedro','0506','05'),
('050618','San Pedro de Palco','0506','05'),
('050619','Sancos','0506','05'),
('050620','Santa Ana de Huaycahuacho','0506','05'),
('050621','Santa Lucia','0506','05'),
('050701','Coracora','0507','05'),
('050702','Chumpi','0507','05'),
('050703','Coronel Castañeda','0507','05'),
('050704','Pacapausa','0507','05'),
('050705','Pullo','0507','05'),
('050706','Puyusca','0507','05'),
('050707','San Francisco de Ravacayco','0507','05'),
('050708','Upahuacho','0507','05'),
('050801','Pausa','0508','05'),
('050802','Colta','0508','05'),
('050803','Corculla','0508','05'),
('050804','Lampa','0508','05'),
('050805','Marcabamba','0508','05'),
('050806','Oyolo','0508','05'),
('050807','Pararca','0508','05'),
('050808','San Javier de Alpabamba','0508','05'),
('050809','San José de Ushua','0508','05'),
('050810','Sara Sara','0508','05'),
('050901','Querobamba','0509','05'),
('050902','Belén','0509','05'),
('050903','Chalcos','0509','05'),
('050904','Chilcayoc','0509','05'),
('050905','Huacaña','0509','05'),
('050906','Morcolla','0509','05'),
('050907','Paico','0509','05'),
('050908','San Pedro de Larcay','0509','05'),
('050909','San Salvador de Quije','0509','05'),
('050910','Santiago de Paucaray','0509','05'),
('050911','Soras','0509','05'),
('051001','Huancapi','0510','05'),
('051002','Alcamenca','0510','05'),
('051003','Apongo','0510','05'),
('051004','Asquipata','0510','05'),
('051005','Canaria','0510','05'),
('051006','Cayara','0510','05'),
('051007','Colca','0510','05'),
('051008','Huamanquiquia','0510','05'),
('051009','Huancaraylla','0510','05'),
('051010','Hualla','0510','05'),
('051011','Sarhua','0510','05'),
('051012','Vilcanchos','0510','05'),
('051101','Vilcas Huaman','0511','05'),
('051102','Accomarca','0511','05'),
('051103','Carhuanca','0511','05'),
('051104','Concepción','0511','05'),
('051105','Huambalpa','0511','05'),
('051106','Independencia','0511','05'),
('051107','Saurama','0511','05'),
('051108','Vischongo','0511','05'),
('060101','Cajamarca','0601','06'),
('060102','Asunción','0601','06'),
('060103','Chetilla','0601','06'),
('060104','Cospan','0601','06'),
('060105','Encañada','0601','06'),
('060106','Jesús','0601','06'),
('060107','Llacanora','0601','06'),
('060108','Los Baños del Inca','0601','06'),
('060109','Magdalena','0601','06'),
('060110','Matara','0601','06'),
('060111','Namora','0601','06'),
('060112','San Juan','0601','06'),
('060201','Cajabamba','0602','06'),
('060202','Cachachi','0602','06'),
('060203','Condebamba','0602','06'),
('060204','Sitacocha','0602','06'),
('060301','Celendín','0603','06'),
('060302','Chumuch','0603','06'),
('060303','Cortegana','0603','06'),
('060304','Huasmin','0603','06'),
('060305','Jorge Chávez','0603','06'),
('060306','José Gálvez','0603','06'),
('060307','Miguel Iglesias','0603','06'),
('060308','Oxamarca','0603','06'),
('060309','Sorochuco','0603','06'),
('060310','Sucre','0603','06'),
('060311','Utco','0603','06'),
('060312','La Libertad de Pallan','0603','06'),
('060401','Chota','0604','06'),
('060402','Anguia','0604','06'),
('060403','Chadin','0604','06'),
('060404','Chiguirip','0604','06'),
('060405','Chimban','0604','06'),
('060406','Choropampa','0604','06'),
('060407','Cochabamba','0604','06'),
('060408','Conchan','0604','06'),
('060409','Huambos','0604','06'),
('060410','Lajas','0604','06'),
('060411','Llama','0604','06'),
('060412','Miracosta','0604','06'),
('060413','Paccha','0604','06'),
('060414','Pion','0604','06'),
('060415','Querocoto','0604','06'),
('060416','San Juan de Licupis','0604','06'),
('060417','Tacabamba','0604','06'),
('060418','Tocmoche','0604','06'),
('060419','Chalamarca','0604','06'),
('060501','Contumaza','0605','06'),
('060502','Chilete','0605','06'),
('060503','Cupisnique','0605','06'),
('060504','Guzmango','0605','06'),
('060505','San Benito','0605','06'),
('060506','Santa Cruz de Toledo','0605','06'),
('060507','Tantarica','0605','06'),
('060508','Yonan','0605','06'),
('060601','Cutervo','0606','06'),
('060602','Callayuc','0606','06'),
('060603','Choros','0606','06'),
('060604','Cujillo','0606','06'),
('060605','La Ramada','0606','06'),
('060606','Pimpingos','0606','06'),
('060607','Querocotillo','0606','06'),
('060608','San Andrés de Cutervo','0606','06'),
('060609','San Juan de Cutervo','0606','06'),
('060610','San Luis de Lucma','0606','06'),
('060611','Santa Cruz','0606','06'),
('060612','Santo Domingo de la Capilla','0606','06'),
('060613','Santo Tomas','0606','06'),
('060614','Socota','0606','06'),
('060615','Toribio Casanova','0606','06'),
('060701','Bambamarca','0607','06'),
('060702','Chugur','0607','06'),
('060703','Hualgayoc','0607','06'),
('060801','Jaén','0608','06'),
('060802','Bellavista','0608','06'),
('060803','Chontali','0608','06'),
('060804','Colasay','0608','06'),
('060805','Huabal','0608','06'),
('060806','Las Pirias','0608','06'),
('060807','Pomahuaca','0608','06'),
('060808','Pucara','0608','06'),
('060809','Sallique','0608','06'),
('060810','San Felipe','0608','06'),
('060811','San José del Alto','0608','06'),
('060812','Santa Rosa','0608','06'),
('060901','San Ignacio','0609','06'),
('060902','Chirinos','0609','06'),
('060903','Huarango','0609','06'),
('060904','La Coipa','0609','06'),
('060905','Namballe','0609','06'),
('060906','San José de Lourdes','0609','06'),
('060907','Tabaconas','0609','06'),
('061001','Pedro Gálvez','0610','06'),
('061002','Chancay','0610','06'),
('061003','Eduardo Villanueva','0610','06'),
('061004','Gregorio Pita','0610','06'),
('061005','Ichocan','0610','06'),
('061006','José Manuel Quiroz','0610','06'),
('061007','José Sabogal','0610','06'),
('061101','San Miguel','0611','06'),
('061102','Bolívar','0611','06'),
('061103','Calquis','0611','06'),
('061104','Catilluc','0611','06'),
('061105','El Prado','0611','06'),
('061106','La Florida','0611','06'),
('061107','Llapa','0611','06'),
('061108','Nanchoc','0611','06'),
('061109','Niepos','0611','06'),
('061110','San Gregorio','0611','06'),
('061111','San Silvestre de Cochan','0611','06'),
('061112','Tongod','0611','06'),
('061113','Unión Agua Blanca','0611','06'),
('061201','San Pablo','0612','06'),
('061202','San Bernardino','0612','06'),
('061203','San Luis','0612','06'),
('061204','Tumbaden','0612','06'),
('061301','Santa Cruz','0613','06'),
('061302','Andabamba','0613','06'),
('061303','Catache','0613','06'),
('061304','Chancaybaños','0613','06'),
('061305','La Esperanza','0613','06'),
('061306','Ninabamba','0613','06'),
('061307','Pulan','0613','06'),
('061308','Saucepampa','0613','06'),
('061309','Sexi','0613','06'),
('061310','Uticyacu','0613','06'),
('061311','Yauyucan','0613','06'),
('070101','Callao','0701','07'),
('070102','Bellavista','0701','07'),
('070103','Carmen de la Legua Reynoso','0701','07'),
('070104','La Perla','0701','07'),
('070105','La Punta','0701','07'),
('070106','Ventanilla','0701','07'),
('070107','Mi Perú','0701','07'),
('080101','Cusco','0801','08'),
('080102','Ccorca','0801','08'),
('080103','Poroy','0801','08'),
('080104','San Jerónimo','0801','08'),
('080105','San Sebastian','0801','08'),
('080106','Santiago','0801','08'),
('080107','Saylla','0801','08'),
('080108','Wanchaq','0801','08'),
('080201','Acomayo','0802','08'),
('080202','Acopia','0802','08'),
('080203','Acos','0802','08'),
('080204','Mosoc Llacta','0802','08'),
('080205','Pomacanchi','0802','08'),
('080206','Rondocan','0802','08'),
('080207','Sangarara','0802','08'),
('080301','Anta','0803','08'),
('080302','Ancahuasi','0803','08'),
('080303','Cachimayo','0803','08'),
('080304','Chinchaypujio','0803','08'),
('080305','Huarocondo','0803','08'),
('080306','Limatambo','0803','08'),
('080307','Mollepata','0803','08'),
('080308','Pucyura','0803','08'),
('080309','Zurite','0803','08'),
('080401','Calca','0804','08'),
('080402','Coya','0804','08'),
('080403','Lamay','0804','08'),
('080404','Lares','0804','08'),
('080405','Pisac','0804','08'),
('080406','San Salvador','0804','08'),
('080407','Taray','0804','08'),
('080408','Yanatile','0804','08'),
('080501','Yanaoca','0805','08'),
('080502','Checca','0805','08'),
('080503','Kunturkanki','0805','08'),
('080504','Langui','0805','08'),
('080505','Layo','0805','08'),
('080506','Pampamarca','0805','08'),
('080507','Quehue','0805','08'),
('080508','Tupac Amaru','0805','08'),
('080601','Sicuani','0806','08'),
('080602','Checacupe','0806','08'),
('080603','Combapata','0806','08'),
('080604','Marangani','0806','08'),
('080605','Pitumarca','0806','08'),
('080606','San Pablo','0806','08'),
('080607','San Pedro','0806','08'),
('080608','Tinta','0806','08'),
('080701','Santo Tomas','0807','08'),
('080702','Capacmarca','0807','08'),
('080703','Chamaca','0807','08'),
('080704','Colquemarca','0807','08'),
('080705','Livitaca','0807','08'),
('080706','Llusco','0807','08'),
('080707','Quiñota','0807','08'),
('080708','Velille','0807','08'),
('080801','Espinar','0808','08'),
('080802','Condoroma','0808','08'),
('080803','Coporaque','0808','08'),
('080804','Ocoruro','0808','08'),
('080805','Pallpata','0808','08'),
('080806','Pichigua','0808','08'),
('080807','Suyckutambo','0808','08'),
('080808','Alto Pichigua','0808','08'),
('080901','Santa Ana','0809','08'),
('080902','Echarate','0809','08'),
('080903','Huayopata','0809','08'),
('080904','Maranura','0809','08'),
('080905','Ocobamba','0809','08'),
('080906','Quellouno','0809','08'),
('080907','Kimbiri','0809','08'),
('080908','Santa Teresa','0809','08'),
('080909','Vilcabamba','0809','08'),
('080910','Pichari','0809','08'),
('080911','Inkawasi','0809','08'),
('080912','Villa Virgen','0809','08'),
('080913','Villa Kintiarina','0809','08'),
('080914','Megantoni','0809','08'),
('081001','Paruro','0810','08'),
('081002','Accha','0810','08'),
('081003','Ccapi','0810','08'),
('081004','Colcha','0810','08'),
('081005','Huanoquite','0810','08'),
('081006','Omachaç','0810','08'),
('081007','Paccaritambo','0810','08'),
('081008','Pillpinto','0810','08'),
('081009','Yaurisque','0810','08'),
('081101','Paucartambo','0811','08'),
('081102','Caicay','0811','08'),
('081103','Challabamba','0811','08'),
('081104','Colquepata','0811','08'),
('081105','Huancarani','0811','08'),
('081106','Kosñipata','0811','08'),
('081201','Urcos','0812','08'),
('081202','Andahuaylillas','0812','08'),
('081203','Camanti','0812','08'),
('081204','Ccarhuayo','0812','08'),
('081205','Ccatca','0812','08'),
('081206','Cusipata','0812','08'),
('081207','Huaro','0812','08'),
('081208','Lucre','0812','08'),
('081209','Marcapata','0812','08'),
('081210','Ocongate','0812','08'),
('081211','Oropesa','0812','08'),
('081212','Quiquijana','0812','08'),
('081301','Urubamba','0813','08'),
('081302','Chinchero','0813','08'),
('081303','Huayllabamba','0813','08'),
('081304','Machupicchu','0813','08'),
('081305','Maras','0813','08'),
('081306','Ollantaytambo','0813','08'),
('081307','Yucay','0813','08'),
('090101','Huancavelica','0901','09'),
('090102','Acobambilla','0901','09'),
('090103','Acoria','0901','09'),
('090104','Conayca','0901','09'),
('090105','Cuenca','0901','09'),
('090106','Huachocolpa','0901','09'),
('090107','Huayllahuara','0901','09'),
('090108','Izcuchaca','0901','09'),
('090109','Laria','0901','09'),
('090110','Manta','0901','09'),
('090111','Mariscal Cáceres','0901','09'),
('090112','Moya','0901','09'),
('090113','Nuevo Occoro','0901','09'),
('090114','Palca','0901','09'),
('090115','Pilchaca','0901','09'),
('090116','Vilca','0901','09'),
('090117','Yauli','0901','09'),
('090118','Ascensión','0901','09'),
('090119','Huando','0901','09'),
('090201','Acobamba','0902','09'),
('090202','Andabamba','0902','09'),
('090203','Anta','0902','09'),
('090204','Caja','0902','09'),
('090205','Marcas','0902','09'),
('090206','Paucara','0902','09'),
('090207','Pomacocha','0902','09'),
('090208','Rosario','0902','09'),
('090301','Lircay','0903','09'),
('090302','Anchonga','0903','09'),
('090303','Callanmarca','0903','09'),
('090304','Ccochaccasa','0903','09'),
('090305','Chincho','0903','09'),
('090306','Congalla','0903','09'),
('090307','Huanca-Huanca','0903','09'),
('090308','Huayllay Grande','0903','09'),
('090309','Julcamarca','0903','09'),
('090310','San Antonio de Antaparco','0903','09'),
('090311','Santo Tomas de Pata','0903','09'),
('090312','Secclla','0903','09'),
('090401','Castrovirreyna','0904','09'),
('090402','Arma','0904','09'),
('090403','Aurahua','0904','09'),
('090404','Capillas','0904','09'),
('090405','Chupamarca','0904','09'),
('090406','Cocas','0904','09'),
('090407','Huachos','0904','09'),
('090408','Huamatambo','0904','09'),
('090409','Mollepampa','0904','09'),
('090410','San Juan','0904','09'),
('090411','Santa Ana','0904','09'),
('090412','Tantara','0904','09'),
('090413','Ticrapo','0904','09'),
('090501','Churcampa','0905','09'),
('090502','Anco','0905','09'),
('090503','Chinchihuasi','0905','09'),
('090504','El Carmen','0905','09'),
('090505','La Merced','0905','09'),
('090506','Locroja','0905','09'),
('090507','Paucarbamba','0905','09'),
('090508','San Miguel de Mayocc','0905','09'),
('090509','San Pedro de Coris','0905','09'),
('090510','Pachamarca','0905','09'),
('090511','Cosme','0905','09'),
('090601','Huaytara','0906','09'),
('090602','Ayavi','0906','09'),
('090603','Córdova','0906','09'),
('090604','Huayacundo Arma','0906','09'),
('090605','Laramarca','0906','09'),
('090606','Ocoyo','0906','09'),
('090607','Pilpichaca','0906','09'),
('090608','Querco','0906','09'),
('090609','Quito-Arma','0906','09'),
('090610','San Antonio de Cusicancha','0906','09'),
('090611','San Francisco de Sangayaico','0906','09'),
('090612','San Isidro','0906','09'),
('090613','Santiago de Chocorvos','0906','09'),
('090614','Santiago de Quirahuara','0906','09'),
('090615','Santo Domingo de Capillas','0906','09'),
('090616','Tambo','0906','09'),
('090701','Pampas','0907','09'),
('090702','Acostambo','0907','09'),
('090703','Acraquia','0907','09'),
('090704','Ahuaycha','0907','09'),
('090705','Colcabamba','0907','09'),
('090706','Daniel Hernández','0907','09'),
('090707','Huachocolpa','0907','09'),
('090709','Huaribamba','0907','09'),
('090710','Ñahuimpuquio','0907','09'),
('090711','Pazos','0907','09'),
('090713','Quishuar','0907','09'),
('090714','Salcabamba','0907','09'),
('090715','Salcahuasi','0907','09'),
('090716','San Marcos de Rocchac','0907','09'),
('090717','Surcubamba','0907','09'),
('090718','Tintay Puncu','0907','09'),
('090719','Quichuas','0907','09'),
('090720','Andaymarca','0907','09'),
('090721','Roble','0907','09'),
('090722','Pichos','0907','09'),
('090723','Santiago de Tucuma','0907','09'),
('100101','Huanuco','1001','10'),
('100102','Amarilis','1001','10'),
('100103','Chinchao','1001','10'),
('100104','Churubamba','1001','10'),
('100105','Margos','1001','10'),
('100106','Quisqui (Kichki)','1001','10'),
('100107','San Francisco de Cayran','1001','10'),
('100108','San Pedro de Chaulan','1001','10'),
('100109','Santa María del Valle','1001','10'),
('100110','Yarumayo','1001','10'),
('100111','Pillco Marca','1001','10'),
('100112','Yacus','1001','10'),
('100113','San Pablo de Pillao','1001','10'),
('100201','Ambo','1002','10'),
('100202','Cayna','1002','10'),
('100203','Colpas','1002','10'),
('100204','Conchamarca','1002','10'),
('100205','Huacar','1002','10'),
('100206','San Francisco','1002','10'),
('100207','San Rafael','1002','10'),
('100208','Tomay Kichwa','1002','10'),
('100301','La Unión','1003','10'),
('100307','Chuquis','1003','10'),
('100311','Marías','1003','10'),
('100313','Pachas','1003','10'),
('100316','Quivilla','1003','10'),
('100317','Ripan','1003','10'),
('100321','Shunqui','1003','10'),
('100322','Sillapata','1003','10'),
('100323','Yanas','1003','10'),
('100401','Huacaybamba','1004','10'),
('100402','Canchabamba','1004','10'),
('100403','Cochabamba','1004','10'),
('100404','Pinra','1004','10'),
('100501','Llata','1005','10'),
('100502','Arancay','1005','10'),
('100503','Chavín de Pariarca','1005','10'),
('100504','Jacas Grande','1005','10'),
('100505','Jircan','1005','10'),
('100506','Miraflores','1005','10'),
('100507','Monzón','1005','10'),
('100508','Punchao','1005','10'),
('100509','Puños','1005','10'),
('100510','Singa','1005','10'),
('100511','Tantamayo','1005','10'),
('100601','Rupa-Rupa','1006','10'),
('100602','Daniel Alomía Robles','1006','10'),
('100603','Hermílio Valdizan','1006','10'),
('100604','José Crespo y Castillo','1006','10'),
('100605','Luyando','1006','10'),
('100606','Mariano Damaso Beraun','1006','10'),
('100607','Pucayacu','1006','10'),
('100608','Castillo Grande','1006','10'),
('100609','Pueblo Nuevo','1006','10'),
('100610','Santo Domingo de Anda','1006','10'),
('100701','Huacrachuco','1007','10'),
('100702','Cholon','1007','10'),
('100703','San Buenaventura','1007','10'),
('100704','La Morada','1007','10'),
('100705','Santa Rosa de Alto Yanajanca','1007','10'),
('100801','Panao','1008','10'),
('100802','Chaglla','1008','10'),
('100803','Molino','1008','10'),
('100804','Umari','1008','10'),
('100901','Puerto Inca','1009','10'),
('100902','Codo del Pozuzo','1009','10'),
('100903','Honoria','1009','10'),
('100904','Tournavista','1009','10'),
('100905','Yuyapichis','1009','10'),
('101001','Jesús','1010','10'),
('101002','Baños','1010','10'),
('101003','Jivia','1010','10'),
('101004','Queropalca','1010','10'),
('101005','Rondos','1010','10'),
('101006','San Francisco de Asís','1010','10'),
('101007','San Miguel de Cauri','1010','10'),
('101101','Chavinillo','1011','10'),
('101102','Cahuac','1011','10'),
('101103','Chacabamba','1011','10'),
('101104','Aparicio Pomares','1011','10'),
('101105','Jacas Chico','1011','10'),
('101106','Obas','1011','10'),
('101107','Pampamarca','1011','10'),
('101108','Choras','1011','10'),
('110101','Ica','1101','11'),
('110102','La Tinguiña','1101','11'),
('110103','Los Aquijes','1101','11'),
('110104','Ocucaje','1101','11'),
('110105','Pachacutec','1101','11'),
('110106','Parcona','1101','11'),
('110107','Pueblo Nuevo','1101','11'),
('110108','Salas','1101','11'),
('110109','San José de Los Molinos','1101','11'),
('110110','San Juan Bautista','1101','11'),
('110111','Santiago','1101','11'),
('110112','Subtanjalla','1101','11'),
('110113','Tate','1101','11'),
('110114','Yauca del Rosario','1101','11'),
('110201','Chincha Alta','1102','11'),
('110202','Alto Laran','1102','11'),
('110203','Chavin','1102','11'),
('110204','Chincha Baja','1102','11'),
('110205','El Carmen','1102','11'),
('110206','Grocio Prado','1102','11'),
('110207','Pueblo Nuevo','1102','11'),
('110208','San Juan de Yanac','1102','11'),
('110209','San Pedro de Huacarpana','1102','11'),
('110210','Sunampe','1102','11'),
('110211','Tambo de Mora','1102','11'),
('110301','Nasca','1103','11'),
('110302','Changuillo','1103','11'),
('110303','El Ingenio','1103','11'),
('110304','Marcona','1103','11'),
('110305','Vista Alegre','1103','11'),
('110401','Palpa','1104','11'),
('110402','Llipata','1104','11'),
('110403','Río Grande','1104','11'),
('110404','Santa Cruz','1104','11'),
('110405','Tibillo','1104','11'),
('110501','Pisco','1105','11'),
('110502','Huancano','1105','11'),
('110503','Humay','1105','11'),
('110504','Independencia','1105','11'),
('110505','Paracas','1105','11'),
('110506','San Andrés','1105','11'),
('110507','San Clemente','1105','11'),
('110508','Tupac Amaru Inca','1105','11'),
('120101','Huancayo','1201','12'),
('120104','Carhuacallanga','1201','12'),
('120105','Chacapampa','1201','12'),
('120106','Chicche','1201','12'),
('120107','Chilca','1201','12'),
('120108','Chongos Alto','1201','12'),
('120111','Chupuro','1201','12'),
('120112','Colca','1201','12'),
('120113','Cullhuas','1201','12'),
('120114','El Tambo','1201','12'),
('120116','Huacrapuquio','1201','12'),
('120117','Hualhuas','1201','12'),
('120119','Huancan','1201','12'),
('120120','Huasicancha','1201','12'),
('120121','Huayucachi','1201','12'),
('120122','Ingenio','1201','12'),
('120124','Pariahuanca','1201','12'),
('120125','Pilcomayo','1201','12'),
('120126','Pucara','1201','12'),
('120127','Quichuay','1201','12'),
('120128','Quilcas','1201','12'),
('120129','San Agustín','1201','12'),
('120130','San Jerónimo de Tunan','1201','12'),
('120132','Saño','1201','12'),
('120133','Sapallanga','1201','12'),
('120134','Sicaya','1201','12'),
('120135','Santo Domingo de Acobamba','1201','12'),
('120136','Viques','1201','12'),
('120201','Concepción','1202','12'),
('120202','Aco','1202','12'),
('120203','Andamarca','1202','12'),
('120204','Chambara','1202','12'),
('120205','Cochas','1202','12'),
('120206','Comas','1202','12'),
('120207','Heroínas Toledo','1202','12'),
('120208','Manzanares','1202','12'),
('120209','Mariscal Castilla','1202','12'),
('120210','Matahuasi','1202','12'),
('120211','Mito','1202','12'),
('120212','Nueve de Julio','1202','12'),
('120213','Orcotuna','1202','12'),
('120214','San José de Quero','1202','12'),
('120215','Santa Rosa de Ocopa','1202','12'),
('120301','Chanchamayo','1203','12'),
('120302','Perene','1203','12'),
('120303','Pichanaqui','1203','12'),
('120304','San Luis de Shuaro','1203','12'),
('120305','San Ramón','1203','12'),
('120306','Vitoc','1203','12'),
('120401','Jauja','1204','12'),
('120402','Acolla','1204','12'),
('120403','Apata','1204','12'),
('120404','Ataura','1204','12'),
('120405','Canchayllo','1204','12'),
('120406','Curicaca','1204','12'),
('120407','El Mantaro','1204','12'),
('120408','Huamali','1204','12'),
('120409','Huaripampa','1204','12'),
('120410','Huertas','1204','12'),
('120411','Janjaillo','1204','12'),
('120412','Julcán','1204','12'),
('120413','Leonor Ordóñez','1204','12'),
('120414','Llocllapampa','1204','12'),
('120415','Marco','1204','12'),
('120416','Masma','1204','12'),
('120417','Masma Chicche','1204','12'),
('120418','Molinos','1204','12'),
('120419','Monobamba','1204','12'),
('120420','Muqui','1204','12'),
('120421','Muquiyauyo','1204','12'),
('120422','Paca','1204','12'),
('120423','Paccha','1204','12'),
('120424','Pancan','1204','12'),
('120425','Parco','1204','12'),
('120426','Pomacancha','1204','12'),
('120427','Ricran','1204','12'),
('120428','San Lorenzo','1204','12'),
('120429','San Pedro de Chunan','1204','12'),
('120430','Sausa','1204','12'),
('120431','Sincos','1204','12'),
('120432','Tunan Marca','1204','12'),
('120433','Yauli','1204','12'),
('120434','Yauyos','1204','12'),
('120501','Junin','1205','12'),
('120502','Carhuamayo','1205','12'),
('120503','Ondores','1205','12'),
('120504','Ulcumayo','1205','12'),
('120601','Satipo','1206','12'),
('120602','Coviriali','1206','12'),
('120603','Llaylla','1206','12'),
('120604','Mazamari','1206','12'),
('120605','Pampa Hermosa','1206','12'),
('120606','Pangoa','1206','12'),
('120607','Río Negro','1206','12'),
('120608','Río Tambo','1206','12'),
('120609','Vizcatan del Ene','1206','12'),
('120701','Tarma','1207','12'),
('120702','Acobamba','1207','12'),
('120703','Huaricolca','1207','12'),
('120704','Huasahuasi','1207','12'),
('120705','La Unión','1207','12'),
('120706','Palca','1207','12'),
('120707','Palcamayo','1207','12'),
('120708','San Pedro de Cajas','1207','12'),
('120709','Tapo','1207','12'),
('120801','La Oroya','1208','12'),
('120802','Chacapalpa','1208','12'),
('120803','Huay-Huay','1208','12'),
('120804','Marcapomacocha','1208','12'),
('120805','Morococha','1208','12'),
('120806','Paccha','1208','12'),
('120807','Santa Bárbara de Carhuacayan','1208','12'),
('120808','Santa Rosa de Sacco','1208','12'),
('120809','Suitucancha','1208','12'),
('120810','Yauli','1208','12'),
('120901','Chupaca','1209','12'),
('120902','Ahuac','1209','12'),
('120903','Chongos Bajo','1209','12'),
('120904','Huachac','1209','12'),
('120905','Huamancaca Chico','1209','12'),
('120906','San Juan de Iscos','1209','12'),
('120907','San Juan de Jarpa','1209','12'),
('120908','Tres de Diciembre','1209','12'),
('120909','Yanacancha','1209','12'),
('130101','Trujillo','1301','13'),
('130102','El Porvenir','1301','13'),
('130103','Florencia de Mora','1301','13'),
('130104','Huanchaco','1301','13'),
('130105','La Esperanza','1301','13'),
('130106','Laredo','1301','13'),
('130107','Moche','1301','13'),
('130108','Poroto','1301','13'),
('130109','Salaverry','1301','13'),
('130110','Simbal','1301','13'),
('130111','Victor Larco Herrera','1301','13'),
('130201','Ascope','1302','13'),
('130202','Chicama','1302','13'),
('130203','Chocope','1302','13'),
('130204','Magdalena de Cao','1302','13'),
('130205','Paijan','1302','13'),
('130206','Rázuri','1302','13'),
('130207','Santiago de Cao','1302','13'),
('130208','Casa Grande','1302','13'),
('130301','Bolívar','1303','13'),
('130302','Bambamarca','1303','13'),
('130303','Condormarca','1303','13'),
('130304','Longotea','1303','13'),
('130305','Uchumarca','1303','13'),
('130306','Ucuncha','1303','13'),
('130401','Chepen','1304','13'),
('130402','Pacanga','1304','13'),
('130403','Pueblo Nuevo','1304','13'),
('130501','Julcan','1305','13'),
('130502','Calamarca','1305','13'),
('130503','Carabamba','1305','13'),
('130504','Huaso','1305','13'),
('130601','Otuzco','1306','13'),
('130602','Agallpampa','1306','13'),
('130604','Charat','1306','13'),
('130605','Huaranchal','1306','13'),
('130606','La Cuesta','1306','13'),
('130608','Mache','1306','13'),
('130610','Paranday','1306','13'),
('130611','Salpo','1306','13'),
('130613','Sinsicap','1306','13'),
('130614','Usquil','1306','13'),
('130701','San Pedro de Lloc','1307','13'),
('130702','Guadalupe','1307','13'),
('130703','Jequetepeque','1307','13'),
('130704','Pacasmayo','1307','13'),
('130705','San José','1307','13'),
('130801','Tayabamba','1308','13'),
('130802','Buldibuyo','1308','13'),
('130803','Chillia','1308','13'),
('130804','Huancaspata','1308','13'),
('130805','Huaylillas','1308','13'),
('130806','Huayo','1308','13'),
('130807','Ongon','1308','13'),
('130808','Parcoy','1308','13'),
('130809','Pataz','1308','13'),
('130810','Pias','1308','13'),
('130811','Santiago de Challas','1308','13'),
('130812','Taurija','1308','13'),
('130813','Urpay','1308','13'),
('130901','Huamachuco','1309','13'),
('130902','Chugay','1309','13'),
('130903','Cochorco','1309','13'),
('130904','Curgos','1309','13'),
('130905','Marcabal','1309','13'),
('130906','Sanagoran','1309','13'),
('130907','Sarin','1309','13'),
('130908','Sartimbamba','1309','13'),
('131001','Santiago de Chuco','1310','13'),
('131002','Angasmarca','1310','13'),
('131003','Cachicadan','1310','13'),
('131004','Mollebamba','1310','13'),
('131005','Mollepata','1310','13'),
('131006','Quiruvilca','1310','13'),
('131007','Santa Cruz de Chuca','1310','13'),
('131008','Sitabamba','1310','13'),
('131101','Cascas','1311','13'),
('131102','Lucma','1311','13'),
('131103','Marmot','1311','13'),
('131104','Sayapullo','1311','13'),
('131201','Viru','1312','13'),
('131202','Chao','1312','13'),
('131203','Guadalupito','1312','13'),
('140101','Chiclayo','1401','14'),
('140102','Chongoyape','1401','14'),
('140103','Eten','1401','14'),
('140104','Eten Puerto','1401','14'),
('140105','José Leonardo Ortiz','1401','14'),
('140106','La Victoria','1401','14'),
('140107','Lagunas','1401','14'),
('140108','Monsefu','1401','14'),
('140109','Nueva Arica','1401','14'),
('140110','Oyotun','1401','14'),
('140111','Picsi','1401','14'),
('140112','Pimentel','1401','14'),
('140113','Reque','1401','14'),
('140114','Santa Rosa','1401','14'),
('140115','Saña','1401','14'),
('140116','Cayalti','1401','14'),
('140117','Patapo','1401','14'),
('140118','Pomalca','1401','14'),
('140119','Pucala','1401','14'),
('140120','Tuman','1401','14'),
('140201','Ferreñafe','1402','14'),
('140202','Cañaris','1402','14'),
('140203','Incahuasi','1402','14'),
('140204','Manuel Antonio Mesones Muro','1402','14'),
('140205','Pitipo','1402','14'),
('140206','Pueblo Nuevo','1402','14'),
('140301','Lambayeque','1403','14'),
('140302','Chochope','1403','14'),
('140303','Illimo','1403','14'),
('140304','Jayanca','1403','14'),
('140305','Mochumi','1403','14'),
('140306','Morrope','1403','14'),
('140307','Motupe','1403','14'),
('140308','Olmos','1403','14'),
('140309','Pacora','1403','14'),
('140310','Salas','1403','14'),
('140311','San José','1403','14'),
('140312','Tucume','1403','14'),
('150101','Lima','1501','15'),
('150102','Ancón','1501','15'),
('150103','Ate','1501','15'),
('150104','Barranco','1501','15'),
('150105','Breña','1501','15'),
('150106','Carabayllo','1501','15'),
('150107','Chaclacayo','1501','15'),
('150108','Chorrillos','1501','15'),
('150109','Cieneguilla','1501','15'),
('150110','Comas','1501','15'),
('150111','El Agustino','1501','15'),
('150112','Independencia','1501','15'),
('150113','Jesús María','1501','15'),
('150114','La Molina','1501','15'),
('150115','La Victoria','1501','15'),
('150116','Lince','1501','15'),
('150117','Los Olivos','1501','15'),
('150118','Lurigancho','1501','15'),
('150119','Lurin','1501','15'),
('150120','Magdalena del Mar','1501','15'),
('150121','Pueblo Libre','1501','15'),
('150122','Miraflores','1501','15'),
('150123','Pachacamac','1501','15'),
('150124','Pucusana','1501','15'),
('150125','Puente Piedra','1501','15'),
('150126','Punta Hermosa','1501','15'),
('150127','Punta Negra','1501','15'),
('150128','Rímac','1501','15'),
('150129','San Bartolo','1501','15'),
('150130','San Borja','1501','15'),
('150131','San Isidro','1501','15'),
('150132','San Juan de Lurigancho','1501','15'),
('150133','San Juan de Miraflores','1501','15'),
('150134','San Luis','1501','15'),
('150135','San Martín de Porres','1501','15'),
('150136','San Miguel','1501','15'),
('150137','Santa Anita','1501','15'),
('150138','Santa María del Mar','1501','15'),
('150139','Santa Rosa','1501','15'),
('150140','Santiago de Surco','1501','15'),
('150141','Surquillo','1501','15'),
('150142','Villa El Salvador','1501','15'),
('150143','Villa María del Triunfo','1501','15'),
('150201','Barranca','1502','15'),
('150202','Paramonga','1502','15'),
('150203','Pativilca','1502','15'),
('150204','Supe','1502','15'),
('150205','Supe Puerto','1502','15'),
('150301','Cajatambo','1503','15'),
('150302','Copa','1503','15'),
('150303','Gorgor','1503','15'),
('150304','Huancapon','1503','15'),
('150305','Manas','1503','15'),
('150401','Canta','1504','15'),
('150402','Arahuay','1504','15'),
('150403','Huamantanga','1504','15'),
('150404','Huaros','1504','15'),
('150405','Lachaqui','1504','15'),
('150406','San Buenaventura','1504','15'),
('150407','Santa Rosa de Quives','1504','15'),
('150501','San Vicente de Cañete','1505','15'),
('150502','Asia','1505','15'),
('150503','Calango','1505','15'),
('150504','Cerro Azul','1505','15'),
('150505','Chilca','1505','15'),
('150506','Coayllo','1505','15'),
('150507','Imperial','1505','15'),
('150508','Lunahuana','1505','15'),
('150509','Mala','1505','15'),
('150510','Nuevo Imperial','1505','15'),
('150511','Pacaran','1505','15'),
('150512','Quilmana','1505','15'),
('150513','San Antonio','1505','15'),
('150514','San Luis','1505','15'),
('150515','Santa Cruz de Flores','1505','15'),
('150516','Zúñiga','1505','15'),
('150601','Huaral','1506','15'),
('150602','Atavillos Alto','1506','15'),
('150603','Atavillos Bajo','1506','15'),
('150604','Aucallama','1506','15'),
('150605','Chancay','1506','15'),
('150606','Ihuari','1506','15'),
('150607','Lampian','1506','15'),
('150608','Pacaraos','1506','15'),
('150609','San Miguel de Acos','1506','15'),
('150610','Santa Cruz de Andamarca','1506','15'),
('150611','Sumbilca','1506','15'),
('150612','Veintisiete de Noviembre','1506','15'),
('150701','Matucana','1507','15'),
('150702','Antioquia','1507','15'),
('150703','Callahuanca','1507','15'),
('150704','Carampoma','1507','15'),
('150705','Chicla','1507','15'),
('150706','Cuenca','1507','15'),
('150707','Huachupampa','1507','15'),
('150708','Huanza','1507','15'),
('150709','Huarochiri','1507','15'),
('150710','Lahuaytambo','1507','15'),
('150711','Langa','1507','15'),
('150712','Laraos','1507','15'),
('150713','Mariatana','1507','15'),
('150714','Ricardo Palma','1507','15'),
('150715','San Andrés de Tupicocha','1507','15'),
('150716','San Antonio','1507','15'),
('150717','San Bartolomé','1507','15'),
('150718','San Damian','1507','15'),
('150719','San Juan de Iris','1507','15'),
('150720','San Juan de Tantaranche','1507','15'),
('150721','San Lorenzo de Quinti','1507','15'),
('150722','San Mateo','1507','15'),
('150723','San Mateo de Otao','1507','15'),
('150724','San Pedro de Casta','1507','15'),
('150725','San Pedro de Huancayre','1507','15'),
('150726','Sangallaya','1507','15'),
('150727','Santa Cruz de Cocachacra','1507','15'),
('150728','Santa Eulalia','1507','15'),
('150729','Santiago de Anchucaya','1507','15'),
('150730','Santiago de Tuna','1507','15'),
('150731','Santo Domingo de Los Olleros','1507','15'),
('150732','Surco','1507','15'),
('150801','Huacho','1508','15'),
('150802','Ambar','1508','15'),
('150803','Caleta de Carquin','1508','15'),
('150804','Checras','1508','15'),
('150805','Hualmay','1508','15'),
('150806','Huaura','1508','15'),
('150807','Leoncio Prado','1508','15'),
('150808','Paccho','1508','15'),
('150809','Santa Leonor','1508','15'),
('150810','Santa María','1508','15'),
('150811','Sayan','1508','15'),
('150812','Vegueta','1508','15'),
('150901','Oyon','1509','15'),
('150902','Andajes','1509','15'),
('150903','Caujul','1509','15'),
('150904','Cochamarca','1509','15'),
('150905','Navan','1509','15'),
('150906','Pachangara','1509','15'),
('151001','Yauyos','1510','15'),
('151002','Alis','1510','15'),
('151003','Allauca','1510','15'),
('151004','Ayaviri','1510','15'),
('151005','Azángaro','1510','15'),
('151006','Cacra','1510','15'),
('151007','Carania','1510','15'),
('151008','Catahuasi','1510','15'),
('151009','Chocos','1510','15'),
('151010','Cochas','1510','15'),
('151011','Colonia','1510','15'),
('151012','Hongos','1510','15'),
('151013','Huampara','1510','15'),
('151014','Huancaya','1510','15'),
('151015','Huangascar','1510','15'),
('151016','Huantan','1510','15'),
('151017','Huañec','1510','15'),
('151018','Laraos','1510','15'),
('151019','Lincha','1510','15'),
('151020','Madean','1510','15'),
('151021','Miraflores','1510','15'),
('151022','Omas','1510','15'),
('151023','Putinza','1510','15'),
('151024','Quinches','1510','15'),
('151025','Quinocay','1510','15'),
('151026','San Joaquín','1510','15'),
('151027','San Pedro de Pilas','1510','15'),
('151028','Tanta','1510','15'),
('151029','Tauripampa','1510','15'),
('151030','Tomas','1510','15'),
('151031','Tupe','1510','15'),
('151032','Viñac','1510','15'),
('151033','Vitis','1510','15'),
('160101','Iquitos','1601','16'),
('160102','Alto Nanay','1601','16'),
('160103','Fernando Lores','1601','16'),
('160104','Indiana','1601','16'),
('160105','Las Amazonas','1601','16'),
('160106','Mazan','1601','16'),
('160107','Napo','1601','16'),
('160108','Punchana','1601','16'),
('160110','Torres Causana','1601','16'),
('160112','Belén','1601','16'),
('160113','San Juan Bautista','1601','16'),
('160201','Yurimaguas','1602','16'),
('160202','Balsapuerto','1602','16'),
('160205','Jeberos','1602','16'),
('160206','Lagunas','1602','16'),
('160210','Santa Cruz','1602','16'),
('160211','Teniente Cesar López Rojas','1602','16'),
('160301','Nauta','1603','16'),
('160302','Parinari','1603','16'),
('160303','Tigre','1603','16'),
('160304','Trompeteros','1603','16'),
('160305','Urarinas','1603','16'),
('160401','Ramón Castilla','1604','16'),
('160402','Pebas','1604','16'),
('160403','Yavari','1604','16'),
('160404','San Pablo','1604','16'),
('160501','Requena','1605','16'),
('160502','Alto Tapiche','1605','16'),
('160503','Capelo','1605','16'),
('160504','Emilio San Martín','1605','16'),
('160505','Maquia','1605','16'),
('160506','Puinahua','1605','16'),
('160507','Saquena','1605','16'),
('160508','Soplin','1605','16'),
('160509','Tapiche','1605','16'),
('160510','Jenaro Herrera','1605','16'),
('160511','Yaquerana','1605','16'),
('160601','Contamana','1606','16'),
('160602','Inahuaya','1606','16'),
('160603','Padre Márquez','1606','16'),
('160604','Pampa Hermosa','1606','16'),
('160605','Sarayacu','1606','16'),
('160606','Vargas Guerra','1606','16'),
('160701','Barranca','1607','16'),
('160702','Cahuapanas','1607','16'),
('160703','Manseriche','1607','16'),
('160704','Morona','1607','16'),
('160705','Pastaza','1607','16'),
('160706','Andoas','1607','16'),
('160801','Putumayo','1608','16'),
('160802','Rosa Panduro','1608','16'),
('160803','Teniente Manuel Clavero','1608','16'),
('160804','Yaguas','1608','16'),
('170101','Tambopata','1701','17'),
('170102','Inambari','1701','17'),
('170103','Las Piedras','1701','17'),
('170104','Laberinto','1701','17'),
('170201','Manu','1702','17'),
('170202','Fitzcarrald','1702','17'),
('170203','Madre de Dios','1702','17'),
('170204','Huepetuhe','1702','17'),
('170301','Iñapari','1703','17'),
('170302','Iberia','1703','17'),
('170303','Tahuamanu','1703','17'),
('180101','Moquegua','1801','18'),
('180102','Carumas','1801','18'),
('180103','Cuchumbaya','1801','18'),
('180104','Samegua','1801','18'),
('180105','San Cristóbal','1801','18'),
('180106','Torata','1801','18'),
('180201','Omate','1802','18'),
('180202','Chojata','1802','18'),
('180203','Coalaque','1802','18'),
('180204','Ichuña','1802','18'),
('180205','La Capilla','1802','18'),
('180206','Lloque','1802','18'),
('180207','Matalaque','1802','18'),
('180208','Puquina','1802','18'),
('180209','Quinistaquillas','1802','18'),
('180210','Ubinas','1802','18'),
('180211','Yunga','1802','18'),
('180301','Ilo','1803','18'),
('180302','El Algarrobal','1803','18'),
('180303','Pacocha','1803','18'),
('190101','Chaupimarca','1901','19'),
('190102','Huachon','1901','19'),
('190103','Huariaca','1901','19'),
('190104','Huayllay','1901','19'),
('190105','Ninacaca','1901','19'),
('190106','Pallanchacra','1901','19'),
('190107','Paucartambo','1901','19'),
('190108','San Francisco de Asís de Yarusyacan','1901','19'),
('190109','Simon Bolívar','1901','19'),
('190110','Ticlacayan','1901','19'),
('190111','Tinyahuarco','1901','19'),
('190112','Vicco','1901','19'),
('190113','Yanacancha','1901','19'),
('190201','Yanahuanca','1902','19'),
('190202','Chacayan','1902','19'),
('190203','Goyllarisquizga','1902','19'),
('190204','Paucar','1902','19'),
('190205','San Pedro de Pillao','1902','19'),
('190206','Santa Ana de Tusi','1902','19'),
('190207','Tapuc','1902','19'),
('190208','Vilcabamba','1902','19'),
('190301','Oxapampa','1903','19'),
('190302','Chontabamba','1903','19'),
('190303','Huancabamba','1903','19'),
('190304','Palcazu','1903','19'),
('190305','Pozuzo','1903','19'),
('190306','Puerto Bermúdez','1903','19'),
('190307','Villa Rica','1903','19'),
('190308','Constitución','1903','19'),
('200101','Piura','2001','20'),
('200104','Castilla','2001','20'),
('200105','Catacaos','2001','20'),
('200107','Cura Mori','2001','20'),
('200108','El Tallan','2001','20'),
('200109','La Arena','2001','20'),
('200110','La Unión','2001','20'),
('200111','Las Lomas','2001','20'),
('200114','Tambo Grande','2001','20'),
('200115','Veintiseis de Octubre','2001','20'),
('200201','Ayabaca','2002','20'),
('200202','Frias','2002','20'),
('200203','Jilili','2002','20'),
('200204','Lagunas','2002','20'),
('200205','Montero','2002','20'),
('200206','Pacaipampa','2002','20'),
('200207','Paimas','2002','20'),
('200208','Sapillica','2002','20'),
('200209','Sicchez','2002','20'),
('200210','Suyo','2002','20'),
('200301','Huancabamba','2003','20'),
('200302','Canchaque','2003','20'),
('200303','El Carmen de la Frontera','2003','20'),
('200304','Huarmaca','2003','20'),
('200305','Lalaquiz','2003','20'),
('200306','San Miguel de El Faique','2003','20'),
('200307','Sondor','2003','20'),
('200308','Sondorillo','2003','20'),
('200401','Chulucanas','2004','20'),
('200402','Buenos Aires','2004','20'),
('200403','Chalaco','2004','20'),
('200404','La Matanza','2004','20'),
('200405','Morropon','2004','20'),
('200406','Salitral','2004','20'),
('200407','San Juan de Bigote','2004','20'),
('200408','Santa Catalina de Mossa','2004','20'),
('200409','Santo Domingo','2004','20'),
('200410','Yamango','2004','20'),
('200501','Paita','2005','20'),
('200502','Amotape','2005','20'),
('200503','Arenal','2005','20'),
('200504','Colan','2005','20'),
('200505','La Huaca','2005','20'),
('200506','Tamarindo','2005','20'),
('200507','Vichayal','2005','20'),
('200601','Sullana','2006','20'),
('200602','Bellavista','2006','20'),
('200603','Ignacio Escudero','2006','20'),
('200604','Lancones','2006','20'),
('200605','Marcavelica','2006','20'),
('200606','Miguel Checa','2006','20'),
('200607','Querecotillo','2006','20'),
('200608','Salitral','2006','20'),
('200701','Pariñas','2007','20'),
('200702','El Alto','2007','20'),
('200703','La Brea','2007','20'),
('200704','Lobitos','2007','20'),
('200705','Los Organos','2007','20'),
('200706','Mancora','2007','20'),
('200801','Sechura','2008','20'),
('200802','Bellavista de la Unión','2008','20'),
('200803','Bernal','2008','20'),
('200804','Cristo Nos Valga','2008','20'),
('200805','Vice','2008','20'),
('200806','Rinconada Llicuar','2008','20'),
('210101','Puno','2101','21'),
('210102','Acora','2101','21'),
('210103','Amantani','2101','21'),
('210104','Atuncolla','2101','21'),
('210105','Capachica','2101','21'),
('210106','Chucuito','2101','21'),
('210107','Coata','2101','21'),
('210108','Huata','2101','21'),
('210109','Mañazo','2101','21'),
('210110','Paucarcolla','2101','21'),
('210111','Pichacani','2101','21'),
('210112','Plateria','2101','21'),
('210113','San Antonio','2101','21'),
('210114','Tiquillaca','2101','21'),
('210115','Vilque','2101','21'),
('210201','Azángaro','2102','21'),
('210202','Achaya','2102','21'),
('210203','Arapa','2102','21'),
('210204','Asillo','2102','21'),
('210205','Caminaca','2102','21'),
('210206','Chupa','2102','21'),
('210207','José Domingo Choquehuanca','2102','21'),
('210208','Muñani','2102','21'),
('210209','Potoni','2102','21'),
('210210','Saman','2102','21'),
('210211','San Anton','2102','21'),
('210212','San José','2102','21'),
('210213','San Juan de Salinas','2102','21'),
('210214','Santiago de Pupuja','2102','21'),
('210215','Tirapata','2102','21'),
('210301','Macusani','2103','21'),
('210302','Ajoyani','2103','21'),
('210303','Ayapata','2103','21'),
('210304','Coasa','2103','21'),
('210305','Corani','2103','21'),
('210306','Crucero','2103','21'),
('210307','Ituata','2103','21'),
('210308','Ollachea','2103','21'),
('210309','San Gaban','2103','21'),
('210310','Usicayos','2103','21'),
('210401','Juli','2104','21'),
('210402','Desaguadero','2104','21'),
('210403','Huacullani','2104','21'),
('210404','Kelluyo','2104','21'),
('210405','Pisacoma','2104','21'),
('210406','Pomata','2104','21'),
('210407','Zepita','2104','21'),
('210501','Ilave','2105','21'),
('210502','Capazo','2105','21'),
('210503','Pilcuyo','2105','21'),
('210504','Santa Rosa','2105','21'),
('210505','Conduriri','2105','21'),
('210601','Huancane','2106','21'),
('210602','Cojata','2106','21'),
('210603','Huatasani','2106','21'),
('210604','Inchupalla','2106','21'),
('210605','Pusi','2106','21'),
('210606','Rosaspata','2106','21'),
('210607','Taraco','2106','21'),
('210608','Vilque Chico','2106','21'),
('210701','Lampa','2107','21'),
('210702','Cabanilla','2107','21'),
('210703','Calapuja','2107','21'),
('210704','Nicasio','2107','21'),
('210705','Ocuviri','2107','21'),
('210706','Palca','2107','21'),
('210707','Paratia','2107','21'),
('210708','Pucara','2107','21'),
('210709','Santa Lucia','2107','21'),
('210710','Vilavila','2107','21'),
('210801','Ayaviri','2108','21'),
('210802','Antauta','2108','21'),
('210803','Cupi','2108','21'),
('210804','Llalli','2108','21'),
('210805','Macari','2108','21'),
('210806','Nuñoa','2108','21'),
('210807','Orurillo','2108','21'),
('210808','Santa Rosa','2108','21'),
('210809','Umachiri','2108','21'),
('210901','Moho','2109','21'),
('210902','Conima','2109','21'),
('210903','Huayrapata','2109','21'),
('210904','Tilali','2109','21'),
('211001','Putina','2110','21'),
('211002','Ananea','2110','21'),
('211003','Pedro Vilca Apaza','2110','21'),
('211004','Quilcapuncu','2110','21'),
('211005','Sina','2110','21'),
('211101','Juliaca','2111','21'),
('211102','Cabana','2111','21'),
('211103','Cabanillas','2111','21'),
('211104','Caracoto','2111','21'),
('211105','San Miguel','2111','21'),
('211201','Sandia','2112','21'),
('211202','Cuyocuyo','2112','21'),
('211203','Limbani','2112','21'),
('211204','Patambuco','2112','21'),
('211205','Phara','2112','21'),
('211206','Quiaca','2112','21'),
('211207','San Juan del Oro','2112','21'),
('211208','Yanahuaya','2112','21'),
('211209','Alto Inambari','2112','21'),
('211210','San Pedro de Putina Punco','2112','21'),
('211301','Yunguyo','2113','21'),
('211302','Anapia','2113','21'),
('211303','Copani','2113','21'),
('211304','Cuturapi','2113','21'),
('211305','Ollaraya','2113','21'),
('211306','Tinicachi','2113','21'),
('211307','Unicachi','2113','21'),
('220101','Moyobamba','2201','22'),
('220102','Calzada','2201','22'),
('220103','Habana','2201','22'),
('220104','Jepelacio','2201','22'),
('220105','Soritor','2201','22'),
('220106','Yantalo','2201','22'),
('220201','Bellavista','2202','22'),
('220202','Alto Biavo','2202','22'),
('220203','Bajo Biavo','2202','22'),
('220204','Huallaga','2202','22'),
('220205','San Pablo','2202','22'),
('220206','San Rafael','2202','22'),
('220301','San José de Sisa','2203','22'),
('220302','Agua Blanca','2203','22'),
('220303','San Martín','2203','22'),
('220304','Santa Rosa','2203','22'),
('220305','Shatoja','2203','22'),
('220401','Saposoa','2204','22'),
('220402','Alto Saposoa','2204','22'),
('220403','El Eslabón','2204','22'),
('220404','Piscoyacu','2204','22'),
('220405','Sacanche','2204','22'),
('220406','Tingo de Saposoa','2204','22'),
('220501','Lamas','2205','22'),
('220502','Alonso de Alvarado','2205','22'),
('220503','Barranquita','2205','22'),
('220504','Caynarachi','2205','22'),
('220505','Cuñumbuqui','2205','22'),
('220506','Pinto Recodo','2205','22'),
('220507','Rumisapa','2205','22'),
('220508','San Roque de Cumbaza','2205','22'),
('220509','Shanao','2205','22'),
('220510','Tabalosos','2205','22'),
('220511','Zapatero','2205','22'),
('220601','Juanjuí','2206','22'),
('220602','Campanilla','2206','22'),
('220603','Huicungo','2206','22'),
('220604','Pachiza','2206','22'),
('220605','Pajarillo','2206','22'),
('220701','Picota','2207','22'),
('220702','Buenos Aires','2207','22'),
('220703','Caspisapa','2207','22'),
('220704','Pilluana','2207','22'),
('220705','Pucacaca','2207','22'),
('220706','San Cristóbal','2207','22'),
('220707','San Hilarión','2207','22'),
('220708','Shamboyacu','2207','22'),
('220709','Tingo de Ponasa','2207','22'),
('220710','Tres Unidos','2207','22'),
('220801','Rioja','2208','22'),
('220802','Awajun','2208','22'),
('220803','Elías Soplin Vargas','2208','22'),
('220804','Nueva Cajamarca','2208','22'),
('220805','Pardo Miguel','2208','22'),
('220806','Posic','2208','22'),
('220807','San Fernando','2208','22'),
('220808','Yorongos','2208','22'),
('220809','Yuracyacu','2208','22'),
('220901','Tarapoto','2209','22'),
('220902','Alberto Leveau','2209','22'),
('220903','Cacatachi','2209','22'),
('220904','Chazuta','2209','22'),
('220905','Chipurana','2209','22'),
('220906','El Porvenir','2209','22'),
('220907','Huimbayoc','2209','22'),
('220908','Juan Guerra','2209','22'),
('220909','La Banda de Shilcayo','2209','22'),
('220910','Morales','2209','22'),
('220911','Papaplaya','2209','22'),
('220912','San Antonio','2209','22'),
('220913','Sauce','2209','22'),
('220914','Shapaja','2209','22'),
('221001','Tocache','2210','22'),
('221002','Nuevo Progreso','2210','22'),
('221003','Polvora','2210','22'),
('221004','Shunte','2210','22'),
('221005','Uchiza','2210','22'),
('230101','Tacna','2301','23'),
('230102','Alto de la Alianza','2301','23'),
('230103','Calana','2301','23'),
('230104','Ciudad Nueva','2301','23'),
('230105','Inclan','2301','23'),
('230106','Pachia','2301','23'),
('230107','Palca','2301','23'),
('230108','Pocollay','2301','23'),
('230109','Sama','2301','23'),
('230110','Coronel Gregorio Albarracín Lanchipa','2301','23'),
('230111','La Yarada los Palos','2301','23'),
('230201','Candarave','2302','23'),
('230202','Cairani','2302','23'),
('230203','Camilaca','2302','23'),
('230204','Curibaya','2302','23'),
('230205','Huanuara','2302','23'),
('230206','Quilahuani','2302','23'),
('230301','Locumba','2303','23'),
('230302','Ilabaya','2303','23'),
('230303','Ite','2303','23'),
('230401','Tarata','2304','23'),
('230402','Héroes Albarracín','2304','23'),
('230403','Estique','2304','23'),
('230404','Estique-Pampa','2304','23'),
('230405','Sitajara','2304','23'),
('230406','Susapaya','2304','23'),
('230407','Tarucachi','2304','23'),
('230408','Ticaco','2304','23'),
('240101','Tumbes','2401','24'),
('240102','Corrales','2401','24'),
('240103','La Cruz','2401','24'),
('240104','Pampas de Hospital','2401','24'),
('240105','San Jacinto','2401','24'),
('240106','San Juan de la Virgen','2401','24'),
('240201','Zorritos','2402','24'),
('240202','Casitas','2402','24'),
('240203','Canoas de Punta Sal','2402','24'),
('240301','Zarumilla','2403','24'),
('240302','Aguas Verdes','2403','24'),
('240303','Matapalo','2403','24'),
('240304','Papayal','2403','24'),
('250101','Calleria','2501','25'),
('250102','Campoverde','2501','25'),
('250103','Iparia','2501','25'),
('250104','Masisea','2501','25'),
('250105','Yarinacocha','2501','25'),
('250106','Nueva Requena','2501','25'),
('250107','Manantay','2501','25'),
('250201','Raymondi','2502','25'),
('250202','Sepahua','2502','25'),
('250203','Tahuania','2502','25'),
('250204','Yurua','2502','25'),
('250301','Padre Abad','2503','25'),
('250302','Irazola','2503','25'),
('250303','Curimana','2503','25'),
('250304','Neshuya','2503','25'),
('250305','Alexander Von Humboldt','2503','25'),
('250401','Purus','2504','25');

/*Table structure for table `especialidades` */

DROP TABLE IF EXISTS `especialidades`;

CREATE TABLE `especialidades` (
  `idespecialidad` int(11) NOT NULL AUTO_INCREMENT,
  `idservicio` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `descripcion` mediumtext NOT NULL,
  `tarifa` decimal(7,2) NOT NULL,
  PRIMARY KEY (`idespecialidad`),
  KEY `fk_esp_idservicio` (`idservicio`),
  KEY `fk_esp_idusuario` (`idusuario`),
  CONSTRAINT `fk_esp_idservicio` FOREIGN KEY (`idservicio`) REFERENCES `servicios` (`idservicio`),
  CONSTRAINT `fk_esp_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `especialidades` */

insert  into `especialidades`(`idespecialidad`,`idservicio`,`idusuario`,`descripcion`,`tarifa`) values 
(1,1,1,'Cálculo de secciones de líneas eléctricas',85.25),
(2,1,1,'Electrotecnia',180.20),
(3,1,1,'Riesgo eléctrico',85.00),
(4,1,1,'Tensión eléctrica',540.00);

/*Table structure for table `establecimientos` */

DROP TABLE IF EXISTS `establecimientos`;

CREATE TABLE `establecimientos` (
  `idestablecimiento` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `establecimiento` varchar(30) NOT NULL,
  `ruc` char(11) NOT NULL,
  `tipocalle` char(2) NOT NULL,
  `nombrecalle` varchar(60) NOT NULL,
  `numerocalle` varchar(5) DEFAULT NULL,
  `referencia` varchar(80) DEFAULT NULL,
  `latitud` float(10,8) NOT NULL,
  `longitud` float(10,8) NOT NULL,
  `iddistrito` varchar(6) NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idestablecimiento`),
  UNIQUE KEY `uk_est_ruc` (`ruc`),
  KEY `fk_est_idusuario` (`idusuario`),
  KEY `fk_est_iddistrito` (`iddistrito`),
  CONSTRAINT `fk_est_iddistrito` FOREIGN KEY (`iddistrito`) REFERENCES `distritos` (`iddistrito`),
  CONSTRAINT `fk_est_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `establecimientos` */

insert  into `establecimientos`(`idestablecimiento`,`idusuario`,`establecimiento`,`ruc`,`tipocalle`,`nombrecalle`,`numerocalle`,`referencia`,`latitud`,`longitud`,`iddistrito`,`estado`) values 
(1,1,'Mecanina pilon motors','12452585696','CA','Molina','25','Pasando la segunda cuadra',-12.06710052,-77.03235626,'010110',''),
(2,2,'Electricista ZORNOMAZ','12452585626','UR','Leon de Vivero','52','Antes de ',-12.06710052,-77.03235626,'010115',''),
(3,3,'ABOGADOS CHINCHA','12452582696','UR','Las palmeras','82','',-12.06720066,-77.03835297,'010120','');

/*Table structure for table `foros` */

DROP TABLE IF EXISTS `foros`;

CREATE TABLE `foros` (
  `idforo` int(11) NOT NULL AUTO_INCREMENT,
  `idtousuario` int(11) NOT NULL,
  `idfromusuario` int(11) NOT NULL,
  `consulta` mediumtext NOT NULL,
  `fechaconsulta` datetime NOT NULL DEFAULT current_timestamp(),
  `fechaeliminado` datetime DEFAULT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idforo`),
  UNIQUE KEY `uk_for_idtousuario` (`idtousuario`,`idfromusuario`),
  KEY `fk_for_idfromusuario` (`idfromusuario`),
  CONSTRAINT `fk_for_idfromusuario` FOREIGN KEY (`idfromusuario`) REFERENCES `usuarios` (`idusuario`),
  CONSTRAINT `fk_for_idtousuario` FOREIGN KEY (`idtousuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `foros` */

/*Table structure for table `galerias` */

DROP TABLE IF EXISTS `galerias`;

CREATE TABLE `galerias` (
  `idgaleria` int(11) NOT NULL AUTO_INCREMENT,
  `idalbum` int(11) DEFAULT NULL,
  `idusuario` int(11) NOT NULL,
  `idtrabajo` int(11) DEFAULT NULL,
  `tipo` char(1) NOT NULL,
  `archivo` varchar(100) NOT NULL,
  `fechaalta` datetime NOT NULL DEFAULT current_timestamp(),
  `fechabaja` datetime DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idgaleria`),
  KEY `fk_gal_idalbum` (`idalbum`),
  KEY `fk_gal_idusuario` (`idusuario`),
  KEY `fk_gal_idtrabajo` (`idtrabajo`),
  CONSTRAINT `fk_gal_idalbum` FOREIGN KEY (`idalbum`) REFERENCES `albumes` (`idalbum`),
  CONSTRAINT `fk_gal_idtrabajo` FOREIGN KEY (`idtrabajo`) REFERENCES `trabajos` (`idtrabajo`),
  CONSTRAINT `fk_gal_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `galerias` */

insert  into `galerias`(`idgaleria`,`idalbum`,`idusuario`,`idtrabajo`,`tipo`,`archivo`,`fechaalta`,`fechabaja`,`estado`) values 
(1,1,1,NULL,'F','012555454545448599','2022-04-02 18:18:02',NULL,'2'),
(2,3,1,1,'V','012555454545447852','2022-04-02 18:18:02',NULL,'1'),
(3,NULL,2,NULL,'F','5454484087874818','2022-04-02 22:05:41',NULL,'1'),
(4,2,2,NULL,'F','5454484087874818','2022-04-02 22:07:19',NULL,'1');

/*Table structure for table `personas` */

DROP TABLE IF EXISTS `personas`;

CREATE TABLE `personas` (
  `idpersona` int(11) NOT NULL AUTO_INCREMENT,
  `iddistrito` varchar(6) NOT NULL,
  `apellidos` varchar(40) NOT NULL,
  `nombres` varchar(40) NOT NULL,
  `fechanac` date NOT NULL,
  `telefono` char(11) DEFAULT NULL,
  `tipocalle` char(2) NOT NULL,
  `nombrecalle` varchar(60) NOT NULL,
  `numerocalle` varchar(5) DEFAULT NULL,
  `pisodepa` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`idpersona`),
  KEY `fk_per_iddistrito` (`iddistrito`),
  CONSTRAINT `fk_per_iddistrito` FOREIGN KEY (`iddistrito`) REFERENCES `distritos` (`iddistrito`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `personas` */

insert  into `personas`(`idpersona`,`iddistrito`,`apellidos`,`nombres`,`fechanac`,`telefono`,`tipocalle`,`nombrecalle`,`numerocalle`,`pisodepa`) values 
(1,'010117','Magallanes Perez','Luis Enrique','1998-05-25','05695674856','AV','Las palmeras','25','5'),
(2,'010118','Hernandez Monterroza','Adriana Carolina','1999-05-14','05695674858','CA','Los Sauces','150','3'),
(3,'010119','Carvajal Vargas','Alexander','1999-05-14','05695674558','JR','Las Lomas','5','2'),
(4,'010120','Blanca Concha','Angelica Maria','1999-05-14','05695604858','PJ','Cartajena','250','3'),
(5,'010121','Ospina Alfonso','Catherine','1999-05-14','05695674858','AV','Prada N°258','255','2');

/*Table structure for table `provincias` */

DROP TABLE IF EXISTS `provincias`;

CREATE TABLE `provincias` (
  `idprovincia` varchar(4) NOT NULL,
  `provincia` varchar(45) NOT NULL,
  `iddepartamento` varchar(2) NOT NULL,
  PRIMARY KEY (`idprovincia`),
  KEY `fk_iddepartamento_pro` (`iddepartamento`),
  CONSTRAINT `fk_iddepartamento_pro` FOREIGN KEY (`iddepartamento`) REFERENCES `departamentos` (`iddepartamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `provincias` */

insert  into `provincias`(`idprovincia`,`provincia`,`iddepartamento`) values 
('0101','Chachapoyas','01'),
('0102','Bagua','01'),
('0103','Bongará','01'),
('0104','Condorcanqui','01'),
('0105','Luya','01'),
('0106','Rodríguez de Mendoza','01'),
('0107','Utcubamba','01'),
('0201','Huaraz','02'),
('0202','Aija','02'),
('0203','Antonio Raymondi','02'),
('0204','Asunción','02'),
('0205','Bolognesi','02'),
('0206','Carhuaz','02'),
('0207','Carlos Fermín Fitzcarrald','02'),
('0208','Casma','02'),
('0209','Corongo','02'),
('0210','Huari','02'),
('0211','Huarmey','02'),
('0212','Huaylas','02'),
('0213','Mariscal Luzuriaga','02'),
('0214','Ocros','02'),
('0215','Pallasca','02'),
('0216','Pomabamba','02'),
('0217','Recuay','02'),
('0218','Santa','02'),
('0219','Sihuas','02'),
('0220','Yungay','02'),
('0301','Abancay','03'),
('0302','Andahuaylas','03'),
('0303','Antabamba','03'),
('0304','Aymaraes','03'),
('0305','Cotabambas','03'),
('0306','Chincheros','03'),
('0307','Grau','03'),
('0401','Arequipa','04'),
('0402','Camaná','04'),
('0403','Caravelí','04'),
('0404','Castilla','04'),
('0405','Caylloma','04'),
('0406','Condesuyos','04'),
('0407','Islay','04'),
('0408','La Uniòn','04'),
('0501','Huamanga','05'),
('0502','Cangallo','05'),
('0503','Huanca Sancos','05'),
('0504','Huanta','05'),
('0505','La Mar','05'),
('0506','Lucanas','05'),
('0507','Parinacochas','05'),
('0508','Pàucar del Sara Sara','05'),
('0509','Sucre','05'),
('0510','Víctor Fajardo','05'),
('0511','Vilcas Huamán','05'),
('0601','Cajamarca','06'),
('0602','Cajabamba','06'),
('0603','Celendín','06'),
('0604','Chota','06'),
('0605','Contumazá','06'),
('0606','Cutervo','06'),
('0607','Hualgayoc','06'),
('0608','Jaén','06'),
('0609','San Ignacio','06'),
('0610','San Marcos','06'),
('0611','San Miguel','06'),
('0612','San Pablo','06'),
('0613','Santa Cruz','06'),
('0701','Prov. Const. del Callao','07'),
('0801','Cusco','08'),
('0802','Acomayo','08'),
('0803','Anta','08'),
('0804','Calca','08'),
('0805','Canas','08'),
('0806','Canchis','08'),
('0807','Chumbivilcas','08'),
('0808','Espinar','08'),
('0809','La Convención','08'),
('0810','Paruro','08'),
('0811','Paucartambo','08'),
('0812','Quispicanchi','08'),
('0813','Urubamba','08'),
('0901','Huancavelica','09'),
('0902','Acobamba','09'),
('0903','Angaraes','09'),
('0904','Castrovirreyna','09'),
('0905','Churcampa','09'),
('0906','Huaytará','09'),
('0907','Tayacaja','09'),
('1001','Huánuco','10'),
('1002','Ambo','10'),
('1003','Dos de Mayo','10'),
('1004','Huacaybamba','10'),
('1005','Huamalíes','10'),
('1006','Leoncio Prado','10'),
('1007','Marañón','10'),
('1008','Pachitea','10'),
('1009','Puerto Inca','10'),
('1010','Lauricocha ','10'),
('1011','Yarowilca ','10'),
('1101','Ica ','11'),
('1102','Chincha ','11'),
('1103','Nasca ','11'),
('1104','Palpa ','11'),
('1105','Pisco ','11'),
('1201','Huancayo ','12'),
('1202','Concepción ','12'),
('1203','Chanchamayo ','12'),
('1204','Jauja ','12'),
('1205','Junín ','12'),
('1206','Satipo ','12'),
('1207','Tarma ','12'),
('1208','Yauli ','12'),
('1209','Chupaca ','12'),
('1301','Trujillo ','13'),
('1302','Ascope ','13'),
('1303','Bolívar ','13'),
('1304','Chepén ','13'),
('1305','Julcán ','13'),
('1306','Otuzco ','13'),
('1307','Pacasmayo ','13'),
('1308','Pataz ','13'),
('1309','Sánchez Carrión ','13'),
('1310','Santiago de Chuco ','13'),
('1311','Gran Chimú ','13'),
('1312','Virú ','13'),
('1401','Chiclayo ','14'),
('1402','Ferreñafe ','14'),
('1403','Lambayeque ','14'),
('1501','Lima ','15'),
('1502','Barranca ','15'),
('1503','Cajatambo ','15'),
('1504','Canta ','15'),
('1505','Cañete ','15'),
('1506','Huaral ','15'),
('1507','Huarochirí ','15'),
('1508','Huaura ','15'),
('1509','Oyón ','15'),
('1510','Yauyos ','15'),
('1601','Maynas ','16'),
('1602','Alto Amazonas ','16'),
('1603','Loreto ','16'),
('1604','Mariscal Ramón Castilla ','16'),
('1605','Requena ','16'),
('1606','Ucayali ','16'),
('1607','Datem del Marañón ','16'),
('1608','Putumayo','16'),
('1701','Tambopata ','17'),
('1702','Manu ','17'),
('1703','Tahuamanu ','17'),
('1801','Mariscal Nieto ','18'),
('1802','General Sánchez Cerro ','18'),
('1803','Ilo ','18'),
('1901','Pasco ','19'),
('1902','Daniel Alcides Carrión ','19'),
('1903','Oxapampa ','19'),
('2001','Piura ','20'),
('2002','Ayabaca ','20'),
('2003','Huancabamba ','20'),
('2004','Morropón ','20'),
('2005','Paita ','20'),
('2006','Sullana ','20'),
('2007','Talara ','20'),
('2008','Sechura ','20'),
('2101','Puno ','21'),
('2102','Azángaro ','21'),
('2103','Carabaya ','21'),
('2104','Chucuito ','21'),
('2105','El Collao ','21'),
('2106','Huancané ','21'),
('2107','Lampa ','21'),
('2108','Melgar ','21'),
('2109','Moho ','21'),
('2110','San Antonio de Putina ','21'),
('2111','San Román ','21'),
('2112','Sandia ','21'),
('2113','Yunguyo ','21'),
('2201','Moyobamba ','22'),
('2202','Bellavista ','22'),
('2203','El Dorado ','22'),
('2204','Huallaga ','22'),
('2205','Lamas ','22'),
('2206','Mariscal Cáceres ','22'),
('2207','Picota ','22'),
('2208','Rioja ','22'),
('2209','San Martín ','22'),
('2210','Tocache ','22'),
('2301','Tacna ','23'),
('2302','Candarave ','23'),
('2303','Jorge Basadre ','23'),
('2304','Tarata ','23'),
('2401','Tumbes ','24'),
('2402','Contralmirante Villar ','24'),
('2403','Zarumilla ','24'),
('2501','Coronel Portillo ','25'),
('2502','Atalaya ','25'),
('2503','Padre Abad ','25'),
('2504','Purús','25');

/*Table structure for table `redessociales` */

DROP TABLE IF EXISTS `redessociales`;

CREATE TABLE `redessociales` (
  `idredsocial` int(11) NOT NULL AUTO_INCREMENT,
  `idusuario` int(11) NOT NULL,
  `redsocial` char(1) NOT NULL,
  `vinculo` mediumtext NOT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idredsocial`),
  KEY `fk_reds_idusuario` (`idusuario`),
  CONSTRAINT `fk_reds_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
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
  KEY `fk_rep_idcomentario` (`idcomentario`),
  CONSTRAINT `fk_rep_idcomentario` FOREIGN KEY (`idcomentario`) REFERENCES `comentarios` (`idcomentario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `reportes` */

insert  into `reportes`(`idreporte`,`idcomentario`,`motivo`,`descripcion`,`fotografia`,`fechareporte`) values 
(1,2,'Mesaje indebido','Mala calificación del trabajo','011555555959258','2022-04-02 18:18:28');

/*Table structure for table `seguidores` */

DROP TABLE IF EXISTS `seguidores`;

CREATE TABLE `seguidores` (
  `idseguidor` int(11) NOT NULL AUTO_INCREMENT,
  `idfollowing` int(11) NOT NULL,
  `idfollower` int(11) NOT NULL,
  `fechaseguido` datetime NOT NULL DEFAULT current_timestamp(),
  `fechaeliminado` datetime DEFAULT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'1',
  PRIMARY KEY (`idseguidor`),
  UNIQUE KEY `uk_seg_idfollower` (`idfollowing`,`idfollower`),
  KEY `fk_seg_idfollower` (`idfollower`),
  CONSTRAINT `fk_seg_idfollower` FOREIGN KEY (`idfollower`) REFERENCES `usuarios` (`idusuario`),
  CONSTRAINT `fk_seg_idfollowing` FOREIGN KEY (`idfollowing`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `seguidores` */

insert  into `seguidores`(`idseguidor`,`idfollowing`,`idfollower`,`fechaseguido`,`fechaeliminado`,`estado`) values 
(1,1,2,'2022-04-02 18:13:41',NULL,''),
(2,1,3,'2022-04-02 18:13:41',NULL,'');

/*Table structure for table `servicios` */

DROP TABLE IF EXISTS `servicios`;

CREATE TABLE `servicios` (
  `idservicio` int(11) NOT NULL AUTO_INCREMENT,
  `nombreservicio` varchar(50) NOT NULL,
  PRIMARY KEY (`idservicio`),
  UNIQUE KEY `uk_ser_nombreservicio` (`nombreservicio`)
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
  KEY `fk_trab_idespecialidad` (`idespecialidad`),
  KEY `fk_trab_idusuario` (`idusuario`),
  CONSTRAINT `fk_trab_idespecialidad` FOREIGN KEY (`idespecialidad`) REFERENCES `especialidades` (`idespecialidad`),
  CONSTRAINT `fk_trab_idusuario` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `trabajos` */

insert  into `trabajos`(`idtrabajo`,`idespecialidad`,`idusuario`,`titulo`,`descripcion`,`fechapublicado`,`fechamodificado`,`fechaeliminado`,`estado`) values 
(1,1,1,'Servicio de electricista','Trabajo realizado en etc..','2022-04-02 18:15:52',NULL,NULL,''),
(2,2,1,'Electrista de cableado','Trabajo realizado en ..','2022-04-02 18:15:52',NULL,NULL,'');

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL AUTO_INCREMENT,
  `idpersona` int(11) NOT NULL,
  `descripcion` mediumtext DEFAULT NULL,
  `horarioatencion` varchar(80) DEFAULT NULL,
  `nivelusuario` char(1) NOT NULL DEFAULT 'E',
  `rol` char(1) NOT NULL DEFAULT 'U',
  `email` varchar(70) NOT NULL,
  `emailrespaldo` varchar(70) DEFAULT NULL,
  `clave` varchar(80) NOT NULL,
  `fechaalta` datetime NOT NULL DEFAULT current_timestamp(),
  `fechabaja` datetime DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idusuario`),
  UNIQUE KEY `uk_usu_email` (`email`),
  UNIQUE KEY `uk_usu_idpersoba` (`idpersona`,`idusuario`),
  UNIQUE KEY `uk_usu_idpersona` (`idpersona`),
  UNIQUE KEY `uk_usu_emailrespaldo` (`emailrespaldo`),
  CONSTRAINT `fk_usu_idpersona` FOREIGN KEY (`idpersona`) REFERENCES `personas` (`idpersona`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `usuarios` */

insert  into `usuarios`(`idusuario`,`idpersona`,`descripcion`,`horarioatencion`,`nivelusuario`,`rol`,`email`,`emailrespaldo`,`clave`,`fechaalta`,`fechabaja`,`estado`) values 
(1,1,'descripción','Atención de Lunes a Sabado de 08:00 AM a 09:00 PM','E','U','Luis@gmail.com',NULL,'12345','2022-04-02 17:52:45',NULL,'1'),
(2,2,'descipción','Atención de Lunes a Sabado de 08:00 AM a 09:00 PM','E','U','Adriana@gmail.com',NULL,'12345','2022-04-02 17:52:45',NULL,'1'),
(3,3,'Albañil','Miercoles y Viernes','E','A','Alex@gmail.com','alex2@gmail.com','12345','2022-04-02 17:52:45',NULL,'1'),
(7,4,'Excelente en su area','Lunes a sabado de 8:00 Am a 6:00 PM','E','U','angelica@gmail.com',NULL,'124563','2022-04-02 18:39:39',NULL,'1');

/* Procedure structure for procedure `spu_albumes_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_albumes_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_albumes_eliminar`(IN _idalbum INT)
BEGIN
	UPDATE albumes SET 
		estado = 0
	WHERE idalbum = _idalbum;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_albumes_getdata` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_albumes_getdata` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_albumes_getdata`(IN _idalbum INT)
BEGIN
	SELECT * FROM albumes 
		WHERE idalbum = _idalbum AND estado = 1;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_albumes_listar_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_albumes_listar_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_albumes_listar_usuario`(IN _idusuario INT)
BEGIN
	SELECT * FROM albumes 
		WHERE idusuario = _idusuario AND estado = 1;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_albumes_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_albumes_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_albumes_modificar`(
	IN _idalbum			INT,
	IN _nombrealbum VARCHAR(30)
)
BEGIN
	UPDATE albumes SET 
		nombrealbum = _nombrealbum
	WHERE idalbum = _idalbum;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_albumes_predeterminados` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_albumes_predeterminados` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_albumes_predeterminados`(
	IN _idusuario 	INT
)
BEGIN
	INSERT INTO albumes (idusuario, nombrealbum) VALUES
		(_idusuario, 'Perfil');
	INSERT INTO albumes (idusuario, nombrealbum) VALUES
		(_idusuario, 'Portada');
	INSERT INTO albumes (idusuario, nombrealbum) VALUES
		(_idusuario, 'Publicaciones');
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_albumes_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_albumes_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_albumes_registrar`(
	IN _idusuario 	INT,
	IN _nombrealbum VARCHAR(30)
)
BEGIN
	INSERT INTO albumes (idusuario, nombrealbum) VALUES
		(_idusuario, _nombrealbum);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_albunes_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_albunes_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_albunes_eliminar`(IN _idalbum INT)
BEGIN
	UPDATE albunes SET 
		estado = 0
	WHERE idalbum = _idalbum;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_calificaciones_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_calificaciones_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_calificaciones_eliminar`(IN _idcalificacion INT)
BEGIN 
	UPDATE calificaciones SET estado = 0
		WHERE idcalificacion = _idcalificacion;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_calificaciones_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_calificaciones_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_calificaciones_modificar`(
	IN _idcalificacion 	INT,
	IN _puntuacion			TINYINT 
)
BEGIN 
	UPDATE calificaciones SET 
		puntuacion = _puntuacion
	WHERE idcalificacion = _idcalificacion;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_calificaciones_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_calificaciones_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_calificaciones_registrar`(
	IN _idtrabajo		INT,
	IN _idusuario		INT,
	IN _puntuacion	TINYINT 
)
BEGIN 
	INSERT INTO calificaciones (idtrabajo , idusuario , puntuacion) VALUES
		(_idtrabajo , _idusuario , _puntuacion);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_comentarios_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_comentarios_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_comentarios_eliminar`(IN _idcomentario INT)
BEGIN 
	UPDATE comentarios SET estado = 0
		WHERE idtrabajo = _idtrabajo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_comentarios_listar_trabajo` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_comentarios_listar_trabajo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_comentarios_listar_trabajo`(in _idtrabajo int)
BEGIN
	SELECT * FROM vs_comentarios_listar
		where idtrabajo = _idtrabajo
		ORDER BY idcomentario DESC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_comentarios_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_comentarios_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_comentarios_modificar`(
	IN _idcomentario INT,
	IN _comentario	MEDIUMTEXT
)
BEGIN 
	UPDATE comentarios SET
		comentario 			= _comentario,
		fechamodificado = now()
	WHERE idcomentario = _idcomentario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_comentarios_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_comentarios_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_comentarios_registrar`(
	IN _idtrabajo		INT,
	IN _idusuario		INT,
	IN _comentario	MEDIUMTEXT
)
BEGIN 
	INSERT INTO comentarios (idtrabajo , idusuario , comentario ) VALUES 
		(_idtrabajo , _idusuario,_comentario);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_departamentos_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_departamentos_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_departamentos_listar`()
BEGIN
	SELECT * FROM departamentos;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_distritos_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_distritos_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_distritos_listar`(IN _idprovincia VARCHAR(4))
BEGIN
	SELECT * FROM distritos WHERE idprovincia = _idprovincia;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_eliminar_actividades` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_eliminar_actividades` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_eliminar_actividades`(IN _idactividad INT)
BEGIN
	DELETE FROM actividades WHERE idactividad = _idactividad;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_email_verifi` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_email_verifi` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_email_verifi`(
	IN _email VARCHAR(70)
)
BEGIN
	SELECT COUNT(*) FROM usuarios WHERE email = _email;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_especialidades_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_especialidades_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_especialidades_listar`()
BEGIN
   SELECT * FROM vs_especialidades_listar;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_especialidades_listar_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_especialidades_listar_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_especialidades_listar_usuario`(in _idusuario int)
BEGIN
   SELECT idespecialidad, idusuario, idservicio, descripcion
      FROM especialidades
      where idusuario = _idusuario
      ORDER BY idespecialidad DESC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_especialidades_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_especialidades_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_especialidades_modificar`(
    IN _idespecialidad	INT,
    IN _idusuario				INT,
    IN _idservicio			INT,
    IN _descripcion			MEDIUMTEXT,
    IN _tarifa					DECIMAL(7,2)
)
BEGIN 
    UPDATE especialidades SET
       idusuario 		= _idusuario, 
       idservicio 	= _idservicio,
       descripcion 	= _descripcion,
       tarifa 			= _tarifa
    WHERE idespecialidad = _idespecialidad;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_especialidades_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_especialidades_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_especialidades_registrar`(
    IN _idusuario		INT,
    IN _idservicio	INT,
    IN _descripcion	MEDIUMTEXT,
    in _tarifa			decimal(7,2)
)
BEGIN
   INSERT INTO especialidades (idusuario, idservicio, descripcion, tarifa)
      VALUES (_idusuario, _idservicio, _descripcion, _tarifa);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_establecimientos_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_establecimientos_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_establecimientos_eliminar`(IN _idestablecimiento INT)
BEGIN
	UPDATE establecimientos SET
		estado = 0
	WHERE idestablecimiento = _idestablecimiento;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_establecimientos_getdata` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_establecimientos_getdata` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_establecimientos_getdata`(IN _idestablecimiento INT)
BEGIN
	SELECT * FROM establecimientos WHERE idestablecimiento = _idestablecimiento;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_establecimientos_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_establecimientos_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_establecimientos_modificar`(
	IN _idestablecimiento INT,
	IN _idusuario 				INT,
	IN _iddistrito 				VARCHAR(6),
	IN _establecimiento		VARCHAR(30),
	IN _ruc								CHAR(11),
	IN _tipocalle 				CHAR(2),
	IN _nombrecalle 			VARCHAR(60),
	IN _numerocalle 			VARCHAR(5),
	IN _referencia				VARCHAR(80),
	IN _latitud						FLOAT(10, 8),
	IN _longitud					FLOAT(10, 8)
)
BEGIN
	UPDATE establecimientos SET
		idusuario 			= _idusuario,
		iddistrito 			= _iddistrito,
		establecimiento = _establecimiento,
		ruc							= _ruc,
		tipocalle				= _tipocalle,
		nombrecalle			= _nombrecalle,
		numerocalle			= _numerocalle,
		referencia			= _referencia,
		latitud					= _latitud,
		longitud				= _longitud
	WHERE idestablecimiento 	= _idestablecimiento;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_establecimientos_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_establecimientos_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_establecimientos_registrar`(
	IN _idusuario 				int,
	in _iddistrito 				varchar(6),
	IN _establecimiento		VARCHAR(30),
	IN _ruc								CHAR(11),
	in _tipocalle 				CHAR(2),
	in _nombrecalle 			VARCHAR(60),
	in _numerocalle 			VARCHAR(5),
	IN _referencia				VARCHAR(80),
	IN _latitud						FLOAT(10, 8),
	IN _longitud					FLOAT(10, 8)
)
BEGIN
	IF _numerocalle = '' THEN SET _numerocalle = NULL; END IF;
	IF _referencia = '' THEN SET _referencia = NULL; END IF;
	INSERT INTO establecimientos (idusuario, iddistrito, establecimiento, ruc, tipocalle, nombrecalle, numerocalle, referencia, latitud, longitud)
		VALUES (_idusuario, _iddistrito, _establecimiento, _ruc, _tipocalle, _nombrecalle, _numerocalle, _referencia, _latitud, _longitud);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_filtrar_actividad` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_filtrar_actividad` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_filtrar_actividad`(IN _idusuario INT)
BEGIN
	SELECT * FROM vs_listar_actividades WHERE idusuario = _idusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_filtrar_actividad_fecha` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_filtrar_actividad_fecha` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_filtrar_actividad_fecha`(
	IN _idusuario 	INT,
	IN _fechainicio DATE,
	IN _fechafin		DATE
)
BEGIN
	SELECT * FROM vs_listar_actividades 
		WHERE idusuario = _idusuario AND 
			fecha BETWEEN _fechainicio AND _fechafin;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_filtrar_reportes_fecha` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_filtrar_reportes_fecha` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_filtrar_reportes_fecha`(
	IN _fechainicio DATE, 
	IN _fechafin 		DATE
)
BEGIN
	SELECT * FROM vs_listar_reportes 
		WHERE fechareporte BETWEEN _fechainicio AND _fechafin;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_filtrar_reportes_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_filtrar_reportes_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_filtrar_reportes_usuario`(
	IN _nombres 	VARCHAR(40), 
	IN _apellidos VARCHAR(40)
)
BEGIN
	SELECT * FROM vs_listar_reportes 
		WHERE usuario LIKE CONCAT('%',_apellidos,'%') OR 
					usuario LIKE  CONCAT('%',_nombres,'%');
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_foros_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_foros_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_foros_eliminar`(
	IN  _idforo	INT
)
BEGIN
	UPDATE foros SET 
		estado = 0
		WHERE idforo = _idforo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_foros_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_foros_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_foros_modificar`(
	IN _idforo			INT,
	IN _consulta		MEDIUMTEXT
)
BEGIN
	UPDATE foros SET
		consulta = _consulta
	WHERE idforo = _idforo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_foros_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_foros_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_foros_registrar`(
	IN _idtousuario		INT,
	IN _idfromusuario	INT,
	IN _consulta 			MEDIUMTEXT
)
BEGIN 
	INSERT INTO foros (idtousuario, idfromusuario, consulta)
		VALUES(_idtousuario, _idfromusuario, _consulta);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_galerias_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_galerias_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_galerias_eliminar`(IN _idgaleria INT)
BEGIN
	UPDATE galerias SET estado = 0
		WHERE idgaleria = _idgaleria;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_galerias_getdata` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_galerias_getdata` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_galerias_getdata`(IN _idgaleria INT)
BEGIN
	SELECT * FROM vs_galerias_listar WHERE idgaleria = _idgaleria;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_galerias_listar_album` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_galerias_listar_album` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_galerias_listar_album`(IN _idalbum INT)
BEGIN
	SELECT * FROM vs_galerias_listar WHERE idalbum = _idalbum;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_galerias_listar_trabajo` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_galerias_listar_trabajo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_galerias_listar_trabajo`(IN _idtrabajo INT)
BEGIN
	SELECT * FROM vs_galerias_listar WHERE idtrabajo = _idtrabajo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_galerias_listar_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_galerias_listar_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_galerias_listar_usuario`(in _idusuario int)
BEGIN
	SELECT * FROM vs_galerias_listar where idusuario = _idusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_galerias_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_galerias_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_galerias_modificar`(
	IN _idgaleria INT,
	IN _idalbum 	INT,
	IN _titulo 		VARCHAR(45)
)
BEGIN
	IF _idalbum = '' THEN SET _idalbum = NULL; END IF;
	
	UPDATE galerias SET
		idalbum 	= _idalbum,
		titulo 		= _titulo
	WHERE idgaleria = _idgaleria;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_galerias_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_galerias_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_galerias_registrar`(
	IN _idalbum 	INT,
	in _idusuario int,
	IN _idtrabajo INT,
	IN _tipo 			CHAR(1),
	IN _titulo 		VARCHAR(45),
	IN _archivo 	VARCHAR(100)
)
BEGIN
	IF _idalbum = '' THEN SET _idalbum = NULL; END IF;
	IF _idtrabajo = '' THEN SET _idtrabajo = NULL; END IF;
	
	INSERT INTO galerias (idalbum, idusuario, idtrabajo, tipo, titulo, archivo) VALUES
		(_idalbum, _idusuario, _idtrabajo, _tipo, _titulo, _archivo);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_grafico_niveles_usu` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_grafico_niveles_usu` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_grafico_niveles_usu`()
BEGIN
	SELECT nivelusuario , COUNT(idusuario) AS 'totalusuario'
		FROM usuarios
	GROUP BY nivelusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_grafico_popular` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_grafico_popular` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_grafico_popular`()
BEGIN
	SELECT SER.nombreservicio, SUM(puntuacion)AS'calificación'
		FROM calificaciones CAL
		INNER JOIN trabajos TRA ON TRA.idtrabajo = CAL.idtrabajo
		INNER JOIN especialidades ESP ON ESP.idespecialidad = TRA.idespecialidad
		INNER JOIN servicios SER ON SER.idservicio = ESP.idservicio
	GROUP BY SER.nombreservicio;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_grafico_reportes` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_grafico_reportes` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_grafico_reportes`()
BEGIN
	SELECT MONTHNAME(fechareporte)AS 'mes', COUNT(idreporte)AS 'reportes'
		FROM reportes
	GROUP BY MONTHNAME(fechareporte)
	ORDER BY MONTH(fechareporte) ASC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_grafico_reportes_year` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_grafico_reportes_year` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_grafico_reportes_year`()
BEGIN
	SELECT YEAR(fechareporte) AS 'year', COUNT(idreporte)AS 'reportes'
		FROM reportes
	GROUP BY YEAR(fechareporte)
	ORDER BY 1 ASC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_listar_actividades` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_listar_actividades` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_listar_actividades`()
BEGIN
	SELECT * FROM vs_listar_actividades;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_listar_fotos` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_listar_fotos` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_listar_fotos`(
	IN _idtrabajo INT
)
BEGIN 
	SELECT GAL.idgaleria ,ALB.nombrealbum,GAL.tipo,GAL.titulo,GAL.archivo
		FROM galerias GAL
		INNER JOIN albunes ALB ON ALB.idalbum = GAL.idalbum
		WHERE idtrabajo = _idtrabajo; 
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_listar_reportes` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_listar_reportes` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_listar_reportes`()
BEGIN
	SELECT * FROM vs_listar_reportes;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_modificar_actividades` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_modificar_actividades` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_modificar_actividades`(	
	IN _idactividad			INT,
	IN _idespecialidad 	INT,
	IN _fecha 					DATETIME,
	IN _hora 						TIME,
	IN _titulo					VARCHAR(45),
	IN _descripcion			VARCHAR(150),
	IN _direccion				VARCHAR(80)
)
BEGIN
	UPDATE actividades SET 	
		idespecialidad 	= _idespecialidad, 
		fecha 					= _fecha, 
		hora 						= _hora,
		titulo 					= _titulo, 
		descripcion 		= _descripcion, 
		direccion 			= _direccion
	WHERE idactividad = _idactividad;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_personas_getdata` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_personas_getdata` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_personas_getdata`(IN _idpersona INT)
BEGIN
	SELECT * FROM personas WHERE idpersona = _idpersona;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_personas_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_personas_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_personas_modificar`(
	IN _idpersona 		INT,
	IN _iddistrito 		VARCHAR(6),
	IN _apellidos			VARCHAR(40),
	IN _nombres				VARCHAR(40), 
	IN _fechanac			DATE,
	IN _telefono			CHAR(11),
	IN _tipocalle 		CHAR(2),	
	IN _nombrecalle 	VARCHAR(60),
	IN _numerocalle 	VARCHAR(5),
	IN _pisodepa  		VARCHAR(5)
)
BEGIN
	IF _telefono = ''  THEN SET _telefono  = NULL; END IF;
	IF _numerocalle = ''  THEN SET _numerocalle  = NULL; END IF;
	IF _pisodepa = '' THEN SET _pisodepa = NULL; END IF;
	
	UPDATE personas SET
		iddistrito 	= _iddistriro,
		apellidos 	= _apellidos, 
		nombres 		= _nombres, 
		fechanac 		= _fechanac,
		telefono 		= _telefono,
		tipocalle 	= _tipocalle,
		nombrecalle = _nombrecalle,
		numerocalle = _numerocalle,
		pisodepa 		= _pisodepa
	WHERE idpersona = _idpersona; 
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_personas_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_personas_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_personas_registrar`(
	IN _iddistrito 	VARCHAR(6),
	IN _apellidos		VARCHAR(40),
	IN _nombres			VARCHAR(40), 
	IN _fechanac		DATE,
	IN _telefono		CHAR(11),
	IN _tipocalle 	CHAR(2),	
	IN _nombrecalle VARCHAR(60),
	IN _numerocalle VARCHAR(5),
	IN _pisodepa  	VARCHAR(5)

)
BEGIN
	IF _telefono = ''  THEN SET _telefono  = NULL; END IF;
	IF _numerocalle = ''  THEN SET _numerocalle  = NULL; END IF;
	IF _pisodepa = '' THEN SET _pisodepa = NULL; END IF;
	
	INSERT INTO personas (iddistrito, apellidos, nombres, fechanac, telefono, tipocalle, nombrecalle, numerocalle, pisodepa)
		VALUES (_iddistrito, _apellidos, _nombres, _fechanac, _telefono, _tipocalle, _nombrecalle, _numerocalle, _pisodepa);
		
	SELECT LAST_INSERT_ID();
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_provincias_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_provincias_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_provincias_listar`(in _iddepartamento	VARCHAR(2))
BEGIN
	SELECT * FROM provincias where iddepartamento = _iddepartamento;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_redessociales_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_redessociales_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_redessociales_eliminar`(
	IN _idredsocial INT
)
BEGIN
	DELETE FROM redessociaes WHERE idredsocial = _idredsocial;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_redessociales_filtrar_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_redessociales_filtrar_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_redessociales_filtrar_usuario`(IN _idusuario int)
BEGIN
	SELECT 	RDS.idredsocial, USU.idusuario,
					PER.nombres, PER.apellidos,
					RDS.redsocial, RDS.vinculo 
		FROM redessociales RDS
		INNER JOIN usuarios USU ON USU.idusuario = RDS.idusuario
		INNER JOIN personas PER ON PER.idpersona = USU.idpersona
		WHERE USU.idusuario = _idusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_redessociales_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_redessociales_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_redessociales_modificar`(
	IN _idredsocial		INT,
	IN _redsocial			CHAR(1),
	IN _vinculo				MEDIUMTEXT
)
BEGIN
	UPDATE productos SET
		redsocial = _redsocial,
		 vinculo  = _vinculo
	WHERE idredsocial = _idredsocial;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_redessociales_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_redessociales_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_redessociales_registrar`(
	IN _idusuario	INT,
	IN _redsocial	CHAR(1), -- F = Facebook, I = Instagram, W = Whatsapp, T = Twitter, Y = Youtube, K = Tik Tok
	IN _vinculo	MEDIUMTEXT
)
BEGIN 
	INSERT INTO redessociales (idusuario, redsocial, vinculo)
		VALUES(_idusuario, _redsocial, _vinculo);
	
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_registrar_actividades` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_registrar_actividades` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_registrar_actividades`(
	IN _idespecialidad 	INT,
	IN _fecha 					DATETIME,
	IN _hora 						TIME,
	IN _titulo					VARCHAR(45),
	IN _descripcion			VARCHAR(150),
	IN _direccion				VARCHAR(80)
)
BEGIN 
	INSERT INTO actividades (idespecialidad, fecha, hora, titulo, descripcion, direccion) VALUES
	(_idespecialidad, _idespecialidad, _fecha, _hora, _titulo, _descripcion, _direccion);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_reportes_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_reportes_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_reportes_registrar`(
	in _idcomentario int,
	in _motivo 			 varchar(30),
	in _descripcion	 mediumtext,
	in _fotografia 	 varchar(100)
)
BEGIN
if _fotografia = '' then set _fotografia = null; end if;
INSERT INTO reportes (idcomentario, motivo, descripcion, fotografia)
	values(_idcomentario, _motivo, _descripcion, _fotografia);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_seguidores_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_seguidores_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_seguidores_listar`(IN _idusuario INT)
BEGIN 
	SELECT * FROM seguidores WHERE idfollowing = _idusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_seguidos_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_seguidos_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_seguidos_listar`(IN _idusuario INT)
BEGIN
SELECT * FROM seguidores WHERE idfollower = _idusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_seguidos_listar_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_seguidos_listar_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_seguidos_listar_usuario`(IN _idusuario INT)
BEGIN
SELECT * FROM seguidores WHERE idfollower = _idusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_servicios_listar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_servicios_listar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_servicios_listar`()
BEGIN
   SELECT idservicio, nombreservicio
      FROM servicios
      ORDER BY idservicio DESC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_servicios_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_servicios_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_servicios_modificar`(
    IN _idservicio        INT,
    IN _nombreservicio    VARCHAR(50)
)
BEGIN 
    UPDATE servicios SET
       nombreservicio = _nombreservicio
    WHERE idservicio = _idservicio;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_servicios_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_servicios_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_servicios_registrar`(
    IN _nombreservicio VARCHAR(50)
)
BEGIN
   INSERT INTO servicios (nombreservicio)
      VALUES (_nombreservicio);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_total_calificaciones_trabajo` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_total_calificaciones_trabajo` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_total_calificaciones_trabajo`(
	IN _idtrabajo INT
)
BEGIN 
	SELECT CALI.idcalificacion,CONCAT (PERS.nombres , ' ', PERS.apellidos) AS 'usuario', idtrabajo , 
				 SUM(CALI.puntuacion) AS 'totalpuntuacion', COUNT(*) AS 'totalpersona'
		FROM calificaciones CALI
		INNER JOIN usuarios USU ON USU.idusuario = CALI.idusuario
		INNER JOIN personas PERS ON PERS.idpersona = USU.idpersona
		WHERE idtrabajo = _idtrabajo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_trabajos_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_trabajos_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_trabajos_eliminar`(IN _idtrabajo INT)
BEGIN 
	UPDATE trabajos SET estado = 0
		WHERE idtrabajo = _idtrabajo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_trabajos_listar_usuario` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_trabajos_listar_usuario` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_trabajos_listar_usuario`(in _idusuario int)
BEGIN
	SELECT * FROM vs_trabajos_listar
		where idusuario = _idusuario
		ORDER BY idtrabajo DESC;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_trabajos_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_trabajos_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_trabajos_modificar`(	
	IN _idtrabajo				INT ,
	IN _idespecialidad	INT ,
	IN _idusuario				INT ,
	IN _titulo					VARCHAR(40),
	IN _descripcion			MEDIUMTEXT
)
BEGIN 
	UPDATE trabajos SET 
		idespecialidad = _idespecialidad,
		idusuario 		 = _idusuario,
		titulo				 = _titulo,
		descripcion		 = _descripcion
	WHERE idtrabajo = _idtrabajo;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_trabajos_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_trabajos_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_trabajos_registrar`(
	IN _idespecialidad	INT ,
	IN _idusuario				INT ,
	IN _titulo					VARCHAR(40),
	IN _descripcion			MEDIUMTEXT
)
BEGIN 
	INSERT INTO trabajos (idespecialidad , idusuario, titulo ,descripcion) VALUES
		(_idespecialidad , _idusuario , _titulo , _descripcion);
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuarios_edit_rol` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuarios_edit_rol` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_edit_rol`(
	in _idusuario int,
	in _rol 			char(1)
)
begin
	update usuarios set rol = _rol 
		where idusuario = _idusuario;
end */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuarios_eliminar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuarios_eliminar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_eliminar`(IN _idusuario INT)
BEGIN
	UPDATE usuarios SET estado = 0 
		WHERE idusuario = _idusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuarios_filtrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuarios_filtrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_filtrar`(
	IN _idservicio 		 INT,
	in _iddepartamento varchar(2)
)
BEGIN
		SELECT * FROM vs_usuarios_servicio
			where idservicio = _idservicio or iddepartamento = _iddepartamento;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuarios_filtrar_rol` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuarios_filtrar_rol` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_filtrar_rol`(IN _rol CHAR(1))
BEGIN
	SELECT VUL.idusuario, VUL.apellidos, VUL.nombres, VUL.rol,
		VUL.fechaalta
		FROM vs_usuarios_listar VUL
		WHERE VUL.rol = _rol;	
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

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_login`(IN _email VARCHAR(70))
BEGIN
	select * from usuarios
		WHERE email = _email;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuarios_modificar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuarios_modificar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_modificar`(
	IN _idusuario 			INT,
	IN _idpersona 			INT,
	IN _descripcion 		MEDIUMTEXT,
	IN _horarioatencion VARCHAR(80),
	IN _email 					VARCHAR(70),
	IN _emailrespaldo		VARCHAR(70),
	IN _clave	 					VARCHAR(80)
)
BEGIN
	IF _descripcion = '' THEN SET _descripcion = NULL; END IF;
	IF _emailrespaldo = '' THEN SET _emailrespaldo = NULL; END IF;
	
	UPDATE usuarios SET 
		idpersona 			= _idpersona,
		descripcion 		= _descripcion,
		horarioatencion = _horarioatencion,
		email 					= _email,
		emailrespaldo 	= _emailrespaldo,
		clave 					= _clave
	WHERE idusuario = _idusuario;
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuarios_registrar` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuarios_registrar` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_registrar`(
	IN _idpersona 			INT,
	IN _descripcion 		MEDIUMTEXT,
	IN _horarioatencion VARCHAR(80),
	IN _email 					VARCHAR(70),
	IN _emailrespaldo		VARCHAR(70),
	IN _clave	 					VARCHAR(80)
)
BEGIN
	IF _descripcion = '' THEN SET _descripcion = NULL; END IF;
	IF _emailrespaldo = '' THEN SET _emailrespaldo = NULL; END IF;
	IF _horarioatencion = '' THEN SET _horarioatencion = NULL; END IF;

	INSERT INTO usuarios (idpersona, descripcion, horarioatencion, email, emailrespaldo, clave) VALUES 
		(_idpersona, _descripcion, _horarioatencion, _email, _emailrespaldo, _clave);
	
	SELECT LAST_INSERT_ID();
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuarios_search` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuarios_search` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_search`(IN _search VARCHAR(40))
BEGIN
SELECT idusuario, idpersona, apellidos, nombres, rol, fechaalta 
	FROM vs_usuarios_listar
	WHERE apellidos LIKE CONCAT('%', _search, '%') OR
	      nombres LIKE CONCAT('%', _search, '%');
END */$$
DELIMITER ;

/* Procedure structure for procedure `spu_usuarios_search_rol` */

/*!50003 DROP PROCEDURE IF EXISTS  `spu_usuarios_search_rol` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `spu_usuarios_search_rol`(IN _rol CHAR(1), IN _search VARCHAR(40))
BEGIN
	IF _rol IS NULL or _rol = '' THEN
		CALL spu_usuarios_search(_search);
	ELSe
		SELECT idusuario, idpersona, apellidos, nombres, rol, fechaalta 
			FROM vs_usuarios_listar 
			WHERE rol = _rol AND 
						(apellidos LIKE CONCAT('%', _search, '%') OR
						nombres LIKE CONCAT('%', _search, '%'));	
	END IF;
END */$$
DELIMITER ;

/*Table structure for table `vs_calificaciones_listar` */

DROP TABLE IF EXISTS `vs_calificaciones_listar`;

/*!50001 DROP VIEW IF EXISTS `vs_calificaciones_listar` */;
/*!50001 DROP TABLE IF EXISTS `vs_calificaciones_listar` */;

/*!50001 CREATE TABLE  `vs_calificaciones_listar`(
 `idcalificacion` int(11) ,
 `idtrabajo` int(11) ,
 `titulotrabajo` varchar(40) ,
 `idpersona` int(11) ,
 `apellidos` varchar(40) ,
 `nombres` varchar(40) ,
 `puntuacion` tinyint(4) 
)*/;

/*Table structure for table `vs_comentarios_listar` */

DROP TABLE IF EXISTS `vs_comentarios_listar`;

/*!50001 DROP VIEW IF EXISTS `vs_comentarios_listar` */;
/*!50001 DROP TABLE IF EXISTS `vs_comentarios_listar` */;

/*!50001 CREATE TABLE  `vs_comentarios_listar`(
 `idcomentario` int(11) ,
 `idtrabajo` int(11) ,
 `titulotrabajo` varchar(40) ,
 `apellidos` varchar(40) ,
 `nombres` varchar(40) ,
 `comentario` mediumtext ,
 `fechacomentado` datetime 
)*/;

/*Table structure for table `vs_especialidades_listar` */

DROP TABLE IF EXISTS `vs_especialidades_listar`;

/*!50001 DROP VIEW IF EXISTS `vs_especialidades_listar` */;
/*!50001 DROP TABLE IF EXISTS `vs_especialidades_listar` */;

/*!50001 CREATE TABLE  `vs_especialidades_listar`(
 `idespecialidad` int(11) ,
 `idusuario` int(11) ,
 `datosusuario` varchar(81) ,
 `nombreservicio` varchar(50) ,
 `telefono` char(11) ,
 `email` varchar(70) 
)*/;

/*Table structure for table `vs_galerias_listar` */

DROP TABLE IF EXISTS `vs_galerias_listar`;

/*!50001 DROP VIEW IF EXISTS `vs_galerias_listar` */;
/*!50001 DROP TABLE IF EXISTS `vs_galerias_listar` */;

/*!50001 CREATE TABLE  `vs_galerias_listar`(
 `idgaleria` int(11) ,
 `idalbum` int(11) ,
 `nombrealbum` varchar(30) ,
 `idusuario` int(11) ,
 `apellidos` varchar(40) ,
 `nombres` varchar(40) ,
 `idtrabajo` int(11) ,
 `titulo` varchar(40) ,
 `tipo` char(1) ,
 `archivo` varchar(100) ,
 `fechaalta` datetime 
)*/;

/*Table structure for table `vs_listar_actividades` */

DROP TABLE IF EXISTS `vs_listar_actividades`;

/*!50001 DROP VIEW IF EXISTS `vs_listar_actividades` */;
/*!50001 DROP TABLE IF EXISTS `vs_listar_actividades` */;

/*!50001 CREATE TABLE  `vs_listar_actividades`(
 `ID` int(11) ,
 `idusuario` int(11) ,
 `idservicio` int(11) ,
 `nombreservicio` varchar(50) ,
 `idespecialidad` int(11) ,
 `especialidad` mediumtext ,
 `fecha` date ,
 `hora` time ,
 `titulo` varchar(45) ,
 `descripcion` varchar(150) ,
 `direccion` varchar(80) 
)*/;

/*Table structure for table `vs_listar_reportes` */

DROP TABLE IF EXISTS `vs_listar_reportes`;

/*!50001 DROP VIEW IF EXISTS `vs_listar_reportes` */;
/*!50001 DROP TABLE IF EXISTS `vs_listar_reportes` */;

/*!50001 CREATE TABLE  `vs_listar_reportes`(
 `idreporte` int(11) ,
 `idcomentario` int(11) ,
 `usuario` varchar(81) ,
 `motivo` varchar(30) ,
 `descripcion` mediumtext ,
 `fechareporte` datetime ,
 `fotografia` varchar(100) 
)*/;

/*Table structure for table `vs_personas_listar` */

DROP TABLE IF EXISTS `vs_personas_listar`;

/*!50001 DROP VIEW IF EXISTS `vs_personas_listar` */;
/*!50001 DROP TABLE IF EXISTS `vs_personas_listar` */;

/*!50001 CREATE TABLE  `vs_personas_listar`(
 `idpersona` int(11) ,
 `apellidos` varchar(40) ,
 `nombres` varchar(40) ,
 `fechanac` date ,
 `telefono` char(11) ,
 `direccion` varchar(86) ,
 `iddistrito` varchar(6) ,
 `distrito` varchar(45) ,
 `idprovincia` varchar(4) ,
 `provincia` varchar(45) ,
 `iddepartamento` varchar(2) ,
 `departamento` varchar(45) 
)*/;

/*Table structure for table `vs_trabajos_listar` */

DROP TABLE IF EXISTS `vs_trabajos_listar`;

/*!50001 DROP VIEW IF EXISTS `vs_trabajos_listar` */;
/*!50001 DROP TABLE IF EXISTS `vs_trabajos_listar` */;

/*!50001 CREATE TABLE  `vs_trabajos_listar`(
 `idtrabajo` int(11) ,
 `idusuario` int(11) ,
 `idpersona` int(11) ,
 `apellidos` varchar(40) ,
 `nombres` varchar(40) ,
 `trabajorealizar` varchar(40) ,
 `descripcion` mediumtext 
)*/;

/*Table structure for table `vs_usuarios_listar` */

DROP TABLE IF EXISTS `vs_usuarios_listar`;

/*!50001 DROP VIEW IF EXISTS `vs_usuarios_listar` */;
/*!50001 DROP TABLE IF EXISTS `vs_usuarios_listar` */;

/*!50001 CREATE TABLE  `vs_usuarios_listar`(
 `idusuario` int(11) ,
 `idpersona` int(11) ,
 `apellidos` varchar(40) ,
 `nombres` varchar(40) ,
 `iddepartamento` varchar(2) ,
 `departamento` varchar(45) ,
 `idprovincia` varchar(4) ,
 `provincia` varchar(45) ,
 `iddistrito` varchar(6) ,
 `distrito` varchar(45) ,
 `direccion` varchar(86) ,
 `descripcion` mediumtext ,
 `horarioatencion` varchar(80) ,
 `rol` char(1) ,
 `email` varchar(70) ,
 `emailrespaldo` varchar(70) ,
 `clave` varchar(80) ,
 `idestablecimiento` int(11) ,
 `establecimiento` varchar(30) ,
 `ruc` char(11) ,
 `ubicacion` varchar(80) ,
 `referencia` varchar(80) ,
 `latitud` float(10,8) ,
 `longitud` float(10,8) ,
 `fechaalta` datetime ,
 `estado` char(1) 
)*/;

/*View structure for view vs_calificaciones_listar */

/*!50001 DROP TABLE IF EXISTS `vs_calificaciones_listar` */;
/*!50001 DROP VIEW IF EXISTS `vs_calificaciones_listar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vs_calificaciones_listar` AS select `cali`.`idcalificacion` AS `idcalificacion`,`trab`.`idtrabajo` AS `idtrabajo`,`trab`.`titulo` AS `titulotrabajo`,`pers`.`idpersona` AS `idpersona`,`pers`.`apellidos` AS `apellidos`,`pers`.`nombres` AS `nombres`,`cali`.`puntuacion` AS `puntuacion` from (((`calificaciones` `cali` join `trabajos` `trab` on(`trab`.`idtrabajo` = `cali`.`idtrabajo`)) join `usuarios` `usu` on(`usu`.`idusuario` = `cali`.`idusuario`)) left join `personas` `pers` on(`pers`.`idpersona` = `usu`.`idpersona`)) where `cali`.`estado` = 1 */;

/*View structure for view vs_comentarios_listar */

/*!50001 DROP TABLE IF EXISTS `vs_comentarios_listar` */;
/*!50001 DROP VIEW IF EXISTS `vs_comentarios_listar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vs_comentarios_listar` AS select `com`.`idcomentario` AS `idcomentario`,`trab`.`idtrabajo` AS `idtrabajo`,`trab`.`titulo` AS `titulotrabajo`,`pers`.`apellidos` AS `apellidos`,`pers`.`nombres` AS `nombres`,`com`.`comentario` AS `comentario`,`com`.`fechacomentado` AS `fechacomentado` from (((`comentarios` `com` join `trabajos` `trab` on(`trab`.`idtrabajo` = `com`.`idtrabajo`)) join `usuarios` `usu` on(`usu`.`idusuario` = `com`.`idusuario`)) left join `personas` `pers` on(`pers`.`idpersona` = `usu`.`idpersona`)) where `trab`.`estado` = 1 */;

/*View structure for view vs_especialidades_listar */

/*!50001 DROP TABLE IF EXISTS `vs_especialidades_listar` */;
/*!50001 DROP VIEW IF EXISTS `vs_especialidades_listar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vs_especialidades_listar` AS select `esp`.`idespecialidad` AS `idespecialidad`,`usu`.`idusuario` AS `idusuario`,concat(`pers`.`nombres`,' ',`pers`.`apellidos`) AS `datosusuario`,`srv`.`nombreservicio` AS `nombreservicio`,`pers`.`telefono` AS `telefono`,`usu`.`email` AS `email` from (((`especialidades` `esp` join `servicios` `srv` on(`srv`.`idservicio` = `esp`.`idservicio`)) join `usuarios` `usu` on(`usu`.`idusuario` = `esp`.`idusuario`)) join `personas` `pers` on(`pers`.`idpersona` = `usu`.`idpersona`)) group by `usu`.`idusuario` */;

/*View structure for view vs_galerias_listar */

/*!50001 DROP TABLE IF EXISTS `vs_galerias_listar` */;
/*!50001 DROP VIEW IF EXISTS `vs_galerias_listar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vs_galerias_listar` AS select `glr`.`idgaleria` AS `idgaleria`,`alb`.`idalbum` AS `idalbum`,`alb`.`nombrealbum` AS `nombrealbum`,`vul`.`idusuario` AS `idusuario`,`vul`.`apellidos` AS `apellidos`,`vul`.`nombres` AS `nombres`,`tbj`.`idtrabajo` AS `idtrabajo`,`tbj`.`titulo` AS `titulo`,`glr`.`tipo` AS `tipo`,`glr`.`archivo` AS `archivo`,`glr`.`fechaalta` AS `fechaalta` from (((`galerias` `glr` left join `albumes` `alb` on(`alb`.`idalbum` = `glr`.`idalbum`)) join `vs_usuarios_listar` `vul` on(`vul`.`idusuario` = `glr`.`idusuario`)) left join `trabajos` `tbj` on(`tbj`.`idtrabajo` = `glr`.`idtrabajo`)) where `glr`.`estado` = 1 */;

/*View structure for view vs_listar_actividades */

/*!50001 DROP TABLE IF EXISTS `vs_listar_actividades` */;
/*!50001 DROP VIEW IF EXISTS `vs_listar_actividades` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vs_listar_actividades` AS select `act`.`idactividad` AS `ID`,`esp`.`idusuario` AS `idusuario`,`ser`.`idservicio` AS `idservicio`,`ser`.`nombreservicio` AS `nombreservicio`,`esp`.`idespecialidad` AS `idespecialidad`,`esp`.`descripcion` AS `especialidad`,`act`.`fecha` AS `fecha`,`act`.`hora` AS `hora`,`act`.`titulo` AS `titulo`,`act`.`descripcion` AS `descripcion`,`act`.`direccion` AS `direccion` from ((`especialidades` `esp` join `actividades` `act` on(`esp`.`idespecialidad` = `act`.`idespecialidad`)) join `servicios` `ser` on(`ser`.`idservicio` = `esp`.`idservicio`)) */;

/*View structure for view vs_listar_reportes */

/*!50001 DROP TABLE IF EXISTS `vs_listar_reportes` */;
/*!50001 DROP VIEW IF EXISTS `vs_listar_reportes` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vs_listar_reportes` AS select `rep`.`idreporte` AS `idreporte`,`com`.`idcomentario` AS `idcomentario`,concat(`prs`.`nombres`,' ',`prs`.`apellidos`) AS `usuario`,`rep`.`motivo` AS `motivo`,`rep`.`descripcion` AS `descripcion`,`rep`.`fechareporte` AS `fechareporte`,`rep`.`fotografia` AS `fotografia` from (((`comentarios` `com` join `reportes` `rep` on(`rep`.`idcomentario` = `com`.`idcomentario`)) join `usuarios` `usu` on(`usu`.`idusuario` = `com`.`idusuario`)) join `personas` `prs` on(`prs`.`idpersona` = `usu`.`idusuario`)) */;

/*View structure for view vs_personas_listar */

/*!50001 DROP TABLE IF EXISTS `vs_personas_listar` */;
/*!50001 DROP VIEW IF EXISTS `vs_personas_listar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vs_personas_listar` AS select `prs`.`idpersona` AS `idpersona`,`prs`.`apellidos` AS `apellidos`,`prs`.`nombres` AS `nombres`,`prs`.`fechanac` AS `fechanac`,`prs`.`telefono` AS `telefono`,concat(case when `prs`.`tipocalle` like 'CA' then 'Calle' when `prs`.`tipocalle` like 'AV' then 'Avenida' when `prs`.`tipocalle` like 'UR' then 'Urbanización' when `prs`.`tipocalle` like 'PJ' then 'Pasaje' when `prs`.`tipocalle` like 'JR' then 'Jirón' end,' ',`prs`.`nombrecalle`,' #',`prs`.`numerocalle`,' ',`prs`.`pisodepa`) AS `direccion`,`dst`.`iddistrito` AS `iddistrito`,`dst`.`distrito` AS `distrito`,`prv`.`idprovincia` AS `idprovincia`,`prv`.`provincia` AS `provincia`,`dpt`.`iddepartamento` AS `iddepartamento`,`dpt`.`departamento` AS `departamento` from (((`personas` `prs` join `distritos` `dst` on(`dst`.`iddistrito` = `prs`.`iddistrito`)) join `provincias` `prv` on(`prv`.`idprovincia` = `dst`.`idprovincia`)) join `departamentos` `dpt` on(`dpt`.`iddepartamento` = `prv`.`iddepartamento`)) */;

/*View structure for view vs_trabajos_listar */

/*!50001 DROP TABLE IF EXISTS `vs_trabajos_listar` */;
/*!50001 DROP VIEW IF EXISTS `vs_trabajos_listar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vs_trabajos_listar` AS select `tbj`.`idtrabajo` AS `idtrabajo`,`usu`.`idusuario` AS `idusuario`,`pers`.`idpersona` AS `idpersona`,`pers`.`apellidos` AS `apellidos`,`pers`.`nombres` AS `nombres`,`tbj`.`titulo` AS `trabajorealizar`,`tbj`.`descripcion` AS `descripcion` from (`galerias` `gal` left join ((`trabajos` `tbj` join `usuarios` `usu` on(`usu`.`idusuario` = `tbj`.`idusuario`)) left join `personas` `pers` on(`pers`.`idpersona` = `usu`.`idpersona`)) on(`gal`.`idgaleria` = `tbj`.`idtrabajo`)) where `tbj`.`estado` = 1 */;

/*View structure for view vs_usuarios_listar */

/*!50001 DROP TABLE IF EXISTS `vs_usuarios_listar` */;
/*!50001 DROP VIEW IF EXISTS `vs_usuarios_listar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vs_usuarios_listar` AS select `usu`.`idusuario` AS `idusuario`,`vpl`.`idpersona` AS `idpersona`,`vpl`.`apellidos` AS `apellidos`,`vpl`.`nombres` AS `nombres`,`vpl`.`iddepartamento` AS `iddepartamento`,`vpl`.`departamento` AS `departamento`,`vpl`.`idprovincia` AS `idprovincia`,`vpl`.`provincia` AS `provincia`,`vpl`.`iddistrito` AS `iddistrito`,`vpl`.`distrito` AS `distrito`,`vpl`.`direccion` AS `direccion`,`usu`.`descripcion` AS `descripcion`,`usu`.`horarioatencion` AS `horarioatencion`,`usu`.`rol` AS `rol`,`usu`.`email` AS `email`,`usu`.`emailrespaldo` AS `emailrespaldo`,`usu`.`clave` AS `clave`,`est`.`idestablecimiento` AS `idestablecimiento`,`est`.`establecimiento` AS `establecimiento`,`est`.`ruc` AS `ruc`,concat(case when `est`.`tipocalle` like 'CA' then 'Calle' when `est`.`tipocalle` like 'AV' then 'Avenida' when `est`.`tipocalle` like 'UR' then 'Urbanización' when `est`.`tipocalle` like 'PJ' then 'Pasaje' when `est`.`tipocalle` like 'JR' then 'Jirón' end,' ',`est`.`nombrecalle`,' #',`est`.`numerocalle`) AS `ubicacion`,`est`.`referencia` AS `referencia`,`est`.`latitud` AS `latitud`,`est`.`longitud` AS `longitud`,`usu`.`fechaalta` AS `fechaalta`,`usu`.`estado` AS `estado` from ((`usuarios` `usu` join `vs_personas_listar` `vpl` on(`vpl`.`idpersona` = `usu`.`idpersona`)) left join `establecimientos` `est` on(`est`.`idusuario` = `usu`.`idusuario`)) where `usu`.`estado` = 1 */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
