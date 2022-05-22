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

  // generar tarjetas de presentación en formato grid
  function generateContentGrid($data)
  {
    if(count($data) <= 0){
      echo "<h5>Sin registro</h5>";
    } else {
      // genera una lista de cards
      echo "<div class='flex-box'>";
      foreach($data as $row){
        echo "<div class='col-flex'>";
          createUserCard($row, "box-sm");
        echo "</div>";
      }
      echo "</div>";
    }
  }

  // Filtrados de especialidades
  function generateSpecialtiesFiltered($data, $wSize)
  {
    if (count($data) == 0) {
      echo "<h5>Sin registros encontrados</h5>";
    } else {
      echo "<div class='flex-box'>";
      
        $classCol = $wSize == "box-sm"? "col-flex-50": "col-flex-100";
        foreach ($data as $row) {
          echo "<div class='{$classCol}'>";
            createUserCard($row, $wSize);             
          echo "</div>";                 
        }
      echo "</div>";
    }
  }

  // Generar carousel
  function generateCarousel($data)
  {
    if(count($data) <= 0){
      echo "<h5>Sin registro</h5>";
    } else {
      echo "<div class='owl-carousel'>";
      foreach($data as $row){
        createUserCard($row);
      }
      echo "</div>";
    }
  }
  
  // Crear tarjetas de presentación a partir de una colección de datos
  function createUserCard($row, $wSize = "box-sm")
  {
    $getImage = getImageProfileUser($row['idusuario']);
    $imageProfile = $getImage != '' ? $getImage : $_SESSION['imgdefault'];
    $scoreUser = getScoreUser($row['idusuario']);
    $scoreUser = ceil($scoreUser); // Redondeado hacia el entero siguiente
    $colorcar = getColorCardService($row['nombreservicio']);
    $iconservice = getIconService($row['nombreservicio']);

    echo "
    <div class='box {$wSize} {$colorcar}'>
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
              <span class='name-service'>{$iconservice} {$row['especialidad']}</span>
              <span class='fee'> S/. {$row['tarifa']}</span>
              <p class='description'>
              {$row['biografia']}
              </p>
            </div>

            <!-- Redes soaciles y ubicación -->
            <div class='row margin-0 content-social-location '>
              <!-- ubicación -->
              <div class='location box-left'>
                <a href='index.php?view=geolocalizacion-view' target='_blank'><i class='fas fa-map-marker-alt'></i> <span>Ubicación del establecimiento</span></a>
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
        // _blank == Abrir en otra pestaña
        echo "<a href='{$row['vinculo']}' target='_blank'>{$icon}</a>";
      }
    }
  }

  // Obtener el icono de la red social
  function getIconRedSocial($red)
  {
    $icon = "";

    if ($red == 'I') {
      $icon = '<i class="fab fa-instagram icon-instagram"></i>';
    } elseif ($red == 'F') {
      $icon = '<i class="fab fa-facebook-f icon-facebook"></i>';
    } elseif ($red == 'W') {
      $icon = '<i class="fab fa-whatsapp icon-whatsapp"></i>';
    } elseif ($red == 'T') {
      $icon = '<i class="fab fa-twitter icon-twitter"></i>';
    } elseif ($red == 'Y') {
      $icon = '<i class="fab fa-youtube icon-youtube"></i>';
    } elseif ($red == 'K') {
      $icon = '<i class="fab fa-tiktok icon-tiktok"></i>';
    }

    return $icon;
  }

  // Aplicar color de acuerdo al servicio
  function getColorCardService($nombreservicio){
    $result = "";

    if ($nombreservicio == "Abogado") $result = "outline-aquamarine";
    if ($nombreservicio == "Albañil") $result = "outline-goldenrod";
    if ($nombreservicio == "Animador") $result = "outline-dark-green";
    if ($nombreservicio == "Asesor") $result = "outline-dark-slateBlue ";
    if ($nombreservicio == "Asistente") $result = "outline-indigo";
    if ($nombreservicio == "Carpintero") $result = "outline-dark-red";
    if ($nombreservicio == "Cocinero") $result = "outline-azure";
    if ($nombreservicio == "Conductor") $result = "outline-chocolate";
    if ($nombreservicio == "Diseñador") $result = "outline-cornflowerBlue";
    if ($nombreservicio == "Docente") $result = "outline-dark-oliveGreen";
    if ($nombreservicio == "Electricista") $result = "outline-dark-seaGreen";
    if ($nombreservicio == "Gasfitero") $result = "outline-steelBlue";
    if ($nombreservicio == "Limpieza") $result = "outline-fireBrick ";
    if ($nombreservicio == "Mecanico") $result = "outline-dark-cyan ";
    if ($nombreservicio == "Medicina") $result = "outline-cadetBlue";
    if ($nombreservicio == "Operario") $result = "outline-teal ";
    if ($nombreservicio == "Programador") $result = "outline-cornflowerBlue";
    if ($nombreservicio == "Promotor") $result = "outline-dark-khaki";
    if ($nombreservicio == "Seguridad") $result = "outline-aquamarine";
    if ($nombreservicio == "Soldador") $result = "outline-dark-salmon";
    if ($nombreservicio == "Traductor") $result = "outline-chartreuse";
    if ($nombreservicio == "Pintor") $result = "outline-paleVioletRed";
    if ($nombreservicio == "Jardinero") $result = "outline-mediumSeaGreen";
    if ($nombreservicio == "Cerrajero") $result = "outline-slateGray ";
    if ($nombreservicio == "Herrero") $result = "outline-lightSeaGreen";
    if ($nombreservicio == "Artista") $result = "outline-darkMagenta";

    return $result;
  }

  // Obtener el icono del servicio
  function getIconService($nombreservicio){
    $attorney = "fab fa-autoprefixer";
    $constructor = "fas fa-hard-hat";
    $animator = "fas fa-theater-masks";
    $consultant = "fab fa-black-tie";
    $asistant = "fas fa-hands-helping";
    $joiner = "fas fa-screwdriver";
    $chef = "fas fa fa-cheese";
    $driver = "fas fa-car-side";
    $design = "fab fa-affiliatetheme";
    $teacher = "fas fa-chalkboard-teacher";
    $electrician = "fas fa-bolt";
    $plumber = "fas fa-wrench";
    $cleaning = "fas fa-hand-sparkles";
    $mechanical = "fas fa-cogs";
    $medicine = "fas fa-syringe";
    $operator = "fas fa-user-tie";
    $developer = "fas fa-code";
    $promoter = "fas fa-ad";
    $security = "fas fa-user-shield";
    $welder = "fas fa-user-astronaut";
    $translator = "fas fa-language";
    $painter = "fas fa-paint-brush";
    $gardener = "fas fa-hat-cowboy";
    $locksmith = "fas fa-key";
    $blacksmith = "fab fa-sith";
    $artist = "fab fa-artstation";

    $result = "fas fa-shapes";

    if ($nombreservicio == "Abogado") $result = $attorney;
    if ($nombreservicio == "Albañil") $result = $constructor;
    if ($nombreservicio == "Animador") $result = $animator;
    if ($nombreservicio == "Asesor") $result = $consultant;
    if ($nombreservicio == "Asistente") $result = $asistant;
    if ($nombreservicio == "Carpintero") $result = $joiner;
    if ($nombreservicio == "Cocinero") $result = $chef;
    if ($nombreservicio == "Conductor") $result = $driver;
    if ($nombreservicio == "Diseñador") $result = $design;
    if ($nombreservicio == "Docente") $result = $teacher;
    if ($nombreservicio == "Electricista") $result = $electrician;
    if ($nombreservicio == "Gasfitero") $result = $plumber;
    if ($nombreservicio == "Limpieza") $result = $cleaning;
    if ($nombreservicio == "Mecanico") $result = $mechanical;
    if ($nombreservicio == "Medicina") $result = $medicine;
    if ($nombreservicio == "Operario") $result = $operator;
    if ($nombreservicio == "Programador") $result = $developer;
    if ($nombreservicio == "Promotor") $result = $promoter;
    if ($nombreservicio == "Seguridad") $result = $security;
    if ($nombreservicio == "Soldador") $result = $welder;
    if ($nombreservicio == "Traductor") $result = $translator;
    if ($nombreservicio == "Pintor") $result = $painter;
    if ($nombreservicio == "Jardinero") $result = $gardener;
    if ($nombreservicio == "Cerrajero") $result = $locksmith;
    if ($nombreservicio == "Herrero") $result = $blacksmith;
    if ($nombreservicio == "Artista") $result = $artist;

    return "<i class='icon-service {$result}'></i>";
  }

  // listar especialidades en un control select
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

  // Mostrar servicios del usuario
  function listServicesUser($data, $visible){

    if(count($data) == 0){
      echo "
        <div class='card card-body'>
          <span>Sin especialidades</span>
        </div>
      ";
    } else {
      echo "<div class='accordion' id='accordion-services'> ";
        foreach($data as $row){
          echo "
            <div class='card'>
              <div class='card-header' id='{$row['idservicio']}'>
                <h5 class='mb-0'>
                  <button type='button' class='btn btn-link btn-block text-left collapsed' data-toggle='collapse' data-target='#collapse-{$row['idservicio']}'>
                    {$row['nombreservicio']} 
                    <span style='position: absolute; right:1em;'><i class='fas fa-sliders-h'></i></span>
                  </button>
                </h5>
              </div>

              <div id='collapse-{$row['idservicio']}' class='collapse' aria-labelledby='{$row['idservicio']}' data-parent='#accordion-services'>
                <div class='card-body'>";
                listSpecialtyUser($row['idservicio'], $row['idusuario'], $visible);
                echo "</div>
              </div>
            </div>
          ";
        }
      echo "</div>";
    }
  }

  // Mostrar especialidades del usuario (TABLA)
  function listSpecialtyUser($idservicio, $idusuario, $visible)
  {
    $specialty = new Specialty();
    $data = $specialty->getSpecialtyByServiceAndUser([
      "idservicio" => $idservicio,
      "idusuario" => $idusuario
    ]);

    if (count($data) <= 0) {
      echo " ";
    } else {
      echo "
      <table class='table table-responsive-sm especialidades'>
      <thead>
        <tr>
          <th></th>
          <th>ESPECIALIDAD</th>
          <th>TARIFA</th>
          <th></th>
        </tr>
      </thead>
      <tbody >";
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
            <td {$visible} class='text-right'>
              <a class='btn btn-info btn-sm modificarEsp' href='javascript:void(0)' data-idespecialidad='{$row['idespecialidad']}'><i class='fas fa-edit'></i></a>            
              <a data-idespecialidad='{$row['idespecialidad']}' class='btn btn-danger btn-sm eliminarEsp' href='#'><i class='fas fa-trash-alt'></i></a>            
            </td>
          </tr>    
  
        ";
      }   

    echo "</tbody>
    </table>
      ";

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

    $data = $specialty->getSpecialtyByUser(["idusuario" => $idusuario]);
    listServicesUser($data, $visible);
  }

  // Listar en el control select
  if ($_GET['op'] == 'getSpecialtyByUser') {
    $data = $specialty->getSpecialtyByUser(["idusuario" => $_SESSION['idusuario']]);
    listSpecialtyControlSelect($data);
  }

  // mostrar especialidades recomendados en carousel
  if ($_GET['op'] == 'listCarouselRecommendation') {
    $data = $specialty->getRandomSpecials(["limit" => 20, "offset" => 0]);
    generateCarousel($data);
  }

  // mostrar especialidades populares en carousel
  if ($_GET['op'] == 'listCarouselPopular') {
    $data = $specialty->getPopularRandomSpecials(["limit" => 20, "offset" => 0]);
    generateCarousel($data);
  }

  // Mostrar especialidades recomendados en formato (GRID)
  if ($_GET['op'] == 'listGridRecommendation') {
    $data = [];
    if($_GET['typeservice'] == "popular"){
      $data = $specialty->getPopularRandomSpecials(["limit" => 20, "offset" => 0]);
    } else {
      $data = $specialty->getRandomSpecials(["limit" => 20, "offset" => 0]);
    }
    generateContentGrid($data);
  }

  // Filtrados por servicio y departamento
  if ($_GET['op'] == 'specialtiesFilteredByServiceAndDepartment') {
    $data;

    if($_GET['iddepartamento'] == ''){
      $data = $specialty->specialtiesFilteredByService([
        "nombreservicio"  => $_GET['nombreservicio'],
        "order"           => $_GET['order'],
        "limit"           => $_GET['limit'],
        "offset"          => $_GET['offset']
      ]);
    } else {
      $data = $specialty->specialtiesFilteredByServiceAndDepartment([
        "nombreservicio"  => $_GET['nombreservicio'],
        "iddepartamento"  => $_GET['iddepartamento'],
        "order"           => $_GET['order'],
        "limit"           => $_GET['limit'],
        "offset"          => $_GET['offset']
      ]);
    }

    if($data){
      generateSpecialtiesFiltered($data, $_GET['wsize']);
    } else {
      echo "sin registros";
    }
  }

  // Filtrados por servicio y provincia
  if ($_GET['op'] == 'specialtiesFilteredByServiceAndProvince') {
    $data = $specialty->specialtiesFilteredByServiceAndProvince([
      "nombreservicio"  => $_GET['nombreservicio'],
      "idprovincia"     => $_GET['idprovincia'],
      "order"           => $_GET['order'],
      "limit"           => $_GET['limit'],
      "offset"          => $_GET['offset']
    ]);

    if($data){
      generateSpecialtiesFiltered($data, $_GET['wsize']);
    } else {
      echo "sin registros";
    }
  }

  // Filtrados por servicio y distrito
  if ($_GET['op'] == 'specialtiesFilteredByServiceAndDistrict') {
    $data = $specialty->specialtiesFilteredByServiceAndDistrict([
      "nombreservicio"  => $_GET['nombreservicio'],
      "iddistrito"      => $_GET['iddistrito'],
      "order"           => $_GET['order'],
      "limit"           => $_GET['limit'],
      "offset"          => $_GET['offset']
    ]);

    if($data){
      generateSpecialtiesFiltered($data, $_GET['wsize']);
    } else {
      echo "sin registros";
    }
  }

  // Filtrados por servicio y tarifas
  if ($_GET['op'] == 'specialtiesFilteredByServiceAndFee') {
    $data = $specialty->specialtiesFilteredByServiceAndFee([
      "nombreservicio"  => $_GET['nombreservicio'],
      "tarifa1"         => $_GET['tarifa1'], // Rango de tarifa
      "tarifa2"         => $_GET['tarifa2'], // Rango de tarifa
      "order"           => $_GET['order'],
      "limit"           => $_GET['limit'],
      "offset"          => $_GET['offset']
    ]);

    if($data){
      generateSpecialtiesFiltered($data, $_GET['wsize']);
    } else {
      echo "sin registros";
    }
  }

  // Total de servicios encontrado al realizar la busqueda
  if($_GET['op'] == 'totalSpecialtiesFound'){
    $data;
    $specialties = $specialty->totalSpecialtiesAvailable();
    $totalSp = $specialties[0]->total;

    if($_GET['iddepartamento'] == ''){
      $data = $specialty->specialtiesFilteredByService([
        "nombreservicio"  => $_GET['nombreservicio'],
        "order"           => 'N',
        "limit"           => $totalSp,
        "offset"          => 0
      ]);
    } else {
      $data = $specialty->specialtiesFilteredByServiceAndDepartment([
        "nombreservicio"  => $_GET['nombreservicio'],
        "iddepartamento"  => $_GET['iddepartamento'],
        "order"           => 'N',
        "limit"           => $totalSp,
        "offset"          => 0
      ]);
    }

    echo count($data);
  }

  // Total de servicios ofrecidos
  if($_GET['op'] == 'totalSpecialtiesAvailable'){
    $data = $specialty->totalSpecialtiesAvailable();

    if(isset($data[0])){
      echo $data[0]->total;
    }
  }

  // Obtener un registro
  if($_GET['op'] == 'getDataSpecialty'){
    $data = $specialty->getAtSpecialty(["idespecialidad" => $_GET['idespecialidad']]);
    if($data){
      echo json_encode($data);
    }
  }

  // Eliminar
  if($_GET['op'] == 'deleteSpecialty'){
    $specialty->deleteSpecialty(["idespecialidad" => $_GET['idespecialidad']]);
  }

  // Listar servicios del usuarios
  if ($_GET['op'] == 'getServicesUser'){
    $idusuario;
    $visible;

    if ($_GET['idusuarioactivo'] != -1) {
      $idusuario = $_GET['idusuarioactivo'];
      $visible = 'hidden';
    } else {
      $idusuario = $_SESSION['idusuario'];
      $visible = 'visible';
    }

    $data = $service->getServicesUser(["idusuario" => $idusuario]);
    listServicesUser($data, $visible);

  }
}

// MÉTODO POST
if (isset($_POST['op'])) {

  if ($_POST['op'] == 'registerSpecialtyUser') {

    $datosEnviar = [
      "idusuario"        =>  $_SESSION['idusuario'],
      "idservicio"       =>  $_POST["idservicio"],
      "descripcion"      =>  $_POST["descripcion"],
      "tarifa"           =>  $_POST["tarifa"]
    ];

    $specialty->registerSpecialtyUser($datosEnviar);
  }

  // modificar descripcion de un usuario
  if ($_POST['op'] == 'updateSpecialty') {
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
