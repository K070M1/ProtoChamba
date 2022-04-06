<?php

require_once '../core/model.master.php';
class User extends ModelMaster{

  // Listar los registro de usuarios
  public function getUsers(){
    try{
      return parent::getRows("spu_usuarios_listar");
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Registrar usuario
  public function registerUser(array $data){
    try{
      parent::execProcedure($data, "spu_usuarios_registrar", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Actualizar usuario
  public function updateUser(array $data){
    try{
      parent::execProcedure($data, "spu_usuarios_modificar", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Actualizar rol del usuario
  public function updateUserRole(array $data){
    try{
      parent::execProcedure($data, "spu_usuarios_edit_rol", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Obtener un registro de usuario
  public function getAUser(array $data){
    try{
      return parent::execProcedure($data, "spu_usuarios_getdata", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Eliminar un registro de usuario
  public function deleteUser(array $data){
    try{
      parent::deleteRegister($data, "spu_usuarios_eliminar");
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Hacer login
  public function loginUser(array $data){
    try{
      return parent::execProcedure($data, "spu_usuarios_login", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Filtrar usuario por idservicio y iddepartamento
  public function filteredUsers(array $data){
    try{
      return parent::execProcedure($data, "spu_usuarios_filtrar", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }
}


?>