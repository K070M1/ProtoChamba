<?php

require_once '../model/Specialty.php';

//creamos un objeto a partir del nombre de la clase 
$specialty = new Specialty();

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
                        <h5>{$row->datosusuario}</h5>
                        <h6>{$row->nombreservicio}</h6>
                    </div>
                  </div>
                </div>
                <div class='card-body'>
                  <div class='contacts'>
                    <a href='#'><i class='fas fa-solid fa-envelope'></i> <span>{$row->email}</span></a>
                    <a href='#'><i class='fas fa-solid fa-phone'></i> <span>{$row->telefono}</span></a>
                    <a href='#'><i class='fas fa-map-marker-alt'></i> <span>Ubicación</span></a>
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
  if($_GET['op'] == 'getSpecialty'){
    $data = $specialty->getSpecialty();
    //echo json_encode($data);
    listSpecialty($data);
  }

  // Listar especialidades por servicio
  if($_GET['op'] == 'getSpecialtyByService'){
    $data = $specialty->getSpecialtyByService(["idservicio" => $_GET['idservicio']]);
    listSpecialtyControlSelect($data);
  }

  // Listar especialidades por usuario
  if($_GET['op'] == 'getSpecialtyByUser'){
    $data = $specialty->getSpecialtyByUser(["idusuario" => 1]);
    listSpecialtyControlSelect($data);
  }
} 


?>