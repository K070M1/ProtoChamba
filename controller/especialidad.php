<?php

require_once '../model/especialidad.php';

//creamos un objeto a partir del nombre de la clase 
$especialidad = new Especialidad();

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
                            <h6>{$row->datosusuario}</h6>
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
    }

    if($_GET['op'] == 'getSpecialty'){
        $data=$especialidad->getSpecialty();
        listSpecialty($data);
    }




?>