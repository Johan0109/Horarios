<?php 
include ('conexion.php');
session_start();
$correo=$_SESSION['ema'];

if (!isset($correo)) {
    header("location:../index.php");
}
$rol=$_SESSION['rol'];
 if ($rol==2) {
   header('location:../horarios.php');
}

$id_trim=$_SESSION['id_trim'];//variable de id trimestre
$ficha_=$_GET['f_h'];
$ins=$_POST['ins'];
$checkdia=$_POST['checkdia'];
$checkhora=$_POST['checkhora'];


  
$amb=$_POST['idAB'];
$hora_i=2; 
$descripcion=$_POST['descrip'];
$observaciones=$_POST['observaciones'];

$querys=mysqli_query($conn,"SELECT SUM(horas_instructor) AS total FROM horarios,tb_trimestre
WHERE horarios.id_trim_fch=tb_trimestre.id_T
AND tb_trimestre.estatus_trim_H=0 AND horarios.id_trim_fch=$id_trim");//suma horas de instructor del estado de la ficha trimestre fecha en el horario---
$row=mysqli_fetch_array($querys);
$sum=$row['total'];





if ($sum<40) {  
    
    foreach ($checkdia as $dia) {
      foreach ($checkhora as $hora) {

        $query="INSERT INTO `horarios`(`id_hora`, `dia`, `ficha`, `instructor`, `hora`, `id_ambiente`, `horas_instructor`, `id_trim_fch`, `descripcion`, `observaciones`) 
        VALUES (NULL,'$dia','$ficha_','$ins','$hora','$amb','$hora_i','$id_trim','$descripcion','$observaciones')";
        mysqli_query($conn,$query);
      }
    }
  
      echo "<script>
                  window.location= '../vista/admin/horarios_ficha.php?ficha=$ficha_'
              </script>";
            }
   
    
elseif ($sum>=40) {
  $cons=mysqli_query($conn,"SELECT * FROM instructor where ID='$ins'");
  $rows=mysqli_fetch_assoc($cons);
  $nom=$rows['Nombre'];
  $ape=$rows['Apellido'];
  echo "<script>
                  alert('Se han completado las horas semanales');
                   window.location= '../vista/admin/horarios_ficha.php?ficha=$ficha_'
              </script>"; 
   
}
