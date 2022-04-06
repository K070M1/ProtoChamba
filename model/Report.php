<?php
require_once '../core/model.master.php';
class Report extends ModelMaster{

  // Registrar reporte
  public function registerReport(array $data){
    try{
      return parent::execProcedure($data, "spu_reportes_registrar", false);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Listar todos los reportes
  public function getReports(){
    try{
      return parent::getRows("spu_listar_reportes");
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Filtrar por fechas
  public function reportsFilteredByDate(array $data){
    try{
      return parent::execProcedure($data, "spu_filtrar_reportes_fecha", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }

  // Filtrar por usuario
  public function reportsFilteredByUser(array $data){
    try{
      return parent::execProcedure($data, "spu_filtrar_reportes_usuario", true);
    }
    catch(Exception $error){
      die($error->getMessage());
    }
  }
}

?>