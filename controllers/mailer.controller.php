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
        'tiempovida' => strtotime( date('G:i:s')."+ 25 seconds"),
        'fechamuerte' =>  date('G:i:s', strtotime( date('G:i:s')."+ 25 seconds"))
    ];
    return $validaciones;
}

$_SESSION['code'];
$_SESSION['tiempolimite'];

if (isset($_POST['op'])) {

    if($_POST['op'] == "sendEmailPassword"){
        $codigogenerado = generateCode();       
        $_SESSION['code'] = $codigogenerado['code'];
        $_SESSION['tiempolimite'] = $codigogenerado['fechamuerte'];
        
        $mailer->sendMail('1321063@senati.pe', 'Su código de verificación es: '.  $_SESSION['code']);

        echo "El código es: ". $_SESSION['code'];
    };

    if($_POST['op'] == 'autentificationCode'){
        $generado = $_SESSION['code'];
        $limite = $_SESSION['tiempolimite'];
        $comprobar = $_POST['code'];
        echo 'El tiempo limite es '.$limite."\n";
        echo 'El cÓdigo es '. $generado ."\n";

        if($limite < date('G:i:s')){
            // Se genera otro codigo
            $codigogenerado = generateCode();       
            $_SESSION['code'] = $codigogenerado['code'];
            $_SESSION['tiempolimite'] = $codigogenerado['fechamuerte'];

            $mailer->sendMail('1299595@senati.pe', 'Su código de verificación es: '.  $_SESSION['code']);

            echo 'Tiempo acabado'. "\n";
            echo 'Se genero otro codigo'. "\n";
            echo $_SESSION['code'];
        }else{
            if($generado == $comprobar){
                echo 'Acceso exitoso';
            }else{
                echo 'Intente otra vez';
            }
        }
        
    }


}

?>