<?php
session_start();
$_SESSION['idusuario'] = 3;
$_SESSION['imagedefault'] = 'default_profile_avatar.svg';

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

        $getImage = getImageProfileUser($row['idtousuario']);
        $imageProfile = $getImage != ''? $getImage : $_SESSION['imagedefault']; 
        $options = "";

        if($_SESSION['idusuario'] == $row['idtousuario']){
          $options = "
            <a href='javascript:void(0)' class='text-info edit-comment'>Editar</a>
            <a href='javascript:void(0)' class='text-danger delete-comment' data-code-forum='{$row['idforo']}'>Eliminar</a>
            <a href='javascript:void(0)' class='text-info update-comment d-none mr-2' data-code-forum='{$row['idforo']}'>Actualizar</a>
            <a href='javascript:void(0)' class='text-secondary cancel-edit-comment d-none'>Cancelar</a>
          ";
        } else{
          $options = "
          <a href='javascript:void(0)' class='text-danger  report-comment' >Denunciar</a>
          ";
        }

        echo "
          <div class='box-comment'>
            <img src='dist/img/{$imageProfile}' alt='' />

            <div class='box-content-commented'>
              <div class='name-user'>
                <span>{$row['nombres']}</span>
                <small class='fecha text-muted'>{$row['fechaconsulta']} </small>
              </div>
              <p class='comment-text'> {$row['consulta']} </p>
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

    return isset($images[0]) ? $images[0]['archivo']: '';
  }

  // Listar
  if($_GET['op'] == 'getQueriesToUser'){
    $idusuario;
    
    if($_GET['idusuarioactivo'] != -1){
      $idusuario = $_GET['idusuarioactivo'];
    } else {
      $idusuario = $_SESSION['idusuario'];
    }

    $data = $forum->getQueriesToUser(['idusuario' => $idusuario]);
    listQueriesForumToUser($data);

  }

  // Registrar publicación de consulta
  if($_GET['op'] == 'commentForum'){
    $forum->commentForum([
      'idtousuario'   => $_SESSION['idusuario'],
      'idfromusuario' => $_GET['idusuario'],
      'consulta'      => $_GET['consulta']
    ]);
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