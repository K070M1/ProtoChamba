<?php

require_once '../model/Graphic.php';

$graphic = new Graphic();

if(isset($_GET['op'])){

  // Reportes mensuales
  if($_GET['op'] == 'monthlyReports'){
    $data = $graphic->monthlyReports();

    if($data)
      echo json_encode($data);    
  }
}

?>