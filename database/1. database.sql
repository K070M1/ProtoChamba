CREATE DATABASE REACTIVACION;

USE REACTIVACION;

CREATE TABLE personas
(
	idpersona		INT AUTO_INCREMENT PRIMARY KEY,
	apellidos		VARCHAR(40)		NOT NULL, 
	nombres			VARCHAR(40)		NOT NULL,
	fechanac		DATE 					NOT NULL,
	telefono		CHAR(11)			NULL,
	tipocalle 	CHAR(2)				NOT NULL, -- AV(Avenida), CA(Calle), JR(Jiron), PJ(Pasaje)
	nombrecalle VARCHAR(60)		NOT NULL,
	numerocalle VARCHAR(5) 		NULL,
	pisodepa  	VARCHAR(5)		NULL
	
)ENGINE = INNODB;

CREATE TABLE empresas
(
	idempresa 			INT AUTO_INCREMENT PRIMARY KEY,
	establecimiento	VARCHAR(30)		NOT NULL,
	ruc							CHAR(11)			NOT NULL,
	ubicacion				VARCHAR(70)		NOT NULL,
	referencia			VARCHAR(70)		NULL,
	latitud					FLOAT(10, 8)	NOT NULL,
	longitud				FLOAT(10, 8)	NOT NULL,
	CONSTRAINT uk_empresas_ruc UNIQUE(ruc)
)ENGINE = INNODB;

CREATE TABLE usuarios
(
	idusuario 			INT AUTO_INCREMENT PRIMARY KEY,
	idpersona				INT 				NOT NULL,
	idempresa				INT 				NULL,
	descripcion			MEDIUMTEXT	NULL,
	horarioatencion	VARCHAR(50) NOT NULL, 
	nivelusuario		CHAR(1) 		NOT NULL, -- E = Estandar, I = Intermedio, A = Avanzado
	rol 						CHAR(1)			NOT NULL DEFAULT 'U', -- U = Usuario, A = Administrador
	email						VARCHAR(70)	NOT NULL,
	emailrespaldo		VARCHAR(70)	NULL,
	clave						VARCHAR(80)	NOT NULL,
	fechaalta				DATETIME		NOT NULL DEFAULT NOW(),
	fechabaja				DATETIME		NULL,
	estado					BIT					NOT NULL DEFAULT 1,
	CONSTRAINT fk_usuarios_idpersona FOREIGN KEY (idpersona) REFERENCES personas (idpersona),
	CONSTRAINT fk_usuarios_idempresa FOREIGN KEY (idempresa) REFERENCES empresas (idempresa),
	CONSTRAINT uk_usuarios_email UNIQUE (email),
	CONSTRAINT uk_usuarios_emailrespaldo UNIQUE(emailrespaldo)
)ENGINE = INNODB;

CREATE TABLE redessociales
(
	idredsocial		INT 	AUTO_INCREMENT PRIMARY KEY,
	idusuario			INT 				NOT NULL,
	redsocial			CHAR(1)			NOT NULL, -- F = Facebook, I = Instagram, W = Whatsapp, T = Twitter, Y = Youtube, K = Tik Tok
	vinculo				MEDIUMTEXT	NOT NULL,
	estado				BIT 				NOT NULL DEFAULT 1,
	CONSTRAINT fk_redessociales_idusuario FOREIGN KEY(idusuario) REFERENCES usuarios (idusuario)
)ENGINE = INNODB;

CREATE TABLE seguidores
(
	idseguidor 		INT AUTO_INCREMENT PRIMARY KEY,
	idfollowing		INT 			NOT NULL,
	idfollower		INT 			NOT NULL,
	fechafollower	DATETIME	NOT NULL DEFAULT NOW(),
	fechabaja			DATETIME	NULL,
	estado 				BIT 			NOT NULL DEFAULT 1,
	CONSTRAINT fk_seguidores_idfollowing FOREIGN KEY(idfollowing) REFERENCES usuarios (idusuario),
	CONSTRAINT fk_seguidores_idfollower FOREIGN KEY(idfollower) REFERENCES usuarios (idusuario),
	CONSTRAINT uk_seguidores_idfollower UNIQUE(idfollowing, idfollower)
)ENGINE = INNODB;

CREATE TABLE servicios
(
	idservicio			INT AUTO_INCREMENT PRIMARY KEY,
	nombreservicio	VARCHAR(50)		NOT NULL,
	CONSTRAINT uk_servicios_nombreservicio UNIQUE(nombreservicio)
)ENGINE = INNODB;

CREATE TABLE especialidades
(
	idespecialidad	INT AUTO_INCREMENT PRIMARY KEY,
	idusuario				INT 				NOT NULL,
	idservicio			INT 				NOT NULL,
	descripcion			MEDIUMTEXT	NOT NULL,
	CONSTRAINT fk_especialidades_idusuario FOREIGN KEY(idusuario) REFERENCES usuarios(idusuario),
	CONSTRAINT fk_especialidades_idservicio FOREIGN KEY(idservicio) REFERENCES servicios(idservicio)
)ENGINE = INNODB;

CREATE TABLE actividades
(
	idactividad			INT AUTO_INCREMENT PRIMARY KEY,
	idespecialidad	INT 				NOT NULL,
	fecha						DATE 				NOT NULL,
	hora						TIME 				NOT NULL,
	titulo					VARCHAR(45)	NOT NULL,
	descripcion			VARCHAR(90)	NULL,
	direccion				VARCHAR(80)	NULL,
	CONSTRAINT fk_actividades_idespecialidad FOREIGN KEY(idactividad) REFERENCES especialidades (idespecialidad)
)ENGINE = INNODB;

CREATE TABLE trabajos 
(
	idtrabajo					INT AUTO_INCREMENT PRIMARY KEY,
	idespecialidad		INT 					NOT NULL,
	idusuario					INT 					NOT NULL,
	titulo						VARCHAR(40)		NOT NULL,
	descripcion				MEDIUMTEXT 		NOT NULL,
	fechapublicado		DATETIME 			NOT NULL DEFAULT NOW(),
	fechamodificado 	DATETIME  		NULL,
	fechaeliminado 		DATETIME			NULL,
	estado 						BIT 					NOT NULL DEFAULT 1,
	CONSTRAINT fk_trabajos_idespecialidad FOREIGN KEY(idespecialidad) REFERENCES especialidades (idespecialidad),	
	CONSTRAINT fk_trabajos_idusuario FOREIGN KEY(idusuario) REFERENCES usuarios(idusuario)
)ENGINE = INNODB;

CREATE TABLE albunes
(
	idalbum			INT AUTO_INCREMENT PRIMARY KEY,
	idusuario		INT 					NOT NULL,
	nombrealbum	VARCHAR(30)		NOT NULL,
	estado 			BIT 					NOT NULL DEFAULT 1,
	CONSTRAINT fk_albunes_idusuario FOREIGN KEY (idusuario) REFERENCES usuarios (idusuario)
)ENGINE = INNODB;

CREATE TABLE galerias 
(
	idgaleria		INT AUTO_INCREMENT PRIMARY KEY,
	idalbum			INT 					NOT NULL,
	idtrabajo		INT 					NULL,
	tipo				CHAR(1)				NOT NULL DEFAULT 'F', -- F = Foto, V = Video
	titulo			VARCHAR(45)		NOT NULL,
	archivo 		VARCHAR(100)	NOT NULL,
	fechaalta		DATETIME 			NOT NULL DEFAULT NOW(),
	fechabaja	 	DATETIME 			NULL,
	estado	 		BIT 					NOT NULL DEFAULT 1,
	CONSTRAINT fk_galerias_idalbum FOREIGN KEY(idalbum) REFERENCES albunes(idalbum),
	CONSTRAINT fk_galerias_idtrabajo FOREIGN KEY(idtrabajo) REFERENCES trabajos (idtrabajo)
)ENGINE = INNODB;

CREATE TABLE calificaciones 
(
	idcalificacion 	INT AUTO_INCREMENT PRIMARY KEY,
	idtrabajo				INT 			NOT NULL,
	idusuario				INT 			NOT NULL,
	puntuacion			TINYINT 	NOT NULL,
	estado 					BIT 			NOT NULL DEFAULT 1,
	CONSTRAINT fk_calificaciones_idtrabajo FOREIGN KEY(idtrabajo) REFERENCES trabajos(idtrabajo),
	CONSTRAINT fk_calificaciones_idusuario FOREIGN KEY(idusuario) REFERENCES usuarios(idusuario)
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
	CONSTRAINT fk_comentarios_idtrabajo FOREIGN KEY(idtrabajo) REFERENCES trabajos(idtrabajo),
	CONSTRAINT fk_comentarios_idusuario FOREIGN KEY(idusuario) REFERENCES usuarios(idusuario)
)ENGINE = INNODB;

CREATE TABLE reportes
(
	idreporte 		INT AUTO_INCREMENT PRIMARY KEY,
	idcomentario 	INT 			NOT NULL,
	motivo 				VARCHAR(30) 	NOT NULL,
	descripcion 	MEDIUMTEXT 		NOT NULL,
	fotografia		VARCHAR(100) 	NULL,
	fechareporte	DATETIME 			NOT NULL DEFAULT NOW(),
	CONSTRAINT fk_reportes_idcomentario FOREIGN KEY(idcomentario) REFERENCES comentarios (idcomentario)
)ENGINE = INNODB;