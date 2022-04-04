<?php
require_once '../core/model.master.php';
class Gallery extends ModelMaster{

  // Listar galerias por usuario
  public function getGalleriesByUser(array $data){
    try{
      return parent::execProcedure($data, "spu_galerias_listar_usuario", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Listar galerias por album
  public function getGalleriesByAlbum(array $data){
    try{
      return parent::execProcedure($data, "spu_galerias_listar_album", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Listar galerias por trabajo
  public function getGalleriesByJob(array $data){
    try{
      return parent::execProcedure($data, "spu_galerias_listar_trabajo", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Obtener un registro
  public function getAGallery(array $data){
    try{
      return parent::execProcedure($data, "spu_galerias_getdata", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Registrar galeria
  public function registerGallery(array $data){
    try{
      parent::execProcedure($data, "spu_galerias_registrar", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  //  Actualizar galeria
  public function updateGallery(array $data){
    try{
      parent::execProcedure($data, "spu_galerias_modificar", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }
}


?>