<?php

require_once '../model/Follower.php';
$follower = new Follower();

if (isset($_GET['op'])){

  // CListar seguidores
  if ($_GET['op'] == 'getFollowersByUser'){

    $data = $follower->getFollowersByUser(["idusuario" => $_GET['idusuario']]);

    if($data){
      echo json_encode($data);
    }
  }


  // CListar seguidos
  if ($_GET['op'] == 'getFollowedByUser'){

    $data = $follower->getFollowedByUser(["idusuario" => $_GET['idusuario']]);

    if($data){
      echo json_encode($data);
    }

  }



}

?>