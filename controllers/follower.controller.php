<?php
session_start();

require_once '../model/Follower.php';
$follower = new Follower();

if (isset($_GET['op'])){


  //Listado de Seguidores
  function listFollower($data){

    if(count($data) <= 0){
      echo "
        <tr>
          <td>No cuentas con seguidores</td>
        </tr>
      ";
    }
    else{
      foreach($data as $row){
        echo "
          <tr>
            <td align='center'>
              <img src='dist/img/default_profile_avatar.svg' alt='Product 1' class='img-circle img-size-32 mr-2'>
            </td>
            <td>{$row['nombres']} {$row['apellidos']}</td>
          </tr>
        ";
      }
    }
      
  }
      
  //Listado de Seguidos
  function listFollowing($data, $visible){

    if(count($data) <= 0){
      echo " 
        <tr>
          <td>No sigues a nadie</td>
        </tr>
      ";

    }
    else{
      foreach($data as $row){
        echo "
          <tr>
            <td align='center'>
              <img src='dist/img/default_profile_avatar.svg' alt='' class='img-circle img-size-32 mr-2'>
            </td>
            <td>{$row['nombres']} {$row['apellidos']}</td>
            <td {$visible}>
              <a href='#' data-idfollowing='{$row['idfollowing']}' class='btn btn-danger btn-sm modificar' title='Dejar de seguir' ><i class='fas fa-user-minus'></i></a> 
            </td>
          </tr>
        ";
      }
    }
    
  }
  
  // Operacion Seguidores
  if ($_GET['op'] == 'getFollowersByUser'){
    $idusuario;
    
    if($_GET['idusuarioactivo'] != -1){
      $idusuario = $_GET['idusuarioactivo'];
    } else {
      $idusuario = $_SESSION['idusuario'];
    }

    $data = $follower->getFollowersByUser(["idusuario" => $idusuario]);
    listFollower($data);
  }

  // Operación Seguidos
  if ($_GET['op'] == 'getFollowedByUser'){
    $idusuario;
    $visible;
    
    if($_GET['idusuarioactivo'] != -1){
      $idusuario = $_GET['idusuarioactivo'];
      $visible = 'hidden';
    } else {
      $idusuario = $_SESSION['idusuario'];
      $visible = 'visible';
    }

    $data = $follower->getFollowedByUser(["idusuario" => $idusuario]); //$_GET['idusuario']]
    listFollowing($data, $visible);
  }


  //Conteo de seguidores
  if ($_GET['op'] == 'getCountFollowersByUser'){
    $data;

    if($_GET['idusuarioactivo'] == -1 && isset($_SESSION['idusuario'])){
      $data = $follower->getCountFollowersByUser(["idusuario" => $_SESSION['idusuario']]);
    } else {
      $data = $follower->getCountFollowersByUser(["idusuario" => $_GET['idusuarioactivo']]);
    }

    if($data <= 0){
      echo "0";
    }
    else{
      echo json_encode($data);
    }
    
  }

  //Conteo de seguidos
  if ($_GET['op'] == 'getCountFollowedByUser'){
    $dat;

    
    if($_GET['idusuarioactivo'] == -1 && isset($_SESSION['idusuario'])){
      $data = $follower->getCountFollowedByUser(["idusuario" => $_SESSION['idusuario']]);
    } else {
      $data = $follower->getCountFollowedByUser(["idusuario" => $_GET['idusuarioactivo']]);
    }

    if($data <= 0){
      echo "0";
    }
    else{
      echo json_encode($data);
    }

  }

  // Registrar seguidor
  if ($_GET['op'] == 'registerFollower'){
    if(isset($_SESSION['idusuario'])){
      $follower->registerFollower(["idfollowing" => $_GET['idusuarioactivo'], "idfollower" => $_SESSION['idusuario']]);
    } else {
      echo "Iniciar sesión";
    }
  }

  // validar si ya esta seguido por el usuario que inicio sesion
  if($_GET['op'] == 'validateFollower'){
    $data = $follower->getFollowersByUser(["idusuario" => $_GET['idusuarioactivo']]);
    $value = "Seguir";
    
    if(isset($_SESSION['idusuario'])){
      if(count($data) > 0){
        foreach($data as $row){
          if ($row['idfollower'] == $_SESSION['idusuario']){
            $value = "Seguido";
          }
        }
      }
    }

    echo $value;
  }

  // Dejar de Seguir
  if ($_GET['op'] == 'deleteFollower'){

    $datosEnviar = [
      "idfollower"       =>  $_SESSION['idusuario'],
      "idfollowing"      =>  $_GET["idfollowing"]
    ];

    $follower->deleteFollower($datosEnviar);
}

}

?>