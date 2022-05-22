<?php

require_once '../core/model.master.php';

class Specialty extends ModelMaster
{

  //Listar los usuarios con especialidades para generar el card
  public function getSpecialty()
  {
    try {
      return parent::getRows("spu_especialidades_listar");
    } catch (Exception $error) {
      die($error->getMessage());
    }
  }

  // Listar especialidades aleatorios
  public function getRandomSpecials(array $data)
  {
    try {
      return parent::execProcedure($data, "spu_especialidades_listar_aleatorio", true);
    } catch (Exception $error) {
      die($error->getMessage());
    }
  }

  // Listar especialidades aleatorios de los más populares
  public function getPopularRandomSpecials(array $data)
  {
    try {
      return parent::execProcedure($data, "spu_especialidades_listar_populares", true);
    } catch (Exception $error) {
      die($error->getMessage());
    }
  }

  // Listar por servicio y  usuario
  public function getSpecialtyByServiceAndUser(array $data)
  {
    try {
      return parent::execProcedure($data, "spu_especialidades_listar_servicio_usuario", true);
    } catch (Exception $error) {
      die($error->getMessage());
    }
  }

  // Listar por servicio de forma aleatorio
  public function getRandomSpecialtyForService(array $data)
  {
    try {
      return parent::execProcedure($data, "spu_especialidades_listar_aleatorio_servicio", true);
    } catch (Exception $error) {
      die($error->getMessage());
    }
  }

  // Listar por id de usuario
  public function getSpecialtyByUser(array $data)
  {
    try {
      return parent::execProcedure($data, "spu_especialidades_listar_usuario", true);
    } catch (Exception $error) {
      die($error->getMessage());
    }
  }

  // Registrar Especialidad por Usuario
  public function registerSpecialtyUser(array $data)
  {
    try {
      parent::execProcedure($data, "spu_especialidades_registrar", false);
    } catch (Exception $error) {
      die($error->getMessage());
    }
  }

  // Obtener un registro
  public function getAtSpecialty(array $data)
  {
    try {
      return parent::execProcedure($data, "spu_especialidades_getdata", true);
    } catch (Exception $error) {
      die($error->getMessage());
    }
  }

  // Actualizar especialidad de un usuario
  public function updateSpecialty(array $data)
  {
    try {
      parent::execProcedure($data, "spu_especialidades_modificar", false);
    } catch (Exception $error) {
      die($error->getMessage());
    }
  }

  // Eliminar Especialidad
  public function deleteSpecialty(array $data){
    try {
      parent::deleteRegister($data, "spu_especialidades_eliminar");
    } catch (Exception $error) {
      die($error->getMessage());
    }
  }

  // total de especialidades disponibles
  public function totalSpecialtiesAvailable(){
    try {
      return parent::getRows("spu_especialidades_total_disponible");
    } catch (Exception $error) {
      die($error->getMessage());
    }
  }

  // Filtrar por servicio
  public function specialtiesFilteredByService(array $data){
    try {
      return parent::execProcedure($data, "spu_especialidades_filtrar_servicio", true);
    } catch (Exception $error) {
      die($error->getMessage());
    }
  }

  // Filtrar por servicio y departamento
  public function specialtiesFilteredByServiceAndDepartment(array $data){
    try {
      return parent::execProcedure($data, "spu_especialidades_filtrar_servicio_dept", true);
    } catch (Exception $error) {
      die($error->getMessage());
    }
  }

  // Filtrar por servicio y provincia
  public function specialtiesFilteredByServiceAndProvince(array $data){
    try {
      return parent::execProcedure($data, "spu_especialidades_filtro_provincia", true);
    } catch (Exception $error) {
      die($error->getMessage());
    }
  }

  // Filtrar por servicio y provincia
  public function specialtiesFilteredByServiceAndDistrict(array $data){
    try {
      return parent::execProcedure($data, "spu_especialidades_filtro_distrito", true);
    } catch (Exception $error) {
      die($error->getMessage());
    }
  }

  // Filtrar por servicio, departamento y tarifas
  public function specialtiesFilteredByServiceAndFee(array $data){
    try {
      return parent::execProcedure($data, "spu_especialidades_filtro_tarifas", true);
    } catch (Exception $error) {
      die($error->getMessage());
    }
  }
}
