<?php
session_start();
require_once '../model/Qualify.php';

$qualify = new Qualify();

if(isset($_GET['op'])){

  // Obtener la calificación del usuario (Estrellas)
  function getScoreUser($idusuario){
    $qualify = new Qualify();
    $score = $qualify->getScoreUser(["idusuario" => $idusuario]);
    return isset($score[0]) ? $score[0]['estrellas'] : 0;
  }

  // Registrar
  if($_GET['op'] == 'registerQualify'){
    if(isset($_SESSION['idusuario'])){
      $qualify->registerQualify([
        "idtrabajo"   => $_GET['idtrabajo'],
        "idusuario"   => $_SESSION['idusuario'],
        "puntuacion"  => $_GET['puntuacion']
      ]);
    } else {
      echo "Iniciar sesión";
    }
  }
  
  // Actualizar puntuación
  if($_GET['op'] == 'updateQualify'){
    if(isset($_SESSION['idusuario'])){
      $qualify->updateQualify([
        "idcalificacion"  => $_GET['idcalificacion'],
        "puntuacion"      => $_GET['puntuacion']
      ]);
    } else {
      echo "Iniciar sesión";
    }
  }

  if($_GET['op'] == 'getScoreUser'){
    $idusuario;

    if($_GET['idusuarioactivo'] == -1 && isset($_SESSION['idusuario'])){
      $idusuario = $_SESSION['idusuario'];
    } else {
      $idusuario = $_GET['idusuarioactivo'];
    }

    $scoreUser = getScoreUser($idusuario);
    // Ceil == Redondear al entero proximo
    $scoreUser = ceil($scoreUser);

    echo "<div class='stars'>";

    /* con estrellas */
    for ($i = 0; $i < $scoreUser; $i++) {
      echo " <i class='fas fa-star active'></i>";
    }

    /* sin estrellas */
    for ($j = 0; $j < 5 - $scoreUser; $j++) {
      // <i class="fas fa-star-half-alt"></i>
      echo "<i class='fas fa-star'></i>";
    }

    echo "</div>";
  }
}


?>