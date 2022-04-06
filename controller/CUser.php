<?php

require_once '../model/User.php';
$user = new User();

//GET
if (isset($_GET['op'])){

  // LISTAR
  if ($_GET['op'] == 'getUsers'){

    $data = $user->getUsers();
    echo json_encode($data);
  }

  // DELETE USER 
  if ($_GET['op'] == 'deleteUser'){

    $user->deleteUser(["idusuario" => $_GET['idusuario']]);
  
  }
}


//POST
if (isset($_POST['op'])){

  if ($_POST['op'] == 'registerUser'){

    $user->registerUser([
      "idpersona"         =>  $_POST["idpersona"],
      "descripcion"       =>  $_POST["descripcion"],
      "horarioatencion"   =>  $_POST["horarioatencion"],
      "email"             =>  $_POST["email"],
      "emailrespaldo"     =>  $_POST["emailrespaldo"],
      "clave"             =>  $_POST["clave"]
    ]);
  }

  //foto perfil
  if($_POST['op'] == 'perfilFotografia'){

    $user->perfilFotografia([
      "idusuario"     =>  $_POST["idusuario"],
      "fotografiausu" =>  $_POST["fotografiausu"]
    ]);
 
  }



}



?>