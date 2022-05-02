<?php
session_start();
$_SESSION['imgdefault'] = "default_profile_avatar.svg";

require_once '../model/Ubigeo.php';
require_once '../model/Service.php';
require_once '../model/Gallery.php';
require_once '../model/Specialty.php';
require_once '../model/Qualify.php';
require_once '../model/RedSocial.php';

//creamos un objeto a partir del nombre de la clase 
$service = new Service();
$specialty = new Specialty();
$ubigeo = new Ubigeo();

if (isset($_GET['op'])) {

  // generar carouseles
  function generateCarousels($data)
  {
    if (count($data) == 0) {
      echo '';
    } else {
      foreach ($data as $row) {
        // Obtener el numero de especialidades de acuerdo al servicio
        $numberOfSpecialties = countSpecialties($row->idservicio);
        $cardDisabled = $numberOfSpecialties <= 5 ? 'disabled' : 'enabled';

        if ($numberOfSpecialties > 0) {
          echo "
          <div class='card'>
            <div class='card-header'>
              <div class='row'>
                <div class='col-6 col-xs-6'>
                  <h5 class='text-bold'>{$row->nombreservicio} <span class='badge badge-primary'> {$numberOfSpecialties}</span></h5>
                </div>
                <div class='col-6 col-xs-6 text-right'>
                  <button type='button' class='btn btn-sm btn-dark btn-more-content' data-more='{$row->idservicio}' {$cardDisabled}> Ver más</button>
                </div>
              </div>
            </div>
            <div class='card-body  pt-2' data-more='{$row->idservicio}'>
              <div class='owl-carousel'>";
          generateUserCards($row->idservicio);
          echo "
              </div> <!-- /. carousel -->
            </div>
          </div>
          ";
        }
      }
    }
  }

  // generar tarjetas de presentación en grid
  function generateContentGrid($idservicio)
  {
    echo "
    <div class='row'>
      <div class='col-md-4 mb-4'>";
    generateUserCards($idservicio);
    echo "
      </div>
    </div>
    ";
  }

  // Filtrados por el nombre del servicio y el iddepartamento
  function generateSpecialtiesFiltered($data, $wSize)
  {
    if (count($data) == 0) {
      echo "<h4>Sin registros encontrados</h4> ";
    } else {
      createUserCard($data, $wSize);
    }
  }

  // obtener el total de especialidades
  function countSpecialties($idservicio)
  {
    $specialty = new Specialty();
    $specialties = $specialty->getSpecialtyByService(["idservicio" => $idservicio]);
    return count($specialties);
  }

  // generar tarjetas de presentaciones
  function generateUserCards($idservicio)
  {
    $specialty = new Specialty();
    $specialties = $specialty->getSpecialtyByService(["idservicio" => $idservicio]);

    // genera una lista de cards
    createUserCard($specialties);
  }

  // Crear tarjetas de presentación a partir de un arreglo de datos
  function createUserCard($data, $wSize = "box-sm")
  {
    if (count($data) > 0) {
      foreach ($data as $row) {
        $getImage = getImageProfileUser($row['idusuario']);
        $imageProfile = $getImage != '' ? $getImage : $_SESSION['imgdefault'];
        $scoreUser = getScoreUser($row['idusuario']);
        $scoreUser = ceil($scoreUser); // Redondeado hacia el entero siguiente

        echo "
        <div class='box {$wSize} outline-dark-red '>
          <div class='box-body'>
            <div class='row'>
              <div class='col-left'>
                <!-- Imagen -->
                <div class='content-img'>
                  <a href='javascript:void(0)' class='link-user' data-user='{$row['idusuario']}'>
                    <img class='img-user' src='dist/img/user/{$imageProfile}'>
                  </a>
                </div>
              </div>
    
              <div class='col-right'>
                <!-- nombre -->
                <div class='row margin-0 content-name-user'>
                  <div class='box-left'>
                    <a href='javascript:void(0)' class='name-user' data-user='{$row['idusuario']}'>
                      <span class='single-line'>{$row['nombres']}</span>
                    </a>
                    <div class='contacts'>
                      <a href='tel:{$row['telefono']}' class='btn btn-sm btn-success'><i class='fas fa-phone-alt'></i> <span>Llamar</span> </a>
                      <a href='mailto:{$row['email']}' class='btn btn-sm btn-info'><i class='fas fa-solid fa-envelope'></i> <span>Enviar email</span></a>
                    </div>
                  </div>
                  <div class='box-right'>
                    <div class='icons-score'>";

        /* con estrellas */
        for ($i = 0; $i < $scoreUser; $i++) {
          echo "
                          <i class='fas fa-star active'></i>
                        ";
        }

        /* sin estrellas */
        for ($i = 0; $i < 5 - $scoreUser; $i++) {
          echo "
                          <i class='fas fa-star'></i>
                        ";
        }
        echo "</div>
                  </div>
                </div>
                <hr>
    
                <!-- Contenido del servicio -->
                <div class='row margin-0 content-service'>
                  <span class='name-service'><i class='fab fa-accusoft'></i> {$row['especialidad']}</span>
                  <span class='fee'> S/. {$row['tarifa']}</span>
                  <p class='description'>
                  {$row['biografia']}
                  </p>
                </div>
    
                <!-- Redes soaciles y ubicación -->
                <div class='row margin-0 content-social-location '>
                  <!-- ubicación -->
                  <div class='location box-left'>
                    <a href='https://www.google.com/maps' target='_blank'><i class='fas fa-map-marker-alt'></i> <span>Ubicación del establecimiento</span></a>
                  </div>
    
                  <!-- redes sociales -->
                  <div class='social-media box-right'>";
        listRedsocialUser($row['idusuario']);

        echo "</div>
                </div>
    
              </div>
            </div> 
          </div> 
        </div>
        ";
      }
    }
  }

  // Obtener imagen de perfil
  function getImageProfileUser($idusuario)
  {
    $gallery = new Gallery();
    $images = $gallery->getProfilePicture(["idusuario" => $idusuario]);

    return isset($images[0]) ? $images[0]['archivo'] : '';
  }

  // Obtener la calificación del usuario (Estrellas)
  function getScoreUser($idusuario)
  {
    $qualify = new Qualify();
    $score = $qualify->getScoreUser(["idusuario" => $idusuario]);
    return isset($score[0]) ? $score[0]['estrellas'] : 0;
  }

  // Obtener las redes del usuario
  function listRedsocialUser($idusuario)
  {
    $redsocial = new RedSocial();
    $data = $redsocial->getRedesSociales(["idusuario" => $idusuario]);

    if (count($data) > 0) {
      foreach ($data as $row) {
        $icon = getIconRedSocial($row['redsocial']);

        echo "
          <a href='{$row['vinculo']}' target='_blank'>{$icon}</a>
        ";
      }
    }
  }

  // Obtener el icono de la red social
  function getIconRedSocial($red)
  {

    $icon = "";

    if ($red == 'I') {
      $red = "Instagram";
      $icon = '<i class="fab fa-instagram icon-instagram"></i>';
    } elseif ($red == 'F') {
      $red = "Facebook";
      $icon = '<i class="fab fa-facebook-f icon-facebook"></i>';
    } elseif ($red == 'W') {
      $red = "WhatsApp";
      $icon = '<i class="fab fa-whatsapp icon-whatsapp"></i>';
    } elseif ($red == 'T') {
      $red = "Twitter";
      $icon = '<i class="fab fa-twitter icon-twitter"></i>';
    } elseif ($red == 'Y') {
      $red = "YouTube";
      $icon = '<i class="fab fa-youtube icon-youtube"></i>';
    } elseif ($red == 'K') {
      $red = "Tik Tok";
      $icon = '<i class="fab fa-tiktok icon-tiktok"></i>';
    }

    return $icon;
  }

  // listar en un control select
  function listSpecialtyControlSelect($data)
  {
    if (count($data) == 0) {
      echo " <option value=''>Sin registros</option> ";
    } else {
      echo " <option value=''>Seleccione</option> ";
      foreach ($data as $row) {
        echo "
          <option value='{$row['idespecialidad']}'>{$row['descripcion']}</option>
        ";
      }
    }
  }


  // Listar especialidades por servicio
  if ($_GET['op'] == 'getSpecialtyByService') {
    $data = $specialty->getSpecialtyByService(['idservicio' => $_GET['idservicio']]);
    listSpecialtyControlSelect($data);
  }

  function listSpecialtyUser($data, $visible){
    if (count($data) <= 0) {
      echo " ";
    } else {

      foreach ($data as $row) {
        echo "
          <tr>
            <td align='center'>
              <i class='fas fa-gavel'></i>
            </td>
            <td>
              {$row['descripcion']}
            </td>
            <td>
              $/.{$row['tarifa']}
            </td>
            <td {$visible}>
              <a class='btn btn-info btn-sm edit-nombre' href='#'><i class='fas fa-edit'></i></a>            
              <a data-idespecialidad='{$row['idespecialidad']}' class='btn btn-danger btn-sm eliminarEsp' href='#'><i class='fas fa-trash-alt'></i></a>            
            </td>
          </tr>
          <hr>       

        ";
      }
    }
  }

  // Listar especialidades por usuario
  if ($_GET['op'] == 'listSpecialtyUser') {
    $idusuario;
    $visible;
    
    if ($_GET['idusuarioactivo'] != -1) {
      $idusuario = $_GET['idusuarioactivo'];
      $visible = 'hidden';
    } else {
      $idusuario = $_SESSION['idusuario'];
      $visible = 'visible';
    }

    $data = $specialty->listSpecialtyUser(["idusuario" => $idusuario]);
    listSpecialtyUser($data, $visible);
  }

  // Listar en el control select
  if ($_GET['op'] == 'getSpecialtyByUser') {
    $data = $specialty->getSpecialtyByUser(["idusuario" => $_SESSION['idusuario']]);
    listSpecialtyControlSelect($data);
  }


  // Listar los carouseles
  if ($_GET['op'] == 'listCarousels') {
    $services = $service->getServices();
    generateCarousels($services);
  }

  // Mostrar especialidades relacionados al servicio (GRID)
  if ($_GET['op'] == 'generateContentGrid') {
    generateContentGrid($_GET['idservicio']);
  }

  // Filtrados por servicio y departamento
  if ($_GET['op'] == 'specialtiesFilteredByServiceAndDepartment') {
    $data = $specialty->specialtiesFilteredByServiceAndDepartment([
      "nombreservicio"  => $_GET['nombreservicio'],
      "iddepartamento"  => $_GET['iddepartamento']
    ]);

    generateSpecialtiesFiltered($data, $_GET['wsize']);
  }

  // Filtrados por servicio y provincia
  if ($_GET['op'] == 'specialtiesFilteredByServiceAndProvince') {
    $data = $specialty->specialtiesFilteredByServiceAndProvince([
      "nombreservicio"  => $_GET['nombreservicio'],
      "idprovincia"     => $_GET['idprovincia']
    ]);

    generateSpecialtiesFiltered($data, $_GET['wsize']);
  }

  // Filtrados por servicio y distrito
  if ($_GET['op'] == 'specialtiesFilteredByServiceAndDistrict') {
    $data = $specialty->specialtiesFilteredByServiceAndDistrict([
      "nombreservicio"  => $_GET['nombreservicio'],
      "iddistrito"      => $_GET['iddistrito']
    ]);

    generateSpecialtiesFiltered($data, $_GET['wsize']);
  }

  // Filtrados por servicio y distrito
  if ($_GET['op'] == 'specialtiesFilteredByServiceAndFee') {
    $data = $specialty->specialtiesFilteredByServiceAndFee([
      "nombreservicio"  => $_GET['nombreservicio'],
      "iddepartamento"  => $_GET['iddepartamento'],
      "tarifa1"         => $_GET['tarifa1'],
      "tarifa2"         => $_GET['tarifa2'],
    ]);

    generateSpecialtiesFiltered($data, $_GET['wsize']);
  }
}

// MÉTODO POST
if (isset($_POST['op'])){

  if ($_POST['op'] == 'registerSpecialtyUser'){

    $datosEnviar = [
      "idusuario"        =>  $_SESSION['idusuario'],
      "idservicio"       =>  $_POST["idservicio"],
      "descripcion"      =>  $_POST["descripcion"],
      "tarifa"           =>  $_POST["tarifa"]

    ];

    $specialty->registerSpecialtyUser($datosEnviar);
  } 

  // modificar descripcion de un usuario
  if ($_POST['op'] == 'updateSpecialty'){
    $datosEnviar = [
      "idespecialidad"    =>  $_POST["idespecialidad"],
      "idusuario"         =>  $_SESSION['idusuario'],
      "idservicio"        =>  $_POST["idservicio"],    
      "descripcion"       =>  $_POST["descripcion"],    
      "tarifa"            =>  $_POST["tarifa"]
    ];

    $specialty->updateSpecialty($datosEnviar);

  }

}

?>