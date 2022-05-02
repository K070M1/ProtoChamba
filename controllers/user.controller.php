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

  // Ver descripcion de información de usuario
  function desc_user($data){
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

  //Cargar modal de paso 1 (email principal)
  function loadContentModalsRes1(){
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
  function loadContentModalsRes2($email){
    $user = new User();
    $searchRes = $user->getEmailVRes(["email" => $email]);

    if ($searchRes == 0) {
      echo "No permitido";
    }else{
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
  function loadContentModalsRes($step){
    
    // Algoritmo de ocultar correo
    /*function ocultEmail($email) {
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
    } */

     if($step == '3'){
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
    }else if($step == '4'){
      
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
  function loadQuestionModal(){

        echo "<option value='' disabled selected hidden >Selecciona tu pregunta</option>";
        
        $questions = array
        (
            "<option value='1'>¿En qué distrito vives?</option>",
            "<option value='2'>¿En qué provincia vives?</option>",
            "<option value='3'>¿En qué departamento vives?</option>",
            "<option value='4'>¿Qué día naciste?</option>",
            "<option value='5'>¿Qué mes naciste?</option>",
            "<option value='6'>¿Qué año naciste?</option>"
        );

        $random_quest = array_rand($questions, 3);
        for($i = 0; $i <= 2; $i++){
          echo $questions[$random_quest[$i]];
        }
      
  }

  // Login
  if($_GET['op'] == 'loginUser'){
    if($_GET['remember'] == 'false'){
      $data = $user->loginUser(["email" => $_GET['email']]);
      if(count($data) <= 0){
        echo 'Inexistente';
      }else{
        $contraseña = $data[0]['clave'];
        $sendpass = $_GET['password'];

        $login = password_verify($sendpass, $contraseña);
        if($login){
          echo 'Acceso';
          $_SESSION['login'] = true;
          $_SESSION['email'] = $data[0]['email'];
          $_SESSION['emailrespaldo'] = $data[0]['emailrespaldo'];
          $_SESSION['idusuario'] = $data[0]['idusuario'];
          $_SESSION['rol'] = $data[0]['rol'];   
          
          $image = getImageProfileUser($data[0]['idusuario']);
          $_SESSION['imagenusuario'] = $image != ''? $image: 'default_profile_avatar.svg';
        }else{
          echo 'Incorrecto';
          $_SESSION['login'] = false;
          $_SESSION['email'] = '';
          $_SESSION['emailrespaldo'] = '';
          $_SESSION['idusuario'] = '';
          $_SESSION['rol'] = '';   
          $_SESSION['imagenusuario'] = '';
        }
      }
    }else{
      if(isset($_COOKIE['email'])){
        $data = $user->loginUser(["email" => $_COOKIE['email']]);
        if(count($data) <= 0){
          echo 'Inexistente';
        }else{
          $contraseña = $data[0]['clave'];
          $sendpass = $_COOKIE['password'];
          $login = password_verify($sendpass, $contraseña);
          if($login){
            echo 'Acceso';
            $_SESSION['login'] = true;
            $_SESSION['email'] = $data[0]['email'];
            $_SESSION['emailrespaldo'] = $data[0]['emailrespaldo'];
            $_SESSION['idusuario'] = $data[0]['idusuario'];
            $_SESSION['rol'] = $data[0]['rol'];

            $image = getImageProfileUser($data[0]['idusuario']);
            $_SESSION['imagenusuario'] = $image != ''? $image: 'default_profile_avatar.svg';
          }else{
            echo 'Incorrecto';
            $_SESSION['login'] = false;
            $_SESSION['email'] = '';
            $_SESSION['emailrespaldo'] = '';
            $_SESSION['idusuario'] = '';
            $_SESSION['rol'] = '';   
            $_SESSION['imagenusuario'] = '';
          }
        }
      }else{
        setcookie("email", $_GET['email'], time() + 60 * 60);
        setcookie("password", $_GET['password'], time() + 60 * 60);
      }
    }
    

  }
  
  if($_GET['op'] == 'logout'){
    session_destroy();
    session_unset();
    header('Location:../index.php?view=main-view');
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
    if($Steps == '1'){
      loadContentModalsRes1();
    }else if($Steps == '2'){
      loadContentModalsRes2($_GET['email']);
    }else{
      loadContentModalsRes($Steps);
    }
  }

  // Ver descripcion de información de usuario
  if ($_GET['op'] == 'getUsersDescrip') {

    $idusuario;
    if($_GET['idusuarioactivo'] != -1){
      $idusuario = $_GET['idusuarioactivo'];
    } else {
      $idusuario = $_SESSION['idusuario'];
    }

    $data = $user->getUsersDescrip(["idusuario" => $idusuario]);
    desc_user($data);
  }

  // Conseguir nombre de usuario
  if($_GET['op'] == 'getUserName'){
    $idusuario;
    
    if($_GET['idusuarioactivo'] != -1){
      $idusuario = $_GET['idusuarioactivo'];
    } else {
      $idusuario = $_SESSION['idusuario'];
    }
    
    $data = $user->getNameUser(["idusuario" => $idusuario]);
    echo $data[0]['nombres'].' '.$data[0]['apellidos'];
  }

  // Elaborar preguntas
  if($_GET['op'] == 'questionLogin'){
    loadQuestionModal();
  }

  // Comprobar respuesta
  if($_GET['op'] == 'answerQuest'){
    if(isset($_SESSION['idusuario'])){
      $data = $user->getAUserQuest(["idusuario" => $_SESSION['idusuario']]);
      $quest = $_GET['quest'];
      $answer = $_GET['answer'];
      if($quest == '1'){
        if($data[0]['distrito'] == $answer){
          $_SESSION['login'] = 1;
          echo '1';
        }else{
          echo '0';
        }
      }else if($quest == '2'){
        if($data[0]['provincia'] == $answer){
          $_SESSION['login'] = 1;
          echo '1';
        }else{
          echo '0';
        }
      }else if($quest == '3'){
        if($data[0]['departamento'] == $answer){
          $_SESSION['login'] = 1;
          echo '1';
        }else{
          echo '0';
        }
      }else if($quest == '4'){
        $fecha = $data[0]['fechanac'];
        $date = strtotime($fecha);
        $day = date("d", $date);
        if($day == $answer){
          $_SESSION['login'] = 1;
          echo '1';
        }else{
          echo '0';
        }
      }else if($quest == '5'){
        $fecha = $data[0]['fechanac'];
        $date = strtotime($fecha);
        $month = date("m", $date);
        if($month == $answer){
          $_SESSION['login'] = 1;
          echo '1';
        }else{
          echo '0';
        }
      }else if($quest == '6'){
        $fecha = $data[0]['fechanac'];
        $date = strtotime($fecha);
        $year = date("Y", $date);
        if($year == $answer){
          $_SESSION['login'] = 1;
          echo '1';
        }else{
          echo '0';
        }
      }else{
        $_SESSION['login'] = 0;
        echo '0';
      }
    }
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
        "idpersona"       => $idperson[0]['idpersona'],
        "descripcion"     => " ",
        "horarioatencion" => " ",
        "email"           => $_POST['email'],
        "emailrespaldo"   => " ",
        "clave"           => password_hash($_POST['clave'], PASSWORD_BCRYPT)
      ];

      $iduser = $user->registerUser($datosRegistrar);

      $album->registerAlbumDefault(["idusuario" => $iduser[0]['idusuario']]);
      echo $iduser[0]['idusuario'];

      $idusern = $iduser[0]['idusuario'];
      $data = $user->getAUser(["idusuario" => $idusern]);

      $_SESSION['login'] = true;
      $_SESSION['email'] = $data[0]['email'];
      $_SESSION['emailrespaldo'] = $data[0]['emailrespaldo'];
      $_SESSION['idusuario'] = $data[0]['idusuario'];
      $_SESSION['rol'] = $data[0]['rol'];

    } else {
      echo ".";
    }
  }

  //Modificar contraseña
  if($_POST['op'] == 'updatePasswordRest'){

    $emailenv = $_POST['email'];

    $datosUp = [
      "email" => $emailenv,
      "clave"  => password_hash($_POST['clave'], PASSWORD_BCRYPT)
    ];

    $user->updatePasswordRest($datosUp);
    echo  $emailenv;

  }

  // modificar descripcion de un usuario
  if ($_POST['op'] == 'updateDescrip'){

    $datosEnviar = [
      "idusuario"       => $_SESSION['idusuario'],
      "descripcion"      =>  $_POST["descripcion"]
    ];

    $user->updateDescrip($datosEnviar);
  }

  // Agregar nueva foto de perfil de nuevo usuario
  if($_POST['op'] == 'newUserProfile'){
    $gallery = new Gallery();
    $regIDAlbumPer = $gallery->getIDAlbum(["idusuario" => $_SESSION['idusuario'] , "tipoalbum" => 'PE']);

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

    if(isset($_FILES['archivo'])){

      $ext = explode('.', $_FILES['archivo']['name']);
      $image = encripPhoto().date('Ymdhis'). '.' . $ext[1];

      $datregister = [
        "idalbum"       => $regIDAlbumPer[0]['idalbum'],
        "idusuario"     => $_SESSION['idusuario'],
        "idtrabajo"     => " ",
        "tipo"          => "F",
        "archivo"       => $image,
        "estado"        => "2"
      ];
      
      $gallery->registerGallery($datregister);
      move_uploaded_file($_FILES['archivo']['tmp_name'], "../dist/img/User/" . $image);

    }else{
      echo 'ERROR';
    }
  }
}