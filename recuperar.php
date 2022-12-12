<?php
session_start();
include('controlador/conexion.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function send_password_reset($get_name, $get_email, $token){
	$mail=new PHPMailer(true);                     
    $mail->isSMTP();                                                             
    $mail->SMTPAuth   = true;
	
	$mail->Host       = 'smtp.gmail.com';    
    $mail->Username   = 'pruebasparkymaya@gmail.com';                     
    $mail->Password   = '-2-3-4';                               
    $mail->SMTPSecure = "tls";            
    $mail->Port       = 587;                                    

    //Recipients
    $mail->setFrom('pruebasparkymaya@gmail.com', $get_name);
    $mail->addAddress($get_email);     //Add a recipient
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Restablecer contraseña del sistema horarios';
	$email_template="Hola

	<a href='http://localhost/horarios/cambio_contrasena.php?token=$token&email=$get_email'>Click Me</a>
	
	";
    $mail->Body= $email_template;
   

    $mail->send();
    echo 'Message has been sent';
}

if(isset($_POST['pass-reset'])){
	$email=mysqli_real_escape_string($conn, $_POST['correo'] );
	$token=md5(rand());

	$check_email="SELECT email FROM instructor WHERE email='$email' LIMIT 1";
	$check_email_run=mysqli_query($conn, $check_email);


	if(mysqli_num_rows($check_email_run)>0)
	{
		$row=mysqli_fetch_array($check_email_run);
		$get_name=$row['Nombre'];
		$get_email=$row['email'];

		$update_token="UPDATE instructor SET token='$token' WHERE email='$get_email' LIMIT 1";
		$update_token_run=mysqli_query($conn,$update_token);
		if($update_token_run){
			send_password_reset($get_name, $get_email, $token);
			$_SESSION['status'] = "Se ha enviado un link a tu correo";
			header("location:restablecer.php");
			exit(0);
		}
		else{
			$_SESSION['status'] = "Algo salio mal. #1";
			header("location:restablecer.php");
			exit(0);
		}
	}


	else
	{
		$_SESSION['status'] = "No se encontro ese correo en la base de datos";
		header("location:restablecer.php");
		exit(0);
	}
}

if(isset($_POST['password_update'])){
	$email=mysqli_real_escape_string($conn, $_POST['email']);
	$n_password=md5($_POST['new_password']);
	$c_password=md5($_POST['confirm_password']);
	$tokenn=mysqli_real_escape_string($conn, $_POST['token']);
	if(!empty($tokenn)){
		if(!empty($email)&&!empty($n_password)&&!empty($c_password)){
			$check_token="SELECT token from instructor WHERE token='$tokenn' LIMIT 1";
			$check_token_run=mysqli_query($conn, $check_token);

			if(mysqli_num_rows($check_token_run)>0){
				if($n_password == $c_password){
					
					$update_password="UPDATE instructor SET contrasena = '$n_password' WHERE token='$tokenn' LIMIT 1";
					$update_password_run=mysqli_query($conn,$update_password);

					if($update_password_run){
						
							$_SESSION['status'] = "Se ha cambiado la contraseña";
							header("location:cambio_contrasena.php");
							exit(0);
						
					}else{
					$_SESSION['status'] = "No se pudo cambiar la contraseña, algo salio mal";
					header("location:cambio_contrasena.php?token=$token&email=$email");
					exit(0);
				}
				}
				else{
					$_SESSION['status'] = "Las contraseñas no coinciden";
					header("location:cambio_contrasena.php?token=$token&email=$email");
					exit(0);
				}
			}else{
				$_SESSION['status'] = "El token no es valido";
				header("location:cambio_contrasena.php?token=$token&email=$email");
				exit(0);
			}
		}
		else{
			$_SESSION['status'] = "Todos los campos son obligatorios";
			header("location:cambio_contrasena.php?token=$token&email=$email");
			exit(0);

		}
	} 
	else{
		$_SESSION['status'] = "El token no esta habilitado";
		header("location:cambio_contrasena.php");
		exit(0);
	}
}
?>