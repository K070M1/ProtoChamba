<?php

require_once '../core/model.master.php';
class Work extends ModelMaster{

  // Listar trabajos por usuario
  public function getWorksByUser(array $data){
    try{
      return parent::execProcedure($data, "spu_trabajos_listar_usuario", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Obtener un registro de trabajo
  public function getAtWork(array $data){
    try{
      return parent::execProcedure($data, "spu_trabajos_getdata", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Registrar trabajo
  public function registerWork(array $data){
    try{
      return parent::execProcedure($data, "spu_trabajos_registrar", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Actualizar trabajo
  public function updateWork(array $data){
    try{
      parent::execProcedure($data, "spu_trabajos_modificar", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Eleminar trabajo
  public function deleteWork(array $data){
    try{
      parent::deleteRegister($data, "spu_trabajos_eliminar");
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }
  
  // Total de trabajos por usuario
  public function countWorksByUser(array $data){
    try{
      return parent::execProcedure($data, "spu_total_trabajos_usuario", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }
  
  // Total de puntuación del trabajo
  public function totalWorkScore(array $data){
    try{
      return parent::execProcedure($data, "spu_total_reaciones_trabajo", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }
  
  // Obtener la calificación del trabajo publicado
  public function workQualification(array $data){
    try{
      return parent::execProcedure($data, "spu_estrellas_trabajo", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

}
?>