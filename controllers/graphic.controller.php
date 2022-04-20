<?php

require_once '../model/Graphic.php';

$graphic = new Graphic();

if(isset($_GET['op'])){

  // Reportes mensuales
  if($_GET['op'] == 'monthlyReports'){
    $data;
    
    if(!isset($_GET['fechainicio']) || !isset($_GET['fechafin'])){
      $data = $graphic->monthlyReports();
    }
    else{
      $data = $graphic->monthlyReportsFilteredByDates([
        "fechainicio" => $_GET['fechainicio'],
        "fechafin"    => $_GET['fechafin']
      ]);
    }    

    if($data)
      echo json_encode($data);    
  }

  // Total de usuarios por servicio
  if($_GET['op'] == 'countUsersByService'){

    $data;
    if(!isset($_GET['fechainicio']) || !isset($_GET['fechafin'])){
      $data = $graphic->countUsersByService();
    }
    else{
      $data = $graphic->countUsersByServiceFilteredByDates([
        "fechainicio" => $_GET['fechainicio'],
        "fechafin"    => $_GET['fechafin']
      ]);
    }

    if($data){
      echo json_encode($data);
    }
  }

  // Total de usuarios por niveles
  if($_GET['op'] == 'userLevels'){
    $data;

    if(!isset($_GET['fechainicio']) || !isset($_GET['fechafin'])){
      $data = $graphic->userLevels();
    }
    else{
      $data = $graphic->userLevelsFilteredByDates([
        "fechainicio" => $_GET['fechainicio'],
        "fechafin"    => $_GET['fechafin']
      ]);
    }
    
    if($data){
      echo json_encode($data);
    }
  }
}

?>