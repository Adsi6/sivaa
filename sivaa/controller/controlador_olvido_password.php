<?php
//session_start();
//echo "<br>" . $_SERVER['PHP_SELF'];
error_reporting(0);

require_once("../model/modelo_olvido_password.php");

/********************************************
envio correo para Recuperar Contraseña
*********************************************/

if ($_POST['recuperar'] == 1) {
	$correo = $_POST['correo'];

	$sqlcorreo = new olvido_password();
	$consulta_correo = $sqlcorreo->select_correo($correo);


  if ($consulta_correo != 0) {
 		foreach ($consulta_correo as $cedula_correo) {
      $cedula = $cedula_correo['cedula'];
      $nombre = $cedula_correo['nombre'];
			$apellido = $cedula_correo['apellido'];
		}
		$code = sha1(uniqid(rand()));

		$updatetoken = new olvido_password();
		$Actualizar_token = $updatetoken->update_token($code,$cedula);

    $mensaje = "
      Buen dia, $nombre $apellido
      <br /><br />
      Se ha realizado una solicitud para restablecer su contraseña, haga clic en el siguiente enlace para continuar con el proceso.
      <br /><br />
      <a href='http://localhost:8080/sivaa/view/app/pages/Olvido_password.php?cedula=$cedula&token=$code'>Haga clic aquí para restablecer la contraseña</a>

      <br /><br />
      
      ";

    $asunto = "Cambiar Password";
              
    require_once('../view/app/email/class.phpmailer.php');

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";
    $mail->Host = "mail.smtp2go.com";
    $mail->Port = "2525"; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'SSL';
    $mail->Username = "grupo6adsi@gmail.com";
    $mail->Password = "ADSI1193334G1";
    $mail->MsgHTML($mensaje);
    $mail->From = "grupo6adsi@gmail.com";
    $mail->FromName = "Cambio de Password";
    $mail->AddAddress($correo);
    //$mail->AddReplyTo("tattox.20@gmail.com", "gracias");
    $mail->Subject = $asunto;
    $mail->Body = ($mensaje);
    $mail->WordWrap = 50;

    if(!$mail->Send()) {
      echo '<script language="javascript">alert("No fue posible enviar correo de validacion.'.$mail->ErrorInfo.'");</script>'; 
    exit;
    } else {
      echo '<script language="javascript">alert("Se ha enviado un correo electrónico a: '.$correo.' para realizar el cambio de contraseña.\\nSi no lo encuntra en bandeja de entrada, revice la bandeja spam.");</script>'; 
      echo '<script>document.location.href="../index.php" </script>';
    }
               
  } else {
      echo "<script> alert('El correo que ingreso no es correcto');</script>"; 
      echo '<script>document.location.href="../index.php" </script>';
  }
}
/********************************************
Recuperar Contraseña
*********************************************/

if ($_POST['recuperar_pass'] == 1) {
$cedula = $_POST['cedula'];
$pass = sha1($_POST['pass']);
  $valida_pass = sha1($_POST['valida_pass']);

  if($pass == $valida_pass){

      $coden = sha1(uniqid(rand()));

      $actualizar_pass = new olvido_password();
	$actualizar_pass->actualizar_pass($cedula,$pass,$coden);

      echo "<script> alert('Se realizo el cambio de la contraseña.');  </script>";
      echo '<script>document.location.href="../index.php" </script>';
  }else{
      echo "<script> alert('La contraseña no es correcta.'); </script>";
      echo '<script>document.location.href="../index.php" </script>';
  }
}
/********************************************
*********************************************
*********************************************/
?>