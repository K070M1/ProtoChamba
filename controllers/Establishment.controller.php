<?php
session_start();
require_once '../model/Establishment.php';

// Objeto establishment
$establishment = new Establishment();

if (isset($_GET['op'])) {
  // switch ($_GET['op']) {
  //   case 'getEstablishments':
  //     $data = $establishment -> getEstablishments([]);
  //     echo json_encode($data);
  //     break;
    
  //   default:
  //     # code...
  //     break;
  // }

  //Establecimiento
  function listEstablishment($data){

    if(count($data) <= 0){
      echo "";
    }
    else{
      foreach($data as $row){
        echo "
          <div class='card' style='background-color: #e2e2e27a'>
            <h5 class='card-header'>{$row['nombreservicio']}</h5>
            <div class='card-body'>
              <table class='table es'>
                <tbody>
                  <tr><td><i class='far fa-building'></i> {$row['establecimiento']}</td></tr>
                  <tr><td><i class='fas fa-business-time'></i> {$row['horarioatencion']}</td></tr>
                  <tr><td><i class='fas fa-map-marker-alt'></i> {$row['ubicacion']}</td></tr>
                  <tr><td><i class='fas fa-thumbtack'></i> {$row['referencia']}</td></tr>
                </tbody>
              </table>

            </div>
          </div>
        ";
      }
    }
  }

  function listInfo($data){

    if(count($data) <= 0){
      echo " 
        <tr>
          <td>No hay informacion</td>
        </tr>
      ";

    }
    else{
      foreach($data as $row){
        echo "
          
          <ul>
            <li><i class='fas fa-medal'></i>{$row['nombreservicio']}</li>
            <li><i class='far fa-building'></i> {$row['establecimiento']}</li>
            <li><i class='fas fa-business-time'></i> {$row['horarioatencion']}</li>
            <li><i class='fas fa-map-marker-alt'></i> {$row['ubicacion']}</li>
          </ul>
          
        ";
      }
    }
    
  }


  if ($_GET['op'] == 'getEstablishmentsByUser'){
    $idusuario;

    if($_GET['idusuarioactivo'] != -1){
      $idusuario = $_GET['idusuarioactivo'];
    } else {
      $idusuario = $_SESSION['idusuario'];
    }

    $data = $establishment->getEstablishmentsByUser(["idusuario" => $idusuario]);
    listEstablishment($data);
    
  }

  if ($_GET['op'] == 'getEstablishmentsInfo'){

    $idusuario;

    if($_GET['idusuarioactivo'] != -1){
      $idusuario = $_GET['idusuarioactivo'];
    } else {
      $idusuario = $_SESSION['idusuario'];
    }

    $data = $establishment->getEstablishmentsByUser(["idusuario" => $idusuario]);
    listInfo($data);
  }

  if ($_GET['op'] == 'getEstablishmentByService') {

    $data = $establishment->getEstablishmentByService(["nombreservicio" => $_GET['nombreservicio']]);
    echo json_encode($data);
  }
}