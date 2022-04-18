<?php

require_once '../model/Service.php';
$service = new Service();

if(isset($_GET['op'])){


  function loadServices($data){
    if(count($data) == 0){
      echo "";
    }
    else{
      echo "<option value=''>Seleccione</option>";
      foreach($data as $row){
        echo "
          <option value='{$row->idservicio}'>{$row->nombreservicio}</option>
        ";
      }
    }
  }

  // Listar servicios
  if($_GET['op'] == 'getServices'){
    $data = $service->getServices();
    loadServices($data);
  }

}

?>