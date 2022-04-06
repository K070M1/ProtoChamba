<?php

require_once '../model/User.php';
// Objeto user
$user = new User();

if(isset($_GET['op'])){

  // generar estructura HTML listando todos los usuarios
  function loadAllDataTable($data){

    if(count($data) <= 0){
      echo " ";
    }
    else{
      // Mostrar registros
      $isAdmin = "";
      foreach($data as $row){
        $isAdmin = $row->rol =='A'? 'checked': '';

        echo "
          <tr>
            <td align='center'>
              <img src='dist/img/default_profile_avatar.svg' alt='Product 1' class='img-circle img-size-32 mr-2'>
            </td>
            <td>{$row->nombres} {$row->apellidos}</td>
            <td>{$row->fechaalta}</td>
            <td align='center'>
              <div class='custom-control custom-switch'>
                <input type='checkbox' class='custom-control-input' id='customSwitch-" . $row->idusuario. "' {$isAdmin}>
                <label class='custom-control-label' for='customSwitch-" . $row->idusuario . "'></label>
              </div>
            </td>
          </tr>
        ";
        
      }
    }
  }

  // generar estructura HTML listando todos los usuarios
  function loadFilteredDataTable($data){

    if(count($data) <= 0){
      echo " ";
    }
    else{
      // Mostrar registros
      $isAdmin = "";
      foreach($data as $row){
        $isAdmin = $row['rol'] =='A'? 'checked': '';

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

  // generar estructura de tipo lista
  function loadListUsers($data){
    if(count($data) <= 0){
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
            <i class='fas fa-hammer'></i>
          </a>
        </td>
      </tr>
      ";
    }
    else{
      // Mostrar registros
      foreach($data as $row){
        echo "
        <tr>
          <td>
            <img class='table-avatar' src='dist/img/default_profile_avatar.svg'>
          </td>
          <td>
            {$row->nombres} {$row->apellidos}
          </td>
          <td class='project-actions text-right'>
            <a class='btn btn-danger btn-sm' href='#' title='Banear cuenta'>
              <i class='fas fa-hammer'></i>
            </a>
          </td>
        </tr>
        ";
      }
    }
  }

  // Listar todos los usuarios
  if($_GET['op'] == 'getUsers'){
    $data = $user->getUsers();
    loadAllDataTable($data);
  }

  // Listrar por rol de usuario
  if($_GET['op'] == 'usersFilteredByRlole'){
    $data = $user->usersFilteredByRlole(["rol" => $_GET['rol']]);
    loadFilteredDataTable($data);
  }

  // Busqueda realizada por nombres o apellidos
  if($_GET['op'] == 'searchUsersByNames'){
    $data = $user->searchUsersByNames(["search" => $_GET['search']]);
    loadFilteredDataTable($data);
  }

  // Listar usuarios para realizar reportes
  if($_GET['op'] == 'listUsers'){
    $data = $user->getUsers();
    loadListUsers($data);
  }
}

?>