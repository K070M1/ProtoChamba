<?php
session_start();
require_once '../model/Establishment.php';
require_once '../model/Service.php';
require_once '../model/User.php';

// Objeto establishment
$establishment = new Establishment();

if (isset($_GET['op'])) {
  //Establecimiento
  function listEstablishment($data, $visible){

    if(count($data) <= 0){
      echo "
        <div class='card card-body'>
          <span>Sin establecimiento</span>
        </div>
      ";
    }
    else{
      foreach($data as $row){
        echo "
          <div class='card' >
            <div class='card-body'>
              <table class='table es'>
                <tbody>
                  <tr><td><i class='far fa-building'></i> {$row['establecimiento']}</td></tr>
                  <tr><td><i class='fas fa-map'></i> {$row['departamento']} - {$row['provincia']} - {$row['distrito']}</td></tr>
                  <tr><td><i class='fas fa-map-marker-alt'></i> {$row['ubicacion']}</td></tr>
                  <tr><td><i class='fas fa-thumbtack'></i> {$row['referencia']}</td></tr>
                  <tr>
                    <td class='text-right' {$visible}>
                      <button type='button' class='btn btn-sm btn-outline-danger btn-delete-est' data-idest='{$row['idestablecimiento']}'>Eliminar</button>
                      <button type='button' class='btn btn-sm btn-outline-info btn-edit-est' data-idest='{$row['idestablecimiento']}'>Editar</button>
                   </td>
                  </tr>
                </tbody>
              </table>

            </div>
          </div>
        ";
      }
    }
  }

  // Listar en información - sección general del perfil
  function listInfo($data){

    if(count($data) <= 0){
      echo "<span>No hay información</span>";
    } else {
      foreach($data as $row){
        $services = listServicesByUser($row['idusuario']);
        $establishments = listEstablishmentByuser($row['idusuario']);
        echo "          
          <ul>
            <li><i class='fas fa-medal'></i> <span>{$services}</span></li>
            <li><i class='far fa-building'></i> <span>{$establishments}</span></li>
            <li><i class='fas fa-business-time'></i> <span>{$row['horarioatencion']}</span></li>
            <li><i class='fas fa-map-marker-alt'></i> <span>{$row['direccion']}</span></li>
          </ul>          
        ";
      }
    }
    
  }

  //Establecimiento para mapas
  function listarEstablecimiento($data){

    if(count($data) <= 0){
      echo "<span>Sin establecimientos</span>";
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
      foreach($data as $row){
        $services .= $row['nombreservicio'] . ", ";
      }
    } else {
      $services = "Sin servicios,";
    }

    // substr (cadena, indice inicial, tamaño)
    // Cambiando la coma del ultimo elemento por un punto
    $services = substr(rtrim($services), 0, -1);
    $services .= ".";
    return $services;
  }

  // Listar establecimientos del usuario - sección general del perfil
  function listEstablishmentByuser($idusuario){
    $establishment = new Establishment();
    $data = $establishment->getEstablishmentsByUser(["idusuario" => $idusuario]);

    $establishments = "";
    if(count($data) > 0){
      foreach($data as $row){
        $establishments .= $row['establecimiento'] . ", ";
      }
    } else {
      $establishments = "Sin establecimiento,";
    }   

    // Cambiando la coma del ultimo elemento por un punto
    $establishments = substr(rtrim($establishments), 0, -1);
    $establishments .= ".";
    return $establishments;
  }

  if ($_GET['op'] == 'getEstablishmentsByUser'){
    $idusuario;
    $visible;
    
    if(isset($_SESSION['idusuario']) && $_GET['idusuarioactivo'] == -1){
      $idusuario = $_SESSION['idusuario'];
      $visible = "visible";
    } else {
      $idusuario = $_GET['idusuarioactivo'];
      $visible = "hidden";
    }

    $data = $establishment->getEstablishmentsByUser(["idusuario" => $idusuario]);
    listEstablishment($data, $visible);
    
  }

  if ($_GET['op'] == 'getEstablishmentsInfo'){
    $user = new User();

    $idusuario;

    if(isset($_SESSION['idusuario']) && $_GET['idusuarioactivo'] == -1){
      $idusuario = $_SESSION['idusuario'];
    } else {
      $idusuario = $_GET['idusuarioactivo'];
    }

    $data = $user->getAUser(["idusuario" => $idusuario]);
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

  if($_GET['op'] == 'registerEstablishment'){
    $establishment->registerEstablishment([
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

  if($_GET['op'] == 'deleteEstablishment'){
    $establishment->deleteEstablishment(["idestablecimiento" => $_GET['idestablecimiento']]);
  }
  
}