
CREATE DATABASE REACTIVACION;

USE REACTIVACION;

-- UBIGEO YA INCORPORADO

CREATE TABLE departamentos
(
  iddepartamento	VARCHAR(2) NOT NULL PRIMARY KEY,
  departamento		VARCHAR(45) NOT NULL
)ENGINE = INNODB;

CREATE TABLE provincias 
(
  idprovincia		VARCHAR(4)	NOT NULL PRIMARY KEY,
  provincia			VARCHAR(45) NOT NULL,
  iddepartamento	VARCHAR(2)	NOT NULL,
  CONSTRAINT fk_iddepartamento_pro FOREIGN KEY (iddepartamento) REFERENCES departamentos (iddepartamento)
)ENGINE = INNODB;

CREATE TABLE distritos 
(
  iddistrito		VARCHAR(6)	NOT NULL PRIMARY KEY,
  distrito			VARCHAR(45) DEFAULT NULL,
  idprovincia		VARCHAR(4)	DEFAULT NULL,
  iddepartamento	VARCHAR(2)	DEFAULT NULL,
  CONSTRAINT fk_idprovincia_dis FOREIGN KEY (idprovincia) REFERENCES provincias (idprovincia),
  CONSTRAINT fk_iddepartamento_dis FOREIGN KEY (iddepartamento) REFERENCES departamentos (iddepartamento)
)ENGINE = INNODB;


CREATE TABLE personas
(
	idpersona		INT AUTO_INCREMENT PRIMARY KEY,
	iddistrito	VARCHAR(6)		NOT NULL,
	apellidos		VARCHAR(40)		NOT NULL, 
	nombres			VARCHAR(40)		NOT NULL,
	fechanac		DATE 					NOT NULL,
	telefono		CHAR(11)			NULL,
	tipocalle 	CHAR(2)				NOT NULL, -- AV(Avenida), CA(Calle), JR(Jiron), PJ(Pasaje), UR(Urbanización), LT(Lote)
	nombrecalle VARCHAR(60)		NOT NULL,
	numerocalle VARCHAR(5) 		NULL,
	pisodepa  	VARCHAR(5)		NULL,
	CONSTRAINT fk_per_iddistrito FOREIGN KEY (iddistrito) REFERENCES distritos (iddistrito)	
)ENGINE = INNODB;

CREATE TABLE usuarios
(
	idusuario 			INT AUTO_INCREMENT PRIMARY KEY,
	idpersona				INT 					NOT NULL,
	descripcion			MEDIUMTEXT		NULL,
	horarioatencion	VARCHAR(80) 	NOT NULL, 
	nivelusuario		CHAR(1)				NOT NULL DEFAULT 'E', -- E(Estandar), I(Intermedio), A(Avanzado)
	rol 						CHAR(1)				NOT NULL DEFAULT 'U', -- U = Usuario, A = Administrador
	email						VARCHAR(70)		NOT NULL,
	emailrespaldo		VARCHAR(70)		NULL,
	clave						VARCHAR(80)		NOT NULL,
	fechaalta				DATETIME			NOT NULL DEFAULT NOW(),
	fechabaja				DATETIME			NULL,
	estado					CHAR(1)				NOT NULL DEFAULT '1', -- 1 (Activo), 2 (Inactivo/bloqueado),0 (Eliminado)
	CONSTRAINT fk_usu_idpersona FOREIGN KEY (idpersona) REFERENCES personas (idpersona),
	CONSTRAINT uk_usu_email UNIQUE (email),
	CONSTRAINT uk_usu_idpersona UNIQUE(idpersona)
)ENGINE = INNODB;


CREATE TABLE establecimientos
(
	idestablecimiento	INT AUTO_INCREMENT PRIMARY KEY,
	idusuario					INT 					NOT NULL,
	iddistrito				VARCHAR(6)		NOT NULL,
	establecimiento		VARCHAR(30)		NOT NULL,
	ruc								CHAR(11)			NOT NULL,
	tipocalle 				CHAR(2) 			NOT NULL,
	nombrecalle 			VARCHAR(60) 	NOT NULL,
	numerocalle 			VARCHAR(5) 		NULL,
	referencia				VARCHAR(80)		NULL,
	latitud						FLOAT(10, 8)	NOT NULL,
	longitud					FLOAT(10, 8)	NOT NULL,
	estado 						BIT 					NOT NULL DEFAULT 1,
	CONSTRAINT fk_est_idusuario FOREIGN KEY(idusuario) REFERENCES usuarios (idusuario),
	CONSTRAINT fk_est_iddistrito FOREIGN KEY(iddistrito) REFERENCES distritos (iddistrito),
	CONSTRAINT uk_est_ruc UNIQUE(ruc)
)ENGINE = INNODB;

CREATE TABLE redessociales
(
	idredsocial		INT 	AUTO_INCREMENT PRIMARY KEY,
	idusuario			INT 				NOT NULL,
	redsocial			CHAR(1)			NOT NULL, -- F = Facebook, I = Instagram, W = Whatsapp, T = Twitter, Y = Youtube, K = Tik Tok
	vinculo				MEDIUMTEXT	NOT NULL,
	estado				BIT 				NOT NULL DEFAULT 1,
	CONSTRAINT fk_reds_idusuario FOREIGN KEY(idusuario) REFERENCES usuarios (idusuario)
)ENGINE = INNODB;

CREATE TABLE seguidores
(
	idseguidor 			INT AUTO_INCREMENT PRIMARY KEY,
	idfollowing			INT 			NOT NULL,
	idfollower			INT 			NOT NULL,
	fechaseguido		DATETIME	NOT NULL DEFAULT NOW(),
	fechaeliminado	DATETIME	NULL,
	estado 					BIT 			NOT NULL DEFAULT 1,
	CONSTRAINT fk_seg_idfollowing FOREIGN KEY(idfollowing) REFERENCES usuarios (idusuario),
	CONSTRAINT fk_seg_idfollower FOREIGN KEY(idfollower) REFERENCES usuarios (idusuario),
	CONSTRAINT uk_seg_idfollower UNIQUE(idfollowing, idfollower)
)ENGINE = INNODB;

CREATE TABLE foros
(
	idforo					INT AUTO_INCREMENT PRIMARY KEY,
	idtousuario			INT 					NOT NULL,
	idfromusuario		INT 					NOT NULL,
	consulta 				MEDIUMTEXT 		NOT NULL,
	fechaconsulta 	DATETIME			NOT NULL DEFAULT NOW(),
	fechaeliminado 	DATETIME			NULL,
	estado					BIT 					NOT NULL DEFAULT 1,
	CONSTRAINT fk_for_idtousuario FOREIGN KEY(idtousuario) REFERENCES usuarios (idusuario),
	CONSTRAINT fk_for_idfromusuario FOREIGN KEY(idfromusuario) REFERENCES usuarios (idusuario)
)ENGINE = INNODB;

CREATE TABLE servicios
(
	idservicio			INT AUTO_INCREMENT PRIMARY KEY,
	nombreservicio	VARCHAR(50)		NOT NULL,
	CONSTRAINT uk_ser_nombreservicio UNIQUE(nombreservicio)
)ENGINE = INNODB;


CREATE TABLE especialidades
(
	idespecialidad	INT AUTO_INCREMENT PRIMARY KEY,
	idservicio			INT 					NOT NULL,
	idusuario				INT 					NOT NULL,	
	descripcion			MEDIUMTEXT		NOT NULL,
	tarifa					DECIMAL(7,2)	NOT NULL,
	estado 					BIT 					NOT NULL	DEFAULT 1;
	CONSTRAINT fk_esp_idservicio FOREIGN KEY(idservicio) REFERENCES servicios(idservicio),
	CONSTRAINT fk_esp_idusuario FOREIGN KEY(idusuario) REFERENCES usuarios(idusuario)	
)ENGINE = INNODB;


CREATE TABLE actividades
(
	idactividad			INT AUTO_INCREMENT PRIMARY KEY,
	idespecialidad	INT 					NOT NULL,
	fechainicio 		DATE 					NOT NULL,
	fechafin				DATE 					NOT NULL,
	horainicio			TIME 					NOT NULL,
	horafin					TIME 					NOT NULL,
	titulo					VARCHAR(45)		NOT NULL,
	descripcion			VARCHAR(150)	NULL,
	direccion				VARCHAR(80)		NULL,
	CONSTRAINT fk_act_idespecialidad FOREIGN KEY(idespecialidad) REFERENCES especialidades (idespecialidad)
)ENGINE = INNODB;

CREATE TABLE trabajos 
(
	idtrabajo					INT AUTO_INCREMENT PRIMARY KEY,
	idespecialidad		INT 					NOT NULL,
	idusuario					INT 					NOT NULL,
	titulo						VARCHAR(200) 	NOT NULL,
	descripcion				MEDIUMTEXT 		NOT NULL,
	fechapublicado		DATETIME 			NOT NULL DEFAULT NOW(),
	fechamodificado 	DATETIME  		NULL,
	fechaeliminado 		DATETIME			NULL,
	estado 						BIT 					NOT NULL DEFAULT 1,
	CONSTRAINT fk_trab_idespecialidad FOREIGN KEY(idespecialidad) REFERENCES especialidades (idespecialidad),	
	CONSTRAINT fk_trab_idusuario FOREIGN KEY(idusuario) REFERENCES usuarios(idusuario)
)ENGINE = INNODB;


CREATE TABLE albumes
(
	idalbum			INT AUTO_INCREMENT PRIMARY KEY,
	idusuario		INT 					NOT NULL,
	nombrealbum		VARCHAR(30)		NOT NULL,
	estado 			BIT 					NOT NULL DEFAULT 1,
	CONSTRAINT fk_alb_idusuario FOREIGN KEY (idusuario) REFERENCES usuarios (idusuario),
	CONSTRAINT uk_alb_nombrealbum UNIQUE(idusuario, nombrealbum)
)ENGINE = INNODB;


CREATE TABLE galerias 
(
	idgaleria		INT AUTO_INCREMENT PRIMARY KEY,
	idalbum			INT 					NULL,
	idusuario		INT 					NOT NULL,
	idtrabajo		INT 					NULL,
	tipo				CHAR(1)				NOT NULL, -- F = Foto, V = Video
	archivo 		VARCHAR(100)	NOT NULL,
	fechaalta		DATETIME 			NOT NULL DEFAULT NOW(),
	fechabaja	 	DATETIME 			NULL,
	estado 			CHAR(1) 			NOT NULL DEFAULT '1', -- 0(Elimimado), 1(activo), 2(Perfil activo), 3(Portada activo);
	CONSTRAINT fk_galerias_idalbum FOREIGN KEY(idalbum) REFERENCES albumes(idalbum),
	CONSTRAINT fk_galerias_idusuario FOREIGN KEY(idusuario) REFERENCES usuarios (idusuario),
	CONSTRAINT fk_galerias_idtrabajo FOREIGN KEY(idtrabajo) REFERENCES trabajos (idtrabajo)
)ENGINE = INNODB;


CREATE TABLE calificaciones 
(
	idcalificacion 	INT AUTO_INCREMENT PRIMARY KEY,
	idtrabajo				INT 			NOT NULL,
	idusuario				INT 			NOT NULL,
	puntuacion			TINYINT 	NOT NULL,
	CONSTRAINT fk_cal_idtrabajo FOREIGN KEY(idtrabajo) REFERENCES trabajos(idtrabajo),
	CONSTRAINT fk_cal_idusuario FOREIGN KEY(idusuario) REFERENCES usuarios(idusuario)
)ENGINE = INNODB;


CREATE TABLE comentarios 
(
	idcomentario 		INT AUTO_INCREMENT PRIMARY KEY,
	idtrabajo				INT 				NOT NULL,
	idusuario				INT 				NOT NULL,
	comentario			MEDIUMTEXT 	NOT NULL,
	fechacomentado	DATETIME	 	NOT NULL DEFAULT NOW(),
	fechamodificado DATETIME 		NULL,
	estado 					BIT 				NOT NULL DEFAULT 1,
	CONSTRAINT fk_com_idtrabajo FOREIGN KEY(idtrabajo) REFERENCES trabajos(idtrabajo),
	CONSTRAINT fk_com_idusuario FOREIGN KEY(idusuario) REFERENCES usuarios(idusuario)
)ENGINE = INNODB;

CREATE TABLE reportes
(
	idreporte 		INT AUTO_INCREMENT PRIMARY KEY,
	idcomentario 	INT 					NOT NULL,
	motivo 				VARCHAR(30) 	NOT NULL,
	descripcion 	MEDIUMTEXT 		NOT NULL,
	fotografia		VARCHAR(100) 	NULL,
	fechareporte	DATETIME 			NOT NULL DEFAULT NOW(),
	CONSTRAINT fk_rep_idcomentario FOREIGN KEY(idcomentario) REFERENCES comentarios (idcomentario)
)ENGINE = INNODB;