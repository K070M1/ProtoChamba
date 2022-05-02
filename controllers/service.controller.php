<?php

require_once '../model/Service.php';
$services = new Service();

if (isset($_GET['op'])){


  //sERVICIOS
  function listServicesUser($data){

    if(count($data) <= 0){
      echo " ";
    }
    else{
      foreach($data as $row){
        echo "
          <tr>
            <td align='center'>
              <i class='fas fa-briefcase'></i>
            </td>
            <td>{$row['nombreservicio']}</td>
          </tr>
          <hr>
          
        ";
      }
    }
  }


  if ($_GET['op'] == 'getServicesUser'){
    $idusuario;
    
    if($_GET['idusuarioactivo'] != -1){
      $idusuario = $_GET['idusuarioactivo'];
    } else {
      $idusuario = $_SESSION['idusuario'];
    }

    $data = $services->getServicesUser(["idusuario" => $idusuario]);
    listServicesUser($data);

  }


  if($_GET['op'] == 'getServices'){

    $data =  $services->getServices();

    if(count($data) > 0){
        echo "<option value='' disabled selected hidden >Seleccione:</option>";
            foreach ($data as $row){
                echo "<option value='$row->idservicio'>$row->nombreservicio</option>";
            }
    }   
  }


}


if (isset($_POST['op'])){

  if ($_POST['op'] == 'registerServicesUser'){

    $datosEnviar = [
      "nombreservicio"     =>  $_POST["nombreservicio"]
    ];

    $services->registerServicesUser($datosEnviar);

  }


}


?>