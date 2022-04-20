<?php
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
            <li><iframe src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15523.146567111802!2d-76.14548722093855!3d-13.425529598205369!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91101686897e15b7%3A0x471a0acba7a881d!2sChincha%20Alta%2011702!5e0!3m2!1ses!2spe!4v1648176214359!5m2!1ses!2spe' width='800' height='600' style='border:0;' allowfullscreen='' loading='lazy' referrerpolicy='no-referrer-when-downgrade'></iframe></li>
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



  if ($_GET['op'] == 'getEstablishmentsByUser'){

    $data = $establishment->getEstablishmentsByUser(["idusuario" => 1]);
    listEstablishment($data);
    
  }

  if ($_GET['op'] == 'getEstablishmentsInfo'){

    $data = $establishment->getEstablishmentsByUser(["idusuario" => 1]);
    listInfo($data);
  }

  if ($_GET['op'] == 'getAEstablishment'){

    $data = $establishment->getAEstablishment(["idestablecimiento" => 1]);
    listarEstablecimiento($data);
  }

  if ($_GET['op'] == 'getEstablishmentByService') {

    $data = $establishment->getEstablishmentByService(["nombreservicio" => $_GET['nombreservicio']]);
    echo json_encode($data);
  }
}