<?php
session_start();
date_default_timezone_set("America/Lima");
$_SESSION['idusuario'] = 1;
$_SESSION['imgdefault'] = "default_profile_avatar.svg";

require_once '../model/Work.php';
require_once '../model/Gallery.php';
require_once '../model/Comment.php';
require_once '../model/Qualify.php';

$work = new Work();
$gallery = new Gallery();

if(isset($_GET['op'])){

  // Generar estructura HTML
  function listWorksHtml($data, $visible){
    if(count($data) == 0){
      echo '<h4> No existen registros</h4>';
    }
    else{
      foreach($data as $row){
        // Comentarios
        $comments = getCommentsPublication($row['idtrabajo']);
        $totalComments = count($comments);

        // calificación en strellas
        $stars = round(getWorkQualification($row['idtrabajo'])); // calificación 
        $totalusersReacted = getTotalUsersReacted($row['idtrabajo']);

        // Puntuación del usuario
        $dataScore = getWorkScoreByUser($row['idtrabajo'], $_SESSION['idusuario']);
        $idcalification = $dataScore != ''? $dataScore['idcalificacion']: 0;
        $userScore = $dataScore != ''? $dataScore['puntuacion']: 0;

        $getImage = getImageProfileUser($row['idusuario']);
        $imageProfile = $getImage != ''? $getImage : 'default_profile_avatar.svg';

        echo "
        <div class='target-service card'> 
          <div class='target-header card-header'>
            <div class='user-block'>
              <img class='img-circle' src='dist/img/{$imageProfile}'>
              <span class='username'><a href='#'>{$row['nombres']} {$row['apellidos']}</a></span>
              <span class='description'>{$row['fechalarga']}</span>
            </div>
            <div class='user-block-right'>
              <span class='text-black btn-show-config' {$visible}>
                <i class='fas fa-ellipsis-h'></i>
              </span>
              <ul class='list-public-config bg-secondary'>
                <li class='item-public-config'>
                  <a href='javascript:void(0)' class='btn-edit-publication' data-code='{$row['idtrabajo']}'>
                    <i class='fas fa-pen'></i>
                    <span>Editar publicación</span>
                  </a>
                </li>
                <li class='item-public-config'>
                  <a href='javascript:void(0)' class='btn-delete-publication' data-code='{$row['idtrabajo']}'>
                    <i class='fas fa-ban'></i>
                    <span>Eliminar publicación</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class='target-header card-body'>
            <h4 class='job-title'>{$row['titulo']}</h4>

            <!-- Contenido de las calificaciones realizadas -->
            <div class='content-califications'>
              <span class='text-muted'>Calificación:</span>
              <div class='califications'>";
                
                for($i = 0; $i < $stars; $i++){
                  echo "
                    <i class='fa fa-star'></i>
                  ";
                }

              echo "</div>
              <span class='text-muted'>({$totalusersReacted} reacciones)</span>
            </div>
            <!-- /. Contenido de las calificaciones realizadas -->
          </div>

          <div class='target-body card-body'>
            <!-- Descripción de la publicación -->
            <p class='text-service'>
              {$row['descripcion']}
            </p>
            <!-- /. Descripción de la publicación -->

            <!-- Contenido de las galerias -->
            <div class='content-galeria'>";

            /* ARCHIVOS A MOSTRAR */
            $files = getFilesWork($row['idtrabajo']);

            foreach($files as $file){

              if($file['tipo'] == 'F'){
                echo "
                <img src='dist/img/user/{$file['archivo']}' />
                ";
              }
              else{
                echo "
                  <video class='video-js fm-video vjs-big-play-centered' controls data-setup='{}' preload='auto' >
                    <source src='dist/video/{$file['archivo']}' type='video/mp4'>
                  </video>
                  ";
              }
            }
              
            echo "</div>
            <!-- /. Contenido de las galerias -->
          </div>
          <div class='target-footer card-footer'>

            <!-- menu (comentarios, calificaciones) -->
            <div class='option-menu'>
              <ul>
                <li class='open-comments'><a href='javascript:void(0)'><span class='badge badge-info text-nowrap'>{$totalComments}</span> Comentarios</a></li>
                <li class='qualify'>
                  <a href='javascript:void(0)'>
                    <span class='badge badge-success '>{$userScore} </span>  
                    Mi reacción
                  </a>
                  <!-- Reacciones -->
                  <div class='content-reactions-qualify'>
                    <div class='reactions' data-code-work='{$row['idtrabajo']}' data-reaction='{$userScore}' data-code-reaction='{$idcalification}'>
                      <span data-code='1'><i class='fa fa-star'></i></span>
                      <span data-code='2'><i class='fa fa-star'></i></span>
                      <span data-code='3'><i class='fa fa-star'></i></span>
                      <span data-code='4'><i class='fa fa-star'></i></span>
                      <span data-code='5'><i class='fa fa-star'></i></span>
                    </div>

                    <span class='number-points'>0 punto</span>
                  </div>                  
                </li>
              </ul>
            </div>
            <!-- /. menu (comentarios, calificaciones) -->

            <!-- Contenido de los comentarios -->
            <div class='content-comments collapse'>
              <!-- Comentario 1 -->
              <!-- <div class='box-comment'>
                <img src='dist/img/avatar2.png' alt='' />

                <div class='box-content-commented'>
                  <div class='name-user'>
                    <span>Nombre del usuario</span>
                    <small class='fecha text-muted'>12-05-2022 04:45 PM</small>
                  </div>
                  <p class='comment-text'>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                    Quia illum mollitia dolores sit vero sint minima incidunt,
                    fugiat quos ullam.
                  </p>
                  <a href='javascript:void(0)' class='text-primary edit-comment'>Editar</a>
                  <a href='javascript:void(0)' class='text-info cancel-edit-comment d-none'>Cancelar</a>
                  <a href='javascript:void(0)' class='text-danger delete-comment'>Eliminar</a>
                </div>
              </div> -->";           

              if($totalComments > 0){
                foreach ($comments as $comment){
  
                  $getImage = getImageProfileUser($comment['idusuario']);
                  $imageProfile = $getImage != ''? $getImage : 'default_profile_avatar.svg'; 
                  $options = "";

                  if($_SESSION['idusuario'] == $comment['idusuario']){
                    $options = "
                      <a href='javascript:void(0)' class='text-info edit-comment'>Editar</a>
                      <a href='javascript:void(0)' class='text-danger delete-comment' data-code='{$comment['idcomentario']}'>Eliminar</a>
                      <a href='javascript:void(0)' class='text-info update-comment d-none mr-2' data-code='{$comment['idcomentario']}'>Actualizar</a>
                      <a href='javascript:void(0)' class='text-secondary cancel-edit-comment d-none'>Cancelar</a>
                    ";
                  }
                  else{
                    $options = "
                    <a href='javascript:void(0)' class='text-danger  report-comment' data-code='{$comment['idcomentario']}'>Denunciar</a>
                    ";
                  }
  
                  echo "
                  <div class='box-comment'>
                    <img src='dist/img/{$imageProfile}' alt='' />
  
                    <div class='box-content-commented'>
                      <div class='name-user'>
                        <span>{$comment['nombres']} {$comment['apellidos']}</span>
                        <small class='fecha text-muted'>{$comment['fechalarga']}</small>
                      </div>
                      <p class='comment-text contenteditable' maxlength='350'>
                        {$comment['comentario']}
                      </p>
                      {$options}
                    </div>
                  </div>
                  ";
                }
              }
              else{
                echo "
                  <p> Sin comentarios </p>
                ";
              }
              
            echo "
            </div>
            <!-- /. Contenido de los comentarios -->

            <!-- Escribir comentario -->
            <div class='write-comment'>
              <img src='dist/img/{$_SESSION['imgdefault']}' alt='' />
              <div class='text-auto-height'>
                <div class='text-input-auto contenteditable write-text-comment' contenteditable='true' maxlength='250' data-code='{$row['idtrabajo']}'> </div>
              </div>
              <button type='button' class='btn btn-primary btn-send'>
                <i class='fas fa-paper-plane'></i>
              </button>
            </div>
            <!-- /. Escribir comentario -->
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

  // Obtener fotos por cada publicación
  function getFilesWork($idtrabajo){
    $gallery = new Gallery();
    $data = $gallery->getGalleriesByWork(["idtrabajo" => $idtrabajo]);
    return $data;
  }

  // Obtner comentarios por cada publicación
  function getCommentsPublication($idtrabajo){
    $comment = new Comment();

    $data = $comment->getCommentsByPublication(["idtrabajo" => $idtrabajo]);
    return $data;
  }

  // Obtemer el total de usuarios que reaccionaron a una publicación de trabajo
  function getTotalUsersReacted($idtrabajo){
    $qualify = new Qualify();
    $data = $qualify->getTotalUsersReactedToAPost(["idtrabajo" => $idtrabajo]);
    
    return isset($data[0]) ? $data[0]['usuarios']: 0;
  }

  // Obtener el puntaje realizado por el usuario
  function getWorkScoreByUser($idtrabajo, $idusuario){
    $qualify = new Qualify();
    $data = $qualify->getScoreWorkByUser(["idtrabajo" => $idtrabajo, "idusuario" => $idusuario]);

    return isset($data[0]) ? $data[0]: '';
  }

  // Obtener calificación del trabajo
  function getWorkQualification($idtrabajo){
    $work = new Work();
    $data = $work->workQualification(["idtrabajo" => $idtrabajo]);

    return isset($data[0]) ? $data[0]['estrellas']: 0;
  }

  // Listar trabajos
  if($_GET['op'] == 'getWorksByUser'){
    $idusuario;
    $visible;
    
    if($_GET['idusuarioactivo'] != -1){
      $idusuario = $_GET['idusuarioactivo'];
      $visible = 'hidden';
    } else {
      $idusuario = $_SESSION['idusuario'];
      $visible = 'visible';
    }

    $data = $work->getWorksByUser(['idusuario' => $idusuario]);
    listWorksHtml($data, $visible);
  }

  // Obtener un registro de trabajo
  if($_GET['op'] == 'getAtWork'){
    $data = $work->getAtWork(["idtrabajo" => $_GET['idtrabajo']]);

    if($data){
      echo json_encode($data[0]);
    }
  }

  // Eliminar publicación
  if($_GET['op'] == 'deleteWork'){
    $work->deleteWork(["idtrabajo" => $_GET['idtrabajo']]);
  }
}

if(isset($_POST['op'])){

  // Registrar un trabajo con imagenes o video
  if($_POST['op'] == 'registerWork'){
    // Registrar trabajo
    $data = $work->registerWork([
      'idespecialidad' => $_POST['idespecialidad'],
      'idusuario'      => $_SESSION['idusuario'],
      'titulo'         => $_POST['titulo'],
      'descripcion'    => $_POST['descripcion']
    ]);

    // Obtener id galeria publicacion

    $idtrabajo = $data[0]['idtrabajo'];
    $countImg = 0;
    $result = '';

    // Si existe imagenes
    if (isset($_FILES['images'])){
      // Validar el array de archivos
      if(is_array(($_FILES))){
        foreach($_FILES['images']['name'] as $key => $value){
          $ext = explode('.', $_FILES['images']['name'][$key]);   // Separar la extension de la imagen
          $image = date('Ymdhis') . $countImg . '.' . end($ext);    // Renombrar cada imagen
  
          $gallery->registerGallery([   
            'idalbum'       => '',
            'idusuario'     => $_SESSION['idusuario'],
            'idtrabajo'     => $idtrabajo,
            'tipo'          => 'F',
            'archivo'       => $image
          ]);
      
          // Mover a la carpeta img indicada
          if(move_uploaded_file($_FILES['images']['tmp_name'][$key], '../dist/img/user/' . $image)){
              $countImg++;
          };
        }
      }

      $result = 'Se agregaron ' . $countImg . ' imagenes';
    }

    // Si existe video
    if(isset($_FILES['video'])){
      $ext = explode('.', $_FILES['video']['name']);    // Obtener extensión del video
      $video = date('Ymdhis') . '.' . end($ext);        // Renombrar

      $gallery->registerGallery([   
        'idalbum'       => '',
        'idusuario'     => $_SESSION['idusuario'],
        'idtrabajo'     => $idtrabajo,
        'tipo'          => 'V',
        'archivo'       => $video
      ]);
      
      // Mover a la carpeta img indicada
      if(move_uploaded_file($_FILES['video']['tmp_name'], '../dist/video/' . $video)){
        $result = 'Se agrego un video ' . $_FILES['video']['name'] . " (" . $video . ")";
      };
    }

    echo $result;
  }

  function incomingFiles(){
    $files = $_FILES;
    $files2 = [];

    foreach($files as $input => $infoArr){
      $fileByInputs = [];

      foreach ($infoArr as $key => $valueArr){
        if(is_array($valueArr)){
          foreach($valueArr as $i => $value){
            $fileByInputs[$i][$key] = $value;
          }
        }
        else{
          $fileByInputs[] = $infoArr;
          break;
        }
      }

      $files2 = array_merge($files2, $fileByInputs);
    }

    $files3 = [];
    foreach($files2 as $file){
      if(!$file['error']) $files3[] = $file;
    }

    return $files3;
  }

  // Actualizar trabajo con imagenes o video
  if($_POST['op'] == 'updateWork'){
    // Actualizar trabajo
    $data = $work->updateWork([
      'idtrabajo'      => $_POST['idtrabajo'],
      'idespecialidad' => $_POST['idespecialidad'],
      'idusuario'      => 1,
      'titulo'         => $_POST['titulo'],
      'descripcion'    => $_POST['descripcion']
    ]);
   
    // Obtener id galeria publicacion

    $idtrabajo = $_POST['idtrabajo'];
    $countImg = 0;
    $result = '';

    // Si existe imagenes
    /* if (isset($_FILES['images'])){
      // Validar el array de archivos
      if(is_array($_FILES)){
        foreach($_FILES['images']['name'] as $key => $value){
          $ext = explode('.', $_FILES['images']['name'][$key]);   // Separar la extension de la imagen
          $image = date('Ymdhis') . $countImg . '.' . $ext[1];    // Renombrar cada imagen
  
          $gallery->registerGallery([   
            'idalbum'       => '',
            'idusuario'     => '1',
            'idtrabajo'     => $idtrabajo,
            'tipo'          => 'F',
            'archivo'       => $image
          ]);
      
          // Mover a la carpeta img indicada
          if(move_uploaded_file($_FILES['images']['tmp_name'][$key], '../dist/img/' . $image)){
              $countImg++;
          };
        }
      }

      $result = 'Se agregaron ' . $countImg . ' imagenes';
    }

    // Si existe video
    if(isset($_FILES['video'])){
      $ext = explode('.', $_FILES['video']['name']);  // Obtener extensión del video
      $video = date('Ymdhis') . '.' . $ext[1];        // Renombrar
      
      // Mover a la carpeta video indicada
      if(move_uploaded_file($_FILES['video']['tmp_name'], '../dist/video/' . $video)){
        $result = 'Se agrego un video ' . $_FILES['video']['name'] . " (" . $video . ")";
      };
    } */

    //echo $result;
  }

}

?>