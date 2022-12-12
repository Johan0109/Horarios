<?php 
include("../conexion.php");
 session_start();

  $correo=$_SESSION['ema'];

if (!isset($correo)) {
    header("location:../../index.php");
}
$rol=$_SESSION['rol'];
 if ($rol==2) {
   header('location:../../horarios.php');
}
$fch=$_SESSION['fh'];
$id = $_GET['id'];
$ins = $_POST['instructor'];
$days = $_POST['days'];
$hours = $_POST['hour'];
$descripcion = $_POST['descrip'];



$query="UPDATE `horarios` SET `instructor`='$ins', `dia`='$days', `hora`='$hours', `descripcion`='$descripcion' 
WHERE `id_hora`='$id'";

 mysqli_query($conn,$query);
 header("location:../../vista/admin/horarios_ficha.php?ficha=$fch");

 ?>