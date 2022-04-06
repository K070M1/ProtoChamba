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
      return parent::getRows("spu_grafico_niveles_usu");
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

  
}


?>