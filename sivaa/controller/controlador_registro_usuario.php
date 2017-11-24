<?php
session_start();
//echo "<br>" . $_SERVER['PHP_SELF'];
error_reporting(0);

require_once("../model/modelo_registro_usuario.php");

/********************************************
Actualizar Datos
*********************************************/

if ($_POST['valida_documento'] == 1) {
	$documento = $_POST['documento'];
	$_SESSION['cedula'] = $documento;

	$cedula = $_SESSION['cedula'];

	$valida_documento = new Registro_usuario();
	$result_documento = $valida_documento->select_documento($documento);

	if ($result_documento != 0) {
		$valida_documento_2 = new Registro_usuario();
		$result_documento_2 = $valida_documento_2->select_documento_registrado($documento);

		if ($result_documento_2 == 0) {
			header("location:/sivaa/view/app/pages/Reguistro_de_usuario.php"); //Lo envia al formulario para registrarce
		} else {
			echo '<script language="javascript">alert("El documento '.$cedula.'. Ya cuenta con un suario registrado");</script>'; 
            echo '<script>document.location.href="../index.php" </script>';
			//header("location:/sivaa/index.php?alerta_usuario=1"); //Envia alerta de usuario ya registrado
		}
	} else {
		echo '<script language="javascript">alert("El documento '.$cedula.'. No se encuentra registrado.\\nComuniquese con el administrador");</script>'; 
        echo '<script>document.location.href="../index.php" </script>';
		//header("location:/sivaa/index.php?error_usuario=1"); //Envia alerta de numero de documento incorecto
	}
}

if ($_POST['ingresar_usuario'] == 1) {
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$correo = $_POST['correo'];
	$sexo = $_POST['sexo'];
	$direccion = $_POST['direccion'];
	$telefono = $_POST['telefono'];
	$pass = sha1($_POST['pass']);
	$cedula = $_SESSION['cedula'];

	//$pass = sha1($_POST['pass']);

	$usuario = new Registro_usuario();
	$usuario->inser_usuario($_SESSION['cedula'], $nombre, $apellido, $correo, $sexo, $direccion, $telefono, $pass);

	/*header("location:/sivaa/view/app/pages/index.php");*/
	$code = sha1(uniqid(rand()));
	$updatetoken = new Registro_usuario();
	$Actualizar_token = $updatetoken->update_token($code,$cedula);

    $mensaje = "
       Buen dia, $nombre
       <br /><br />
       Este es un mensaje para activar el usuario de la aplicacion Sivaa (Sistema de verificacion de ambientes de aprendizaje), haga clic en el siguiente enlace para confirmar la activacion del usuario, si no solo ignore este correo electrónico,
       <br /><br />
      <a href='http://localhost:8080/sivaa/view/app/pages/usuario_activo.php?cedula=$cedula&token=$code'>Haga clic aquí para activar su usuario</a>

       <br /><br />
       Gracias 
       ";

    $asunto = "Activar Usuario";
                
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
	  $mail->FromName = "Activar usuario Sivaa";
	  $mail->AddAddress($correo);
	  //$mail->AddReplyTo("tattox.20@gmail.com", "gracias");
	  $mail->Subject = $asunto;
	  $mail->Body = ($mensaje);
	  $mail->WordWrap = 50;

	  if(!$mail->Send()) 
	  {
	    echo '<script language="javascript">alert("no fue posible enviar correo de validacion.'.$mail->ErrorInfo.'");</script>';
	    echo '<script>document.location.href="../index.php" </script>';
	  exit;
	  } else {
	    echo '<script language="javascript">alert("Se envio un mensaje al correo: '.$correo.' para realizar la activacion del usuario ");</script>'; 
	    echo '<script>document.location.href="../index.php" </script>';
	  }       
   }

/********************************************
*********************************************
*********************************************/
?>