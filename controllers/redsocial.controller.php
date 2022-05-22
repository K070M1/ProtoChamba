<?php
session_start();

require_once '../model/RedSocial.php';
$redsocial = new RedSocial();

if (isset($_GET['op'])){


  //Redes sociales
  function listRedSocial($data, $visible){

    if(count($data) <= 0){
      echo "<span>Sin redes sociales</span> ";
    }
    else{
      foreach($data as $row){

        $icono = "";
        $red = $row['redsocial'];

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
              {$icono}
            </td>
            <td>
              <a  href='{$row['vinculo']}' target='_blank'>{$red}</a>
            </td>
            <td align='right' {$visible}>
              <a data-idredSocial='{$row['idredsocial']}' class='btn btn-sm btn-outline-info btn-sm modificarRed' href='javascript:void(0)'><i class='fas fa-edit'></i></a>  
              <a data-idredSocial='{$row['idredsocial']}' class='btn btn-sm btn-outline-danger btn-sm eliminarRed' href='javascript:void(0)'><i class='fas fa-trash-alt'></i></a>             
            </td> 
          </tr>       
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
    $idusuario;
    $visible;
    
    if($_GET['idusuarioactivo'] != -1){
      $idusuario = $_GET['idusuarioactivo'];
      $visible = 'hidden';
    } else {
      $idusuario = $_SESSION['idusuario'];
      $visible = 'visible';
    }

    $data = $redsocial->getRedesSociales(["idusuario" => $idusuario]);
    listRedSocial($data, $visible);
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
      "idusuario"       =>  $_SESSION['idusuario'],
      "redsocial"       =>  $_POST["redsocial"],
      "vinculo"         =>  $_POST["vinculo"]
    ];

    $redsocial->registerRedSocial($datosEnviar);
  }

  if ($_POST['op'] == 'updateRedSocial'){

    $datosEnviar = [
      "idusuario"       =>  $_SESSION['idusuario'],
      "idredsocial"     =>  $_POST["idredsocial"],
      "redsocial"       =>  $_POST["redsocial"],
      "vinculo"         =>  $_POST["vinculo"]
    ];

    $redsocial->updateRedSocial($datosEnviar);
  }
}


?>