<?php

require_once '../core/model.master.php';
class Activity extends ModelMaster{

  // Listar actividades
  public function registerActivity(array $data){
    try{
      parent::execProcedure($data, "spu_registrar_actividades", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Listar actividades
  public function updateActivity(array $data){
    try{
      parent::execProcedure($data, "spu_modificar_actividades", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Listar actividades
  public function getActivities(){
    try{
      return parent::getRows("spu_listar_actividades");
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Obtener una actividad
  public function getAnActivity(array $data){
    try{
      return parent::execProcedure($data, "spu_actividades_getdata", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Actividades filtradas por el idusuario
  public function activitiesFilterByUser(array $data){
    try{
      return parent::execProcedure($data, "spu_filtrar_actividad", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Eliminar una actividad
  public function deleteActivity(array $data){
    try{
      parent::deleteRegister($data, "spu_eliminar_actividades");
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

}


?>