<?php

require_once '../model/Person.php';
$persona = new Person();

if (isset($_GET['op'])){

  if ($_GET['op'] == 'getAPerson'){

    $data = $persona->getAPerson(["idpersona" => $_GET['idpersona']]);
    
    if ($data){
      echo json_encode($data);
    }else{
      echo "no existe";
    }

  }





}


?>