<?php
session_start();

require_once '../model/Service.php';
$services = new Service();

if (isset($_GET['op'])){

  if($_GET['op'] == 'getServices'){

    $data = $services->getServices();

    if(count($data) > 0){
        echo "<option value='' disabled selected hidden >Seleccione:</option>";
            foreach ($data as $row){
                echo "<option value='$row->idservicio'>$row->nombreservicio</option>";
            }
    }   
  }


}



?>