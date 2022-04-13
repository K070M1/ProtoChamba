CALL spu_provincias_listar('01');
CALL spu_personas_registrar('010101', 'Valentin Capan', 'Josefino', '2000-03-12','51957689057','AV','Luciernagas','','');
CALL spu_usuarios_registrar(40,'','','SantosV@ssa','','12');

CALL spu_albumes_predeterminados(18);
CALL spu_albumes_listar_usuario();
CALL spu_especialidades_listar();