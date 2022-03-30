
USE REACTIVACION;

-- =============================================================================================================
-- TABLA PERSONAS
-- =============================================================================================================
INSERT INTO personas (apellidos, nombres, fechanac, telefono, tipocalle, nombrecalle, numerocalle, pisodepa) VALUES 
	('Magallanes Perez', 'Luis Enrique', '1998-05-25', '05695674856', 'AV', 'Las palmeras', '25', '5'),
	('Hernandez Monterroza', 'Adriana Carolina', '1999-05-14', '05695674858', 'CA', 'Los Sauces', '150', '3'),
	('Carvajal Vargas', 'Alexander', '1999-05-14', '05695674558', 'JR', 'Las Lomas', '5', '2'),
	('Blanca Concha', 'Angelica Maria', '1999-05-14', '05695604858', 'PJ', 'Cartajena', '250', '3'),
	('Ospina Alfonso', 'Catherine', '1999-05-14', '05695674858', 'AV', 'Prada N°258', '255', '2');

SELECT * FROM personas;

-- =============================================================================================================
-- TABLA EMPRESAS
-- =============================================================================================================
INSERT INTO empresas (establecimiento, ruc, ubicacion, referencia, latitud, longitud) VALUES
	('Mecanina pilon motors', '12452585696', 'Calle molina N°25', 'Pasando la segunda cuadra', -12.0671008, -77.032355),
	('Electricista ZORNOMAZ', '12452585626', 'Urb. Leon de Vivero MZ:13 LT:16 Pueblo Nuevo, 11701', 'Antes de ', -12.0671008, -77.032355),
	('ABOGADOS CHINCHA', '12452582696', 'C. Lima, Chincha Alta 11702', '', -12.0672008, -77.038355),
	('Soldadura ferrrer', '12452565696', 'Chincha baja Litardoo, baja', '', -12.0856008, -77.032355),
	('NADIRA Centro Masoterapista', '12452580696', '15725 ROMA Municipalidad Metropolitana de Lima LIMA, 01', '', -12.0956008, -77.032355);
	
SELECT * FROM empresas;

-- =============================================================================================================
-- TABLA USUARIOS
-- =============================================================================================================
INSERT INTO usuarios (idpersona, idempresa, descripcion, horarioatencion, email, clave) VALUES 
	(1, NULL, 'descripción', 'Atención de Lunes a Sabado de 08:00 AM a 09:00 PM', 'Luis@gmail.com', '12345'),
	(2, NULL, 'descipción', 'Atención de Lunes a Sabado de 08:00 AM a 09:00 PM', 'Adriana@gmail.com', '12345'),
	(3, 1, 'Uno de sus profesores en la Universidad de Pensilvania era director ejecutivo de una empresa en Los Gatos, Silicon Valley, dedicada a investigar ultracondensadores electrolíticos destinados a vehículos eléctricos. Elon Musk trabajó un verano en la empresa Pinnacle Research. Esos ultracondensadores tenían una densidad energética muy alta, pero sus componentes químicos eran carísimos y se vendían por miligramos porque había muy pocas minas que los extrajeran. No eran escalables para su producción en masa.11',
			'Atención de Lunes a Viernes de 08:00 AM a 09:00 PM, Sabados y domingos de 07:00 AM a 12:00 PM', 'Alenxander@gmail.com', '12345');
			
SELECT * FROM usuarios;

-- =============================================================================================================
-- TABLA REDES SOCIALES
-- =============================================================================================================
INSERT INTO redessociales (idusuario, redsocial, vinculo) VALUES
	(1, 'I', 'https://www.instagram.com/?hl=es-la/usuario/luis%enrique'),
	(1, 'F', 'https://web.facebook.com/?_rdc=1&_rdr/usuario/login');
	
SELECT * FROM redessociales;

-- =============================================================================================================
-- TABLA SEGUIDORES
-- =============================================================================================================
INSERT INTO seguidores (idfollowing, idfollower) VALUES
	(1, 2),
	(1, 3);
	
SELECT * FROM seguidores;

-- =============================================================================================================
-- TABLA SERVICIOS
-- =============================================================================================================
INSERT INTO servicios (nombreservicio) VALUES
	('Electricista'),
	('Soldador'),
	('Carpintero'),
	('Diseñador'),
	('Programador');
	
SELECT * FROM servicios;

-- =============================================================================================================
-- TABLA ESPECIALIDADES
-- =============================================================================================================
INSERT INTO especialidades (idusuario, idservicio, descripcion) VALUES
	(1,1, 'Cálculo de secciones de líneas eléctricas'),
	(1,1, 'Electrotecnia'),
	(1,1, 'Riesgo eléctrico'),
	(1,1, 'Tensión eléctrica');
	
SELECT * FROM especialidades;

-- =============================================================================================================
-- TABLA ACTIVIDADES
-- =============================================================================================================
INSERT INTO actividades (idespecialidad, fecha, hora, titulo, descripcion, direccion) VALUES 
	(1, '2022-03-25', '08:45', 'Trabajo 1', 'Descripción opcional', 'Calle Ica N°58'),
	(1, '2022-03-27', '08:45', 'Trabajo 2', 'Descripción opcional', 'Calle Ica N°58');
	
SELECT * FROM actividades;

-- =============================================================================================================
-- TABLA TRABAJOS REALIZADOS
-- =============================================================================================================
INSERT INTO trabajos (idespecialidad, idusuario, titulo, descripcion) VALUES 
	(1, 1, 'Servicio de electricista', 'Trabajo realizado en etc..'),
	(2, 1, 'Electrista de cableado', 'Trabajo realizado en ..');

SELECT * FROM trabajos;

-- =============================================================================================================
-- TABLA ÁLBUM
-- =============================================================================================================
INSERT INTO albunes (idusuario, nombrealbum) VALUES 
	(1, 'Perfil'),
	(1, 'Portada'),
	(1, 'Publicaciones');

SELECT * FROM albunes;

-- =============================================================================================================
-- TABLA GALERIAS
-- =============================================================================================================
INSERT INTO galerias (idalbum, idtrabajo, tipo, titulo, archivo) VALUES
	(1, NULL,'F', 'Foto de electricista','012555454545448599'),
	(3, 1,'V', 'Video de electricista','012555454545447852');
	
SELECT * FROM galerias;

-- =============================================================================================================
-- TABLA CALIFICACIONES
-- =============================================================================================================
INSERT INTO calificaciones (idtrabajo, idusuario, puntuacion) VALUES
	(1, 1, 1),
	(1, 2, 1);
	
SELECT * FROM calificaciones;

-- =============================================================================================================
-- TABLA COMENTARIOS
-- =============================================================================================================
INSERT INTO comentarios (idtrabajo, idusuario, comentario) VALUES 
	(1,1, 'Muy buen trabajo'),
	(1,2, 'Pesimo trabajo');
	
SELECT * FROM comentarios;

-- =============================================================================================================
-- TABLA REPORTES
-- =============================================================================================================
INSERT INTO reportes (idcomentario, motivo, descripcion, fotografia) VALUES
	(2, 'Mesaje indebido', 'Mala calificación del trabajo', '011555555959258');

SELECT * FROM reportes;