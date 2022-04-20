<?php
session_start();

require_once '../model/User.php';
require_once '../model/Person.php';
require_once '../model/Album.php';
require_once '../model/Gallery.php';
require_once '../model/Mailer.php';

// Instancias de objetos
$user = new User();
$person  = new Person();
$album = new Album();
$mailer = new Mailer();

$_SESSION['email'] = 'joserafaelomg@gmail.com';
$_SESSION['emailrespaldo'] = '1302314@senati.pe';

if (isset($_GET['op'])) {

  // Generar estructura HTML listando todos los usuarios (vista permisos)
  function loadUsersViewPermissions($data){

    if (count($data) == 0) {
      echo " ";
    } else {
      // Mostrar registros
      foreach ($data as $row) {
        $isAdmin = $row['rol'] == 'A' ? 'checked' : '';    

        $getImage = getImageProfileUser($row['idusuario']);
        $imageProfile = $getImage != ''? $getImage : 'default_profile_avatar.svg'; 

        echo "
          <tr>
            <td align='center'>
              <img src='dist/img/{$imageProfile}' class='img-circle img-size-32 mr-2'>
            </td> 
            <td>{$row['nombres']}</td>
            <td>{$row['fechaalta']}</td>
            <td align='center'>
              <div class='custom-control custom-switch'>
                <input type='checkbox' class='custom-control-input switch-role' id='{$row['idusuario']}' {$isAdmin}>
                <label class='custom-control-label' for='{$row['idusuario']}'></label>
              </div>
            </td>
          </tr>
        ";
      }
    }
  }

  // Obtener imagen de perfil
  function getImageProfileUser($idusuario){
    $gallery = new Gallery();
    $images = $gallery->getProfilePicture(["idusuario" => $idusuario]);

    return isset($images[0]) ? $images[0]['archivo']: '';
  }

  // Listar los usuaros filtrados - (vista reportes)
  function loadListUsersViewHistory($data){
    if (count($data) == 0) {
      echo "
        <tr>
          <td colspan='3'>No se encontrarón registros</td>
        </tr>
      ";
    } else {
      // Mostrar registros
      foreach ($data as $row) {
        $classIcon = $row['estado'] == 1? "fa-user-slash": "fa-user-check";
        $classBtn = $row['estado'] == 1? "btn-danger": "btn-primary";
        $title = $row['estado'] == 1? "Banear cuenta": "Activar cuenta";

        $getImage = getImageProfileUser($row['idusuario']);
        $imageProfile = $getImage != ''? $getImage : 'default_profile_avatar.svg'; 

        echo "
          <tr>
            <td>
              <img class='table-avatar' src='dist/img/{$imageProfile}'>
            </td>
            <td>
              {$row['nombres']}
            </td>
            <td class='project-actions text-right'>
              <a class='btn {$classBtn} btn-sm btn-ban-user' href='#' title='{$title}' data-code='{$row['idusuario']}' data-condition='{$row['estado']}'>            
                <i class='fas {$classIcon}'></i>
              </a>
            </td>
          </tr>
        ";
      }
    }
  }

  //Cargar Modales
  function loadContentModalsRes($step, $status){

    $emailU = $_SESSION['email'];
    $emailresU = $_SESSION['emailrespaldo'];

    // Algoritmo de ocultar correo
    function ocultEmail($email) {
      $emailocult = '';
      $base = '';
      $nbase = '';
      $fbase = '';
      $arroba = strpos($email, '@');
      for($i=0;$i<strlen($email);$i++){
        if($i  < $arroba){
          $base .= $email[$i];
        }
      }

      $nbase = trim($base, $base[-1]);
      $fbase = trim($nbase, $base[0]);

      $emailocult = str_replace($fbase, "*****"  , $email);
      return $emailocult;
    }

    $emailview = ocultEmail($emailU);
    $emailviewRes = ocultEmail($emailresU);

    if($step == '1'){
      echo
      "
        <div id='back-icon'>
          <a id='backi-1'>
            <i class='fas fa-arrow-left'></i>
          </a>
        </div>
        <h3 class='font-weight-bold'>Solicitar cambio de contraseña</h3>
        <form>
          <div class='form-group row'>
            <div class='col-sm-12'>
              <label for='emailDir'>Los procesos se enviarán a: </label>
              <input type='email' class='form-control' disabled value='$emailview'>
            </div>
          </div>
          <a id='secondEmailMd' href='#'>!No tengo acceso a este correo...!</a>
        </form>
        <div id='btn-gen-res'>
          <button type='button' class='btn btn-secondary' id='btnRes1'>Siguiente</button>
        </div>
      ";
    }elseif($step == '2'){
      echo
      "
      <div id='back-icon'>
        <a id='backi-2'>
          <i class='fas fa-arrow-left'></i>
        </a>
      </div>
      <h3 class='font-weight-bold'>Cambio de email de repaldo</h3>
      <form>
        <div class='form-group row'>
          <div class='col-sm-12'>
            <label>Los procesas han sido cambiados al email:</label>
            <input type='email' class='form-control' disabled value='$emailviewRes'>
          </div>
        </div>
      </form>
      <div id='btn-gen-res'>
        <button type='button' class='btn btn-secondary' id='btnRes2'>Siguiente</button>
      </div>
      ";
    }elseif($step == '3'){
      if($status == 'false'){
        echo
        "
        <div id='back-icon'>
          <a id='backi-3'>
            <i class='fas fa-arrow-left'></i>
          </a>
        </div>
        <h3 class='font-weight-bold'>He olvidado mi contraseña...!</h3>
        <span><label>$emailview</label></span>
        <div class='cnt-res'>
          <h5>Obtener un código de verificación</h5>
          <p>Se enviará un código de verificación temporal al correo indicado</p>
        </div>
        <div id='btn-gen-res'>
          <button type='button' class='btn btn-secondary' id='btnRes3'>Generar Código</button>
        </div>
        ";
      }else{
        echo
        "
        <div id='back-icon'>
          <a id='backi-4'>
            <i class='fas fa-arrow-left'></i>
          </a>
        </div>
        <h3 class='font-weight-bold'>He olvidado mi contraseña...!</h3>
        <span><label>$emailviewRes</label></span>
        <div class='cnt-res'>
          <h5>Obtener un código de verificación</h5>
          <p>Se enviará un código de verificación temporal al correo indicado</p>
        </div>
        <div id='btn-gen-res'>
          <button type='button' class='btn btn-secondary' id='btnRes4'>Generar Código</button>
        </div>
        ";
      };
    }elseif($step == '4'){
      if($status == 'false'){
        echo
        "
        <div id='back-icon'>
          <a id='backi-5'>
            <i class='fas fa-arrow-left'></i>
          </a>
          <div class='wrapper'>
            <div class='pie spinner'></div>
            <div class='pie filler'></div>
            <div class='mask'></div>
          </div>​ 
        </div>
        <h3 class='font-weight-bold'>Validar el código de verificación</h3>
        <span><label>$emailview</label></span>
        <form>
          <div class='form-group row'>
            <div class='col-sm-5'>
              <label>Ingrese el código enviado:</label>
            </div>
            <div class='col-sm-7'>
              <input type='text' class='form-control' id='code-send1'>
            </div>
          </div>
        </form>
        <div id='btn-gen-res'>
          <button type='button' class='btn btn-secondary' id='btnRes5'>Validar</button>
        </div>
        ";
      }else{
        echo
        "
        <div id='back-icon'>
          <a id='backi-6'>
            <i class='fas fa-arrow-left'></i>
          </a>
          <div class='wrapper'>
            <div class='pie spinner'></div>
            <div class='pie filler'></div>
            <div class='mask'></div>
          </div>​ 
        </div>
        <h3 class='font-weight-bold'>Validar el código de verificación</h3>
        <span><label>$emailviewRes</label></span>
        <form>
          <div class='form-group row'>
            <div class='col-sm-5'>
              <label>Ingrese el código enviado:</label>
            </div>
            <div class='col-sm-7'>
              <input type='text' class='form-control' id='code-send2'>
            </div>
          </div>
        </form>
        <div id='btn-gen-res'>
          <button type='button' class='btn btn-secondary' id='btnRes6'>Validar</button>
        </div>
        ";
      }
    }elseif($step == '5'){
      if($status == 'false'){
        echo
        "
          <div id='back-icon'>
            <a id='backi-7'>
              <i class='fas fa-arrow-left'></i>
            </a>
          </div>
          <h3 class='font-weight-bold'>Crear nueva contraseña</h3>
          <form>
            <div class='form-group row'>
              <div class='col-sm-5'>
                <label>Nueva contraseña:</label>
              </div>
              <div class='col-sm-7'>
                <input type='password' class='form-control' id='pass-n-1'>
              </div>
            </div>
            <div class='form-group row'>
              <div class='col-sm-5'>
                <label>Repetir contraseña:</label>
              </div>
              <div class='col-sm-7'>
                <input type='password' class='form-control' id='pass-n-2'>
              </div>
            </div>
          </form>
          <div id='btn-gen-res'>
            <button type='button' class='btn btn-secondary' id='btnRes7'>Crear contraseña</button>
          </div>
        ";
      }else{
        echo
        "
          <div id='back-icon '>
            <a id='backi-8'>
              <i class='fas fa-arrow-left'></i>
            </a>
          </div>
          <h3 class='font-weight-bold'>Crear nueva contraseña</h3>
          <form>
            <div class='form-group row'>
              <div class='col-sm-5'>
                <label>Nueva contraseña:</label>
              </div>
              <div class='col-sm-7'>
                <input type='password' class='form-control' id='pass-n-3'>
              </div>
            </div>
            <div class='form-group row'>
              <div class='col-sm-5'>
                <label>Repetir contraseña:</label>
              </div>
              <div class='col-sm-7'>
                <input type='password' class='form-control' id='pass-n-4'>
              </div>
            </div>
          </form>
          <div id='btn-gen-res'>
            <button type='button' class='btn btn-secondary' id='btnRes8'>Crear contraseña</button>
          </div>
        ";
        }
    }
  }

  // Busqueda realizada por nombres o apellidos - (Asignar permisos admin)
  if ($_GET['op'] == 'searchUsersByNamesAndRole') {

    $data;

    if($_GET['rol'] == '')
      $data = $user->searchUsersByNames(["search" => $_GET['search']]);
    else
      $data = $user->searchUsersByNamesAndRole(["rol" => $_GET['rol'], "search" => $_GET['search']]);    

    loadUsersViewPermissions($data);
  }

  // Busqueda realizada por nombres o apellidos - (lista de usuario en reportes)
  if ($_GET['op'] == 'searchUsersByNamesViewHistory') {
    $data = $user->searchUsersByNames(["search" => $_GET['search']]);
    loadListUsersViewHistory($data);
  }

  // Camvbiar rol de usuario
  if($_GET['op'] == 'updateUserRole'){
    $user->updateUserRole(["idusuario" => $_GET['idusuario'],  "rol" => $_GET['rol']]);
  }

  // banear usuario
  if($_GET['op'] == 'banUser'){
    $data = $user->getAUser(["idusuario" => $_GET['idusuario']]);
    $user->banUser(["idusuario" => $_GET['idusuario']]);
    
    $mailer->sendMail($data[0]['email'], "Su cuenta a sido baneado temporalmente debido a...");
    //echo json_encode($data[0]['email']);
  }

  // banear usuario
  if($_GET['op'] == 'reactivateUser'){
    $data = $user->getAUser(["idusuario" => $_GET['idusuario']]);
    $user->reactivateUser(["idusuario" => $_GET['idusuario']]);
    $mailer->sendMail($data[0]['email'], "Su cuenta a sido restablecido");
    //echo json_encode($data[0]['email']);
  }

  // verificar correo
  if ($_GET['op'] == 'EmailVerifi') {
    $data = $user->getEmailV(["email" => $_GET['email']]);
    if ($data == 0) {
      echo "permitido";
    } else {
      echo "No permitido";
    }
  }

  //Cargar contenido en los modales
  if($_GET['op'] == 'modalsRest'){
    $Steps = $_GET['paso'];
    $Status = $_GET['estado'];
    loadContentModalsRes($Steps, $Status);
  }
}

//METODO POST

if (isset($_POST['op'])) {

  //Registrar usuario
  if ($_POST['op'] == 'registerUser') {

    $emailverifi = $user->getEmailV(["email" => $_POST['email']]);

    if ($emailverifi == 0) {
      $datosIngresados = [
        "iddistrito" => $_POST['iddistrito'],
        "apellidos"  => $_POST['apellidos'],
        "nombres"    => $_POST['nombres'],
        "fechanac"   => $_POST['fechanac'],
        "telefono"   => $_POST['telefono'],
        "tipocalle"  => $_POST['tipocalle'],
        "nombrecalle" => $_POST['nombrecalle'],
        "numerocalle" => $_POST['numerocalle'],
        "pisodepa"    => $_POST['pisodepa']
      ];

      $idperson = $person->registerPerson($datosIngresados);

      $datosRegistrar = [
        "idpersona"       => $idperson,
        "descripcion"     => " ",
        "horarioatencion" => " ",
        "email"           => $_POST['email'],
        "emailrespaldo"   => " ",
        "clave"           => password_hash($_POST['clave'], PASSWORD_BCRYPT)
      ];

      $iduser = $user->registerUser($datosRegistrar);

      $album->registerAlbumDefault(["idusuario" => $iduser]);
      echo "Correct";
    } else {
      echo ".";
    }
  }

  //Modificar contraseña
  if($_POST['op'] == 'updatePasswordRest'){
    $datosUp = [
      "idusuario" => '1',
      "clave"  => password_hash($_POST['clave'], PASSWORD_BCRYPT)
    ];

    $user->updatePasswordRest($datosUp);
  }

  // modificar descripcion de un usuario
  if ($_POST['op'] == 'updateDescrip'){

    $datosEnviar = [
      "idusuario"       =>  1,
      "descripcion"      =>  $_POST["descripcion"]
    ];

    $user->updateDescrip($datosEnviar);
  }
}
