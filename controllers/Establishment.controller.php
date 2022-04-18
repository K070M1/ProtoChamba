<?php
require_once '../model/Establishment.php';

// Objeto establishment
$establecimiento = new Establishment();

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



  if ($_GET['op'] == 'getAEstablishment'){

    $data = $establecimiento->getAEstablishment(["idestablecimiento" => 1]);
    listarEstablecimiento($data);
    
  }

  if ($_GET['op'] == 'getEstablishmentByService'){

    $data = $establecimiento->getEstablishmentByService(["nombreservicio" => $_GET['nombreservicio']]);
    echo json_encode($data);
    
  }
}