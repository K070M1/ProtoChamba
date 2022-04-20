<?php

require_once '../model/RedSocial.php';
$redsocial = new RedSocial();

if (isset($_GET['op'])){


  //sERVICIOS
  function listRedSocial($data){

    if(count($data) <= 0){
      echo " ";
    }
    else{
      foreach($data as $row){

        $icono;
        $red = $row['redsocial'];
        $icono = $red;

        if ($red == 'I'){
          $red = "Instagram";
          $icono = '<i class="fab fa-instagram"></i>';
        }elseif($red == 'F'){
          $red = "Facebook";
          $icono ='<i class="fab fa-facebook"></i>';
        }elseif($red == 'W'){
          $red = "WhatsApp";
          $icono ='<i class="fab fa-whatsapp"></i>';
        }elseif($red == 'T'){
          $red = "Twitter";
          $icono ='<i class="fab fa-twitter"></i>';
        }elseif($red == 'Y'){
          $red = "YouTube";
          $icono ='<i class="fab fa-youtube"></i>';
        }
        elseif($red == 'K'){
          $red = "Tik Tok";
          $icono ='<i class="fab fa-tiktok"></i>';
        }
      

        echo "
          <tr>
            <td align='center'>
              $icono
            </td>
            <td>
              <a  href='{$row['vinculo']}'>$red</a>
            </td>
            <td>
              <a data-idredSocial='{$row['idredsocial']}' class='btn btn-outline-info btn-sm modificarRed' href='#'><i class='fas fa-edit'></i></a>  
              <a data-idredSocial='{$row['idredsocial']}' class='btn btn-outline-danger btn-sm eliminarRed' href='#'><i class='fas fa-trash-alt'></i></a>             
            </td> 
          </tr>
          <hr>

          
        ";
      }
    }
  }

  if($_GET['op'] == 'getRedSocial'){
    $data = $redsocial->getRedSocial(["idredsocial" => $_GET['idredsocial']]);
    echo json_encode($data);
  }

  //Listar redesSociales
  if ($_GET['op'] == 'getRedesSociales'){

    $data = $redsocial->getRedesSociales(["idusuario" => 1]);
    listRedSocial($data);
  }

  //Eliminar RedSocial
  if ($_GET['op'] == 'deleteRedSocial'){

    $redsocial->deleteRedSocial(["idredsocial" => $_GET['idredsocial']]);

  }

}

// MÉTODO POST

if (isset($_POST['op'])){

  if ($_POST['op'] == 'registerRedSocial'){

    $datosEnviar = [
      "idusuario"      =>  1,
      "redsocial"       =>  $_POST["redsocial"],
      "vinculo"         =>  $_POST["vinculo"]
    ];

    $redsocial->registerRedSocial($datosEnviar);

  }

  if ($_POST['op'] == 'updateRedSocial'){

    $datosEnviar = [
      "idusuario"       =>  1,
      "idredsocial"     =>  $_POST["idredsocial"],
      "redsocial"       =>  $_POST["redsocial"],
      "vinculo"         =>  $_POST["vinculo"]
    ];

    $redsocial->updateRedSocial($datosEnviar);
  }


}


?>