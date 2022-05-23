USE REACTIVACION;

-- OBTER EL NOMBRE DEL DÍA Y MES DEL AÑO
DELIMITER $$
CREATE FUNCTION GETDATENAME(fecha DATE)
RETURNS VARCHAR(35) CHARSET utf8
BEGIN
	RETURN CONCAT (
    CASE DAYOFWEEK(fecha)
		 WHEN 1 THEN 'Domingo'
		 WHEN 2 THEN 'Lunes'
		 WHEN 3 THEN 'Martes'
		 WHEN 4 THEN 'Miércoles'
		 WHEN 5 THEN 'Jueves'
		 WHEN 6 THEN 'Viernes'
		 WHEN 7 THEN 'Sábado'
    END
    ,', ', DATE_FORMAT(fecha, '%d'), ' de ',
    CASE MONTH(fecha)
		 WHEN 1 THEN 'Enero'
		 WHEN 2 THEN 'Febrero'
		 WHEN 3 THEN 'Marzo'
		 WHEN 4 THEN 'Abril'
		 WHEN 5 THEN 'Mayo'
		 WHEN 6 THEN 'Junio'
		 WHEN 7 THEN 'Julio'
		 WHEN 8 THEN 'Agosto'
		 WHEN 9 THEN 'Septiembre'
		 WHEN 10 THEN 'Octubre'
		 WHEN 11 THEN 'Noviembre'
		 WHEN 12 THEN 'Diciembre'
    END, ' de ', DATE_FORMAT(fecha, '%Y'));
END $$


DELIMITER $$
CREATE FUNCTION GETDATENAMEHM(fecha DATE)
RETURNS VARCHAR(45) CHARSET utf8
BEGIN
	RETURN CONCAT (
    CASE DAYOFWEEK(fecha)
		 WHEN 1 THEN 'Domingo'
		 WHEN 2 THEN 'Lunes'
		 WHEN 3 THEN 'Martes'
		 WHEN 4 THEN 'Miércoles'
		 WHEN 5 THEN 'Jueves'
		 WHEN 6 THEN 'Viernes'
		 WHEN 7 THEN 'Sábado'
    END
    ,', ', DATE_FORMAT(fecha, '%d'), ' de ',
    CASE MONTH(fecha)
		 WHEN 1 THEN 'Enero'
		 WHEN 2 THEN 'Febrero'
		 WHEN 3 THEN 'Marzo'
		 WHEN 4 THEN 'Abril'
		 WHEN 5 THEN 'Mayo'
		 WHEN 6 THEN 'Junio'
		 WHEN 7 THEN 'Julio'
		 WHEN 8 THEN 'Agosto'
		 WHEN 9 THEN 'Septiembre'
		 WHEN 10 THEN 'Octubre'
		 WHEN 11 THEN 'Noviembre'
		 WHEN 12 THEN 'Diciembre'
    END, ' de ', DATE_FORMAT(fecha, '%Y %h:%m:%S %p'));
END $$

-- DIVIDIR 2 NUMEROS
DELIMITER $$
CREATE FUNCTION DIVIDENUM
(
	_num1 DECIMAL(7,2), 
	_num2 DECIMAL(7,2)
)
RETURNS DECIMAL(7,2)
BEGIN
	DECLARE _salida DECIMAL(7,2);
	
	SET _salida = _num1 / _num2;
	SET _salida = ROUND(_salida, 2); -- Redondear a 2 decimales
	
	IF _salida IS NULL THEN SET _salida = 0; END IF;
	
	RETURN _salida;
END $$


-- TOTAL DE TRABAJOS POR USUARIO
DELIMITER $$
CREATE FUNCTION TOTALTRABAJOS(_idusuario INT)
RETURNS INT
BEGIN
	DECLARE _salida INT;
	
	SET _salida =	(SELECT COUNT(*)  
		FROM trabajos 
		WHERE idusuario = _idusuario AND estado = 1);
	
	RETURN _salida;
END $$


-- OBTENER EL TOTAL DE REACCIONES POR TRABAJO
DELIMITER $$
CREATE FUNCTION TOTALREACCIONES(_idtrabajo INT)
RETURNS INT
BEGIN
	DECLARE _total INT;
	SET _total =	(SELECT SUM(CLF.puntuacion) AS 'puntos' 
			FROM calificaciones CLF
			INNER JOIN trabajos TRB ON TRB.idtrabajo = CLF.idtrabajo
			WHERE TRB.idtrabajo = _idtrabajo
			GROUP BY TRB.idtrabajo);
		
	RETURN _total;
END $$


-- CALIFICACION POR TRABAJO (1 - 5)
DELIMITER $$
CREATE FUNCTION CALIFICACIONTRABAJO(_idtrabajo INT)
RETURNS DECIMAL(4,2)
BEGIN
	DECLARE _calificacion DECIMAL(4,2);
	DECLARE _total_usuario INT;
	DECLARE _total_reacion INT;
	
	SET _total_usuario = (SELECT COUNT(*) FROM usuarios);
	SET _total_reacion = TOTALREACCIONES(_idtrabajo);	
	SET _calificacion = DIVIDENUM(_total_reacion, _total_usuario);
	
	RETURN _calificacion;
END $$

-- SUMA DE TODAS LAS CALIFICACIONES DE LOS TRABAJOS QUE PERTENECEN A UN USUARIO
DELIMITER $$
CREATE FUNCTION TCALIFICACIONTRABAJO(_idusuario INT)
RETURNS DECIMAL(4,2)
BEGIN
	DECLARE _total DECIMAL(4,2);	
	SET _total =	(SELECT SUM(CALIFICACIONTRABAJO(idtrabajo)) FROM trabajos WHERE idusuario = _idusuario);
				
	RETURN _total;
END $$

-- ESTRELLAS DEL USUARIO
DELIMITER $$
CREATE FUNCTION TCALIFICACIONUSUARIO(_idusuario INT)
RETURNS DECIMAL(4,2)
BEGIN
	RETURN DIVIDENUM(TCALIFICACIONTRABAJO(_idusuario), TOTALTRABAJOS(_idusuario));
END $$