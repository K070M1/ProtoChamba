<?php

require_once '../core/model.master.php';
class Service extends ModelMaster{

  // Listar los servicios
  public function getServices(){
    try{
      return parent::getRows("spu_servicios_listar");
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Listar servicios por usuario
  public function getServicesByUser(array $data){
    try{
      return parent::execProcedure($data, "spu_especialidades_listar_servicio", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }
}



?>