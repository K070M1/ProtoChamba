USE REACTIVACION;

-- =============================================================================================================
-- VISTA DE PERSONAS Y DISTRITOS
-- -------------------------------------------------------------------------------------------------------------
CREATE VIEW vs_personas_listar AS
	SELECT 	PRS.idpersona, PRS.apellidos, PRS.nombres, PRS.fechanac,	
					PRS.telefono, DST.iddistrito, DST.distrito, PRV.idprovincia, 
					PRV.provincia, DPT.iddepartamento, DPT.departamento,
					CONCAT(
						CASE 
							WHEN PRS.tipocalle LIKE 'CA' THEN 'Calle'
							WHEN PRS.tipocalle LIKE 'AV' THEN 'Avenida'
							WHEN PRS.tipocalle LIKE 'UR' THEN 'Urbanización'
							WHEN PRS.tipocalle LIKE 'PJ' THEN 'Pasaje'
							WHEN PRS.tipocalle LIKE 'JR' THEN 'Jirón'
							WHEN PRS.tipocalle LIKE 'LT' THEN 'Lote'
						END, ' ', PRS.nombrecalle, ' #',
						CASE
							WHEN PRS.numerocalle IS NULL THEN 'S/N'
							WHEN PRS.numerocalle IS NOT NULL THEN PRS.numerocalle
						END, ' ',
						CASE
							WHEN PRS.pisodepa IS NULL THEN 'S/N'
							WHEN PRS.pisodepa IS NOT NULL THEN PRS.pisodepa
						END) AS 'direccion'								
		FROM personas PRS
		INNER JOIN distritos DST ON DST.iddistrito = PRS.iddistrito
		INNER JOIN provincias PRV ON PRV.idprovincia = DST.idprovincia
		INNER JOIN departamentos DPT ON DPT.iddepartamento = PRV.iddepartamento;

-- =============================================================================================================
-- VISTA DE USUARIOS
-- -------------------------------------------------------------------------------------------------------------
CREATE VIEW vs_usuarios_listar AS
	SELECT 	USU.idusuario, VPL.idpersona, VPL.apellidos, VPL.nombres, VPL.fechanac,
					USU.fechaalta, VPL.iddepartamento, VPL.departamento, VPL.idprovincia, 
					VPL.provincia, VPL.iddistrito, VPL.distrito, VPL.direccion, USU.descripcion, 
					USU.horarioatencion, VPL.telefono, USU.rol, USU.email, USU.emailrespaldo,
					USU.clave, USU.nivelusuario, USU.estado
		FROM usuarios USU
		INNER JOIN vs_personas_listar VPL ON VPL.idpersona = USU.idpersona
		WHERE USU.estado = '1' OR USU.estado = '2';


-- =============================================================================================================
-- VISTA DE USUARIOS - DATOS RESUMIDOS
-- -------------------------------------------------------------------------------------------------------------
CREATE VIEW vs_usuarios_listar_datos_basicos AS
	SELECT 	USU.idusuario, VPL.idpersona, CONCAT(VPL.nombres, ' ', VPL.apellidos) AS 'nombres',
					USU.email, USU.rol, VPL.fechanac, USU.fechaalta, USU.estado
		FROM usuarios USU
		INNER JOIN vs_personas_listar VPL ON VPL.idpersona = USU.idpersona
		WHERE USU.estado = 1 OR USU.estado = 2
		ORDER BY USU.rol ASC;		
		
-- =============================================================================================================
-- VISTA DE ESTABLECIMIENTOS
-- -------------------------------------------------------------------------------------------------------------
CREATE VIEW vs_establecimientos AS 
		SELECT EST.idestablecimiento, EST.establecimiento, EST.ruc, 
					CONCAT(
						CASE 
							WHEN EST.tipocalle LIKE 'CA' THEN 'Calle'
							WHEN EST.tipocalle LIKE 'AV' THEN 'Avenida'
							WHEN EST.tipocalle LIKE 'UR' THEN 'Urbanización'
							WHEN EST.tipocalle LIKE 'PJ' THEN 'Pasaje'
							WHEN EST.tipocalle LIKE 'JR' THEN 'Jirón'
						END, ' ', EST.nombrecalle, ' #', EST.numerocalle) AS 'ubicacion', 
					EST.referencia, EST.latitud, EST.longitud,
					DST.iddistrito, DST.distrito, PRV.idprovincia, PRV.provincia,
					DPT.iddepartamento, DPT.departamento, USU.idusuario, USU.horarioatencion
		FROM establecimientos EST
		INNER JOIN usuarios USU ON USU.idusuario = EST.idusuario
		INNER JOIN distritos DST ON DST.iddistrito = EST.iddistrito
		INNER JOIN provincias PRV ON PRV.idprovincia = DST.idprovincia
		INNER JOIN departamentos DPT ON DPT.iddepartamento = PRV.iddepartamento
		WHERE EST.estado = 1;
	
	
-- =============================================================================================================
-- VISTA DE ESPECIALIDAD Y SERVICIOS
-- -------------------------------------------------------------------------------------------------------------
CREATE VIEW vs_especialidades_listar AS
	SELECT DISTINCT	ESP.`idespecialidad`, ESP.descripcion AS 'especialidad', USU.idusuario, CONCAT(USU.`nombres` , ' ' , USU.apellidos) AS 'nombres' , 
					USU.email, USU.telefono, SRV.idservicio,	SRV.`nombreservicio`, USU.horarioatencion, ESP.tarifa,
					 USU.descripcion AS 'biografia', USU.iddepartamento, USU.departamento, USU.idprovincia, USU.provincia, USU.iddistrito, USU.distrito,
					 DIVIDENUM(TCALIFICACIONTRABAJO(USU.idusuario), TOTALTRABAJOS(USU.idusuario)) AS 'estrellas'
	FROM especialidades ESP
	INNER JOIN servicios SRV ON SRV.idservicio = ESP.idservicio
	INNER JOIN vs_usuarios_listar USU ON USU.idusuario = ESP.idusuario
	WHERE ESP.estado = 1
	GROUP BY USU.idusuario, SRV.idservicio
	ORDER BY ESP.descripcion;
	
-- =============================================================================================================
-- VISTA DE GALERIAS Y ALBUNES
-- -------------------------------------------------------------------------------------------------------------
CREATE VIEW vs_galerias_listar AS
	SELECT 	GLR.idgaleria, ALB.idalbum, ALB.nombrealbum, 
					VUL.idusuario, VUL.apellidos, VUL.nombres,
					TBJ.idtrabajo, TBJ.titulo, GLR.tipo, GLR.archivo,
					GLR.fechaalta
		FROM 	galerias GLR
		LEFT JOIN albumes ALB ON ALB.idalbum = GLR.idalbum
		INNER JOIN vs_usuarios_listar VUL ON VUL.idusuario = GLR.idusuario
		LEFT JOIN trabajos TBJ ON TBJ.idtrabajo = GLR.idtrabajo
		WHERE GLR.estado <> 0;


-- =============================================================================================================
-- VISTA DE TRABAJOS Y USUARIO
-- -------------------------------------------------------------------------------------------------------------
CREATE VIEW vs_trabajos_listar AS 
	SELECT 	TBJ.idtrabajo, USU.idusuario, PERS.idpersona, PERS.apellidos, 
					PERS.nombres, TBJ.titulo, TBJ.descripcion, TBJ.fechapublicado,
					GETDATENAMEHM(TBJ.fechapublicado) AS 'fechalarga', TBJ.fechamodificado
		FROM trabajos TBJ
		INNER JOIN usuarios USU ON USU.idusuario = TBJ.idusuario
		INNER JOIN personas PERS ON PERS.idpersona = USU.idpersona
		WHERE TBJ.estado = 1;

-- =============================================================================================================
-- TABLA COMENTARIOS
-- ===========================================================================================================
CREATE VIEW vs_comentarios_listar AS 
	SELECT COM.idcomentario, TRAB.idtrabajo,
				TRAB.titulo AS 'titulotrabajo', USU.idusuario, PERS.apellidos, 
				PERS.nombres, COM.comentario, COM.fechacomentado,
				GETDATENAMEHM(COM.fechacomentado) AS 'fechalarga',COM.fechamodificado
		FROM comentarios COM
		INNER JOIN trabajos TRAB ON TRAB.idtrabajo = COM.idtrabajo
		INNER JOIN usuarios USU ON USU.idusuario = COM.idusuario
		LEFT JOIN personas PERS ON PERS.idpersona = USU.idpersona
		WHERE TRAB.estado = 1 AND COM.estado = 1;
		
-- =============================================================================================================
-- VISTA PARA LISTAR REPORTES
-- -------------------------------------------------------------------------------------------------------------
CREATE VIEW vs_listar_reportes AS 
	SELECT REP.idreporte, COM.idcomentario, USU.idusuario, CONCAT(' ', PRS.nombres, ' ', PRS.apellidos) AS usuario, 
				 REP.motivo, REP.descripcion, REP.fechareporte, REP.fotografia
		FROM comentarios COM
		INNER JOIN reportes REP ON REP.idcomentario = COM.idcomentario
		INNER JOIN usuarios USU ON USU.idusuario = COM.idusuario
		INNER JOIN personas PRS ON PRS.idpersona = USU.idusuario;

-- =============================================================================================================
-- VISTA PARA LISTAR ACTIVIDADES
-- -------------------------------------------------------------------------------------------------------------
CREATE VIEW vs_listar_actividades AS 
	SELECT ACT.idactividad, ESP.idusuario, SER.idservicio, 
				 SER.nombreservicio, ESP.idespecialidad, ESP.descripcion AS 'especialidad', 
				 ACT.fechainicio, ACT.horainicio, ACT.fechafin, ACT.horafin, ACT.titulo, ACT.descripcion, ACT.direccion 
		FROM especialidades ESP
		INNER JOIN actividades ACT ON ESP.idespecialidad = ACT.idespecialidad
		INNER JOIN servicios SER ON SER.idservicio = ESP.idservicio;
		
-- =============================================================================================================
-- VISTA PARA LISTAR CONSULTAS DEL FORO
-- -------------------------------------------------------------------------------------------------------------
CREATE VIEW vs_listar_foros AS 
	SELECT 	FRS.idforo, FRS.idtousuario, FRS.idfromusuario, VUS.nombres,  
					FRS.consulta, FRS.fechaconsulta, FRS.fechaeliminado
		FROM foros FRS
		INNER JOIN vs_usuarios_listar_datos_basicos VUS ON VUS.idusuario = FRS.idfromusuario
		WHERE FRS.estado = 1
		ORDER BY FRS.idforo ASC;
	
