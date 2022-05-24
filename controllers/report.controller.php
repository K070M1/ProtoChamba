<?php
session_start();
require_once '../model/Report.php';

$report = new Report();

if(isset($_GET['op'])){

  // Mostrar todos los reportes realizados en una estructura HTML
  function loadAllReportsDataTable($data){
    if(count($data) == 0){
      echo "";
    }
    else{
      foreach($data as $row){
        echo "
        <tr>
          <td>{$row->usuario}</td>
          <td>{$row->motivo}</td>
          <td>{$row->descripcion}</td>
          <td>{$row->fechareporte}</td>
          <td>
            <div class='btn-group'>
              <button type='button' class='btn btn-sm btn-default'>
                Acción
              </button>
              <button type='button' class='btn btn-sm btn-default dropdown-toggle dropdown-icon' data-toggle='dropdown' aria-expanded='false'>
                <span class='sr-only'>Toggle Dropdown</span>
              </button>
              <div class='dropdown-menu' role='menu'>
                <a class='dropdown-item btn-open-modal-report' href='javascript:void(0)' data-img='{$row->fotografia}'>Ver archivo adjunto</a>
                <a class='dropdown-item btn-ban-user' href='javascript:void(0)' data-code='{$row->idusuario}'>Banear usuario</a>
              </div>
            </div>
          </td>
        </tr>
        
        ";
      }
    }
  }

  // Mostrar todos los reportes
  if($_GET['op'] == 'getReports'){
    $data = $report->getReports();
    loadAllReportsDataTable($data);
  }
}

if(isset($_POST['op'])){

  // registrar
  if($_POST['op'] == 'registerReport'){
    // Validar si existe imagen
    if (isset($_FILES['fotografia'])){
      $ext = explode('.', $_FILES['fotografia']['name']);     // Separar la extension de la imagen
      $image = date('Ymdhis') . '.' . end($ext);              // Renombrar imagen
    }
    else{
      $image = "";
    }

    // registrar reporte
    $report->registerReport([
      "idcomentario"  => $_POST['idcomentario'],
      "motivo"        => $_POST['motivo'],
      "descripcion"   => $_POST['descripcion'],
      "fotografia"    => $image
    ]);


    // guardar si existe imagen
    if($image != ""){
      move_uploaded_file($_FILES['fotografia']['tmp_name'], '../dist/img/user/' . $image);
    }
  }
}
?>