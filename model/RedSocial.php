<?php

require_once '../core/model.master.php';
class RedSocial extends ModelMaster{

  //Obtener datos de una red social
  public function getRedSocial(array $data){
    try{
      return parent::execProcedure($data, "spu_redessociales_getdata", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Listar por usuario
  public function getRedesSociales(array $data){
    try{
      return parent::execProcedure($data, "spu_redessociales_filtrar_usuario", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Registrar
  public function registerRedSocial(array $data){
    try{
      parent::execProcedure($data, "spu_redessociales_registrar", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Actualizar
  public function updateRedSocial(array $data){
    try{
      parent::execProcedure($data, "spu_redessociales_modificar", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Eliminar
  public function deleteRedSocial(array $data){
    try{
      parent::deleteRegister($data, "spu_redessociales_eliminar");
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }
}

?>