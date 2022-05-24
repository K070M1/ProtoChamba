<?php

require_once '../core/model.master.php';

class Comment extends ModelMaster{

  // Obtener comentarios por publicacion
  public function getCommentsByPublication($data){
    try{
      return parent::execProcedure($data, "spu_comentarios_listar_trabajo", true);

    } catch (Exception $error){
      die($error->getMessage());
    }
  }

  // Registrar comentario
  public function registerComment($data){
    try{
      return parent::execProcedure($data, "spu_comentarios_registrar", true);

    } catch (Exception $error){
      die($error->getMessage());
    }
  }

  // Actualizar comentario
  public function updateComment($data){
    try{
      parent::execProcedure($data, "spu_comentarios_modificar", false);

    } catch (Exception $error){
      die($error->getMessage());
    }
  }

  // Eliminar comentario
  public function deleteComment($data){
    try{
      parent::deleteRegister($data, "spu_comentarios_eliminar");

    } catch (Exception $error){
      die($error->getMessage());
    }
  }
}


?>