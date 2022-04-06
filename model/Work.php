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

  // Registrar trabajo
  public function registerWork(array $data){
    try{
      parent::execProcedure($data, "spu_trabajos_registrar", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Registrar trabajo
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

}


?>