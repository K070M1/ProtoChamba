<?php
session_start();
require_once '../model/Qualify.php';

$qualify = new Qualify();

if(isset($_GET['op'])){

  // Registrar
  if($_GET['op'] == 'registerQualify'){
    $qualify->registerQualify([
      "idtrabajo"   => $_GET['idtrabajo'],
      "idusuario"   => $_SESSION['idusuario'],
      "puntuacion"  => $_GET['puntuacion']
    ]);
  }
  
  // Actualizar puntuación
  if($_GET['op'] == 'updateQualify'){
    $qualify->updateQualify([
      "idcalificacion"  => $_GET['idcalificacion'],
      "puntuacion"      => $_GET['puntuacion']
    ]);
  }
}


?>