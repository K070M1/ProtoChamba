<?php
session_start();

require_once '../model/Comment.php';
require_once '../model/Report.php';
$comment = new Comment();

if(isset($_GET['op'])){

  // Palabras inapropiadas
  $inappropriate = ["negro", "gordo", "pelele", "moro", "obeso", "mediocre", "babosada", "borrico", "cretino", "lerdo"];

  // Encontrar contenido inapropiado
  function findInappropriateContent($comment, $phrases){
    $comments = explode(" ", strtolower($comment)); // Convertir en array
    $found = false;
    $i = 0;

    do{
      $found = in_array($comments[$i], $phrases);
      $i++;
      
    } while($i < count($comments) && !$found);

    return $found;
  }

  // Generar denuncia automatica
  function generateReportUser($idcomentario){
    $report = new Report();
    // registrar reporte
    $report->registerReport([
      "idcomentario"  => $idcomentario,
      "motivo"        => "Contenido inapropiado",
      "descripcion"   => "El usuario hizo un comentario indebido en el sistema",
      "fotografia"    => ""
    ]);
  }

  // Registrar
  if($_GET['op'] == 'registerComment'){
    if(isset($_SESSION['idusuario'])){
      $comentario = $comment->registerComment([
        "idtrabajo"   => $_GET['idtrabajo'],
        "idusuario"   => $_SESSION['idusuario'],
        "comentario"  => $_GET['comentario']
      ]);

      $isInappropriate = findInappropriateContent($_GET['comentario'], $inappropriate);
      if($isInappropriate){
        generateReportUser($comentario[0]['idcomentario']);
      }
    } else {
      echo "Iniciar sesión";
    }
  }
  
  // Actualizar
  if($_GET['op'] == 'updateComment'){
    $comment->updateComment([
      "idcomentario" => $_GET['idcomentario'],
      "comentario"   => $_GET['comentario']
    ]);

    $isInappropriate = findInappropriateContent($_GET['comentario'], $inappropriate);
    if($isInappropriate){
      generateReportUser($_GET['idcomentario']);
    }
  }
  
  // Eliminar
  if($_GET['op'] == 'deleteComment'){
    $comment->deleteComment(["idcomentario" => $_GET['idcomentario']]);
  }

}
?>
