<?php
session_start();

require_once '../model/Forum.php';
require_once '../model/Gallery.php';

$forum = new Forum();

if(isset($_GET['op'])){
  
  // generar las consultas en formato HTML
  function listQueriesForumToUser($data){

    if(count($data) == 0){
      echo '<h5>Sin consultas</h5>';
    }
    else{
      foreach ($data as $row){
        $getImage = getImageProfileUser($row['idfromusuario']);
        $imageProfile = $getImage != ''? $getImage : 'default_profile_avatar.svg'; 
        $options = "";

        if(isset($_SESSION['idusuario'])){
          if($_SESSION['idusuario'] == $row['idfromusuario']){
            $options = "
              <a href='javascript:void(0)' class='text-info edit-comment'>Editar</a>
              <a href='javascript:void(0)' class='text-danger delete-comment' data-code-forum='{$row['idforo']}'>Eliminar</a>
              <a href='javascript:void(0)' class='text-info update-comment d-none mr-2' data-code-forum='{$row['idforo']}'>Actualizar</a>
              <a href='javascript:void(0)' class='text-secondary cancel-edit-comment d-none'>Cancelar</a>
            ";
          } 
        }

        echo "
          <div class='box-comment'>
            <img src='dist/img/user/{$imageProfile}' />
            <div class='box-content-commented'>
              <div class='name-user'>
                <span>{$row['nombres']}</span>
                <small class='fecha text-muted'>{$row['fechaconsulta']} </small>
              </div>
              <p class='comment-text contenteditable'> {$row['consulta']} </p>
              {$options}
            </div>
          </div>
        ";        
      }
    }
  }

  // Obtener imagen de perfil
  function getImageProfileUser($idusuario){
    $gallery = new Gallery();
    $images = $gallery->getProfilePicture(["idusuario" => $idusuario]);

    // Operador ternario 
    return isset($images[0]) ? $images[0]['archivo']:'';
  }

  // Listar consultas
  if($_GET['op'] == 'getQueriesToUser'){
    $idusuario;

    if(isset($_SESSION['idusuario']) && $_GET['idusuarioactivo'] == -1){
      $idusuario = $_SESSION['idusuario'];
    } else {
      $idusuario = $_GET['idusuarioactivo'];
    }

    $data = $forum->getQueriesToUser([
      'idusuario' => $idusuario,
      'offset'    => $_GET['offset'], 
      'limit'     => $_GET['limit']
    ]);
    
    if($data){
      listQueriesForumToUser($data);
    } else {
      echo "sin consultas";
    }

  }

  // Registrar publicación de consulta
  if($_GET['op'] == 'commentForum'){
    $idusuarioactivo;

    if(isset($_SESSION['idusuario'])){
      if($_GET['idusuarioactivo'] == -1){
        $idusuarioactivo = $_SESSION['idusuario'];
      } else {
        $idusuarioactivo = $_GET['idusuarioactivo'];
      }

      $forum->commentForum([
        'idfromusuario' => $_SESSION['idusuario'],
        'idtousuario'   => $idusuarioactivo,
        'consulta'      => $_GET['consulta']
      ]);
    } else {
      echo "Iniciar sesión";
    }
  }

  // Actualizar publicación de consulta
  if($_GET['op'] == 'updateCommentForum'){
    $forum->updateCommentForum([
      'idforo'     => $_GET['idforo'],
      'consulta'   => $_GET['consulta']
    ]);
  }

  // Eliminar consulta
  if($_GET['op'] == 'deleteForum'){
    $forum->deleteForum(["idforo" => $_GET['idforo']]);
  }
}

?>