USE REACTIVACION;

-- =============================================================================================================
-- TABLA USUARIOS
-- =============================================================================================================
CREATE VIEW vs_usuarios_listar
AS
SELECT 	USU.idusuario, PRS.apellidos, 
		PRS.nombres, CONCAT(PRS.tipocalle, ' ',PRS.nombrecalle, ' #', PRS.numerocalle, ' ', PRS.pisodepa) AS 'direccion',
		USU.descripcion, 
		USU.horarioatencion, USU.nivelusuario, 
		USU.rol, USU.email, USU.emailrespaldo,
		USU.clave, EMP.establecimiento, 
		EMP.ruc, EMP.ubicacion, EMP.referencia,
		EMP.latitud, EMP.longitud
	FROM usuarios USU
	INNER JOIN personas PRS ON PRS.idpersona = USU.idpersona
	LEFT JOIN empresas EMP ON EMP.idempresa = USU.idempresa
	WHERE USU.estado = 1;

-- =============================================================================================================
-- TABLA GALERIAS
-- =============================================================================================================
CREATE VIEW vs_galerias_listar
AS
	SELECT GLR.idgaleria, ALB.nombrealbum, 
				 GLR.idtrabajo,
				 GLR.tipo, GLR.titulo, GLR.archivo,
				 GLR.fechaalta
		FROM galerias GLR
		INNER JOIN albunes ALB ON ALB.idalbum = GLR.idalbum
		WHERE GLR.estado = 1;



SELECT * FROM galerias;
SELECT * FROM vs_galerias_listar;

