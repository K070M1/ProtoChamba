<?php

require_once '../core/model.master.php';
class Service extends ModelMaster{


  //listar servicios de un usuario
  public function getServicesUser(array $data){
    try{
      return parent::execProcedure($data, "spu_servicios_listar_usuario", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  //Listar los servicios
  public function getServices(){
    try{
      return parent::getRows("spu_servicios_listar");
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

   // Registrar Servicios usuario
   public function registerServicesUser(array $data){
    try{
      parent::execProcedure($data, "spu_servicios_registrar", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

}
?>