<?php

require_once '../core/model.master.php';
class Establishment extends ModelMaster{

  // Listar establecimientos por usuario
  public function getEstablishmentsByUser(array $data){
    try{
      return parent::execProcedure($data, "spu_albumes_listar_usuario", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Registrar establecimiento
  public function registerEstablishment(array $data){
    try{
      parent::execProcedure($data, "spu_establecimientos_registrar", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Actualizar establecimiento
  public function updateEstablishment(array $data){
    try{
      parent::execProcedure($data, "spu_establecimientos_modificar", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Obtenr un establecimiento
  public function getAEstablishment(array $data){
    try{
      return parent::execProcedure($data, "spu_establecimientos_getdata", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Eliminar un establecimiento
  public function deleteEstablishment(array $data){
    try{
      parent::deleteRegister($data, "spu_establecimientos_eliminar");
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

}
?>