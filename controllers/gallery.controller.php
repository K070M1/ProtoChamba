<?php 
session_start();
date_default_timezone_set("America/Lima");

require_once '../model/Gallery.php';

$gallery = new Gallery();

if (isset($_GET['op'])) {
  // Cargar todas las fotografias
  function loadGallery($data, $visible, $portada, $perfil, $NoCollapse){

    if (count($data) > 0) {
      foreach ($data as $row) {
        echo
        "
        <div class='col-md-3 user-cd-img'>
            <div class='image-container'>
                <figure>
                    <img src='./dist/img/user/{$row['archivo']}'>
                    ";
          if($NoCollapse === false){
              echo "
                  </figure>
                </div>
            </div>";
          }else{
            echo
            "
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
            </div>";
          }
      }
    }else{
      echo
      "
      <div class='col-md-3' {$visible}>
        <div class='add-img-cd' title='Sin archivos'>
          <h5>Sin Archivos</h5>
        </div>
      </div>
      ";
    }

    if($NoCollapse){
      echo
      "
        <div class='col-md-3' {$visible}>
          <div class='add-img-cd' title='Subir una imágen a mi galería' id='agr-gal'>
            <i class='fas fa-camera'></i>
          </div>
        </div>
        ";
    }
  }

  // Cargar contenido en el modal de las fotografias
  function loadGalleryView($data){
    
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
                    <img src='./dist/img/user/{$data[0]['archivo']}'>
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

    $dataPer = $gallery->getIDAlbum(["idusuario" => $idusuario , "tipoalbum" => 'PE']);
    $dataPor = $gallery->getIDAlbum(["idusuario" => $idusuario , "tipoalbum" => 'PO']);

    $data = $gallery->getGalleriesByUser(["idusuario" => $idusuario]);

    loadGallery($data, $visible, $dataPor[0]['idalbum'], $dataPer[0]['idalbum'], true);
  }

  // Cargar todas las fotografias dentro de un collapse
  if ($_GET['op'] == 'listGalleryFromAlbum') {
    $visible;
    $idusuario;

    if($_GET['idusuarioactivo'] != -1){
      $idusuario = $_GET['idusuarioactivo'];
      $visible = 'hidden';
    } else {
      $idusuario = $_SESSION['idusuario'];
      $visible = 'visible';
    }

    $dataPer = $gallery->getIDAlbum(["idusuario" => $idusuario , "tipoalbum" => 'PE']);
    $dataPor = $gallery->getIDAlbum(["idusuario" => $idusuario , "tipoalbum" => 'PO']);
    
    $data = $gallery->getGalleriesByAlbum(["idalbum" => $_GET['idalbum']]);
    loadGallery($data, $visible, $dataPor[0]['idalbum'], $dataPer[0]['idalbum'], false);
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

  if($_GET['op'] == 'getAPicturePort'){
    $idusuario;

    if($_GET['idusuarioactivo'] != -1){
      $idusuario = $_GET['idusuarioactivo'];
    } else {
      $idusuario = $_SESSION['idusuario'];
    }

    $data = $gallery->getPortPicture(["idusuario" => $idusuario]);
    echo json_encode($data);
  }

  if($_GET['op'] == 'getAPicturePerfil'){
    $idusuario;

    if($_GET['idusuarioactivo'] != -1){
      $idusuario = $_GET['idusuarioactivo'];
    } else {
      $idusuario = $_SESSION['idusuario'];
    }

    $data = $gallery->getProfilePicture(["idusuario" => $idusuario]);
    echo json_encode($data);
  }
}

if (isset($_POST['op'])){
  
  // Para encriptar fotos
  function encripPhoto(){
      $lenght = 15;
      $base = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $longitud = strlen($base);
      $code = '';
      for($i = 0; $i < $lenght; $i++){
          $random = $base[mt_rand(0, $longitud -1)];
          $code .= $random;
      }
  
      return $code;
  }

  if($_POST['op'] == "registerGalleryPhotos"){
    if(isset($_FILES['archivo'])){
      if(is_array(($_FILES))){
        foreach($_FILES['archivo']['name'] as $key => $value){
          $ext = explode('.', $_FILES['archivo']['name'][$key]);
          $extension = encripPhoto() . date('Ymdhis') . '.' . end($ext);
          
          $gallery->registerGallery([
            "idalbum"       => $_POST['idalbum'],
            "idusuario"     => $_SESSION['idusuario'],
            "idtrabajo"     => " ",
            "tipo"          => "F",
            "archivo"       => $extension,
            "estado"        => "1"
          ]);
          
          move_uploaded_file($_FILES['archivo']['tmp_name'][$key], "../dist/img/user/" . $extension);
        }
      }
    }
  }

  if($_POST['op'] == "updateGallery"){

    $enviard =  [   
        "idgaleria"     => $_POST['idgaleria'],
        "idalbum"       => $_POST['idalbum'],
        "estado"        => '1'
    ];

    $gallery->updateGallery($enviard);
  }
  
  if($_POST['op'] == "updateUserPerfilPort"){ 
      $dataPor = $gallery->getPortPicture(["idusuario" => $_SESSION['idusuario']]);
      $dataPer = $gallery->getProfilePicture(["idusuario" => $_SESSION['idusuario']]);
      $regIDAlbumPer = $gallery->getIDAlbum(["idusuario" => $_SESSION['idusuario'] , "tipoalbum" => 'PE']);
      $regIDAlbumPor = $gallery->getIDAlbum(["idusuario" => $_SESSION['idusuario'], "tipoalbum" => 'PO']);


      if(isset($_FILES['archivo'])){
          $ext = explode('.', $_FILES['archivo']['name']);
          $image = encripPhoto().date('Ymdhis'). '.' . end($ext);

    
          //Portada
          if($_POST['estado'] == 'true'){
            if(count($dataPor) != 0){
              $idporgal = $dataPor[0]['idgaleria'];
              $idalbumpor = $dataPor[0]['idalbum'];
  
              $enviarDat = [
                  'idgaleria' => $idporgal,
                  'idalbum'   => $idalbumpor,
                  'estado'    => '1'
              ];
              
              $gallery->updateGallery($enviarDat);
            }                  

            $datregister = [
                "idalbum"       => $regIDAlbumPor[0]['idalbum'],
                "idusuario"     => $_SESSION['idusuario'],
                "idtrabajo"     => " ",
                "tipo"          => "F",
                "archivo"       => $image,
                "estado"        => "3"
            ];

            $gallery->registerGallery($datregister);
            move_uploaded_file($_FILES['archivo']['tmp_name'], "../dist/img/user/" . $image);
            
          }else{
              if(count($dataPer) != 0){
                $idpergal = $dataPer[0]['idgaleria'];
                $idalbumper = $dataPer[0]['idalbum'];
                
                $enviarDat =
                [
                    'idgaleria' => $idpergal,
                    'idalbum'   => $idalbumper,
                    'estado'    => '1'
                ];
                $gallery->updateGallery($enviarDat);
              }
              
              $datregister = [
                  "idalbum"       => $regIDAlbumPer[0]['idalbum'],
                  "idusuario"     => $_SESSION['idusuario'],
                  "idtrabajo"     => " ",
                  "tipo"          => "F",
                  "archivo"       => $image,
                  "estado"        => "2"
              ];
              
              $gallery->registerGallery($datregister);
              move_uploaded_file($_FILES['archivo']['tmp_name'], "../dist/img/user/" . $image);
          }
           
      }else{
          echo "ERROR";
      }    
  }
}
?>