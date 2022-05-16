<?php
session_start();
date_default_timezone_set("America/Lima");
require_once '../model/Mailer.php';

$mailer = new Mailer();

function generateCode(){
    $lenght = 10;
    $base = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ@$';
    $longitud = strlen($base);
    $code = '';
    for($i = 0; $i < $lenght; $i++){
        $random = $base[mt_rand(0, $longitud -1)];
        $code .= $random;
    }

    $validaciones = [
        'code' => $code,
        'fechainicio' => date('G:i:s'),
        'tiempovida' => strtotime( date('G:i:s')."+ 45 seconds"),
        'fechamuerte' =>  date('G:i:s', strtotime( date('G:i:s')."+ 45 seconds"))
    ];
    return $validaciones;
}

if (isset($_POST['op'])) {

    if($_POST['op'] == "sendEmailPassword"){
        $codigogenerado = generateCode();       
        $_SESSION['code'] = $codigogenerado['code'];
        $_SESSION['tiempolimite'] = $codigogenerado['fechamuerte'];
        
        $mailer->sendMail($_POST['email'], 'Su código de verificación es: '.  $_SESSION['code']);
            
        echo "El código es: ". $_SESSION['code'];
    };

    if($_POST['op'] == 'autentificationCode'){
        $generado = $_SESSION['code'];
        $limite = $_SESSION['tiempolimite'];
        $comprobar = $_POST['code'];

        if($limite < date('G:i:s')){
            // Se genera otro codigo
            $codigogenerado = generateCode();       
            $_SESSION['code'] = $codigogenerado['code'];
            $_SESSION['tiempolimite'] = $codigogenerado['fechamuerte'];

            $mailer->sendMail($_POST['email'], 'Su código de verificación es: '.  $_SESSION['code']);
       
            echo 'Expirado';
 
        }else{
            if($generado == $comprobar){
                echo 'Acceso';
            }else{
                echo 'Intente';
            }
        }
        
    }


}

?>