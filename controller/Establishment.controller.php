<?php
require_once '../model/Establishment.php';

// Objeto establishment
$establishment = new Establishment();

if (isset($_GET['op'])) {
  switch ($_GET['op']) {
    case 'getEstablishments':
      $data = $establishment -> getEstablishments([]);
      echo json_encode($data);
      break;
    
    default:
      # code...
      break;
  }
}