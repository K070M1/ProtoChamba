<?php

require_once '../model/Person.php';
require_once '../model/Service.php';
require_once '../model/Specialty.php';
require_once '../model/Follower.php';
require_once '../model/Gallery.php';

$person = new Person();
$service = new Service();
$specialty = new Specialty();
$follower = new Follower();
$gallery = new Gallery();

if (isset($_POST['op'])){

  // Funcion para encriptar foto
  function encripPhoto(){
    $lenght = 15;
    $base = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $longitud = strlen($base);
    $code = '';
    for($i = 0; $i < $lenght; $i++){
        $random = $base[mt_rand(0, $longitud -1)];
        $code .= $random;
    }

    return $code;
  }

  /*DATOS PERSONA*/ 

  if ($_POST['op'] == 'dataPersonAndroid'){
    $data = $person->getPerson(["idpersona" => $_POST['idpersona']]);
    if($data){
      echo json_encode($data);
    }
  }

  //Actualizar Persona
  if ($_POST['op'] == 'updatePersonAndroid'){
    $datosEnviar = [
      "idpersona"       =>  $_POST["idpersona"],
      "apellidos"       =>  $_POST["apellidos"],
      "nombres"         =>  $_POST["nombres"],
      "fechanac"        =>  $_POST["fechanac"],
      "telefono"        =>  $_POST["telefono"],
    ];

    $person->updatePerson($datosEnviar);
    var_dump($datosEnviar);
  }


  /*SERVICIOS CARDS*/ 

  //Listado de servicios mediante los cards
  if ($_POST['op'] == 'listServicesAndroid'){
    $data = $specialty->getSpecialty();
    if($data){
      echo json_encode($data);
    }
  }

  //Lista de Servicios
  if ($_POST['op'] == 'listServices'){
    $data = $service->getServices();
    if($data){
      echo json_encode($data);
    }
  }


  /*DATOS ESPECIALIDADES*/ 

  //Agregar especialidad por Usuario
  if ($_POST['op'] == 'registerSpeUser') {
    $datosEnviar = [
      "idusuario"        =>  $_POST['idusuario'],
      "idservicio"       =>  $_POST["idservicio"],
      "descripcion"      =>  $_POST["descripcion"],
      "tarifa"           =>  $_POST["tarifa"]
    ];
    $specialty->registerSpecialtyUser($datosEnviar);
  }

  //Listado de especialidades de un Usuario
  if ($_POST['op'] == 'listSpecial'){
    $data = $specialty->getAtSpecialty(["idusuario" => $_POST['idusuario']]);
    if($data){
      echo json_encode($data);
    }
  }


  /*DATOS REDES SOCIALES*/
  
  //Listado de seguidores por Usuario
  if ($_POST['op'] == 'getFollowerAndroid'){
    $data = $follower->getFollowersByUser(["idusuario" => $_POST['idusuario']]);
    if($data){
      echo json_encode($data);
    }
  }

  //Listado de seguidos por Usuario
  if ($_POST['op'] == 'getFollowingAndroid'){
    $data = $follower->getFollowedByUser(["idusuario" => $_POST['idusuario']]);
    if($data){
      echo json_encode($data);
    }
  }

  //Eliminar seguidor por Usuario
  if ($_POST['op'] == 'deleteFollowerAndroid'){
    $datos = [
      "idfollower"  =>  $_POST["idfollower"],
      "idfollowing"  =>  $_POST["idfollowing"]
    ];

    $follower->deleteFollower($datos);
  
  }

  // Registrar o actualizar foto de perfil 
  if($_POST['op'] == "updateUserPerfilPort"){ 
    $dataPor = $gallery->getPortPicture(["idusuario" => $_POST['idusuario']]);
    $dataPer = $gallery->getProfilePicture(["idusuario" => $_POST['idusuario']]);
    $regIDAlbumPer = $gallery->getIDAlbum(["idusuario" => $_POST['idusuario'] , "tipoalbum" => 'PE']);
    $regIDAlbumPor = $gallery->getIDAlbum(["idusuario" => $_POST['idusuario'], "tipoalbum" => 'PO']);

    if(isset($_FILES['archivo'])){
        $ext = explode('.', $_FILES['archivo']['name']);
        $image = encripPhoto().date('Ymdhis'). '.' . end($ext);

  
        //Portada
        if($_POST['estado'] == 'true'){

            if(count($dataPor) != 0){
              $idporgal = $dataPor[0]['idgaleria'];
              $idalbumpor = $dataPor[0]['idalbum'];
  
              $enviarDat =
              [
                  'idgaleria' => $idporgal,
                  'idalbum'   => $idalbumpor,
                  'estado'    => '1'
              ];
              
              $gallery->updateGallery($enviarDat);
            }

            $datregister = [
              "idalbum"       => $regIDAlbumPor[0]['idalbum'],
              "idusuario"     => $_POST['idusuario'],
              "idtrabajo"     => " ",
              "tipo"          => "F",
              "archivo"       => $image,
              "estado"        => "3"
            ];

            $gallery->registerGallery($datregister);
            move_uploaded_file($_FILES['archivo']['tmp_name'], "../dist/img/User/" . $image);
        
            // Perfil
        }else{
            if(count($dataPer) != 0){
                $idpergal = $dataPer[0]['idgaleria'];
                $idalbumper = $dataPer[0]['idalbum'];
                
                $enviarDat =
                [
                    'idgaleria' => $idpergal,
                    'idalbum'   => $idalbumper,
                    'estado'    => '1'
                ];
                $gallery->updateGallery($enviarDat);
            }
          
                $datregister = [
                    "idalbum"       => $regIDAlbumPer[0]['idalbum'],
                    "idusuario"     => $_POST['idusuario'],
                    "idtrabajo"     => " ",
                    "tipo"          => "F",
                    "archivo"       => $image,
                    "estado"        => "2"
                ];
                
                $gallery->registerGallery($datregister);
                move_uploaded_file($_FILES['archivo']['tmp_name'], "../dist/img/User/" . $image);
        } 
    }else{
        echo "ERROR";
    }
    
  }

  //Encontrar el archivo
  if($_POST['op'] == "encontrarName"){
    /* if(isset($_FILES['archivo'])){
      $ext = explode('.', $_FILES['archivo']['name']);
      $image = encripPhoto().date('Ymdhis'). '.' . end($ext);

      echo $image;
    } */
    //echo $_FILES['archivo'];
    var_dump($_FILES['archivo']);   
  }

  // Traer una foto de portada
  if($_POST['op'] == 'getAPicturePort'){
    $data = $gallery->getPortPicture(["idusuario" => $_POST['idusuario']]);
    if(count($data) == 0){
      return null;
    }else{
      echo json_encode($data);
    }
  }

  // Traer una foto de perfil
  if($_POST['op'] == 'getAPicturePerfil'){
    $data = $gallery->getProfilePicture(["idusuario" => $_POST['idusuario']]);
    if(count($data) == 0){
      return null;
    }else{
      echo json_encode($data);
    }
  }

}

?>