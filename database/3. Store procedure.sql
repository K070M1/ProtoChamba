USE REACTIVACION;

-- =============================================================================================================
-- UBIGEO
-- -------------------------------------------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_departamentos_listar()
BEGIN
	SELECT * FROM departamentos;
END $$

DELIMITER $$
CREATE PROCEDURE spu_provincias_listar(IN _iddepartamento	VARCHAR(2))
BEGIN
	SELECT * FROM provincias WHERE iddepartamento = _iddepartamento;
END $$

CALL spu_provincias_listar('01');

DELIMITER $$
CREATE PROCEDURE spu_distritos_listar(IN _idprovincia VARCHAR(4))
BEGIN
	SELECT * FROM distritos WHERE idprovincia = _idprovincia;
END $$



-- =============================================================================================================
-- TABLA PERSONAS
-- -------------------------------------------------------------------------------------------------------------
-- REGISTRAR PERSONAS--
DELIMITER $$
CREATE PROCEDURE spu_personas_registrar
(
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
END $$

CALL spu_personas_registrar('010101', 'Valentin Capan', 'Josefino', '2000-03-12','51957689057','AV','Luciernagas','','');

-- VERIFICAR EXISTENCIA DE UN EMAIL
DELIMITER $$
CREATE PROCEDURE spu_email_verifi
(
	IN _email VARCHAR(70)
)
BEGIN
	SELECT COUNT(*) FROM usuarios WHERE email = _email;
END $$



-- MODIFICAR PERSONA -- 
DELIMITER $$
CREATE PROCEDURE spu_personas_modificar
(
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
		nombres 	= _nombres, 
		fechanac 	= _fechanac,
		telefono 	= _telefono,
		tipocalle 	= _tipocalle,
		nombrecalle = _nombrecalle,
		numerocalle = _numerocalle,
		pisodepa 	= _pisodepa
	WHERE idpersona = _idpersona; 
END $$


-- OBTENER DATOS DE UNA PERSONA--
DELIMITER $$
CREATE PROCEDURE spu_personas_getdata(IN _idpersona INT)
BEGIN
	SELECT * FROM personas WHERE idpersona = _idpersona;
END $$


-- =============================================================================================================
-- TABLA USUARIOS
-- -------------------------------------------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_usuarios_listar()
BEGIN
	SELECT * FROM vs_usuarios_listar
		ORDER BY idusuario DESC;
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_registrar
(
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
END $$

CALL spu_usuarios_registrar(40,'','','SantosV@ssa','','12');

-- EDITAR ROL DEL USUARIO (A -> ADMIN, U -> USUARIO)
DELIMITER $$
CREATE PROCEDURE spu_usuarios_edit_rol
(
	IN _idusuario INT,
	IN _rol 			CHAR(1)
)
BEGIN
	UPDATE usuarios SET rol = _rol 
		WHERE idusuario = _idusuario;
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_getdata(IN _idusuario INT)
BEGIN
	SELECT * FROM vs_usuarios_listar
		WHERE idusuario = _idusuario;
END $$


DELIMITER $$
CREATE PROCEDURE spu_usuarios_modificar
(
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
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_eliminar(IN _idusuario INT)
BEGIN
	UPDATE usuarios SET estado = 0 
		WHERE idusuario = _idusuario;
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_login(IN _email VARCHAR(70))
BEGIN
	SELECT * FROM usuarios
		WHERE email = _email;
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_filtrar
(
	IN _idservicio 		 INT,
	IN _iddepartamento VARCHAR(2)
)
BEGIN
		SELECT * FROM vs_usuarios_servicio
			WHERE idservicio = _idservicio OR iddepartamento = _iddepartamento;
END $$


-- =============================================================================================================
-- TABLA ESTABLECIMIENTOS
-- -------------------------------------------------------------------------------------------------------------
-- AGREGAR ESTABLECIMIENTO --
DELIMITER $$
CREATE PROCEDURE spu_establecimientos_registrar
(
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
	IF _numerocalle = '' THEN SET _numerocalle = NULL; END IF;
	IF _referencia = '' THEN SET _referencia = NULL; END IF;
	INSERT INTO establecimientos (idusuario, iddistrito, establecimiento, ruc, tipocalle, nombrecalle, numerocalle, referencia, latitud, longitud)
		VALUES (_idusuario, _iddistrito, _establecimiento, _ruc, _tipocalle, _nombrecalle, _numerocalle, _referencia, _latitud, _longitud);
END $$


-- MODIFICAR ESTABLECIMIENTO --
DELIMITER $$
CREATE PROCEDURE spu_establecimientos_modificar
(
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
END $$


-- ELIMINAR ESTABLECIMIENTO (Lógico) --
DELIMITER $$
CREATE PROCEDURE spu_establecimientos_eliminar(IN _idestablecimiento INT)
BEGIN
	UPDATE establecimientos SET
		estado = 0
	WHERE idestablecimiento = _idestablecimiento;
END $$


-- OBTENER DATOS DEL ESTABLECIMIENTO --
DELIMITER $$
CREATE PROCEDURE spu_establecimientos_getdata(IN _idestablecimiento INT)
BEGIN
	SELECT * FROM establecimientos WHERE idestablecimiento = _idestablecimiento;
END $$


-- OBTENER DATOS DE LOS ESTABLECIMIENTOS
DELIMITER $$
CREATE PROCEDURE spu_establecimientos_getAll()
BEGIN
	SELECT * FROM establecimientos;
END $$

-- =============================================================================================================
-- TABLA ALBUNES
-- -------------------------------------------------------------------------------------------------------------==
DELIMITER $$
CREATE PROCEDURE spu_albumes_listar_usuario(IN _idusuario INT)
BEGIN
	SELECT * FROM albumes 
		WHERE idusuario = _idusuario AND estado = 1;
END $$

CALL spu_albumes_listar_usuario()
DELIMITER $$
CREATE PROCEDURE spu_albumes_getdata(IN _idalbum INT)
BEGIN
	SELECT * FROM albumes 
		WHERE idalbum = _idalbum AND estado = 1;
END $$

DELIMITER $$
CREATE PROCEDURE spu_albumes_registrar
(
	IN _idusuario 	INT,
	IN _nombrealbum VARCHAR(30)
)
BEGIN
	INSERT INTO albumes (idusuario, nombrealbum) VALUES
		(_idusuario, _nombrealbum);
END $$

DELIMITER $$
CREATE PROCEDURE spu_albumes_predeterminados
(
	IN _idusuario 	INT
)
BEGIN
	INSERT INTO albumes (idusuario, nombrealbum) VALUES
		(_idusuario, 'Perfil');
	INSERT INTO albumes (idusuario, nombrealbum) VALUES
		(_idusuario, 'Portada');
	INSERT INTO albumes (idusuario, nombrealbum) VALUES
		(_idusuario, 'Publicaciones');
END $$

CALL spu_albumes_predeterminados(18);

DELIMITER $$
CREATE PROCEDURE spu_albumes_modificar
(
	IN _idalbum			INT,
	IN _nombrealbum VARCHAR(30)
)
BEGIN
	UPDATE albumes SET 
		nombrealbum = _nombrealbum
	WHERE idalbum = _idalbum;
END $$

DELIMITER $$
CREATE PROCEDURE spu_albumes_eliminar(IN _idalbum INT)
BEGIN
	UPDATE albumes SET 
		estado = 0
	WHERE idalbum = _idalbum;
END $$


-- =============================================================================================================
-- TABLA GALERIA
-- -------------------------------------------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_galerias_listar_usuario(IN _idusuario INT)
BEGIN
	SELECT * FROM vs_galerias_listar WHERE idusuario = _idusuario;
END $$

DELIMITER $$
CREATE PROCEDURE spu_galerias_listar_album(IN _idalbum INT)
BEGIN
	SELECT * FROM vs_galerias_listar WHERE idalbum = _idalbum;
END $$

DELIMITER $$
CREATE PROCEDURE spu_galerias_listar_trabajo(IN _idtrabajo INT)
BEGIN
	SELECT * FROM vs_galerias_listar WHERE idtrabajo = _idtrabajo;
END $$

DELIMITER $$
CREATE PROCEDURE spu_galerias_getdata(IN _idgaleria INT)
BEGIN
	SELECT * FROM vs_galerias_listar WHERE idgaleria = _idgaleria;
END $$

DELIMITER $$
CREATE PROCEDURE spu_galerias_registrar
(
	IN _idalbum 	INT,
	IN _idusuario INT,
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
END $$

DELIMITER $$
CREATE PROCEDURE spu_galerias_modificar
(
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
END $$

DELIMITER $$
CREATE PROCEDURE spu_galerias_eliminar(IN _idgaleria INT)
BEGIN
	UPDATE galerias SET estado = 0
		WHERE idgaleria = _idgaleria;
END $$


-- =============================================================================================================
-- TABLA REDES
-- -------------------------------------------------------------------------------------------------------------
-- =============REGISTRAR REDES============
DELIMITER $$
CREATE PROCEDURE spu_redessociales_registrar
(
	IN _idusuario	INT,
	IN _redsocial	CHAR(1), -- F = Facebook, I = Instagram, W = Whatsapp, T = Twitter, Y = Youtube, K = Tik Tok
	IN _vinculo	MEDIUMTEXT

)
BEGIN 
	INSERT INTO redessociales (idusuario, redsocial, vinculo)
		VALUES(_idusuario, _redsocial, _vinculo);
END $$

-- =============ELIMINAR REDES==================
DELIMITER $$
CREATE PROCEDURE spu_redessociales_eliminar
(
	IN _idredsocial INT
)
BEGIN
	DELETE FROM redessociaes WHERE idredsocial = _idredsocial;
END $$


-- ============MODIFICAR REDES===============
DELIMITER $$
CREATE PROCEDURE spu_redessociales_modificar
(
	IN _idredsocial		INT,
	IN _redsocial			CHAR(1),
	IN _vinculo				MEDIUMTEXT

)
BEGIN
	UPDATE productos SET
		redsocial = _redsocial,
		 vinculo  = _vinculo
	WHERE idredsocial = _idredsocial;
END $$

-- ==============FILTRAR POR USUARIO=================
DELIMITER $$
CREATE PROCEDURE spu_redessociales_filtrar_usuario(IN _idusuario INT)
BEGIN
	SELECT 	RDS.idredsocial, USU.idusuario,
					PER.nombres, PER.apellidos,
					RDS.redsocial, RDS.vinculo 
		FROM redessociales RDS
		INNER JOIN usuarios USU ON USU.idusuario = RDS.idusuario
		INNER JOIN personas PER ON PER.idpersona = USU.idpersona
		WHERE USU.idusuario = _idusuario;
END $$


-- =============================================================================================================
-- TABLA DE SEGUIDORES
-- -------------------------------------------------------------------------------------------------------------

-- ===============LISTAR SEGUIDORES================
DELIMITER $$
CREATE PROCEDURE spu_seguidores_listar(IN _idusuario INT)
BEGIN 
	SELECT * FROM seguidores WHERE idfollowing = _idusuario;
END $$

-- ===============LISTAR SEGUIDOS================
DELIMITER $$
CREATE PROCEDURE spu_seguidos_listar(IN _idusuario INT)
BEGIN
SELECT * FROM seguidores WHERE idfollower = _idusuario;
END $$

-- =============================================================================================================
-- TABLA FOROS
-- -------------------------------------------------------------------------------------------------------------

-- ========= REGISTRAR EN LA TABLA FOROS============
DELIMITER $$
CREATE PROCEDURE spu_foros_registrar
(
	IN _idtousuario		INT,
	IN _idfromusuario	INT,
	IN _consulta 			MEDIUMTEXT
)
BEGIN 
	INSERT INTO foros (idtousuario, idfromusuario, consulta)
		VALUES(_idtousuario, _idfromusuario, _consulta);
END $$


-- ========= ELIMINAR (FORMA LOGICA) EN LA TABLA FOROS============
DELIMITER $$
CREATE PROCEDURE spu_foros_eliminar
(
	IN  _idforo	INT
)
BEGIN
	UPDATE foros SET 
		estado = 0
		WHERE idforo = _idforo;
END $$

-- ========= MODIFICAR EN LA TABLA FOROS============
DELIMITER $$
CREATE PROCEDURE spu_foros_modificar
(
	IN _idforo			INT,
	IN _consulta		MEDIUMTEXT

)
BEGIN
	UPDATE foros SET
		consulta = _consulta
	WHERE idforo = _idforo;
END $$


-- =============================================================================================================
-- TABLA SERVICIOS
-- -------------------------------------------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_servicios_listar()
BEGIN
   SELECT idservicio, nombreservicio
      FROM servicios
      ORDER BY idservicio DESC;
END $$


DELIMITER $$
CREATE PROCEDURE spu_servicios_registrar
(
    IN _nombreservicio VARCHAR(50)
)
BEGIN
   INSERT INTO servicios (nombreservicio)
      VALUES (_nombreservicio);
END $$

DELIMITER $$
CREATE PROCEDURE spu_servicios_modificar
(
    IN _idservicio        INT,
    IN _nombreservicio    VARCHAR(50)
)
BEGIN 
    UPDATE servicios SET
       nombreservicio = _nombreservicio
    WHERE idservicio = _idservicio;
END $$


-- =============================================================================================================
-- TABLA ESPECIALIDADES
-- -------------------------------------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_especialidades_listar()
BEGIN
   SELECT * FROM vs_especialidades_listar;
END $$

CALL spu_especialidades_listar()

DELIMITER $$
CREATE PROCEDURE spu_especialidades_listar_usuario(IN _idusuario INT)
BEGIN
   SELECT idespecialidad, idusuario, idservicio, descripcion
      FROM especialidades
      WHERE idusuario = _idusuario
      ORDER BY idespecialidad DESC;
END $$


DELIMITER $$
CREATE PROCEDURE spu_especialidades_registrar
(
    IN _idusuario		INT,
    IN _idservicio	INT,
    IN _descripcion	MEDIUMTEXT,
    IN _tarifa			DECIMAL(7,2)
)
BEGIN
   INSERT INTO especialidades (idusuario, idservicio, descripcion, tarifa)
      VALUES (_idusuario, _idservicio, _descripcion, _tarifa);
END $$


DELIMITER $$
CREATE PROCEDURE spu_especialidades_modificar
(
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
END $$



/* PROCEDIMIENTOS : TRABAJOS , COMENTARIOS Y CALIFICACIONES */
-- =============================================================================================================
-- TABLA TRABABJOS
-- -------------------------------------------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_trabajos_listar_usuario(IN _idusuario INT)
BEGIN
	SELECT * FROM vs_trabajos_listar
		WHERE idusuario = _idusuario
		ORDER BY idtrabajo DESC;
END $$


/* REGISTRAR */
DELIMITER $$
CREATE PROCEDURE spu_trabajos_registrar
(
	IN _idespecialidad	INT ,
	IN _idusuario				INT ,
	IN _titulo					VARCHAR(40),
	IN _descripcion			MEDIUMTEXT
)
BEGIN 
	INSERT INTO trabajos (idespecialidad , idusuario, titulo ,descripcion) VALUES
		(_idespecialidad , _idusuario , _titulo , _descripcion);
END $$

/* ACTUALIZAR */
DELIMITER $$
CREATE PROCEDURE spu_trabajos_modificar
(	
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
END $$

/* Eliminar */
DELIMITER $$
CREATE PROCEDURE spu_trabajos_eliminar(IN _idtrabajo INT)
BEGIN 
	UPDATE trabajos SET estado = 0
		WHERE idtrabajo = _idtrabajo;
END $$

/* PROCEDIMIENTO PARA VISUALIZAR LAS IMAGENES DE CADA TRABAJO  */
DELIMITER $$
CREATE PROCEDURE spu_listar_fotos
(
	IN _idtrabajo INT
)
BEGIN 
	SELECT GAL.idgaleria ,ALB.nombrealbum,GAL.tipo,GAL.titulo,GAL.archivo
		FROM galerias GAL
		INNER JOIN albunes ALB ON ALB.idalbum = GAL.idalbum
		WHERE idtrabajo = _idtrabajo; 
END $$


-- =============================================================================================================
-- TABLA COMENTARIOS
-- -------------------------------------------------------------------------------------------------------------

/* LISTAR */
DELIMITER $$
CREATE PROCEDURE spu_comentarios_listar_trabajo(IN _idtrabajo INT)
BEGIN
	SELECT * FROM vs_comentarios_listar
		WHERE idtrabajo = _idtrabajo
		ORDER BY idcomentario DESC;
END $$


/* REGISTRAR */
DELIMITER $$
CREATE PROCEDURE spu_comentarios_registrar
(
	IN _idtrabajo		INT,
	IN _idusuario		INT,
	IN _comentario	MEDIUMTEXT
)
BEGIN 
	INSERT INTO comentarios (idtrabajo , idusuario , comentario ) VALUES 
		(_idtrabajo , _idusuario,_comentario);
END $$

/* MODIFICAR*/
DELIMITER $$
CREATE PROCEDURE spu_comentarios_modificar
(
	IN _idcomentario INT,
	IN _comentario	MEDIUMTEXT
)
BEGIN 
	UPDATE comentarios SET
		comentario 			= _comentario,
		fechamodificado = NOW()
	WHERE idcomentario = _idcomentario;
END $$

/* ELIMINAR */
DELIMITER $$
CREATE PROCEDURE spu_comentarios_eliminar(IN _idcomentario INT)
BEGIN 
	UPDATE comentarios SET estado = 0
		WHERE idtrabajo = _idtrabajo;
END $$


-- =============================================================================================================
-- TABLA CALIFICACIONES
-- -------------------------------------------------------------------------------------------------------------

/* LISTAR */
/* REGISTRAR */
DELIMITER $$
CREATE PROCEDURE spu_calificaciones_registrar
(
	IN _idtrabajo		INT,
	IN _idusuario		INT,
	IN _puntuacion	TINYINT 
)
BEGIN 
	INSERT INTO calificaciones (idtrabajo , idusuario , puntuacion) VALUES
		(_idtrabajo , _idusuario , _puntuacion);
END $$

/* MODIFICAR */
DELIMITER $$
CREATE PROCEDURE spu_calificaciones_modificar
(
	IN _idcalificacion 	INT,
	IN _puntuacion			TINYINT 
)
BEGIN 
	UPDATE calificaciones SET 
		puntuacion = _puntuacion
	WHERE idcalificacion = _idcalificacion;
END $$

/* ELIMINAR */
DELIMITER $$
CREATE PROCEDURE spu_calificaciones_eliminar(IN _idcalificacion INT)
BEGIN 
	UPDATE calificaciones SET estado = 0
		WHERE idcalificacion = _idcalificacion;
END $$

/* PROCEDIMIENTO PARA CONTAR LAS PUNTUACIONES*/
DELIMITER $$
CREATE PROCEDURE spu_total_calificaciones_trabajo
(
	IN _idtrabajo INT
)
BEGIN 
	SELECT CALI.idcalificacion,CONCAT (PERS.nombres , ' ', PERS.apellidos) AS 'usuario', idtrabajo , 
				 SUM(CALI.puntuacion) AS 'totalpuntuacion', COUNT(*) AS 'totalpersona'
		FROM calificaciones CALI
		INNER JOIN usuarios USU ON USU.idusuario = CALI.idusuario
		INNER JOIN personas PERS ON PERS.idpersona = USU.idpersona
		WHERE idtrabajo = _idtrabajo;
END $$

-- =============================================================================================================
-- TABLA REPORTES
-- -------------------------------------------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_reportes_registrar
(
	IN _idcomentario INT,
	IN _motivo 			 VARCHAR(30),
	IN _descripcion	 MEDIUMTEXT,
	IN _fotografia 	 VARCHAR(100)
)
BEGIN
IF _fotografia = '' THEN SET _fotografia = NULL; END IF;

INSERT INTO reportes (idcomentario, motivo, descripcion, fotografia)
	VALUES(_idcomentario, _motivo, _descripcion, _fotografia);
END $$

DELIMITER $$
CREATE PROCEDURE spu_listar_reportes()
BEGIN
	SELECT * FROM vs_listar_reportes;
END $$

/*Reporte con filtrado por fecha*/
DELIMITER $$
CREATE PROCEDURE spu_filtrar_reportes_fecha
(
	IN _fechainicio DATE, 
	IN _fechafin 		DATE
)
BEGIN
	SELECT * FROM vs_listar_reportes 
		WHERE fechareporte BETWEEN _fechainicio AND _fechafin;
END $$

/*Reporte con filtrado por usuario*/
DELIMITER $$
CREATE PROCEDURE spu_filtrar_reportes_usuario
(
	IN _nombres 	VARCHAR(40), 
	IN _apellidos VARCHAR(40)
)
BEGIN
	SELECT * FROM vs_listar_reportes 
		WHERE usuario LIKE CONCAT('%',_apellidos,'%') OR 
					usuario LIKE  CONCAT('%',_nombres,'%');
END $$


-- =============================================================================================================
-- TABLA ACTIVIDADES
-- -------------------------------------------------------------------------------------------------------------

-- Listar actividades
DELIMITER $$
CREATE PROCEDURE spu_listar_actividades()
BEGIN
	SELECT * FROM vs_listar_actividades;
END $$

-- Filtrar actividades
DELIMITER $$
CREATE PROCEDURE spu_filtrar_actividad(IN _idusuario INT)
BEGIN
	SELECT * FROM vs_listar_actividades WHERE idusuario = _idusuario;
END $$

-- Filtrar entre fechas
DELIMITER $$
CREATE PROCEDURE spu_filtrar_actividad_fecha
(
	IN _idusuario 	INT,
	IN _fechainicio DATE,
	IN _fechafin		DATE
)
BEGIN
	SELECT * FROM vs_listar_actividades 
		WHERE idusuario = _idusuario AND 
			fecha BETWEEN _fechainicio AND _fechafin;
END $$

-- Registrar actividad
DELIMITER $$
CREATE PROCEDURE spu_registrar_actividades
(
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
END $$


-- Modificar actividad
DELIMITER $$
CREATE PROCEDURE spu_modificar_actividades
(	
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
END $$


-- Eliminar actividad
DELIMITER $$
CREATE PROCEDURE spu_eliminar_actividades(IN _idactividad INT)
BEGIN
	DELETE FROM actividades WHERE idactividad = _idactividad;
END $$


-- =============================================================================================================
-- GRAFICOS ESTADISTICOS 
-- -------------------------------------------------------------------------------------------------------------

-- REPORTES RECIBIDOS POR MES --
DELIMITER $$
CREATE PROCEDURE spu_grafico_reportes()
BEGIN
	SELECT MONTHNAME(fechareporte)AS 'mes', COUNT(idreporte)AS 'reportes'
		FROM reportes
	GROUP BY MONTHNAME(fechareporte)
	ORDER BY MONTH(fechareporte) ASC;
END $$


-- REPORTES RECIBIDOS POR AÑO --
DELIMITER $$
CREATE PROCEDURE spu_grafico_reportes_year()
BEGIN
	SELECT YEAR(fechareporte) AS 'year', COUNT(idreporte)AS 'reportes'
		FROM reportes
	GROUP BY YEAR(fechareporte)
	ORDER BY 1 ASC;
END $$


-- NIVELES DE USUARIOS --
DELIMITER $$
CREATE PROCEDURE spu_grafico_niveles_usu()
BEGIN
	SELECT nivelusuario , COUNT(idusuario) AS 'totalusuario'
		FROM usuarios
	GROUP BY nivelusuario;
END $$

-- SERVICIOS POPULARES (Según su calificación) --
DELIMITER $$
CREATE PROCEDURE spu_grafico_popular()
BEGIN
	SELECT SER.nombreservicio, SUM(puntuacion)AS'calificación'
		FROM calificaciones CAL
		INNER JOIN trabajos TRA ON TRA.idtrabajo = CAL.idtrabajo
		INNER JOIN especialidades ESP ON ESP.idespecialidad = TRA.idespecialidad
		INNER JOIN servicios SER ON SER.idservicio = ESP.idservicio
	GROUP BY SER.nombreservicio;
END $$
