<?php
session_start();

require_once '../model/Specialty.php';
require_once '../model/Ubigeo.php';

//creamos un objeto a partir del nombre de la clase 
$specialty = new Specialty();
$ubigeo = new Ubigeo();

if (isset($_GET['op'])){

  //Listar los cards 
  function listSpecialty($data){

      if(count($data) == 0 ){
          echo "<h5>No hay especialidades disponibles</h5>";
      }
      else{
          foreach($data as $row){
            echo "
            <div class ='card' >
                <div class='card-header'>
                  <div class='box-left'>
                    <img src='dist/img/avatar2.png'>
                  </div>
                  <div class='box-right'>
                    <div class='icons'>
                      <i class='fas fa-star active'></i>
                      <i class='fas fa-star active'></i>
                      <i class='fas fa-star'></i>
                      <i class='fas fa-star'></i>
                      <i class='fas fa-star'></i>
                    </div>
                    <div class='name-user'>
                        <h6>{$row['datosusuario']}</h6>
                        <h6>{$row['nombreservicio']}</h6>
                    </div>
                  </div>
                </div>
                <div class='card-body'>
                  <div class='contacts'>
                    <a href='#'><i class='fas fa-solid fa-envelope'></i> <span>{$row['email']}</span></a>
                    <a href='#'><i class='fas fa-solid fa-phone'></i> <span>{$row['telefono']}</span></a>
                    <a href='#'><i class='fas fa-map-marker-alt'></i> <span>{$row['ubicacion']}</span></a>
                  </div>
                </div>
              <div class='card-footer'>
                <div class='social-media'>
                  <a href='#'><i class='fab fa-facebook-f'></i></a>     
                  <a href='#'><i class='fab fa-instagram'></i></a>     
                  <a href='#'><i class='fab fa-whatsapp'></i></a>       
                </div>
              </div>
                </div>   
                  
            ";
          }
                
      }              
  }

  function listSpecialtyLarge($data){
    if(count($data) == 0 ){
      echo "<h5>No hay especialidades disponibles</h5>";
    }
    else{
      foreach($data as $row){
        echo "
        <div class='card-blarga'>
        <div class='row'>
          <div class='col-md-4'>
          <img src='dist/img/avatar2.png'>
          </div>
          <div class='col-md-8'>
            <div class='card-body'>
              <div class='iconos'>
                <i class='fas fa-star active'></i>
                <i class='fas fa-star active'></i>
                <i class='fas fa-star'></i>
                <i class='fas fa-star'></i>
                <i class='fas fa-star'></i>
              </div>
              <div class='info-servicios'>
                <h6 class='text-white'>{$row['datosusuario']}</h6>
                <h5 class='text-white'>{$row['nombreservicio']}</h5>
                <h6 class='text-white'>Tarifa estimada : {$row['tarifa']}</h6>
                <hr style='background-color:white;'>
                <h6 class='text-white'>Establecimiento : {$row['ubicacion']}</h6>
                <div class='redes-sociales'>
                  <i class='fab fa-facebook-f'></i>
                  <i class='fab fa-instagram'></i>
                  <i class='fab fa-whatsapp'></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        
        ";
      }
    }
  }

  // listar en un control select
  function listSpecialtyControlSelect($data){
    if(count($data) == 0){
      echo " <option value=''>Sin registros</option> ";
    }
    else{
      echo " <option value=''>Seleccione</option> ";
      foreach($data as $row){
        echo "
          <option value='{$row['idespecialidad']}'>{$row['descripcion']}</option>
        ";
      }
    }
  }

  // Listar todas las especialidades
  /* if($_GET['op'] == 'getSpecialty'){
    $data = $specialty->getSpecialty();
    //echo json_encode($data);
    listSpecialty($data);
  } */
/* 
  if($_GET['op'] == 'getSpecialtyLarge'){
    $data = $specialty->getSpecialty();
    //echo json_encode($data);
    listSpecialtyLarge($data);
  } */

  // Listar especialidades por servicio
  if($_GET['op'] == 'getSpecialtyByService'){
    $data = $specialty->getSpecialtyByService(["idservicio" => $_GET['idservicio']]);
    listSpecialtyControlSelect($data);
  }

  // Listar especialidades por usuario
  if($_GET['op'] == 'getSpecialtyByUser'){
    $data = $specialty->getSpecialtyByUser(["idusuario" => $_SESSION['idusuario']]);
    listSpecialtyControlSelect($data);
  }

  //Filtrar en la opcion de vista corta
  if($_GET['op'] == 'filterSpecialty'){

      $data;

      if($_GET['iddepartamento'] == '')
        $data = $specialty->filterService(["search" => $_GET['search']]);
      else
      $data = $specialty->filterSpecialty(["iddepartamento" => $_GET['iddepartamento'] , "search" => $_GET['search']]);
      
      
      listSpecialty($data);
  }

  //Filtrar en la opcion de vista de lista
  if($_GET['op'] == 'filterSpecialtyLarge'){

    $data;

    if($_GET['iddepartamento'] == '')
      $data = $specialty->filterService(["search" => $_GET['search']]);
    else
      $data = $specialty->filterSpecialty(["iddepartamento" => $_GET['iddepartamento'] , "search" => $_GET['search']]);
    
    listSpecialtyLarge($data);
  }

  if($_GET['op'] == 'filterTarifasGrid'){
    $data = $specialty->filterTarifas(["tarifa" => $_GET['tarifa']]);
    listSpecialty($data);
  }

  if($_GET['op'] == 'filterTarifasList'){
    $data = $specialty->filterTarifas(["tarifa" => $_GET['tarifa']]);
    listSpecialtyLarge($data);
  }
} 


?>