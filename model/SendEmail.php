<?php
use PHPMailer\PHPMailer\PHPMailer;  // Core (Nucleo)
use PHPMailer\PHPMailer\Exception;  // Contralador de expecepiones(Errores)
use PHPMailer\PHPMailer\SMTP;       // Administra protocolo envio correo

require '../libs/PHPMailer/src/Exception.php';
require '../libs/PHPMailer/src/PHPMailer.php';
require '../libs/PHPMailer/src/SMTP.php';

class SendEmail{
  // Enviar correo
  function enviarCorreo($contenidomensaje, $correo){   
    $mail = new PHPMailer(true);

    try{
  
      //Server settings
      $mail->SMTPDebug = 0;                                       //Enable verbose debug output
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
      $mail->Username   = 'jarvis.team.2021@gmail.com';          //SMTP username
      $mail->Password   = 'jarvis.123';                           //SMTP password
      $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    
      //Recipients
      $mail->setFrom('jarvis.team.2021@gmail.com', 'Q TAL CHAMBA');
    
      // Copias del correo
      $mail->addAddress($correo);                           //Destinatarios
    
      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = "Notificaciones Q TAL CHAMBA";
      $mail->Body    = $contenidomensaje;
      $mail->AltBody = $contenidomensaje;
    
      $mail->CharSet = 'UTF-8';
      $mail->send();
      echo "";
    }
    catch (Exception $e){
      echo "No se ha podido enviar el correo electrónico: {$mail->ErrorInfo}";
    }
  } 
}
?>