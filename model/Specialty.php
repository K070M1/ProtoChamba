<?php

require_once '../core/model.master.php';

class Specialty extends ModelMaster{

  //Obtener datos de una especialidad
  public function getDataSpecialty(array $data){
    try{
      return parent::execProcedure($data, "spu_especialidades_getdata", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  //Listar los usuarios con especialidades para generar el card
  public function getSpecialty (){
    try{
        return parent::getRows("spu_especialidades_listar");
      }
    catch(Exception $error){
        die($error->getMessage());
    }
  }

  // Listar por servicio
  public function getSpecialtyByService(array $data){
    try{
        return parent::execProcedure($data,"spu_especialidades_listar_servicio",true);
    }
    catch(Exception $error){
        die($error->getMessage());
    }
  }

  // Listar por id de usuario
  public function getSpecialtyByUser(array $data){
    try{
        return parent::execProcedure($data,"spu_especialidades_listar_usuario",true);
    }
    catch(Exception $error){
        die($error->getMessage());
    }
  }
  
  // Listar por especialidad por usuario
  public function listSpecialtyUser(array $data){
    try{
      return parent::execProcedure($data, "spu_especialidades_listar_usuario", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Registrar Especialidad por Usuario
  public function registerSpecialtyUser(array $data){
    try{
      parent::execProcedure($data, "spu_especialidades_registrar", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Actualizar especialidad de un usuario
  public function updateSpecialty(array $data){
    try{
      parent::execProcedure($data, "spu_especialidades_modificar", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Eliminar Especialidad
  public function deleteSpecialty(array $data){
    try{
      parent::deleteRegister($data, "spu_especialidades_eliminar");
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }
}

?>