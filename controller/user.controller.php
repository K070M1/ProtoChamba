<?php

require_once '../model/User.php';
require_once '../model/Person.php';
require_once '../model/Album.php';
// Objeto user
$user = new User();
$person  = new Person();
$album = new Album();

if (isset($_GET['op'])) {

  //Listar usuario por correo
<<<<<<< HEAD
  if ($_GET['op'] == 'loginUser') {
=======
 /*  if($_GET['op'] == 'loginUser'){
>>>>>>> dca0b708ca2faec3bb838944620da27932926045
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

  // Generar estructura HTML listando todos los usuarios  (Todos)
  function loadAllDataTable($data){

    if (count($data) <= 0) {
      echo " ";
    } else {
      // Mostrar registros
      $isAdmin = "";
      foreach ($data as $row) {
        $isAdmin = $row->rol == 'A' ? 'checked' : '';

        echo "
          <tr>
            <td align='center'>
              <img src='dist/img/default_profile_avatar.svg' alt='Product 1' class='img-circle img-size-32 mr-2'>
            </td>
            <td>{$row->nombres} {$row->apellidos}</td>
            <td>{$row->fechaalta}</td>  
            <td align='center'>
              <div class='custom-control custom-switch'>
                <input type='checkbox' class='custom-control-input' id='customSwitch-" . $row->idusuario . "' {$isAdmin}>
                <label class='custom-control-label' for='customSwitch-" . $row->idusuario . "'></label>
              </div>
            </td>
          </tr>
        ";
      }
    }
  }

  // Generar estructura HTML listando todos los usuarios (Filtrados)
  function loadFilteredDataTable($data){

    if (count($data) <= 0) {
      echo " ";
    } else {
      // Mostrar registros
      $isAdmin = "";
      foreach ($data as $row) {
        $isAdmin = $row['rol'] == 'A' ? 'checked' : '';

        echo "
          <tr>
            <td align='center'>
              <img src='dist/img/default_profile_avatar.svg' alt='Product 1' class='img-circle img-size-32 mr-2'>
            </td>
            <td>{$row['nombres']} {$row['apellidos']}</td>
            <td>{$row['fechaalta']}</td>
            <td align='center'>
              <div class='custom-control custom-switch'>
                <input type='checkbox' class='custom-control-input' id='customSwitch-" . $row['idusuario'] . "' {$isAdmin}>
                <label class='custom-control-label' for='customSwitch-" . $row['idusuario'] . "'></label>
              </div>
            </td>
          </tr>
        ";
      }
    }
  }

  // Generar estructura de tipo lista (Lista)
  function loadListUsers($data){
    $user = new User();
    if (count($data) <= 0) {
      echo " ";
    } else {
      // Mostrar registros
      foreach ($data as $row) {
        echo "
        <tr>
          <td>";


        //$data = $user->getProfilePicture();

          echo "<img class='table-avatar' src='dist/img/default_profile_avatar.svg'>
          </td>
          <td>
            {$row->nombres} {$row->apellidos}
          </td>
          <td class='project-actions text-right'>
            <a class='btn btn-danger btn-sm' href='#' title='Banear cuenta'>
              <i class='fas fa-ban'></i>
            </a>
          </td>
        </tr>
        ";
      }
    }
  }

  // Listar los usuaros filtrados - (Reportes)
  function loadListUsersHistory($data){
    if (count($data) <= 0) {
      echo "
      <tr>
        <td>
          <img class='table-avatar' src='dist/img/default_profile_avatar.svg'>
        </td>
        <td>
          rgutierrez
        </td>
        <td class='project-actions text-right'>
          <a class='btn btn-danger btn-sm' href='' title='Banear cuenta'>
            <i class='fas fa-ban'></i>
          </a>
        </td>
      </tr>
      ";
    } else {
      // Mostrar registros
      foreach ($data as $row) {
        echo "
        <tr>
          <td>
            <img class='table-avatar' src='dist/img/default_profile_avatar.svg'>
          </td>
          <td>
            {$row['nombres']} {$row['apellidos']}
          </td>
          <td class='project-actions text-right'>
            <a class='btn btn-danger btn-sm' href='#' title='Banear cuenta'>
              <i class='fas fa-ban'></i>
            </a>
          </td>
        </tr>
        ";
      }
    }
  }

  // Listar todos los usuarios
  if ($_GET['op'] == 'getUsers') {
    $data = $user->getUsers();
    loadAllDataTable($data);
  }

  // Listrar por rol de usuario
  if ($_GET['op'] == 'usersFilteredByRlole') {
    $data = $user->usersFilteredByRlole(["rol" => $_GET['rol']]);
    loadFilteredDataTable($data);
  }

  // Busqueda realizada por nombres o apellidos - permiso de administrador
  if ($_GET['op'] == 'searchUsersByNamesPermissions') {
    $data = $user->searchUsersByNames(["search" => $_GET['search']]);
    loadFilteredDataTable($data);
  }

  // Busqueda realizada por nombres o apellidos - para reportar o bloquear 
  if ($_GET['op'] == 'searchUsersByNamesAndRole') {
    $data = $user->searchUsersByNamesAndRole(["rol" => $_GET['rol'] ,"search" => $_GET['search']]);
    loadFilteredDataTable($data);
  }

  // Busqueda realizada por nombres o apellidos - para reportar o bloquear 
  if ($_GET['op'] == 'searchUsersByNamesHistory') {
    $data = $user->searchUsersByNames(["search" => $_GET['search']]);
    loadListUsersHistory($data);
  }

  // Listar usuarios para realizar reportes
  if ($_GET['op'] == 'listUsers') {
    $data = $user->getUsers();
    loadListUsers($data);
  }

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
