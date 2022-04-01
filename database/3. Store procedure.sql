USE REACTIVACION;

-- =============================================================================================================
-- TABLA USUARIOS
-- =============================================================================================================
DELIMITER $$
CREATE PROCEDURE spu_usuarios_listar()
BEGIN
	SELECT * FROM vs_usuarios_listar
		ORDER BY idusuario DESC;
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuario_registrar
(
	IN _idpersona 			INT,
	IN _idempresa 			INT,
	IN _descripcion 		MEDIUMTEXT,
	IN _horarioatencion VARCHAR(70),
	IN _nivelusuario 		CHAR(1),
	IN _rol 						CHAR(1),
	IN _email 					VARCHAR(70),
	IN _emailrespaldo		VARCHAR(70),
	IN _clave	 					VARCHAR(100)
)
BEGIN
	IF _idempresa = '' OR _idempresa < 1 THEN SET _idempresa = NULL; END IF;
	IF _descripcion = '' THEN SET _descripcion = NULL; END IF;
	IF _emailrespaldo = '' THEN SET _emailrespaldo = NULL; END IF;

	INSERT INTO usuarios (idpersona, idempresa, descripcion, horarioatencion, nivelusuario, rol, email, emailrespaldo, clave) VALUES 
		(_idpersona, _idempresa, _descripcion, _horarioatencion, _nivelusuario, _rol, _email, _emailrespaldo, _clave);
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuario_fila(IN _idusuario INT)
BEGIN
	SELECT * FROM vs_usuarios_listar
		WHERE idusuario = _idusuario;
END $$

DELIMITER $$
CREATE PROCEDURE spu_usuarios_modificar
(
	IN _idusuario 			INT,
	IN _idpersona 			INT,
	IN _idempresa 			INT,
	IN _descripcion 		MEDIUMTEXT,
	IN _horarioatencion VARCHAR(70),
	IN _nivelusuario 		CHAR(1),
	IN _rol 						CHAR(1),
	IN _email 					VARCHAR(70),
	IN _emailrespaldo		VARCHAR(70),
	IN _clave	 					VARCHAR(100)
)
BEGIN
	UPDATE usuarios SET 
		idpersona 			= _idpersona,
		idempresa 			= _idempresa,
		descripcion 		= _descripcion,
		horarioatencion = _horarioatencion,
		nivelusuario 		= _nivelusuario,
		rol 						= _rol,
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
	SELECT * FROM vs_usuarios_listar
		WHERE email = _email;
END $$

-- POR TERMINAR - filtrados
DELIMITER $$
CREATE PROCEDURE spu_usuarios_filtrar()
BEGIN
	SELECT * FROM vs_usuarios_listar;
END $$


-- =============================================================================================================
-- TABLA ALBUNES
-- =============================================================================================================
DELIMITER $$
CREATE PROCEDURE spu_albunes_listar()
BEGIN
	SELECT * FROM albunes;
END $$

DELIMITER $$
CREATE PROCEDURE spu_albunes_fila(IN _idalbum INT)
BEGIN
	SELECT * FROM albunes WHERE idalbum = _idalbum;
END $$


DELIMITER $$
CREATE PROCEDURE spu_albunes_registrar
(
	IN _idusuario 	INT,
	IN _nombrealbum VARCHAR(30)
)
BEGIN
	INSERT INTO albunes (idusuario, nombrealbum) VALUES
		(_idusuario, _nombrealbum);
END $$

DELIMITER $$
CREATE PROCEDURE spu_albunes_modificar
(
	IN _idalbum			INT,
	IN _idusuario 	INT,
	IN _nombrealbum VARCHAR(30)
)
BEGIN
	UPDATE albunes SET 
		idusuario	 	= _idusuario,
		nombrealbum = _nombrealbum
	WHERE idalbum = _idalbum;
END $$

DELIMITER $$
CREATE PROCEDURE spu_albunes_eliminar(IN _idalbum INT)
BEGIN
	UPDATE albunes SET 
		estado = 0
	WHERE idalbum = _idalbum;
END $$


-- =============================================================================================================
-- TABLA GALERIA
-- =============================================================================================================
DELIMITER $$
CREATE PROCEDURE spu_galerias_listar()
BEGIN
	SELECT * FROM vs_galerias_listar;
END $$

DELIMITER $$
CREATE PROCEDURE spu_galerias_fila(IN _idgaleria INT)
BEGIN
	SELECT * FROM vs_galerias_listar WHERE idgaleria = _idgaleria;
END $$


DELIMITER $$
CREATE PROCEDURE spu_galerias_registrar
(
	IN _idalbum 	INT,
	IN _idtrabajo INT,
	IN _tipo 			CHAR(1),
	IN _titulo 		VARCHAR(45),
	IN _archivo 	VARCHAR(100)
)
BEGIN
	IF _idtrabajo = '' THEN SET _idtrabajo = NULL; END IF;
	
	INSERT INTO galerias (idalbum, idtrabajo, tipo, titulo, archivo) VALUES
		(_idalbum, _idtrabajo, _tipo, _titulo, _archivo);
END $$

DELIMITER $$
CREATE PROCEDURE spu_galerias_modificar
(
	IN _idgaleria INT,
	IN _idalbum 	INT,
	IN _titulo 		VARCHAR(45)
)
BEGIN
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


DELIMITER $$
CREATE PROCEDURE spu_galerias_filtrar(IN _idalbum INT)
BEGIN
	SELECT * FROM vs_galerias_listar WHERE idalbum = _idalbum;
END $$



