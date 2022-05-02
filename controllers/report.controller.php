<?php

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
                <a class='dropdown-item btn-open-modal-report' href='#' data-img='{$row->fotografia}'>Ver archivo adjunto</a>
                <a class='dropdown-item btn-ban-user' href='#' data-code='{$row->idusuario}'>Banear usuario</a>
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