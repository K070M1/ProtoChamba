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

  //Listar usuario por correo
  /*  if($_GET['op'] == 'loginUser'){
    $response = [];
    //error_reporting(0);
    try {
      $data = $user->loginUser(["email" => $_GET['email']]);
      if ($data) {
        $clave = isset($_GET["clave"]) ? $_GET["clave"] : null;
        $clavefuerte = $data[0]["clave"];
        if (password_verify($clave, $clavefuerte)) {
          $response['message'] = 'Acceso permitido';
          // Establecer variables de sesión (opcional)
        } else {
          throw new Exception("La contraseña es incorrecta", 1);
        }
      } else {
        throw new Exception("El usuario no existe", 1);
      }
      $response['status'] = 200;
    } catch (Exception $e) {
      $response['status'] = 400;
      $response['message'] = $e->getMessage();
    } finally {
      http_response_code($response['status']);
      echo json_encode($response);
    }
  } */

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
}
