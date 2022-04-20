<?php

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
  function listFollowing($data){

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
            <td>
              <a href='#' data-idfollowing='{$row['idfollowing']}' class='btn btn-danger btn-sm modificar' title='Dejar de seguir' ><i class='fas fa-user-minus'></i></a> 
            </td>
          </tr>
        ";
      }
    }
    
  }
  
  // Operacion Seguidores
  if ($_GET['op'] == 'getFollowersByUser'){

    $data = $follower->getFollowersByUser(["idusuario" => 1]);
    listFollower($data);
  }

  // Operación Seguidos
  if ($_GET['op'] == 'getFollowedByUser'){

    $data = $follower->getFollowedByUser(["idusuario" => 1]); //$_GET['idusuario']]
    listFollowing($data);
  }


  //Conteo de seguidores
  if ($_GET['op'] == 'getCountFollowersByUser'){
    
    $data = $follower->getCountFollowersByUser(["idusuario" => 1]);

    if($data <= 0){
      echo "0";
    }
    else{
      echo json_encode($data);
    }
  }

  //Conteo de seguidos
  if ($_GET['op'] == 'getCountFollowedByUser'){
  
    $data = $follower->getCountFollowedByUser(["idusuario" => 1]);

    if($data <= 0){
      echo "0";
    }
    else{
      echo json_encode($data);
    }
  }

}


// METODO POST

if (isset($_POST['op'])){

  // Dejar de Seguir
  if ($_POST['op'] == 'deleteFoller'){

      $datosEnviar = [
        "idfollower"       =>  1,
        "idfollowing"      =>  $_POST["idfollowing"]
      ];

      $follower->deleteFoller($datosEnviar);
  }


}

?>