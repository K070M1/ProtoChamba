USER REACTIVACION;

-- ELIMINAR IAMGENES VINCULADOS A UNA PUBLICACIÓN
DELIMITER $$
CREATE TRIGGER tg_delete_imgs_trabajo
AFTER UPDATE ON trabajos
FOR EACH ROW
BEGIN
	UPDATE galerias SET estado = '0' 
		WHERE idtrabajo = new.idtrabajo AND new.estado = 0;
END $$ 

-- ACTUALIZAR NIVEL DE USUARIO - AL INSERTAR CALIFICACIÓN
DELIMITER $$
CREATE TRIGGER tg_level_user_inserted
AFTER INSERT ON calificaciones
FOR EACH ROW
BEGIN
	DECLARE _idusuario INT;
	DECLARE _puntos DECIMAL(5,2);
	
	SET _idusuario =	(SELECT idusuario FROM trabajos WHERE idtrabajo = new.idtrabajo);
	SET _puntos = TCALIFICACIONUSUARIO(_idusuario);
	
	IF _puntos <= 2 THEN
		UPDATE usuarios SET nivelusuario = 'E' WHERE idusuario = _idusuario;
	ELSEIF _puntos > 2 AND _puntos <= 4 THEN
		UPDATE usuarios SET nivelusuario = 'I' WHERE idusuario = _idusuario;
	ELSEIF _puntos = 5 THEN
		UPDATE usuarios SET nivelusuario = 'A' WHERE idusuario = _idusuario;
	END IF;
END $$

-- ACTUALIZAR NIVEL DE USUARIO - AL ACTUALIZAR CALIFICACIÓN
DELIMITER $$
CREATE TRIGGER tg_level_user_update
AFTER UPDATE ON calificaciones
FOR EACH ROW
BEGIN
	DECLARE _idusuario INT;
	DECLARE _puntos DECIMAL(5,2);
	
	SET _idusuario =	(SELECT idusuario FROM trabajos WHERE idtrabajo = new.idtrabajo);
	SET _puntos = TCALIFICACIONUSUARIO(_idusuario);
	
	IF _puntos <= 2 THEN
		UPDATE usuarios SET nivelusuario = 'E' WHERE idusuario = _idusuario;
	ELSEIF _puntos > 2 AND _puntos <= 4 THEN
		UPDATE usuarios SET nivelusuario = 'I' WHERE idusuario = _idusuario;
	ELSEIF _puntos = 5 THEN
		UPDATE usuarios SET nivelusuario = 'A' WHERE idusuario = _idusuario;
	END IF;
END $$
