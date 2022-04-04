<?php

require_once '../core/model.master.php';
class Follower extends ModelMaster{

  // Listar seguidores
  public function getFollowersByUser(array $data){
    try{
      return parent::execProcedure($data, "spu_seguidores_listar", true);
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

}


?>