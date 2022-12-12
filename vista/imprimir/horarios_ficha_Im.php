<?php
include('../../controlador/conexion.php');
session_start();
$correo = $_SESSION['ema'];
$inst = $_SESSION['nam'];
if (!isset($correo)) {
  header("location:../../index.php");
}

$trim_f = $_SESSION['trim'];
$id_f = $_GET['fich'];


//echo $trim_f,$id_f;
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <title>Horario Ficha Imprimir </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <table>
    <?php
    $fcht = mysqli_query($conn, "SELECT * FROM ficha,programa,tb_trimestre 
   WHERE ficha.fc_id_programa=programa.id_program and tb_trimestre.id_fch=ficha.ID_F AND ficha.ID_F=$id_f 
   and tb_trimestre.Trimestre='$trim_f'");
    $fchT = mysqli_fetch_assoc($fcht);
    ?>
    <tr>
      <th colspan="4" rowspan="3"><img src="../../img/sena_horarios_1.png" style="width: 500px;"></th>
      <th colspan="3">Versión: 03</th>
    </tr>
    <tr>
      <th colspan="3">Año: <?php echo date('Y'); ?></th>
    </tr>
    <tr>
      <th colspan="3">Taller</th>
    </tr>
    <tr>
      <th colspan="3">GRUPO: <?php echo $fchT['Nº ficha'] . " " . $fchT['Nom_program'] ?></th>
      <th colspan="2"><?php echo $fchT['Trimestre'] ?></th>
      <td colspan="2">Fecha: <?php echo $fchT['Trim_date_Inc']?>  a <?php echo $fchT['Trim_date_fin']  ?></td>
      
    </tr>
    <div>
    <tr class="dias">
      <th class="hora">Hora</th>
      <th class="horario">Lunes</th>
      <th class="horario">Martes</th>
      <th class="horario">Miercoles</th>
      <th class="horario">Jueves</th>
      <th class="horario">Viernes</th>
      <th class="horario">Sabado</th>
    </tr>
    <?php
    $days = array(0,1, 2, 3, 4, 5, 6,);
    $hours = array(1,9,2,10,3,11,4,12,5,13,6,14,7,15,8);
    foreach ($hours as $hour) {
    ?>
      <tr>
        <?php
        foreach ($days as $day) {
        ?>
          <td>
            <?php
            $querys_horas = "SELECT * FROM horas WHERE id_h=$hour";
            $result_horas = mysqli_query($conn, $querys_horas);
            while ($rcon = mysqli_fetch_assoc($result_horas)) {
              if ($day == 0) { ?> <strong><?php echo $rcon['hora']; ?></strong>
              <?php } ?>
            <?php } ?>
            <?php
            $query = "SELECT * FROM horarios,ficha,dias,horas,ambiente,tb_trimestre, programa, instructor 
                WHERE horarios.dia=$day AND horarios.hora=$hour
                AND horarios.id_ambiente=ambiente.id_A 
                AND horarios.instructor = instructor.ID
                and horarios.ficha=$id_f
                AND ficha.ID_F = tb_trimestre.id_fch 
                AND horarios.id_trim_fch=tb_trimestre.id_T
                AND horarios.hora = horas.id_h 
                AND ficha.fc_id_programa=programa.id_program";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            if (isset($row)) { ?>
              <ul>
                <li><?php echo $row['descripcion']; ?></li>
                <li style="color:red;"><?php echo $row['Nombre'] . " " . $row['Apellido']; ?></li>
                <li><?php echo $row['Nombre_ambiente']; ?></li>
              </ul>
            <?php
            } elseif ($hour == 12) {
              echo "Almuerzo";
            }elseif ($hour > 8) {
              echo "Descanso";
            }elseif (!isset($row)) {
              echo "&nbsp";
            
            } 

            ?>
          </td><?php
              }
              echo "</tr>";
            }
                ?>
      <tr>
      </div>
        <th colspan="5">COMPETENCIAS A DESARROLLAR</th>
        <?php
        $instructor = mysqli_query($conn, "SELECT * FROM instructor,tb_trimestre, ficha
      WHERE tb_trimestre.instructor_id = instructor.ID and tb_trimestre.Trimestre='$trim_f' 
      AND tb_trimestre.id_fch=ficha.ID_F AND ficha.ID_F=$id_f 
      AND tb_trimestre.Trimestre='$trim_f'");
        $ins = mysqli_fetch_assoc($instructor);

        $observaciones = mysqli_query($conn, "SELECT * FROM horarios");
        $obs = mysqli_fetch_assoc($observaciones);
        ?>
        <th colspan="3">JEFE DE TALLER  <p style="color:red;"><?php echo $ins['Nombre'] . " " . $ins['Apellido'] ?></p>
        </th>
      </tr>
      
      <tr>
        <th colspan="4" style="text-align: center;">Competencia</th>
        <th colspan="2" style="text-align: center;">Fecha de inicio y fin</th>
        <th colspan="2" style="text-align: center;">Instructor a cargo de la competencia</th>
        
      </tr>
        <?php
        $competencias = mysqli_query($conn, "SELECT * FROM competencias, programa,
        ficha WHERE ficha.fc_id_programa=programa.id_program
        AND competencias.programas_id = programa.id_program
        
        AND ficha.ID_F = $id_f");
        while ($row = mysqli_fetch_assoc($competencias)) {
        ?>
          <tr>
            <td colspan="4"><?php echo $row['competencias']; ?></td>
            <td colspan="2"><?php echo $row["fecha_ini"]." - ".$row["fecha_fin"]; ?></td>
            <td colspan="2"><?php echo $row["instructor"]; ?></td>
          </tr>
        <?php
        }
        ?>
        <tr>
        <th colspan="3" style="text-align: center;">Resultados</th>
        <th colspan="1" style="text-align: center;">Instructor asignado</th>
        <th colspan="3" rowspan="2">Observaciones:<?php echo $obs['observaciones'] ?></th>
        </tr>

        <?php
        $resultados = mysqli_query($conn, "SELECT * FROM resultados, programa,
        ficha WHERE ficha.fc_id_programa=programa.id_program
        AND resultados.programas_id = programa.id_program
        
        AND ficha.ID_F=$id_f ");
        while ($row = mysqli_fetch_assoc($resultados)) {
        ?>
          <tr>
            <td colspan="3"><?php echo $row['resultados']; ?></td>
            <td><?php echo $row["instructor_resultados"]; ?></td>
          </tr>
        <?php
        }
        ?>

  </table>
  <script>
    window.addEventListener("load", window.print());
  </script>
</body>

</html>