<?php

require_once '../core/model.master.php';
class Graphic extends ModelMaster{

  // Reportes mensuales
  public function monthlyReports(){
    try{
      return parent::getRows("spu_grafico_reportes");
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Reportes mensuales
  public function monthlyReportsFilteredByDates(array $data){
    try{
      return parent::execProcedure($data, "spu_grafico_reportes_fechas", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Reportes mensuales
  public function annualReports(){
    try{
      return parent::getRows("spu_grafico_reportes_year");
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Niveles de usuario
  public function userLevels(){
    try{
      return parent::getRows("spu_grafico_niveles_usuario");
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Niveles de usuario
  public function userLevelsFilteredByDates(array $data){
    try{
      return parent::execProcedure($data, "spu_grafico_niveles_usuario_fechas", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // usuaros populares
  public function userPopulares(){
    try{
      return parent::getRows("spu_grafico_popular");
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Cantidad de usuarios que tiene cada servicio
  public function countUsersByService(){
    try{
      return parent::getRows("spu_total_usuarios_servicio");
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Cantidad de usuarios que tiene cada servicio
  public function countUsersByServiceFilteredByDates(array $data){
    try{
      return parent::execProcedure($data, "spu_total_usuarios_servicio_fechas", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }  
}
?>