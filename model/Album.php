<?php

require_once '../core/model.master.php';
class Album extends ModelMaster{

  // Listar por usuario
  public function getAlbumsByUser(array $data){
    try{
      return parent::execProcedure($data, "spu_albumes_listar_usuario", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Listar un solo album
  public function getAnAlbum(array $data){
    try{
      return parent::execProcedure($data, "spu_albumes_getdata", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Registrar album
  public function registerAlbum(array $data){
    try{
      parent::execProcedure($data, "spu_albumes_registrar", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Actualizar album
  public function updateAlbum(array $data){
    try{
      parent::execProcedure($data, "spu_albumes_modificar", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Eliminar album
  public function deleteAlbum(array $data){
    try{
      parent::deleteRegister($data, "spu_albumes_eliminar");
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Registro de albumes predeterminados
  public function registerAlbumDefault(array $data){
    try{
      parent::execProcedurePerso($data, "spu_albumes_predeterminados");
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }
}

?>