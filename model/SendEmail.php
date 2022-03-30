<?php
use PHPMailer\PHPMailer\PHPMailer;  // Core (Nucleo)
use PHPMailer\PHPMailer\Exception;  // Contralador de expecepiones(Errores)
use PHPMailer\PHPMailer\SMTP;       // Administra protocolo envio correo

// Archivos requeridos ::  estan incluidos en la Clase Chat.php
/* require '../libs/PHPMailer/src/Exception.php';
require '../libs/PHPMailer/src/PHPMailer.php';
require '../libs/PHPMailer/src/SMTP.php'; */

class SendEmail{
  // Atributo
  private $mail;

  // Constructor 
  public function __CONSTRUCT(){
      //Instancia 
      $this->mail = new PHPMailer(true);
  }

  // Enviar correo
  function enviarCorreo($contenidomensaje, $correo){   
    try{
  
      //Server settings
      $this->mail->SMTPDebug = 0;                                       //Enable verbose debug output
      $this->mail->isSMTP();                                            //Send using SMTP
      $this->mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
      $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $this->mail->Username   = 'developersweb2021@gmail.com';          //SMTP username
      $this->mail->Password   = 'desarrolladoresweb2021';                               //SMTP password
      $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $this->mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
      //Recipients
      $this->mail->setFrom('developersweb2021@gmail.com', 'First Pay');
    
      // Copias del correo
      $this->mail->addAddress($correo);                           //Destinatarios
    
      //Content
      $this->mail->isHTML(true);                                  //Set email format to HTML
      $this->mail->Subject = "RECORDATORIO DE PAGOS";
      $this->mail->Body    = $contenidomensaje;
      $this->mail->AltBody = $contenidomensaje;
    
      $this->mail->CharSet = 'UTF-8';
      $this->mail->send();
      echo "";
    }
    catch (Exception $e){
      echo "No se ha podido enviar el correo electrónico, error: {$mail->ErrorInfo}";
    }
  } 
}
?>