CALL spu_provincias_listar('01');
CALL spu_personas_registrar('010101', 'Valentin Capan', 'Josefino', '2000-03-12','51957689057','AV','Luciernagas','','');
CALL spu_usuarios_registrar(40,'','','SantosV@ssa','','12');

CALL spu_albumes_predeterminados(18);
CALL spu_albumes_listar_usuario();
CALL spu_especialidades_listar();

SELECT VUL.idusuario, VUL.apellidos, VUL.nombres, VUL.rol,
		VUL.fechaalta, ALB.idalbum, ALB.nombrealbum, GLR.idgaleria,
		GLR.tipo, GLR.archivo, GLR.estado
		FROM vs_usuarios_listar VUL
		INNER JOIN albumes ALB ON ALB.`idusuario` = VUL.idusuario
		LEFT JOIN galerias GLR ON GLR.idalbum = GLR.idalbum
		WHERE ALB.nombrealbum = 'perfil' AND GLR.tipo = 'f' AND GLR.estado = '2';	
		
	UPDATE galerias SET estado = '2' WHERE idgaleria = 1;
	
	
	
CALL spu_usuarios_buscar_rol_nombres('A', '');
CALL spu_galerias_foto_perfil(3);

DELIMITER $$
CREATE PROCEDURE spu_usuarios_buscar_rol_nombres
(
	IN _rol 		CHAR(1), 
	IN _search 	VARCHAR(40)
)
BEGIN
	IF _rol IS NULL OR _rol = '' THEN
		CALL spu_usuarios_buscar_nombres(_search);
	ELSE
		SELECT *	FROM vs_usuarios_listar_datos_basicos 
			WHERE rol = _rol AND nombres LIKE CONCAT('%', _search, '%');	
	END IF;
END $$
	
	
	-- =================
	SELECT 	GLR.`idgaleria`, GLR.`archivo`, GLR.`estado`, 
					GLR.`tipo`, ALB.`idalbum`, ALB.`nombrealbum`
		FROM galerias GLR
		INNER JOIN albumes ALB ON ALB.`idalbum` = GLR.`idalbum`
		INNER JOIN usuarios USU ON USU.idusuario = ALB.`idusuario`
		WHERE USU.`idusuario` = 1 AND ALB.`nombrealbum` = 'perfil' AND
					GLR.`estado` = '2'
	
	-- 
		SELECT VUL.idusuario, VUL.apellidos, VUL.nombres, VUL.rol,
		VUL.fechaalta, ALB.idalbum, ALB.nombrealbum,
		GLR.tipo, GLR.archivo, GLR.estado
		FROM vs_usuarios_listar VUL
		WHERE ALB.nombrealbum = 'perfil' AND GLR.tipo = 'f' AND (GLR.estado = '2' OR GLR.estado = '1');	
		
	SELECT * FROM galerias;