<?php 

session_start();
require_once '../model/Album.php';

$album = new Album();


if (isset($_GET['op'])) {

  // Cargar los albumes
  function loadAlbum($data, $visible) {
    if (count($data) > 0) {
      foreach ($data as $row) {
        echo
        "
          <div class='col-md-3 user-cd-img user-cd-albm' >
            <div class='image-container' >
              <figure >
                <img src='./dist/img/albumdefa.png'>
                <h4>{$row['nombrealbum']}</h4>
                <figcaption >
                    <ul>";

                    if($row['nombrealbum'] == 'Portada' || $row['nombrealbum'] == 'Perfil' || $row['nombrealbum'] == 'Publicaciones'){
                      echo "
                        <li>
                            <i class='fas fa-folder-open btn-abr' data-alb-open='{$row['idalbum']}' data-alb-open-name='{$row['nombrealbum']}'></i>
                        </li>";
                    }else{
                      echo"
                      <li>
                          <i class='fas fa-pen btn-modif' data-alb-act='{$row['idalbum']}' {$visible}></i>
                      </li>
                      <li>
                          <i class='fas fa-trash btn-elim' data-alb-eli='{$row['idalbum']}' {$visible}></i>
                      </li>
                      <li>
                            <i class='fas fa-folder-open btn-abr' data-alb-open='{$row['idalbum']}' data-alb-open-name='{$row['nombrealbum']}'></i>
                      </li>
                        ";
                    }
                        echo "
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
        <div class='add-album-cd' title='Crear nuevo album' id='agr-albm' >
          <i class='fas fa-plus' ></i>
        </div>
      </div>
  
  ";
  }

  // Cargar el album dentro de un modal
  function loadAlbumSlcModal($data)
  {
    if (count($data) > 0) {
      echo  "<option value=''>Ninguno</option>";
      foreach ($data as $row) {
        if($row['nombrealbum'] == 'Portada' || $row['nombrealbum'] == 'Perfil'){
          continue;
        }else{
          echo
          "
            <option value='{$row['idalbum']}'>{$row['nombrealbum']}</option>
          ";
        }
      }
    }
  }

  // Cargar los albumes
  if ($_GET['op'] == 'loadAlbum') {

    $idusuario;
    $visible;

    if ($_GET['idusuarioactivo'] != -1) {
      $idusuario = $_GET['idusuarioactivo'];
      $visible = 'hidden';
    } else {
      $idusuario = $_SESSION['idusuario'];
      $visible = 'visible';
    }

    $data = $album->getAlbumsByUser(["idusuario" => $idusuario]);
    loadAlbum($data, $visible);
  }

  // Eliminar album
  if ($_GET['op'] == 'deleteAlbum') {
    $data = $album->deleteAlbum(["idalbum" => $_GET['idalbum']]);
  }

  // Traer datos del album para el modal
  if($_GET['op'] == 'getAlbumDat'){
      $data = $album->getAnAlbum(["idalbum" => $_GET['idalbum']]);
      echo json_encode($data);
  }

  // Cargar el album dentro de un modal
  if($_GET['op'] == 'loadAlbumSlcModal'){
      $data = $album->getAlbumsByUser(["idusuario" => $_SESSION['idusuario']]);
      loadAlbumSlcModal($data);
  }

  // Cargar el album dentro de un modal
  if ($_GET['op'] == 'loadAlbumSlcModal') {
    $data = $album->getAlbumsByUser(["idusuario" => $_GET['idusuario']]);
    loadAlbumSlcModal($data);
  }
}

if (isset($_POST['op'])) {
  // Registrar un album
  if($_POST['op'] == "registerAlbum"){
    $enviard = [
        "idusuario"     => $_SESSION['idusuario'],
        "nombrealbum"   => $_POST['nombrealbum']
    ];

    $data = $album->registerAlbum($enviard);
  }

  // Modificar un album
  if ($_POST['op'] == "updateAlbum") {
    $enviard =
      [
        "idalbum"     => $_POST['idalbum'],
        "nombrealbum"   => $_POST['nombrealbum']
      ];

    $data = $album->updateAlbum($enviard);
  }
}
