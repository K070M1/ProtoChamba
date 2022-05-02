<?php

require_once '../core/model.master.php';
class Person extends ModelMaster{

  // Registrar persona
  public function registerPerson(array $data){
    try{
      return parent::execProcedure($data, "spu_personas_registrar", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Actualizar registro de la persona
  public function updatePerson(array $data){
    try{
      parent::execProcedure($data, "spu_personas_modificar", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // LISTAR DATOS de la persona
  public function getAPerson(array $data){
    try{
      parent::execProcedure($data, "spu_personas_getdata", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

    //listar datos de persona
    public function getPerson(array $data){
      try{
        return parent::execProcedure($data, "spu_personas_getdata", true);
      }
      catch(Exception $error){
        die($error->getMessage());
      }
    }
    //listar datos de persona
    public function getDataPerson(array $data){
      try{
        return parent::execProcedure($data, "spu_personas_getdata", true);
      }
      catch(Exception $error){
        die($error->getMessage());
      }
    }
}
?>