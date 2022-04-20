<?php

require_once '../model/User.php';
require_once '../model/Person.php';
require_once '../model/Album.php';
require_once '../model/Gallery.php';
require_once '../model/Mailer.php';

// Instancias de objetos
$user = new User();
$person  = new Person();
$album = new Album();
$mailer = new Mailer();


if (isset($_GET['op'])) {

  // Generar estructura HTML listando todos los usuarios (vista permisos)
  function loadUsersViewPermissions($data){

    if (count($data) == 0) {
      echo " ";
    } else {
      // Mostrar registros
      foreach ($data as $row) {
        $isAdmin = $row['rol'] == 'A' ? 'checked' : '';    

        $getImage = getImageProfileUser($row['idusuario']);
        $imageProfile = $getImage != ''? $getImage : 'default_profile_avatar.svg'; 

        echo "
          <tr>
            <td align='center'>
              <img src='dist/img/{$imageProfile}' class='img-circle img-size-32 mr-2'>
            </td> 
            <td>{$row['nombres']}</td>
            <td>{$row['fechaalta']}</td>
            <td align='center'>
              <div class='custom-control custom-switch'>
                <input type='checkbox' class='custom-control-input switch-role' id='{$row['idusuario']}' {$isAdmin}>
                <label class='custom-control-label' for='{$row['idusuario']}'></label>
              </div>
            </td>
          </tr>
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

  // Listar los usuaros filtrados - (vista reportes)
  function loadListUsersViewHistory($data){
    if (count($data) == 0) {
      echo "
        <tr>
          <td colspan='3'>No se encontrarón registros</td>
        </tr>
      ";
    } else {
      // Mostrar registros
      foreach ($data as $row) {
        $classIcon = $row['estado'] == 1? "fa-user-slash": "fa-user-check";
        $classBtn = $row['estado'] == 1? "btn-danger": "btn-primary";
        $title = $row['estado'] == 1? "Banear cuenta": "Activar cuenta";

        $getImage = getImageProfileUser($row['idusuario']);
        $imageProfile = $getImage != ''? $getImage : 'default_profile_avatar.svg'; 

        echo "
          <tr>
            <td>
              <img class='table-avatar' src='dist/img/{$imageProfile}'>
            </td>
            <td>
              {$row['nombres']}
            </td>
            <td class='project-actions text-right'>
              <a class='btn {$classBtn} btn-sm btn-ban-user' href='#' title='{$title}' data-code='{$row['idusuario']}' data-condition='{$row['estado']}'>            
                <i class='fas {$classIcon}'></i>
              </a>
            </td>
          </tr>
        ";
      }
    }
  }


  function Descripcion($data){

    if (count($data) <= 0) {
      echo " ";
    } else {
      foreach ($data as $row) {
        echo "
          <p>{$row['descripcion']}</p>
        ";
      }
    }
  }

  //Descripcion
  if ($_GET['op'] == 'getUsersDescrip') {
    $data = $user->getUsersDescrip(["idusuario" => 1]);
    Descripcion($data);
  }



  // Busqueda realizada por nombres o apellidos - (Asignar permisos admin)
  if ($_GET['op'] == 'searchUsersByNamesAndRole') {

    $data;

    if($_GET['rol'] == '')
      $data = $user->searchUsersByNames(["search" => $_GET['search']]);
    else
      $data = $user->searchUsersByNamesAndRole(["rol" => $_GET['rol'], "search" => $_GET['search']]);    

    loadUsersViewPermissions($data);
  }

  // Busqueda realizada por nombres o apellidos - (lista de usuario en reportes)
  if ($_GET['op'] == 'searchUsersByNamesViewHistory') {
    $data = $user->searchUsersByNames(["search" => $_GET['search']]);
    loadListUsersViewHistory($data);
  }

  // Camvbiar rol de usuario
  if($_GET['op'] == 'updateUserRole'){
    $user->updateUserRole(["idusuario" => $_GET['idusuario'],  "rol" => $_GET['rol']]);
  }

  // banear usuario
  if($_GET['op'] == 'banUser'){
    $data = $user->getAUser(["idusuario" => $_GET['idusuario']]);
    $user->banUser(["idusuario" => $_GET['idusuario']]);
    
    $mailer->sendMail($data[0]['email'], "Su cuenta a sido baneado temporalmente debido a...");
    //echo json_encode($data[0]['email']);
  }

  // banear usuario
  if($_GET['op'] == 'reactivateUser'){
    $data = $user->getAUser(["idusuario" => $_GET['idusuario']]);
    $user->reactivateUser(["idusuario" => $_GET['idusuario']]);
    $mailer->sendMail($data[0]['email'], "Su cuenta a sido restablecido");
    //echo json_encode($data[0]['email']);
  }

  // verificar correo
  if ($_GET['op'] == 'EmailVerifi') {
    $data = $user->getEmailV(["email" => $_GET['email']]);
    if ($data == 0) {
      echo "permitido";
    } else {
      echo "No permitido";
    }
  }
}

//METODO POST

if (isset($_POST['op'])) {

  //Registrar usuario
  if ($_POST['op'] == 'registerUser') {

    $emailverifi = $user->getEmailV(["email" => $_POST['email']]);

    if ($emailverifi == 0) {
      $datosIngresados = [
        "iddistrito" => $_POST['iddistrito'],
        "apellidos"  => $_POST['apellidos'],
        "nombres"    => $_POST['nombres'],
        "fechanac"   => $_POST['fechanac'],
        "telefono"   => $_POST['telefono'],
        "tipocalle"  => $_POST['tipocalle'],
        "nombrecalle" => $_POST['nombrecalle'],
        "numerocalle" => $_POST['numerocalle'],
        "pisodepa"    => $_POST['pisodepa']
      ];

      $idperson = $person->registerPerson($datosIngresados);

      $datosRegistrar = [
        "idpersona"       => $idperson,
        "descripcion"     => " ",
        "horarioatencion" => " ",
        "email"           => $_POST['email'],
        "emailrespaldo"   => " ",
        "clave"           => password_hash($_POST['clave'], PASSWORD_BCRYPT)
      ];

      $iduser = $user->registerUser($datosRegistrar);

      $album->registerAlbumDefault(["idusuario" => $iduser]);
      echo "Correct";
    } else {
      echo ".";
    }
  }

  if($_POST['op'] == 'updatePasswordRest'){
    $datosUp = [
      "idusuario" => $_POST['idusuario'],
      "clave"  => password_hash($_POST['clave'], PASSWORD_BCRYPT)
    ];

    $user->updatePasswordRest($datosUp);
  }

  // modificar descripcion de un usuario
  if ($_POST['op'] == 'updateDescrip'){

    $datosEnviar = [
      "idusuario"       =>  1,
      "descripcion"      =>  $_POST["descripcion"]
    ];

    $user->updateDescrip($datosEnviar);
  }

  if($_POST['op'] == "registerGalleryPhotos"){

    $idtypefile = $_POST['tipoarchivo'];

    if($idtypefile == 'image/png'){
        $extension = date('YmdhGs') . ".png";
    }else if($idtypefile == 'image/jpeg'){
        $extension = date('YmdhGs') . ".jpg";
    }else{
        $extension = date('YmdhGs') . ".gif";
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
    move_uploaded_file($_FILES['archivo']['tmp_name'], "../dist/img/User/" . $extension);
    echo $_FILES['archivo']['tmp_name'];
    echo $extension;
}
}
