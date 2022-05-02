<?php
session_start();
require_once '../model/Gallery.php';

$gallery = new Gallery();
date_default_timezone_set("America/Lima");

if (isset($_GET['op'])) {

  // Cargar todas las fotografias
  function loadGallery($data, $visible) {
    if (count($data) > 0) {
      foreach ($data as $row) {
        echo
        "
        <div class='col-md-3 user-cd-img'>
            <div class='image-container'>
                <figure>
                    <img src='./dist/img/user/{$row['archivo']}'>
                    <figcaption>
                        <ul>
                        <li>
                            <i class='fas fa-pen-square btn-modif' {$visible}  data-gal-act='{$row['idgaleria']}' data-gal-albm='{$row['idalbum']}' ></i>
                        </li>
                        <li>
                            <i class='fas fa-trash-alt btn-elim' {$visible}  data-gal-eli='{$row['idgaleria']}' ></i>
                        </li>
                        <li>
                            <i class='fas fa-eye btn-vw' data-gal-open='{$row['idgaleria']}' data-gal-albm='{$row['idalbum']}'></i>
                        </li>
                        </ul>
                    </figcaption>
                </figure>
            </div>
        </div>
        ";
      }
    }
    echo
    "
      <div class='col-md-3' {$visible}>
        <div class='add-img-cd' title='Subir una imágen a mi galería' id='agr-gal'>
          <i class='fas fa-camera'></i>
        </div>
      </div>
      ";
  }

  // Cargar contenido en el modal de las fotografias
  function loadGalleryView($data)
  {
    $fechaalta = $data[0]['fechaalta'];
    $cambio = strtotime($fechaalta);
    $nuevaFecha = date("Y-m-d", $cambio);

    echo
    "
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            <div class= 'modal-body'>
                <div id= 'md-contain-img'>
                    <img src='./dist/img/User/{$data[0]['archivo']}'>
                </div>
            </div>
            <div class='md-footer'>
                <form class='row'>
                    <div class='col-md-2 text-right'>
                        <label>Album:</label>
                    </div>
                    <div class='btn-group col-md-6'>
                        <select id='slc-album-md' class='form-control view-only-img'>
                           
                        </select>
                        <button type='button' class='btn btn-outline-secondary' id='btn-cmb-alb' data-id-gal='{$data[0]['idgaleria']}'>Cambiar</button>
                    </div>
                    <div class='col-md-4 text-right'>
                        <h7 class='font-weight-bold'>$nuevaFecha</h7>
                    </div>
                </form>
            </div>
        ";
  }

  // Cargar todas las fotografias
  if ($_GET['op'] == 'listGallery') {
    $idusuario;
    $visible;
    
    if($_GET['idusuarioactivo'] != -1){
      $idusuario = $_GET['idusuarioactivo'];
      $visible = 'hidden';
    } else {
      $idusuario = $_SESSION['idusuario'];
      $visible = 'visible';
    }

    $data = $gallery->getGalleriesByUser(["idusuario" => $idusuario]);
    loadGallery($data, $visible);
  }

  // Cargar todas las fotografias dentro de un collapse
  if ($_GET['op'] == 'listGalleryFromAlbum') {
    $visible;
    
    if($_GET['idusuarioactivo'] != -1){
      $visible = 'hidden';
    } else {
      $visible = 'visible';
    }

    $data = $gallery->getGalleriesByAlbum(["idalbum" => $_GET['idalbum']]);
    loadGallery($data, $visible);
  }

  //  Cargar contenido en el modal de las fotografias
  if ($_GET['op'] == 'getGalleryModal') {
    $data = $gallery->getAGallery(["idgaleria" => $_GET['idgaleria']]);
    if (count($data) > 0) {
      loadGalleryView($data);
    }
  }

  // Obtener imagenes de trabajo
  if($_GET['op'] == 'getGalleriesByWork'){
    $data = $gallery->getGalleriesByWork(["idtrabajo" => $_GET['idtrabajo']]);

    if($data){
      echo json_encode($data);
    }
  }

  // Eliminar fotos
  if ($_GET['op'] == 'deleteGallery') {
    $data = $gallery->deleteGallery(["idgaleria" => $_GET['idgaleria']]);
  }
}

if (isset($_POST['op'])) {

  // Registrar
  if ($_POST['op'] == "registerGalleryPhotos") {

    // Para encriptar fotos
    function encripPhoto()
    {
      $lenght = 15;
      $base = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $longitud = strlen($base);
      $code = '';
      for ($i = 0; $i < $lenght; $i++) {
        $random = $base[mt_rand(0, $longitud - 1)];
        $code .= $random;
      }

      return $code;
    }

    $idtypefile = $_POST['tipoarchivo'];

    if ($idtypefile == 'image/png') {
      $extension =  encripPhoto() . date('YmdhGsuv') . ".png";
    } else if ($idtypefile == 'image/jpeg') {
      $extension = encripPhoto() . date('YmdhGsuv') . ".jpg";
    } else {
      $extension = encripPhoto() . date('YmdhGsuv') . ".gif";
    }

    $enviard =
      [
        "idalbum"       => $_POST['idalbum'],
        "idusuario"     => '1',
        "idtrabajo"     => " ",
        "tipo"          => "F",
        "archivo"       => $extension
      ];

    $data = $gallery->registerGallery($enviard);
    move_uploaded_file($_FILES['archivo']['tmp_name'], "../dist/img/user/" . $extension);
    echo $_FILES['archivo']['tmp_name'];
    echo $extension;
  }

  // Actualizar
  if ($_POST['op'] == "updateGallery") {

    $enviard =
      [
        "idgaleria"     => $_POST['idgaleria'],
        "idalbum"       => $_POST['idalbum']
      ];

    $data = $gallery->updateGallery($enviard);
  }

  // DEMOS
  // Eliminar imagen de la carpeta
  if ($_POST['op'] == 'deleteImg') {
    $result;
    
    if (unlink('../dist/img/202204200525472.jpg')) {
      $result = " Imagen (202204200525472.jpg) Eliminado";
    } else {
      $result = " Error";
    }

    echo $result;
  }

  // Renombrar imagen de la carpeta
  if ($_POST['op'] == 'renameImg') {
    $oldName = "202204200352290.jpg";
    $newName = "Eliminar.jpg";
    $result;
    
    if(rename("../dist/img/" . $oldName, "../dist/img/" . $newName)){
      $result = "Renombrado";
    }
    else{
      $result = "Error al renombrar";

    }

    echo $result;
  }

  // FIN DEMOS
}
?>