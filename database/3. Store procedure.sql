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


-- VERIFICAR EXISTENCIA DE UN EMAIL
DELIMITER $$
CREATE PROCEDURE spu_email_verifi
(
	IN _email VARCHAR(70)
)
BEGIN
	SELECT COUNT(*) AS 'email' FROM usuarios WHERE email = _email;
END $$

DELIMITER $$
CREATE PROCEDURE spu_email_verifi_res(
	IN _emailres VARCHAR(70)
)
BEGIN
	SELECT COUNT(*) AS 'email' FROM usuarios WHERE emailrespaldo = _emailres OR email = _emailres;
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
CREATE PROCEDURE spu_usuarios_modificar_horarioatencion
(
	IN _idusuario 			INT,
	IN _horarioatencion VARCHAR(80)
)
BEGIN
	UPDATE usuarios SET 
		horarioatencion = _horarioatencion
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

-- Actualizar correos
DELIMITER $$
CREATE PROCEDURE spu_usuarios_modificar_emails
(
	IN _idusuario 			INT,
	IN _email 					VARCHAR(70),
	IN _emailrespaldo		VARCHAR(70)
)
BEGIN
	IF _emailrespaldo = '' THEN SET _emailrespaldo = NULL; END IF;

	UPDATE usuarios SET 
		email 					= _email,
		emailrespaldo 	= _emailrespaldo
	WHERE idusuario = _idusuario;
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_modificar_clave
(
	IN _idusuario 			INT,
	IN _clave 					VARCHAR(80)
)
BEGIN
	UPDATE usuarios SET 
		clave 					= _clave
	WHERE idusuario = _idusuario;
END $$


DELIMITER $$
CREATE PROCEDURE spu_usuarios_eliminar(IN _idusuario INT)
BEGIN
	UPDATE usuarios SET estado = '0' 
		WHERE idusuario = _idusuario;
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_login(IN _email VARCHAR(70))
BEGIN
	SELECT * FROM usuarios
		WHERE email = _email AND estado = '1';
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_filtrar_rol(IN _rol CHAR(1))
BEGIN
	SELECT *	FROM vs_usuarios_listar_datos_basicos
		WHERE rol = _rol;	
END $$


DELIMITER $$
CREATE PROCEDURE spu_usuarios_buscar_nombres(IN _search VARCHAR(40))
BEGIN
	SELECT* FROM vs_usuarios_listar_datos_basicos
		WHERE nombres LIKE CONCAT('%', _search, '%');
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_buscar_nombres_scroll(
	IN _search VARCHAR(40),
	IN _offset INT,
	IN _limit  TINYINT 
)
BEGIN
	SELECT* FROM vs_usuarios_listar_datos_basicos
		WHERE nombres LIKE CONCAT('%', _search, '%') LIMIT _limit OFFSET _offset;
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_buscar_rol_nombres
(
	IN _rol 		CHAR(1), 
	IN _search 	VARCHAR(40)
)
BEGIN
	SELECT *	FROM vs_usuarios_listar_datos_basicos 
			WHERE rol = _rol AND nombres LIKE CONCAT('%', _search, '%');	
END $$

-- Información para las preguntas
DELIMITER $$
CREATE PROCEDURE spu_usuarios_quest(IN _idusuario INT)
BEGIN
	SELECT * FROM vs_usuarios_listar
		WHERE idusuario = _idusuario;
END $$


-- BANEAR USUARIO
DELIMITER $$
CREATE PROCEDURE spu_usuarios_banear(IN _idusuario INT)
BEGIN
UPDATE usuarios SET	
	estado = '2'
	WHERE idusuario = _idusuario;	
END $$

-- REACTIVAR CUENTA
DELIMITER $$
CREATE PROCEDURE spu_usuarios_reactivar(IN _idusuario INT)
BEGIN
UPDATE usuarios SET	
	estado = '1'
	WHERE idusuario = _idusuario;	
END $$


-- Restablecer contraseña
DELIMITER $$
CREATE PROCEDURE spu_usuarios_edit_pass
(
	IN _idusuario INT,
	IN _clave VARCHAR(80)
)
BEGIN
	UPDATE usuarios SET clave = _clave WHERE idusuario = _idusuario;
END


-- =============================================================================================================
-- TABLA ESTABLECIMIENTOS
-- -------------------------------------------------------------------------------------------------------------
-- ESTABLECIMIENTOS LISTADO POR USUARIO
DELIMITER $$
CREATE PROCEDURE spu_establecimientos_listar_user(IN _idusuario INT)
BEGIN
	SELECT * FROM vs_establecimientos WHERE idusuario = _idusuario;
END $$

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
	SELECT	EST.idestablecimiento, EST.idusuario, EST.establecimiento,
					EST.ruc, EST.tipocalle, EST.nombrecalle, EST.numerocalle, 
					EST.referencia, EST.latitud, EST.longitud, DST.iddistrito,
					DST.idprovincia, DST.iddepartamento
		FROM establecimientos EST
		INNER JOIN distritos DST ON DST.iddistrito = EST.iddistrito
		WHERE EST.idestablecimiento = _idestablecimiento AND EST.estado = 1;
END $$


-- OBTENER ESTABLECIMIENTOS SEGUN EL SERVICIO QUE BRINDA EL USUARIO
DELIMITER $$
CREATE PROCEDURE spu_establecimientos_getdata_servicio
(
    IN _nombreservicio VARCHAR(50),
    IN _nombreciudad VARCHAR(50)
) BEGIN
    SELECT
        DISTINCT(e.idestablecimiento), e.establecimiento, e.ruc, e.latitud, e.longitud,
        u.idusuario, u.horarioatencion,
        p.idpersona, p.nombres, p.apellidos, p.telefono,
        s.idservicio, s.nombreservicio,
        es.idespecialidad, es.descripcion
    FROM establecimientos e
        INNER JOIN usuarios u ON e.idusuario = u.idusuario
        JOIN especialidades es ON u.idusuario = es.idusuario
        JOIN servicios s ON es.idservicio = s.idservicio
        JOIN personas p ON u.idpersona = p.idpersona
        JOIN distritos d ON e.iddistrito = d.iddistrito
    WHERE
        s.nombreservicio LIKE CONCAT('%', _nombreservicio, '%') &&
        d.distrito LIKE CONCAT('%', _nombreciudad, '%')
    GROUP BY establecimiento;
END $$

-- =============================================================================================================
-- TABLA ALBUMES
-- -------------------------------------------------------------------------------------------------------------==
DELIMITER $$
CREATE PROCEDURE spu_albumes_listar_usuario(IN _idusuario INT)
BEGIN
	SELECT * FROM albumes 
		WHERE idusuario = _idusuario AND estado = 1 ORDER BY idalbum;
END $$

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

DELIMITER $$
CREATE PROCEDURE spu_albumes_getalbum(IN _idusuario INT, IN _nombrealbum VARCHAR(30))
BEGIN
	SELECT * FROM albumes 
		WHERE nombrealbum = _nombrealbum AND idusuario = _idusuario;
END $$

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
	SELECT * FROM vs_galerias_listar WHERE idusuario = _idusuario AND tipo = "F" AND idalbum IS NULL;
END $$

DELIMITER $$
CREATE PROCEDURE spu_galerias_listar_album(IN _idalbum INT)
BEGIN
	SELECT * FROM vs_galerias_listar WHERE idalbum = _idalbum AND tipo = 'F';
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
	IN _archivo 	VARCHAR(100),
	IN _estado		CHAR(1)
)
BEGIN
	IF _idalbum = '' THEN SET _idalbum = NULL; END IF;
	IF _idtrabajo = '' THEN SET _idtrabajo = NULL; END IF;
	
	INSERT INTO galerias (idalbum, idusuario, idtrabajo, tipo, archivo, estado) VALUES
		(_idalbum, _idusuario, _idtrabajo, _tipo, _archivo, _estado);
END $$

DELIMITER $$
CREATE PROCEDURE spu_galerias_modificar
(
	IN _idgaleria INT,
	IN _idalbum 	INT
)
BEGIN
	IF _idalbum = '' THEN SET _idalbum = NULL; END IF;
	
	UPDATE galerias SET
		idalbum 	= _idalbum
	WHERE idgaleria = _idgaleria;
END $$

DELIMITER $$
CREATE PROCEDURE spu_galerias_foto_perfil(IN _idusuario INT)
BEGIN	
		SELECT 	GLR.`idgaleria`, GLR.`archivo`, GLR.`estado`, 
						GLR.`tipo`, ALB.`idalbum`, ALB.`nombrealbum`
			FROM galerias GLR
			INNER JOIN albumes ALB ON ALB.`idalbum` = GLR.`idalbum`
			INNER JOIN usuarios USU ON USU.idusuario = ALB.`idusuario`
			WHERE ALB.`nombrealbum` = 'perfil' AND GLR.`estado` = '2'
					AND  USU.`idusuario` = _idusuario;
END $$

DELIMITER $$
CREATE PROCEDURE spu_galerias_foto_portada(IN _idusuario INT)
BEGIN	
		SELECT 	GLR.`idgaleria`, GLR.`archivo`, GLR.`estado`, 
						GLR.`tipo`, ALB.`idalbum`, ALB.`nombrealbum`
			FROM galerias GLR
			INNER JOIN albumes ALB ON ALB.`idalbum` = GLR.`idalbum`
			INNER JOIN usuarios USU ON USU.idusuario = ALB.`idusuario`
			WHERE ALB.`nombrealbum` = 'portada' AND GLR.`estado` = '3'
					AND  USU.`idusuario` = _idusuario;
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
		WHERE USU.idusuario = _idusuario
		ORDER BY RDS.redsocial;
END $$


-- =============================================================================================================
-- TABLA DE SEGUIDORES
-- -------------------------------------------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_seguidor_registrar(IN _idfollowing INT, IN _idfollower INT)
BEGIN
	DECLARE _idseguidor INT;
	SET _idseguidor = (SELECT idseguidor FROM seguidores WHERE idfollowing = _idfollowing AND idfollower = _idfollower);
	
	IF _idseguidor IS NULL THEN
		INSERT INTO seguidores (idfollowing, idfollower) VALUES
		(_idfollowing, _idfollower);
	ELSE
		UPDATE seguidores SET estado = 1 WHERE idseguidor = _idseguidor;
	END IF;	
END $$


DELIMITER $$
CREATE PROCEDURE spu_seguidores_listar(IN _idusuario INT)
BEGIN
	SELECT SEG.idfollower, PER.nombres, PER.apellidos, SEG.fechaseguido
	FROM seguidores SEG
	INNER JOIN usuarios USU ON USU.idusuario = SEG.idfollower
	INNER JOIN personas PER ON PER.idpersona = USU.idpersona
	WHERE idfollowing = _idusuario AND SEG.estado = 1
	ORDER BY PER.nombres, PER.apellidos;
END $$

DELIMITER $$
CREATE PROCEDURE spu_seguidos_listar(IN _idusuario INT)
BEGIN
	SELECT SEG.idfollowing, PER.nombres, PER.apellidos, SEG.fechaseguido, SEG.estado
	FROM seguidores SEG
	INNER JOIN usuarios USU ON USU.idusuario = SEG.idfollowing
	INNER JOIN personas PER ON PER.idpersona = USU.idpersona
	WHERE idfollower = _idusuario AND SEG.estado = 1
	ORDER BY PER.nombres, PER.apellidos;
END $$

DELIMITER $$
CREATE PROCEDURE spu_seguidores_conteo(IN _idusuario INT)
BEGIN
	SELECT COUNT(idfollowing) AS 'totalseguidores'
	FROM seguidores
	WHERE idfollowing = _idusuario AND estado = 1;
END $$

DELIMITER $$
CREATE PROCEDURE spu_seguidos_conteo(IN _idusuario INT)
BEGIN
	SELECT COUNT(idfollower) AS 'totalseguidos'
	FROM seguidores
	WHERE idfollower = _idusuario AND estado = 1;
END $$

DELIMITER $$
CREATE PROCEDURE spu_seguidos_eliminar(IN _idusuario INT, IN _following INT)
BEGIN
	UPDATE seguidores SET
	estado = 0
	WHERE idfollower = _idusuario AND idfollowing = _following;
END $$

-- =============================================================================================================
-- TABLA FOROS
-- -------------------------------------------------------------------------------------------------------------

DELIMITER $$
CREATE PROCEDURE spu_foros_listar_usuario 
(
	IN _idusuario INT,
	IN _offset 		INT,
	IN _limit 		TINYINT
)
BEGIN
	SELECT * FROM vs_listar_foros WHERE idtousuario = _idusuario LIMIT _limit OFFSET _offset;
END $$

-- ========= REGISTRAR EN LA TABLA FOROS============
DELIMITER $$
CREATE PROCEDURE spu_foros_registrar
(
	IN _idfromusuario		INT,
	IN _idtousuario			INT,
	IN _consulta 				MEDIUMTEXT
)
BEGIN 
	INSERT INTO foros (idtousuario, idfromusuario, consulta)
		VALUES(_idtousuario, _idfromusuario, _consulta);
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

-- =============================================================================================================
-- TABLA SERVICIOS
-- -------------------------------------------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_servicios_listar_usuario(IN _idusuario INT)
BEGIN
   SELECT SRV.idservicio, SRV.nombreservicio, USU.idusuario 
		FROM servicios SRV
		INNER JOIN especialidades ESP ON ESP.idservicio = SRV.idservicio
		INNER JOIN usuarios USU ON USU.idusuario = ESP.idusuario
		WHERE USU.idusuario = _idusuario AND ESP.estado = 1
		GROUP BY SRV.idservicio
		ORDER BY SRV.nombreservicio ASC;
END $$


DELIMITER $$
CREATE PROCEDURE spu_servicios_listar()
BEGIN
   SELECT idservicio, nombreservicio
      FROM servicios
      ORDER BY nombreservicio ASC;
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

-- LISTADO ALEATORIO DE ESPECIALIDADES
DELIMITER $$
CREATE PROCEDURE spu_especialidades_listar_aleatorio(IN _limit TINYINT, IN _offset INT)
BEGIN
   SELECT * FROM vs_especialidades_listar
   ORDER BY RAND() LIMIT _limit OFFSET _offset
   
END $$


-- LISTADO ALEATORIO DE LOS MÁS POPULARES
DELIMITER $$
CREATE PROCEDURE spu_especialidades_listar_populares(IN _limit TINYINT, IN _offset INT)
BEGIN
   SELECT * FROM vs_especialidades_listar
   WHERE estrellas > 1
   GROUP BY idusuario
   ORDER BY RAND() LIMIT _limit OFFSET _offset;
END $$

DELIMITER $$
CREATE PROCEDURE spu_especialidades_listar_usuario(IN _idusuario INT)
BEGIN
   SELECT * FROM especialidades
      WHERE idusuario = _idusuario AND estado = 1
      ORDER BY descripcion ASC;
END $$


DELIMITER $$
CREATE PROCEDURE spu_especialidades_listar_servicio_usuario(IN _idservicio INT, IN _idusuario INT)
BEGIN
	SELECT * FROM especialidades 
		WHERE idservicio = _idservicio AND 
				idusuario = _idusuario AND 
				estado = 1;
END $$

DELIMITER $$
CREATE PROCEDURE spu_especialidades_listar_aleatorio_servicio
(
	IN _idservicio 	INT,
	IN _limit 			TINYINT,
	IN _offset 			INT
)
BEGIN
	SELECT * FROM vs_especialidades_listar
		WHERE idservicio = _idservicio
		ORDER BY RAND() LIMIT _limit OFFSET _offset;
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
CREATE PROCEDURE spu_especialidades_getdata(IN _idespecialidad INT)
BEGIN 
	SELECT * FROM especialidades WHERE idespecialidad = _idespecialidad;
END $$

DELIMITER $$
CREATE PROCEDURE spu_especialidades_eliminar(IN _idespecialidad INT)
BEGIN
	DELETE FROM actividades WHERE idespecialidad = _idespecialidad;	
	UPDATE trabajos SET estado = 0 WHERE idespecialidad = _idespecialidad;
	UPDATE especialidades SET estado = 0 WHERE idespecialidad = _idespecialidad;
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

-- TOTAL DE SERVICOS OFRECIDOS
DELIMITER $$
CREATE PROCEDURE spu_especialidades_total_disponible()
BEGIN
   SELECT COUNT(idespecialidad) AS 'total' FROM vs_especialidades_listar;
END $$


-- FILTRAR POR SERVICIO
DELIMITER $$
CREATE PROCEDURE spu_especialidades_filtrar_servicio
(
	IN _nombreservicio 	VARCHAR(50), 
	IN _order 					CHAR(1),
	IN _limit 					TINYINT,
	IN _offset					INT
)
BEGIN		
	IF _order = 'N' THEN
		SELECT * FROM vs_especialidades_listar
		WHERE nombreservicio LIKE CONCAT(_nombreservicio, '%')
		ORDER BY nombres ASC LIMIT _limit OFFSET _offset;	
		
	ELSEIF _order = 'F' THEN
		SELECT * FROM vs_especialidades_listar
		WHERE nombreservicio LIKE CONCAT(_nombreservicio, '%')
		ORDER BY idespecialidad ASC LIMIT _limit OFFSET _offset;		
		
	ELSEIF _order = 'S' THEN
		SELECT * FROM vs_especialidades_listar
		WHERE nombreservicio LIKE CONCAT(_nombreservicio, '%')
		ORDER BY tarifa ASC LIMIT _limit OFFSET _offset;	
		
	ELSEIF _order = 'E' THEN
		SELECT * FROM vs_especialidades_listar
		WHERE nombreservicio LIKE CONCAT(_nombreservicio, '%')
		ORDER BY estrellas DESC LIMIT _limit OFFSET _offset;	
	END IF;
END $$ 


-- FILTRAR POR SERVICIO Y DEPARTAMENTO
DELIMITER $$
CREATE PROCEDURE spu_especialidades_filtrar_servicio_dept
(
	IN _nombreservicio 	VARCHAR(50), 
	IN _iddepartamento 	VARCHAR(2),
	IN _order 					CHAR(1),
	IN _limit 					TINYINT,
	IN _offset					INT
)
BEGIN		
	IF _order = 'N' THEN
		SELECT * FROM vs_especialidades_listar
		WHERE nombreservicio LIKE CONCAT( _nombreservicio, '%') AND iddepartamento = _iddepartamento
		ORDER BY nombres ASC LIMIT _limit OFFSET _offset;	
		
	ELSEIF _order = 'F' THEN
		SELECT * FROM vs_especialidades_listar
		WHERE nombreservicio LIKE CONCAT( _nombreservicio, '%') AND iddepartamento = _iddepartamento
		ORDER BY idespecialidad ASC LIMIT _limit OFFSET _offset;		
		
	ELSEIF _order = 'S' THEN
		SELECT * FROM vs_especialidades_listar
		WHERE nombreservicio LIKE CONCAT( _nombreservicio, '%') AND iddepartamento = _iddepartamento
		ORDER BY tarifa ASC LIMIT _limit OFFSET _offset;	
		
	ELSEIF _order = 'E' THEN
		SELECT * FROM vs_especialidades_listar
		WHERE nombreservicio LIKE CONCAT( _nombreservicio, '%') AND iddepartamento = _iddepartamento
		ORDER BY estrellas DESC LIMIT _limit OFFSET _offset;	
	END IF;
END $$ 


-- FILTRAR POR SERVICIO Y PROVINCIA
DELIMITER $$
CREATE PROCEDURE spu_especialidades_filtro_provincia
(
	IN _nombreservicio 	VARCHAR(50), 
	IN _idprovincia 		VARCHAR(4),
	IN _order 					CHAR(1),
	IN _limit 					TINYINT,
	IN _offset					INT
)
BEGIN
	
	IF _order = 'N' THEN
		SELECT * FROM vs_especialidades_listar
		WHERE nombreservicio LIKE CONCAT( _nombreservicio, '%') AND idprovincia 	 = _idprovincia
		ORDER BY nombres ASC LIMIT _limit OFFSET _offset;	
		
	ELSEIF _order = 'F' THEN
		SELECT * FROM vs_especialidades_listar
		WHERE nombreservicio LIKE CONCAT( _nombreservicio, '%') AND idprovincia 	 = _idprovincia
		ORDER BY idespecialidad ASC LIMIT _limit OFFSET _offset;		
		
	ELSEIF _order = 'S' THEN
		SELECT * FROM vs_especialidades_listar
		WHERE nombreservicio LIKE CONCAT( _nombreservicio, '%') AND idprovincia 	 = _idprovincia
		ORDER BY tarifa ASC LIMIT _limit OFFSET _offset;	
		
	ELSEIF _order = 'E' THEN
		SELECT * FROM vs_especialidades_listar
		WHERE nombreservicio LIKE CONCAT( _nombreservicio, '%') AND idprovincia 	 = _idprovincia
		ORDER BY estrellas DESC LIMIT _limit OFFSET _offset;	
	END IF;
END $$

-- FILTRAR POR SERVICIO Y DISTRITO
DELIMITER $$
CREATE PROCEDURE spu_especialidades_filtro_distrito
(
	IN _nombreservicio 	VARCHAR(50), 
	IN _iddistrito 			VARCHAR(6),
	IN _order 					CHAR(1),
	IN _limit 					TINYINT,
	IN _offset					INT
)
BEGIN
	IF _order = 'N' THEN
		SELECT * FROM vs_especialidades_listar
		WHERE nombreservicio LIKE CONCAT( _nombreservicio, '%') AND iddistrito = _iddistrito
		ORDER BY nombres ASC LIMIT _limit OFFSET _offset;	
		
	ELSEIF _order = 'F' THEN
		SELECT * FROM vs_especialidades_listar
		WHERE nombreservicio LIKE CONCAT( _nombreservicio, '%') AND iddistrito = _iddistrito
		ORDER BY idespecialidad ASC LIMIT _limit OFFSET _offset;		
		
	ELSEIF _order = 'S' THEN
		SELECT * FROM vs_especialidades_listar
		WHERE nombreservicio LIKE CONCAT( _nombreservicio, '%') AND iddistrito = _iddistrito
		ORDER BY tarifa ASC LIMIT _limit OFFSET _offset;	
		
	ELSEIF _order = 'E' THEN
		SELECT * FROM vs_especialidades_listar
		WHERE nombreservicio LIKE CONCAT( _nombreservicio, '%') AND iddistrito = _iddistrito
		ORDER BY estrellas DESC LIMIT _limit OFFSET _offset;	
	END IF;
END $$

-- FILTRAR POR SERVICIO, DEPARTAMENTO Y TARIFAS
DELIMITER $$
CREATE PROCEDURE spu_especialidades_filtro_tarifas
(	
	IN _nombreservicio 	VARCHAR(50), 
	IN _tarifa1					DECIMAL(7,2),
	IN _tarifa2					DECIMAL(7,2),
	IN _order 					CHAR(1),
	IN _limit 					TINYINT,
	IN _offset					INT
)
BEGIN	
	IF _order = 'N' THEN
		SELECT * FROM vs_especialidades_listar
		WHERE nombreservicio LIKE CONCAT( _nombreservicio, '%') AND tarifa BETWEEN _tarifa1 AND _tarifa2
		ORDER BY nombres ASC LIMIT _limit OFFSET _offset;	
		
	ELSEIF _order = 'F' THEN
		SELECT * FROM vs_especialidades_listar
		WHERE nombreservicio LIKE CONCAT( _nombreservicio, '%') AND tarifa BETWEEN _tarifa1 AND _tarifa2
		ORDER BY idespecialidad ASC LIMIT _limit OFFSET _offset;		
		
	ELSEIF _order = 'S' THEN
		SELECT * FROM vs_especialidades_listar
		WHERE nombreservicio LIKE CONCAT( _nombreservicio, '%') AND tarifa BETWEEN _tarifa1 AND _tarifa2
		ORDER BY tarifa ASC LIMIT _limit OFFSET _offset;	
		
	ELSEIF _order = 'E' THEN
		SELECT * FROM vs_especialidades_listar
		WHERE nombreservicio LIKE CONCAT( _nombreservicio, '%') AND tarifa BETWEEN _tarifa1 AND _tarifa2
		ORDER BY estrellas DESC LIMIT _limit OFFSET _offset;	
	END IF;
END $$ 


/* PROCEDIMIENTOS : TRABAJOS , COMENTARIOS Y CALIFICACIONES */
-- =============================================================================================================
-- TABLA TRABABJOS
-- -------------------------------------------------------------------------------------------------------------
DELIMITER $$
CREATE PROCEDURE spu_trabajos_listar_usuario
(
	IN _idusuario INT,
	IN _offset 		INT,
	IN _limit 		INT
)
BEGIN
	SELECT * FROM vs_trabajos_listar
		WHERE idusuario = _idusuario
		ORDER BY idtrabajo DESC LIMIT _limit OFFSET _offset;
END $$


-- OBTENER UN REGISTRO
DELIMITER $$
CREATE PROCEDURE spu_trabajos_getdata(IN _idtrabajo INT)
BEGIN
	SELECT * FROM trabajos WHERE idtrabajo = _idtrabajo;
END $$


/* REGISTRAR */
DELIMITER $$
CREATE PROCEDURE spu_trabajos_registrar
(
	IN _idespecialidad	INT ,
	IN _idusuario				INT ,
	IN _titulo					VARCHAR(200),
	IN _descripcion			MEDIUMTEXT
)
BEGIN 
	INSERT INTO trabajos (idespecialidad , idusuario, titulo ,descripcion) VALUES
		(_idespecialidad , _idusuario , _titulo , _descripcion);
		
	SELECT LAST_INSERT_ID() AS 'idtrabajo'; -- ULTIMO ID REGISTRADO
END $$

/* ACTUALIZAR */
DELIMITER $$
CREATE PROCEDURE spu_trabajos_modificar
(	
	IN _idtrabajo				INT ,
	IN _idespecialidad	INT ,
	IN _idusuario				INT ,
	IN _titulo					VARCHAR(200),
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
		ORDER BY idcomentario ASC;
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
		
	SELECT LAST_INSERT_ID() AS 'idcomentario';
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
		WHERE idcomentario = _idcomentario;
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

-- MODIFICAR O ELIMINAR PUNTUACIÓN
DELIMITER $$
CREATE PROCEDURE spu_calificaciones_modificar_eliminar
(
	IN _idcalificacion 	INT,
	IN _puntuacion			TINYINT 
)
BEGIN
	DECLARE _puntaje_anterior TINYINT;
	SET _puntaje_anterior = (SELECT puntuacion FROM calificaciones WHERE idcalificacion = _idcalificacion);
	
	IF _puntaje_anterior = _puntuacion THEN
		CALL spu_calificaciones_modificar(_idcalificacion, 0);
	ELSE
		CALL spu_calificaciones_modificar(_idcalificacion, _puntuacion);
	END IF;
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

-- Registrar actividad
DELIMITER $$
CREATE PROCEDURE spu_registrar_actividades
(
	IN _idespecialidad 	INT,
	IN _fechainicio			DATE,
	IN _fechafin				DATE,
	IN _horainicio			TIME,	
	IN _horafin					TIME,
	IN _titulo					VARCHAR(45),
	IN _descripcion			VARCHAR(150),
	IN _direccion				VARCHAR(80)
)
BEGIN 
	INSERT INTO actividades (idespecialidad, fechainicio, fechafin, horainicio, horafin, titulo, descripcion, direccion) VALUES
		(_idespecialidad, _fechainicio, _fechafin, _horainicio, _horafin, _titulo, _descripcion, _direccion);
END $$


-- Modificar actividad
DELIMITER $$
CREATE PROCEDURE spu_modificar_actividades
(	
	IN _idactividad			INT,
	IN _idespecialidad 	INT,
	IN _fechainicio			DATE,
	IN _fechafin				DATE,
	IN _horainicio			TIME,	
	IN _horafin					TIME,
	IN _titulo					VARCHAR(45),
	IN _descripcion			VARCHAR(150),
	IN _direccion				VARCHAR(80)
)
BEGIN
	UPDATE actividades SET 	
		idespecialidad 	= _idespecialidad, 
		fechainicio			= _fechainicio, 
		fechafin				= _fechafin,
		horainicio			= _horainicio,
		horafin					= _horafin,
		titulo 					= _titulo, 
		descripcion 		= _descripcion, 
		direccion 			= _direccion
	WHERE idactividad = _idactividad;
END $$

DELIMITER $$
CREATE PROCEDURE spu_actividades_getdata(IN _idactividad INT)
BEGIN
	SELECT * FROM vs_listar_actividades  WHERE idactividad = _idactividad;
END $$


-- Eliminar actividad
DELIMITER $$
CREATE PROCEDURE spu_eliminar_actividades(IN _idactividad INT)
BEGIN
	DELETE FROM actividades WHERE idactividad = _idactividad;
END $$


-- =============================================================================================================
-- GENERAR PUNTUACIONES POR TRABAJO Y POR USUARIO
-- -------------------------------------------------------------------------------------------------------------
-- TOTAL DE TRABAJOS POR USUARIO
DELIMITER $$
CREATE PROCEDURE spu_total_trabajos_usuario(IN _idusuario INT)
BEGIN
	SELECT COUNT(*) AS 'trabajos' FROM trabajos WHERE idusuario = _idusuario;
END $$


-- OBTENER EL PUNTAJE DADO POR EL USUARIO (Estrellas)
DELIMITER $$
CREATE PROCEDURE spu_reacciones_trabajo_por_usuario(IN _idtrabajo INT, IN _idusuario INT)
BEGIN
	SELECT idcalificacion, puntuacion FROM calificaciones 
		WHERE idtrabajo = _idtrabajo AND idusuario = _idusuario;
END $$


-- TOTAL DE REACCIONES POR TRABAJO
DELIMITER $$
CREATE PROCEDURE spu_total_reaciones_trabajo(IN _idtrabajo INT)
BEGIN
	SELECT SUM(CLF.puntuacion) AS 'reacciones' 
			FROM calificaciones CLF
			INNER JOIN trabajos TRB ON TRB.idtrabajo = CLF.idtrabajo
			WHERE TRB.idtrabajo = _idtrabajo
			GROUP BY TRB.idtrabajo;
END $$

-- TOTAL DE USUARIOS QUE REACCIONARÓN A UNA PUBLICACIÓN DE TRABAJO
DELIMITER $$
CREATE PROCEDURE  spu_total_usuarios_reaccion_trabajo(IN _idtrabajo INT)
BEGIN
	SELECT idtrabajo, COUNT(DISTINCT(idusuario)) AS 'usuarios'
	FROM calificaciones
	GROUP BY idtrabajo
	HAVING idtrabajo = _idtrabajo;
END $$;

-- CALIFICACION POR TRABAJO
DELIMITER $$
CREATE PROCEDURE spu_estrellas_trabajo(IN _idtrabajo INT)
BEGIN
	DECLARE estrellas DECIMAL(4,2);
	DECLARE total_usuario INT;
	DECLARE total_reacion INT;
	
	SET total_usuario = (SELECT COUNT(*) FROM usuarios);
	SET total_reacion = TOTALREACCIONES(_idtrabajo);
	SET estrellas = DIVIDENUM(total_reacion, total_usuario);
	
	SELECT estrellas;
END $$

-- TOTAL DE ESTRELLAS POR TODOS LOS TRABAJOS DEL USUARIO
DELIMITER $$
CREATE PROCEDURE spu_total_calificacion_trabajos(IN _idusuario INT)
BEGIN
	SELECT SUM(CALIFICACIONTRABAJO(idtrabajo)) AS 'total' 
		FROM trabajos
		WHERE idusuario = _idusuario AND estado = 1;
END $$


-- ESTRELLAS POR USUARIOS
DELIMITER $$
CREATE PROCEDURE spu_estrellas_usuario(IN _idusuario INT)
BEGIN
	SELECT DIVIDENUM(TCALIFICACIONTRABAJO(_idusuario), TOTALTRABAJOS(_idusuario)) AS 'estrellas';
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


DELIMITER $$
CREATE PROCEDURE spu_grafico_reportes_fechas(IN _fechainicio DATE, IN _fechafin DATE)
BEGIN
	SELECT MONTHNAME(fechareporte)AS 'mes', COUNT(idreporte)AS 'reportes'
		FROM reportes
		WHERE fechareporte BETWEEN _fechainicio AND LAST_DAY(_fechafin)
	GROUP BY fechareporte
	ORDER BY fechareporte ASC;
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
CREATE PROCEDURE spu_grafico_niveles_usuario()
BEGIN
	SELECT CASE  
					WHEN nivelusuario = 'E' THEN 'Estandar'
					
					WHEN nivelusuario = 'I' THEN 'Intermedio'
					WHEN nivelusuario = 'A' THEN 'Avanzado' 
				 END 'nivelusuario',	COUNT(idusuario) AS 'total'
		FROM usuarios
	GROUP BY nivelusuario;
END $$


DELIMITER $$
CREATE PROCEDURE spu_grafico_niveles_usuario_fechas(IN _fechainicio DATE, IN _fechafin DATE)
BEGIN
	SELECT CASE  
					WHEN nivelusuario = 'E' THEN 'Estandar'
					
					WHEN nivelusuario = 'I' THEN 'Intermedio'
					WHEN nivelusuario = 'A' THEN 'Avanzado' 
				 END 'nivelusuario',	COUNT(idusuario) AS 'total'
		FROM usuarios
		WHERE fechaalta BETWEEN _fechainicio AND LAST_DAY(_fechafin)
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

-- TOTAL DE USUARIOS - POR CADA SERVICIO
DELIMITER $$
CREATE PROCEDURE spu_total_usuarios_servicio()
BEGIN
		SELECT SRV.nombreservicio, COUNT(ESP.idusuario) AS 'total' 
			FROM servicios SRV
			INNER JOIN especialidades ESP ON ESP.idservicio = SRV.idservicio
			GROUP BY SRV.nombreservicio;
END $$

DELIMITER $$
CREATE PROCEDURE spu_total_usuarios_servicio_fechas(IN _fechainicio DATE, IN _fechafin DATE)
BEGIN
	SELECT SRV.nombreservicio, COUNT(USU.idusuario) AS 'total'
	FROM servicios SRV
	INNER JOIN especialidades ESP ON ESP.idservicio = SRV.idservicio
	INNER JOIN usuarios USU ON USU.idusuario = ESP.idusuario
	WHERE USU.fechaalta BETWEEN _fechainicio AND LAST_DAY(_fechafin)
	GROUP BY SRV.nombreservicio;
END $$
