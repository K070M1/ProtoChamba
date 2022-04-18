USE REACTIVACION;

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
CREATE FUNCTION GETMONTHNAME(fecha DATE)
RETURNS VARCHAR(20) CHARSET utf8
BEGIN
	RETURN 
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
    END;
END $$