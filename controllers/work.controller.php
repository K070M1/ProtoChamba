<?php
session_start();

require_once '../model/Work.php';
require_once '../model/Gallery.php';

$work = new Work();
$gallery = new Gallery();

if(isset($_GET['op'])){

  // Generar estructura HTML
  function listWorksHtml($data){
    if(count($data) == 0){
      echo '<h4> No existen registros</h4>';
    }
    else{
      foreach($data as $row){
        echo "
        <div class='target-service card'>
          <div class='target-header card-header'>
            <div class='user-block'>
              <img class='img-circle' src='dist/img/user1-128x128.jpg' alt='User Image'>
              <span class='username'><a href='#'>{$row['nombres']} {$row['apellidos']}</a></span>
              <span class='description'>{$row['fechalarga']}</span>
            </div>
            <div class='user-block-right'>
              <span class='text-black btn-show-config'>
                <i class='fas fa-ellipsis-h'></i>
              </span>
              <ul class='list-public-config bg-secondary'>
                <li class='item-public-config'>
                  <a href='javascript:void(0)'>
                    <i class='fas fa-pen'></i>
                    <span>Editar publicación</span>
                  </a>
                </li>
                <li class='item-public-config'>
                  <a href='javascript:void(0)'>
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
              <div class='califications'>
                <i class='fa fa-star'></i>
                <i class='fa fa-star'></i>
                <i class='fa fa-star'></i>
                <i class='fa fa-star'></i>
                <i class='fa fa-star'></i>
              </div>
              <span class='text-muted'>(85 reacciones)</span>
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

            $images = getImagesWork($row['idtrabajo']);

            foreach($images as $image){
              echo "
              <img src='dist/img/{$image['archivo']}' />
              ";
            }
              
            echo "</div>
            <!-- /. Contenido de las galerias -->
          </div>
          <div class='target-footer card-footer'>

            <!-- menu (comentarios, calificaciones) -->
            <div class='option-menu'>
              <ul>
                <li class='open-comments'><a href='javascript:void(0)'><span>25</span> Comentarios</a></li>
                <li class='qualify'>
                  <a href='javascript:void(0)'>Reacciones</a>
                  <!-- Reacciones -->
                  <div class='content-reactions-qualify'>
                    <div class='reactions'>
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
              <div class='box-comment'>
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
              </div>

              <!-- Comentario 2 -->
              <div class='box-comment'>
                <img src='dist/img/avatar2.png' alt='' />

                <div class='box-content-commented'>
                  <div class='name-user'>
                    <span>Nombre del usuario</span>
                    <small class='fecha text-muted'>12-05-2022 04:45 PM</small>
                  </div>
                  <p class='comment-text'>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                    Quia illum mollitia dolores sit vero sint minima incidunt,
                    fugiat quos ullam. Lorem ipsum dolor sit amet consectetur,
                    adipisicing elit. Quia illum mollitia dolores sit vero sint
                    minima incidunt, fugiat quos ullam.
                  </p>
                  <a href='javascript:void(0)' class='text-danger  report-comment'>Denunciar</a>
                </div>
              </div>

              <!-- Comentario 3 -->
              <div class='box-comment'>
                <img src='dist/img/avatar2.png' alt='' />

                <div class='box-content-commented'>
                  <div class='name-user'>
                    <span>Nombre del usuario</span>
                    <small class='fecha text-muted'>12-05-2022 04:45 PM</small>
                  </div>
                  <p class='comment-text'>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                    Quia illum mollitia dolores sit vero sint minima incidunt,
                    fugiat quos ullam. Lorem ipsum dolor sit amet consectetur,
                    adipisicing elit. Quia illum mollitia dolores sit vero sint
                    minima incidunt, fugiat quos ullam.
                  </p>
                  <a href='javascript:void(0)' class='text-danger  report-comment'>Denunciar</a>
                </div>
              </div>
            </div>
            <!-- /. Contenido de los comentarios -->

            <!-- Escribir comentario -->
            <div class='write-comment'>
              <img src='dist/img/avatar5.png' alt='' />
              <div class='text-auto-height'>
                <div class='text-input-auto contenteditable write-text-comment' contenteditable='true' maxlength='250'> </div>
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

  // Obtener fotos por trabajo
  function getImagesWork($idtrabajo){
    $gallery = new Gallery();
    $images = $gallery->getGalleriesByWork(["idtrabajo" => $idtrabajo]);
    return $images;
  }

  // Listar trabajos
  if($_GET['op'] == 'getWorksByUser'){
    $data = $work->getWorksByUser(['idusuario' => $_SESSION['idusuario']]);
    listWorksHtml($data);
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

    $idtrabajo = $data[0]['idtrabajo'];
    $countImgs = 0;
    $result = '';

    // Si existe imagenes
    if (isset($_FILES['images'])){
      // Validar el array de archivos
      if(is_array(($_FILES))){
        foreach($_FILES['images']['name'] as $key => $value){
          $ext = explode('.', $_FILES['images']['name'][$key]); // Separar la extension de la imagen
          $image = date('Ymdhis') . $countImgs . '.' . $ext[1];
  
          $gallery->registerGallery([   
            'idalbum'       => '',
            'idusuario'     => $_SESSION['idusuario'],
            'idtrabajo'     => $idtrabajo,
            'tipo'          => 'F',
            'archivo'       => $image
          ]);
      
          // Mover a la carpeta img indicada
          if(move_uploaded_file($_FILES['images']['tmp_name'][$key], '../dist/img/' . $image)){
              $countImgs++;
          };
        }
      }

      $result = 'Se agregaron ' . $countImgs . ' imagenes';
    }

    // Si existe video
    if(isset($_FILES['video'])){
      $ext = explode('.', $_FILES['video']['name']); 
      $video = date('Ymdhis') . '.' . $ext[1];
      
      // Mover a la carpeta img indicada
      if(move_uploaded_file($_FILES['video']['tmp_name'], '../dist/img/' . $video)){
        $result = 'Se agrego un video ' . $_FILES['video']['name'];
      };
    }

    echo $result;
  }
}

?>