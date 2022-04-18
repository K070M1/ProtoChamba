<?php

require_once '../model/Person.php';
$persona = new Person();

if (isset($_GET['op'])){

  function nombre($data){
    foreach($data as $row){
      echo "
        <tr>
          <td>{$row['nombres']} {$row['apellidos']}</td>      
        </tr>
      
      ";
    }
  }


  //Personas
  function listDatosPerson($data){

    if(count($data) <= 0){
      echo " ";
    }
    else{
      foreach($data as $row){
        echo "
          <tr>
            <td align='center'>
              <i class='fas fa-smile'></i>
            </td>
            <td>{$row['nombres']} {$row['apellidos']}</td>
            <td>
              <a class='btn btn-sm' href=''><i class='fas fa-edit'></i></a>            
            </td> 
          </tr>
          <hr>
          <tr>
            <td align='center'>
              <i class='fas fa-phone'></i>
            </td>
            <td>{$row['telefono']}</td>
            <td>
              <a class='btn btn-sm' href=''><i class='fas fa-edit'></i></a>            
            </td> 
          </tr>
          <hr>
          <tr>
            <td align='center'>
              <i class='fas fa-calendar-check'>
            </td>
            <td>{$row['fechanac']}</td>
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
          
        ";
      }
    }
  }

  if ($_GET['op'] == 'getPerson'){

    $data = $persona->getPerson(["idpersona" => 2]);
    listDatosPerson($data);
  }

  if ($_GET['op'] == 'getPersona'){

    $data = $persona->getPerson(["idpersona" => 1]);
    nombre($data);
  }

}


?>