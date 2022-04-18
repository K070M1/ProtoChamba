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
  public function getGalleriesByWork(array $data){
    try{
      return parent::execProcedure($data, "spu_galerias_listar_trabajo", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Obtener un registro
  public function getProfilePicture(array $data){
    try{
      return parent::execProcedure($data, "spu_galerias_foto_perfil", true);
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
      return parent::execProcedure($data, "spu_galerias_registrar", true);
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

  public function deleteGallery(array $data){
    try{
      parent::deleteRegister($data, "spu_galerias_eliminar");
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }
}


?>