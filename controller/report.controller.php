<?php

require_once '../model/Report.php';

$report = new Report();

if(isset($_GET['op'])){

  function loadAllReportsDataTable($data){
    if(count($data) == 0){
      //
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
                <a class='dropdown-item' href='#'>Ver archivo adjunto</a>
                <!-- <a class='dropdown-item' href='#'>Marcar como no leído</a> -->
                <a class='dropdown-item' href='#'>Eliminar reporte</a>
                <!-- <div class='dropdown-divider'></div> -->
                <!-- <a class='dropdown-item' href='#'>Contactar usuario</a> -->
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

?>