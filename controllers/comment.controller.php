<?php

session_start();

require_once '../model/Comment.php';
$comment = new Comment();

if(isset($_GET['op'])){

  // Registrar
  if($_GET['op'] == 'registerComment'){
    if(isset($_SESSION['idusuario'])){
      $comment->registerComment([
        "idtrabajo"   => $_GET['idtrabajo'],
        "idusuario"   => $_SESSION['idusuario'],
        "comentario"  => $_GET['comentario']
      ]);
    } else {
      echo "Iniciar sesión";
    }
  }
  
  // Actualizar
  if($_GET['op'] == 'updateComment'){
    $comment->updateComment([
      "idcomentario"   => $_GET['idcomentario'],
      "comentario"  => $_GET['comentario']
    ]);
  }
  
  // Eliminar
  if($_GET['op'] == 'deleteComment'){
    $comment->deleteComment(["idcomentario" => $_GET['idcomentario']]);
  }

}


?>
