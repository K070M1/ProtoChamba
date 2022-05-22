<?php
session_start();
require_once '../model/Person.php';
$person = new Person();

if (isset($_GET['op'])){


  //Personas
  function listDataPerson($data){

    if(count($data) <= 0){
      echo " ";
    }
    else{
      foreach($data as $row){


        echo "
          <tr>
            <td>
              <div class='text-right d-none' >
                <a data-idpersona='{$row['idpersona']}' class='btn btn-outline-info btn-sm modificarPerson' href='#'><i class='fas fa-edit'></i></a>  
              </div>
            </td>
          </tr>
          <tr>
            <td align='center'>
              <i class='fas fa-smile'></i>
            </td>
            <td id='no'>{$row['nombres']} {$row['apellidos']}</td>
          </tr>
          <tr>
            <td align='center'>
              <i class='fas fa-phone'></i>
            </td>
            <td id='te'>{$row['telefono']}</td>
          </tr>
          <tr>
            <td align='center'>
              <i class='fas fa-calendar-check'>
            </td>
            <td id='fe'>{$row['fechanac']}</td>
          </tr>
          
          <tr>
            <td align='center'>
              <i class='fas fa-map-marked-alt'></i>
            </td>
            <td id='ti'>{$row['tipocalle']} {$row['nombrecalle']} {$row['numerocalle']}</td>
          </tr>
          

          
        ";
      }
    }
  }

  if ($_GET['op'] == 'getPerson'){
    $idusuario;
    
    if($_GET['idusuarioactivo'] != -1){
      $idusuario = $_GET['idusuarioactivo'];
    } else {
      $idusuario = $_SESSION['idusuario'];
    }

    $data = $person->getPerson(["idpersona" => $idusuario]);
    //listDataPerson($data);
  }

  if ($_GET['op'] == 'getDataPerson'){
    $data = $person->getPerson(["idpersona" => $_SESSION['idpersona']]);
    echo json_encode($data);
  }
}


if (isset($_POST['op'])){

  // Actualizar person
  if ($_POST['op'] == 'updatePerson'){

    $datosEnviar = [
      "idpersona"       =>  $_POST["idpersona"],
      "apellidos"       =>  $_POST["apellidos"],
      "nombres"         =>  $_POST["nombres"],
      "fechanac"        =>  $_POST["fechanac"],
      "telefono"        =>  $_POST["telefono"],
      "tipocalle"       =>  $_POST["tipocalle"],
      "nombrecalle"     =>  $_POST["nombrecalle"],
      "numerocalle"     =>  $_POST["numerocalle"],
      "pisodepa"        =>  $_POST["pisodepa"]
    ];

    $person->updatePerson($datosEnviar);
  }
}
?>