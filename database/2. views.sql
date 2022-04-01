USE REACTIVACION;

-- =============================================================================================================
-- TABLA USUARIOS
-- =============================================================================================================
CREATE VIEW vs_usuarios_listar
AS
SELECT 	USU.idusuario, PRS.apellidos, PRS.nombres, 
				CONCAT(
					CASE 
						WHEN PRS.tipocalle LIKE 'CA' THEN 'Calle'
						WHEN PRS.tipocalle LIKE 'AV' THEN 'Avenida'
						WHEN PRS.tipocalle LIKE 'UR' THEN 'Urbanización'
						WHEN PRS.tipocalle LIKE 'PJ' THEN 'Pasaje'
						WHEN PRS.tipocalle LIKE 'JR' THEN 'Jirón'
					END, ' ', PRS.nombrecalle, ' #', PRS.numerocalle, ' ', PRS.pisodepa) AS 'direccion',
				USU.descripcion, USU.horarioatencion,
				USU.rol, USU.email, USU.emailrespaldo,
				USU.clave, EMP.establecimiento, EMP.ruc,
				CONCAT(
					CASE 
						WHEN EMP.tipocalle LIKE 'CA' THEN 'Calle'
						WHEN EMP.tipocalle LIKE 'AV' THEN 'Avenida'
						WHEN EMP.tipocalle LIKE 'UR' THEN 'Urbanización'
						WHEN EMP.tipocalle LIKE 'PJ' THEN 'Pasaje'
						WHEN EMP.tipocalle LIKE 'JR' THEN 'Jirón'
					END, ' ', EMP.nombrecalle, ' #', EMP.numerocalle) AS 'ubicacion', 
				EMP.referencia, EMP.latitud, EMP.longitud
	FROM usuarios USU
	INNER JOIN personas PRS ON PRS.idpersona = USU.idpersona
	LEFT JOIN empresas EMP ON EMP.idempresa = USU.idempresa
	WHERE USU.estado = 1;
	
-- =============================================================================================================
-- TABLA GALERIAS
-- =============================================================================================================
CREATE VIEW vs_galerias_listar
AS
	SELECT 	GLR.idgaleria, ALB.idalbum, ALB.nombrealbum, 
					GLR.idtrabajo, GLR.tipo, GLR.titulo, GLR.archivo,
					GLR.fechaalta
		FROM 	galerias GLR
		INNER JOIN albunes ALB ON ALB.idalbum = GLR.idalbum
		WHERE GLR.estado = 1;


