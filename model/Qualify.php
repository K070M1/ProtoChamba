<?php

require_once '../core/model.master.php';

class Qualify extends ModelMaster{

  // Registrar
  public function registerQualify(array $data){
    try{
      parent::execProcedure($data, "spu_calificaciones_registrar", false);
    } catch (Exception $error){
      die($error->getMessage());
    }
  }

  // Modifica o elimina la puntuación realizada
  public function updateQualify(array $data){
    try{
      parent::execProcedure($data, "spu_calificaciones_modificar_eliminar", false);
    } catch (Exception $error){
      die($error->getMessage());
    }
  }

  // Obtener el puntaje realizado por el usuario(trabajo y usuario)
  public function getScoreWorkByUser(array $data){
    try{
      return parent::execProcedure($data, "spu_reacciones_trabajo_por_usuario", true);
    } catch (Exception $error){
      die($error->getMessage());
    }
  }

  // Obtener la calificación en estrellas del usuario
  public function getScoreUser(array $data){
    try{
      return parent::execProcedure($data, "spu_estrellas_usuario", true);
    } catch (Exception $error){
      die($error->getMessage());
    }
  }
  
  // Obtener la cantidad de usuarios que reaccionarón a una publicación  
  public function getTotalUsersReactedToAPost(array $data){
    try{
      return parent::execProcedure($data, "spu_total_usuarios_reaccion_trabajo", true);
    } catch (Exception $error){
      die($error->getMessage());
    }
  }
}

?>