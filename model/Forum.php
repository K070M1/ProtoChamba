<?php

require_once '../core/model.master.php';
class Forum extends ModelMaster{

  // Comentar en el foro
  public function commentForum(array $data){
    try{
      parent::execProcedure($data, "spu_foros_registrar", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // actualizar Comentario en el foro
  public function updateCommentForum(array $data){
    try{
      parent::execProcedure($data, "spu_foros_modificar", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // eliminar Comentarto del foro
  public function deleteForum(array $data){
    try{
      parent::deleteRegister($data, "spu_foros_eliminar");
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

}

?>