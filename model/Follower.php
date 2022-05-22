<?php

require_once '../core/model.master.php';
class Follower extends ModelMaster{

  // registrar seguidor
  public function registerFollower(array $data){
    try{
      parent::execProcedure($data, "spu_seguidor_registrar", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Listar seguidores
  public function getFollowersByUser(array $data){
    try{
      return parent::execProcedure($data, "spu_seguidores_listar", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  //Conteo seguidores
  public function getCountFollowersByUser(array $data){
    try{
      return parent::execProcedure($data, "spu_seguidores_conteo", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }


  // Listar seguidos
  public function getFollowedByUser(array $data){
    try{
      return parent::execProcedure($data, "spu_seguidos_listar", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  //Conteo seguidos
  public function getCountFollowedByUser(array $data){
    try{
      return parent::execProcedure($data, "spu_seguidos_conteo", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Eliminar follower logica
  public function deleteFollower(array $data){
    try{
      parent::execProcedure($data, "spu_seguidos_eliminar", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

}


?>