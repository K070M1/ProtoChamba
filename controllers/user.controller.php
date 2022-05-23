<?php
session_start();
//$_SESSION['imagedefault'] = 'default_profile_avatar.svg';

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


if (isset($_GET['op'])) {

  // Generar estructura HTML listando todos los usuarios (vista permisos)
  function loadUsersViewPermissions($data)
  {

    if (count($data) == 0) {
      echo " ";
    } else {
      // Mostrar registros
      foreach ($data as $row) {
        $isAdmin = $row['rol'] == 'A' ? 'checked' : '';

        $getImage = getImageProfileUser($row['idusuario']);
        $imageProfile = $getImage != '' ? $getImage : 'default_profile_avatar.svg';

        echo "
          <tr>
            <td align='center'>
              <img src='dist/img/user/{$imageProfile}' class='img-user-table'>
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
  function getImageProfileUser($idusuario)
  {

    $gallery = new Gallery();
    $images = $gallery->getProfilePicture(["idusuario" => $idusuario]);

    return isset($images[0]) ? $images[0]['archivo'] : '';
  }

  // Listar los usuaros filtrados - (vista reportes)
  function loadListUsersViewHistory($data)
  {
    if (count($data) == 0) {
      echo "
        <tr>
          <td colspan='3'>No se encontraron registros</td>
        </tr>
      ";
    } else {
      // Mostrar registros
      foreach ($data as $row) {
        $classIcon = $row['estado'] == 1 ? "fa-user-slash" : "fa-user-check";
        $classBtn = $row['estado'] == 1 ? "btn-danger" : "btn-primary";
        $title = $row['estado'] == 1 ? "Banear cuenta" : "Activar cuenta";

        $getImage = getImageProfileUser($row['idusuario']);
        $imageProfile = $getImage != '' ? $getImage : 'default_profile_avatar.svg';

        echo "
          <tr>
            <td>
              <img class='img-user-table' src='dist/img/user/{$imageProfile}'>
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

  // Ver descripcion de información de usuario
  function desc_user($data)
  {
    if (count($data) <= 0) {
      echo " ";
    } else {
      foreach ($data as $row) {
        echo "
          <p>{$row['descripcion']}</p>
        ";
      }
    }
  }

  //Cargar modal de paso 1 (email)
  function loadContentModalsRes1()
  {
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
            <label for='emailDir'>Los procesos se enviarán a tu correo: </label>
            <input type='email' class='form-control' id='inptEmailRes'>
          </div>
        </div>
      </form>
      <div id='btn-gen-res'>
        <button type='button' class='btn btn-secondary' id='btnRes1'>Siguiente</button>
      </div>
    ";
  }

  //Cargar modal de paso 2
  function loadContentModalsRes2($email)
  {
    $user = new User();
    $searchRes = $user->getEmailVRes(["email" => $email]);

    if ($searchRes[0]['email'] == 0) {
      echo "No permitido";
    } else {
      echo
      "
      <div id='back-icon'>
        <a id='backi-3'>
          <i class='fas fa-arrow-left'></i>
        </a>
      </div>
      <h3 class='font-weight-bold'>He olvidado mi contraseña...!</h3>
      <div class='cnt-res'>
        <h5>Obtener un código de verificación</h5>
        <p>Se enviará un código de verificación temporal al correo indicado</p>
      </div>
      <div id='btn-gen-res'>
        <button type='button' class='btn btn-secondary' id='btnRes2'>Generar Código</button>
      </div>
      ";
    }
  }

  // Cargar resto de modales
  function loadContentModalsRes($step)
  {
    if ($step == '3') {
      echo
      "
        <div id='back-icon'>
          <a id='backi-4'>
            <i class='fas fa-arrow-left'></i>
          </a>
          <div class='wrapper'>
            <div class='pie spinner'></div>
            <div class='pie filler'></div>
            <div class='mask'></div>
          </div>​ 
        </div>
        <h3 class='font-weight-bold'>Validar el código de verificación</h3>
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
          <button type='button' class='btn btn-secondary' id='btnRes3'>Validar</button>
        </div>
        ";
    } else if ($step == '4') {

      echo
      "
        <div id='back-icon'>
          <a id='backi-5'>
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
          <button type='button' class='btn btn-secondary' id='btnRes4'>Crear contraseña</button>
        </div>
      ";
    }
  }

  // Cargar preguntas para el cuestionario
  function loadQuestionModal()
  {

    echo "<option value='' disabled selected hidden >Selecciona tu pregunta</option>";

    $questions = array(
      "<option value='1'>¿En qué distrito vives?</option>",
      "<option value='2'>¿En qué provincia vives?</option>",
      "<option value='3'>¿En qué departamento vives?</option>",
      "<option value='4'>¿Qué día naciste?</option>",
      "<option value='5'>¿Qué mes naciste?</option>",
      "<option value='6'>¿Qué año naciste?</option>"
    );
    // Genera un array de indices a partir de un array
    $random_quest = array_rand($questions, 3);
    for ($i = 0; $i <= 2; $i++) {
      echo $questions[$random_quest[$i]];
    }
  }

  //Personas
  function listDataUser($data){
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
            <td id='no'>{$row['nombres']} {$row['apellidos']}</td>
          </tr>
          <tr>
            <td align='center'>
              <i class='fas fa-phone'></i>
            </td>
            <td id='te'>{$row['telefono']}</td>
          </tr>
          <tr>
            <td align='center'>
              <i class='fas fa-calendar-check'>
            </td>
            <td id='fe'>{$row['fechanac']}</td>
          </tr>          
          <tr>
            <td align='center'>
              <i class='fas fa-map-marked-alt'></i>
            </td>
            <td id='ti'>{$row['direccion']}</td>
          </tr>         
          <tr>
            <td align='center'>
            <i class='fas fa-business-time'></i>
            </td>
            <td id='ti'>{$row['horarioatencion']}</td>
          </tr>          
        ";
      }
    }
  }

  // Login
  if ($_GET['op'] == 'loginUser') {
      $data = $user->loginUser(["email" => $_GET['email']]);
      if (count($data) <= 0) {
        echo 'Inexistente';
      } else {
        $contraseña = $data[0]['clave'];
        $sendpass = $_GET['password'];

        $login = password_verify($sendpass, $contraseña);
        if ($login) {
          echo 'Acceso';
          $_SESSION['login'] = true;
          $_SESSION['email'] = $data[0]['email'];
          $_SESSION['emailrespaldo'] = $data[0]['emailrespaldo'];
          $_SESSION['idusuario'] = $data[0]['idusuario'];
          $_SESSION['idpersona'] = $data[0]['idpersona'];
          $_SESSION['rol'] = $data[0]['rol'];

          $image = getImageProfileUser($data[0]['idusuario']);
          $_SESSION['imagenusuario'] = $image != '' ? $image : 'default_profile_avatar.svg';
        } else {
          echo 'Incorrecto';
          $_SESSION['login'] = false;
          $_SESSION['email'] = '';
          $_SESSION['emailrespaldo'] = '';
          $_SESSION['idusuario'] = '';
          $_SESSION['idpersona'] = '';
          $_SESSION['rol'] = '';
          $_SESSION['imagenusuario'] = '';
        }
      }
  }

  // Logout
  if ($_GET['op'] == 'logout') {
    session_destroy(); // Elimninar la sesión
    session_unset(); // Eliminar todas las variables de session
    header('Location:../index.php');
  }
  
  // Busqueda realizada por nombres o apellidos - (Asignar permisos admin)
  if ($_GET['op'] == 'searchUsersByNamesAndRole') {

    $data;

    if ($_GET['rol'] == '')
      $data = $user->searchUsersByNames(["search" => $_GET['search']]);
    else
      $data = $user->searchUsersByNamesAndRole(["rol" => $_GET['rol'], "search" => $_GET['search']]);

    loadUsersViewPermissions($data);
  }

  // Busqueda realizada por nombres o apellidos - (lista de usuario en reportes)
  if ($_GET['op'] == 'searchUsersByNamesViewHistory') {
    $data = $user->searchUsersByNamesScroll([
      "search" => $_GET['search'],
      "offset" => $_GET['offset'],
      "limit"  => $_GET['limit']
    ]);

    if($data){
      loadListUsersViewHistory($data);
    } else {
      echo "sin registros";
    }
  }

  // Cambiar rol de usuario
  if ($_GET['op'] == 'updateUserRole') {
    $user->updateUserRole(["idusuario" => $_GET['idusuario'],  "rol" => $_GET['rol']]);
  }

  // banear usuario
  if ($_GET['op'] == 'banUser') {
    $data = $user->getAUser(["idusuario" => $_GET['idusuario']]);
    $user->banUser(["idusuario" => $_GET['idusuario']]);
    $mailer->sendMail($data[0]['email'], "Su cuenta a sido baneada temporalmente debido a contenido inapropiado para los demás usuarios");
  }

  // Reactivar usuario
  if ($_GET['op'] == 'reactivateUser') {
    $data = $user->getAUser(["idusuario" => $_GET['idusuario']]);
    $user->reactivateUser(["idusuario" => $_GET['idusuario']]);
    $mailer->sendMail($data[0]['email'], "Su cuenta a sido restablecida");
  }

  // verificar correo
  if ($_GET['op'] == 'EmailVerifi') {
    $data = $user->getEmailV(["email" => $_GET['email']]);
    if ($data[0]['email'] == 0) {
      echo "permitido";
    } else {
      echo "No permitido";
    }
  }

  //Cargar contenido en los modales
  if ($_GET['op'] == 'modalsRest') {
    $Steps = $_GET['paso'];
    if ($Steps == '1') {
      loadContentModalsRes1();
    } else if ($Steps == '2') {
      loadContentModalsRes2($_GET['email']);
    } else {
      loadContentModalsRes($Steps);
    }
  }

  // Ver descripcion de información de usuario
  if ($_GET['op'] == 'getUsersDescrip') {

    $idusuario;
    if ($_GET['idusuarioactivo'] != -1) {
      $idusuario = $_GET['idusuarioactivo'];
    } else {
      $idusuario = $_SESSION['idusuario'];
    }

    $data = $user->getUsersDescrip(["idusuario" => $idusuario]);
    desc_user($data);
  }

  // Conseguir nombre de usuario
  if ($_GET['op'] == 'getUserName') {
    $idusuario;

    if ($_GET['idusuarioactivo'] != -1) {
      $idusuario = $_GET['idusuarioactivo'];
    } else {
      $idusuario = $_SESSION['idusuario'];
    }

    $data = $user->getNameUser(["idusuario" => $idusuario]);
    echo $data[0]['nombres'] . ' ' . $data[0]['apellidos'];
  }

  // Elaborar preguntas
  if ($_GET['op'] == 'questionLogin') {
    loadQuestionModal();
  }

  // Comprobar respuesta
  if ($_GET['op'] == 'answerQuest') {
    if (isset($_SESSION['idusuario'])) {
      $data = $user->getAUserQuest(["idusuario" => $_SESSION['idusuario']]);
      $quest = $_GET['quest'];
      $answer = $_GET['answer'];
      if ($quest == '1') {
        if ($data[0]['distrito'] == $answer) {
          $_SESSION['login'] = true;
          echo '1';
        } else {
          echo '0';
        }
      } else if ($quest == '2') {
        if ($data[0]['provincia'] == $answer) {
          $_SESSION['login'] = true;
          echo '1';
        } else {
          echo '0';
        }
      } else if ($quest == '3') {
        if ($data[0]['departamento'] == $answer) {
          $_SESSION['login'] = true;
          echo '1';
        } else {
          echo '0';
        }
      } else if ($quest == '4') {
        $fecha = $data[0]['fechanac'];
        $date = strtotime($fecha);
        $day = date("d", $date);
        if ($day == $answer) {
          $_SESSION['login'] = true;
          echo '1';
        } else {
          echo '0';
        }
      } else if ($quest == '5') {
        $fecha = $data[0]['fechanac'];
        $date = strtotime($fecha);
        $month = date("m", $date);
        if ($month == $answer) {
          $_SESSION['login'] = true;
          echo '1';
        } else {
          echo '0';
        }
      } else if ($quest == '6') {
        $fecha = $data[0]['fechanac'];
        $date = strtotime($fecha);
        $year = date("Y", $date);
        if ($year == $answer) {
          $_SESSION['login'] = true;
          echo '1';
        } else {
          echo '0';
        }
      } else {
        $_SESSION['login'] = false;
        echo '0';
      }
    }
  }

  // Listar Datos de un usuario
  if($_GET['op'] == 'getAUserProfile'){
    $idusuario;
    
    if($_GET['idusuarioactivo'] != -1){
      $idusuario = $_GET['idusuarioactivo'];
    } else {
      $idusuario = $_SESSION['idusuario'];
    }
    $data = $user->getAUser(["idusuario" => $idusuario]);
    listDataUser($data);
  }

  // Traer datos
  if($_GET['op'] == 'getDataUser'){
    $data = $user->getAUser(["idusuario" => $_SESSION['idusuario']]);
    if($data){
      echo json_encode($data);
    }
  }

  // Actualizar datos del usuario
  if($_GET['op'] == 'updateUser'){
    $person->updatePerson([
      "idpersona"       =>  $_SESSION["idpersona"],
      "apellidos"       =>  $_GET["apellidos"],
      "nombres"         =>  $_GET["nombres"],
      "fechanac"        =>  $_GET["fechanac"],
      "telefono"        =>  $_GET["telefono"],
      "tipocalle"       =>  $_GET["tipocalle"],
      "nombrecalle"     =>  $_GET["nombrecalle"],
      "numerocalle"     =>  $_GET["numerocalle"],
      "pisodepa"        =>  $_GET["pisodepa"]
    ]);

    $user->updateOfficeHours([
      "idusuario" => $_SESSION['idusuario'],
      "horarioatencion" => $_GET['horarioatencion']
    ]);
  }

  // Level usuario
  if($_GET['op'] == 'getLevelUser'){
    $idusuario;
    
    if($_GET['idusuarioactivo'] != -1){
      $idusuario = $_GET['idusuarioactivo'];
    } else {
      $idusuario = $_SESSION['idusuario'];
    }

    $data = $user->getAUser(["idusuario" => $idusuario]);
    if($data){
      echo $data[0]['nivelusuario'];
    }
  }

  // Actualizar correo
  if($_GET['op'] == 'updateEmailUser'){
    $row = $user->getAUser(["idusuario" => $_SESSION['idusuario']]);
    $data = $user->loginUser(["email" => $row[0]['email']]);
    $password = $data[0]['clave'];
    $sendpass = $_GET['password'];

    $login = password_verify($sendpass, $password);
    if($login){
      $user->updateEmailsUser([
        "idusuario"       => $_SESSION['idusuario'],
        "email"           => $_GET['email'],
        "emailrespaldo"   => $_GET['emailrespaldo']
      ]);
    } else {
      echo "Contraseña actual incorrecta";      
    }
  }

  // Actualizar clave
  if($_GET['op'] == 'updatePasswordUser'){
    $row = $user->getAUser(["idusuario" => $_SESSION['idusuario']]);
    $data = $user->loginUser(["email" => $row[0]['email']]);

    $password = $data[0]['clave'];
    $sendpass = $_GET['password'];

    $login = password_verify($sendpass, $password);

    if($login){
      $user->updatePasswordUser([
        "idusuario" => $_SESSION['idusuario'],
        "clave"     => password_hash($_GET['newpassword'], PASSWORD_BCRYPT)
      ]);
    } else {
      echo "Contraseña actual incorrecta";    
    }
  }

  // Eliminar cuenta
  if($_GET['op'] == 'deleteUser'){
    $row = $user->getAUser(["idusuario" => $_SESSION['idusuario']]);
    $data = $user->loginUser(["email" => $row[0]['email']]);

    $password = $data[0]['clave'];
    $sendpass = $_GET['password'];

    $login = password_verify($sendpass, $password);

    if($login){
      $user->deleteUser(["idusuario" => $_SESSION['idusuario']]);
    } else {
      echo "Contraseña actual incorrecta";
    }
  }
}

//METODO POST

if (isset($_POST['op'])) {

  //Registrar usuario
  if ($_POST['op'] == 'registerUser') {

    $emailverifi = $user->getEmailV(["email" => $_POST['email']]);

    if ($emailverifi[0]['email'] == 0) {
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
        "idpersona"       => $idperson[0]['idpersona'],
        "descripcion"     => " ",
        "horarioatencion" => " ",
        "email"           => $_POST['email'],
        "emailrespaldo"   => " ",
        "clave"           => password_hash($_POST['clave'], PASSWORD_BCRYPT)
      ];

      $iduser = $user->registerUser($datosRegistrar);
      $_SESSION['idusuario'] = $iduser[0]['idusuario'];
      $album->registerAlbumDefault(["idusuario" => $iduser[0]['idusuario']]);

    } else {
      echo ".";
    }
  }

  //Modificar contraseña
  if ($_POST['op'] == 'updatePasswordRest') {

    $emailenv = $_POST['email'];

    $datosUp = [
      "email" => $emailenv,
      "clave"  => password_hash($_POST['clave'], PASSWORD_BCRYPT)
    ];

    $user->updatePasswordRest($datosUp);
    echo  $emailenv;
  }

  // modificar descripcion de un usuario
  if ($_POST['op'] == 'updateDescrip') {

    $datosEnviar = [
      "idusuario"       => $_SESSION['idusuario'],
      "descripcion"      =>  $_POST["descripcion"]
    ];

    $user->updateDescrip($datosEnviar);
  }

  // Agregar nueva foto de perfil de nuevo usuario
  if ($_POST['op'] == 'newUserProfile') {
    $gallery = new Gallery();
    $regIDAlbumPer = $gallery->getIDAlbum(["idusuario" => $_SESSION['idusuario'], "tipoalbum" => 'PE']);

    function encripPhoto()
    {
      $lenght = 15;
      $base = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $longitud = strlen($base);
      $code = '';
      for ($i = 0; $i < $lenght; $i++) {
        $random = $base[mt_rand(0, $longitud - 1)];
        $code .= $random;
      }

      return $code;
    }

    if (isset($_FILES['archivo'])) {

      $ext = explode('.', $_FILES['archivo']['name']);
      $image = encripPhoto() . date('Ymdhis') . '.' . end($ext);

      $datregister = [
        "idalbum"       => $regIDAlbumPer[0]['idalbum'],
        "idusuario"     => $_SESSION['idusuario'],
        "idtrabajo"     => " ",
        "tipo"          => "F",
        "archivo"       => $image,
        "estado"        => "2"
      ];

      $gallery->registerGallery($datregister);
      move_uploaded_file($_FILES['archivo']['tmp_name'], "../dist/img/user/" . $image);
    } else {
      echo 'ERROR';
    }
  }
}
