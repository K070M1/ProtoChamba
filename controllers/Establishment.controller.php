<?php
session_start();
require_once '../model/Establishment.php';
require_once '../model/Service.php';

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
        $services = listServicesByUser($row['idusuario']);
        echo "
          <div class='card' >
            <div class='card-body'>
              <table class='table es'>
                <tbody>
                  <tr><td><i class='far fa-building'></i> {$row['establecimiento']}</td></tr>
                  <tr><td><i class='fas fa-map'></i> {$row['departamento']} - {$row['provincia']} - {$row['distrito']}</td></tr>
                  <tr><td><i class='fas fa-map-marker-alt'></i> {$row['ubicacion']}</td></tr>
                  <tr><td><i class='fas fa-thumbtack'></i> {$row['referencia']}</td></tr>
                  <tr><td class='text-right'><button type='button' class='btn btn-info btn-edit-est' data-idest='{$row['idestablecimiento']}'>Editar</button></td></tr>
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
        $services = listServicesByUser($row['idusuario']);
        echo "          
          <ul>
            <li><i class='fas fa-medal'></i>{$services}</li>
            <li><i class='far fa-building'></i> {$row['establecimiento']}</li>
            <li><i class='fas fa-business-time'></i> {$row['horarioatencion']}</li>
            <li><i class='fas fa-map-marker-alt'></i> {$row['ubicacion']}</li>
            <hr>
        </ul>
          
        ";
      }
    }
    
  }

  //Establecimiento para mapas
  function listarEstablecimiento($data){

    if(count($data) <= 0){
      echo "";
    }
    else{
      foreach($data as $row){
        echo "
          <tr>
            <td align='center'>
              <i class='fas fa-business-time'></i>
            </td>
            <td>{$row['establecimiento']}</td>
            <td>
              <a class='btn btn-sm' href=''><i class='fas fa-edit'></i></a>            
            </td> 
          </tr>
          <hr>
          <tr>
            <td align='center'>
              <i class='fas fa-map-marked-alt'></i>
            </td>
            <td>{$row['tipocalle']} {$row['nombrecalle']} {$row['numerocalle']}</td>
            <td>
              <a class='btn btn-sm' href=''><i class='fas fa-edit'></i></a>            
            </td> 
          </tr>
          <hr>
          <tr>
            <td align='center'>
              <i class='fas fa-asterisk'></i>
            </td>
            <td>{$row['referencia']}</td>
            <td>
              <a class='btn btn-sm' href=''><i class='fas fa-edit'></i></a>            
            </td> 
          </tr>
          <hr>
        ";
      }
    }
  }


  // Listar servicios del usuario
  function listServicesByUser($idusuario){
    $service = new Service();
    $data = $service->getServicesUser(["idusuario" => $idusuario]);

    $services = "";
    if(count($data) > 0){
      //$services = implode(",", $data[0]['nombreservicio'])."."; //concateno el punto al final
      foreach($data as $row){
        $services .= $row['nombreservicio'] . ", ";
      }

      // Quitando la coma del ultimo elemento
      $services = substr(rtrim($services), 0, -1);
      $services .= ".";
      return $services;
    }
  }

  if ($_GET['op'] == 'getEstablishmentsByUser'){
    $idusuario;

    if(isset($_SESSION['idusuario']) && $_GET['idusuarioactivo'] == -1){
      $idusuario = $_SESSION['idusuario'];
    } else {
      $idusuario = $_GET['idusuarioactivo'];
    }

    $data = $establishment->getEstablishmentsByUser(["idusuario" => $idusuario]);
    listEstablishment($data);
    
  }

  if ($_GET['op'] == 'getEstablishmentsInfo'){
    $idusuario;
    if(isset($_SESSION['idusuario']) && $_GET['idusuarioactivo'] == -1){
      $idusuario = $_SESSION['idusuario'];
    } else {
      $idusuario = $_GET['idusuarioactivo'];
    }

    $data = $establishment->getEstablishmentsByUser(["idusuario" => $idusuario]);
    listInfo($data);
  }

  if ($_GET['op'] == 'getAEstablishment'){

    $data = $establishment->getAEstablishment(["idestablecimiento" => $_GET['idestablecimiento']]);
    //listarEstablecimiento($data);
    if($data){
      echo json_encode($data[0]);
    }
  }

  if ($_GET['op'] == 'getEstablishmentByService') {

    $data = $establishment->getEstablishmentByService([
      "nombreservicio" => $_GET['nombreservicio'],
      "nombreciudad" => $_GET['nombreciudad']
    ]);
    echo json_encode($data);
  }

  if($_GET['op'] == 'updateEstablishment'){
    $establishment->updateEstablishment([
      "idestablecimiento" => $_GET['idestablecimiento'],
      "idusuario"         => $_SESSION['idusuario'],
      "iddistrito"        => $_GET['iddistrito'],
      "establecimiento"   => $_GET['establecimiento'],
      "ruc"               => $_GET['ruc'],
      "tipocalle"         => $_GET['tipocalle'],
      "nombrecalle"       => $_GET['nombrecalle'],
      "numerocalle"       => $_GET['numerocalle'],
      "referencia"        => $_GET['referencia'],
      "latitud"           => $_GET['latitud'],
      "longitud"          => $_GET['longitud']
    ]);
  }
  
}