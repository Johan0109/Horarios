<?php
include('../../controlador/conexion.php');
session_start();
$correo = $_SESSION['ema'];
$inst = $_SESSION['nam'];
if (!isset($correo)) {
  header("location:../../index.php");
}
$rol = $_SESSION['rol'];
if ($rol == 2) {
  header('location:../horarios.php');
}


$id_ins = $_GET['instructor'];


?>
<?php
$pageTitle = 'Horarios instructor';
include("plantilla-horarios.php");
?>

<div class="content-wrapper">
  <?php

  $con_ins = mysqli_query($conn, "SELECT * FROM instructor WHERE ID='$id_ins'");
  $rowins = mysqli_fetch_array($con_ins);
  ?> <br>
  <!--div TABLAS-->
  <div class="container">
    <h2><?php echo "Instructor " . $rowins['Nombre'] . " " . $rowins['Apellido'] ?></h2>
    <br>
    <div class="table-responsive-sm">
      <table class="table table-hover table-sm" id="example">
        <thead class="bg-orange">
          <tr class="text-white">
            <th>Horas</th>
            <th>Lunes</th>
            <th>Martes</th>
            <th>Miercoles</th>
            <th>Jueves</th>
            <th>Viernes</th>
            <th>Sabado</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $days = array(0, 1, 2, 3, 4, 5, 6);
          $hours = array(1, 2, 3, 4, 5, 6, 7, 8);
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
                  $querys = "SELECT * FROM horarios,ficha,instructor,dias,horas,ambiente,tb_trimestre,programa
                            WHERE horarios.dia=$day AND ficha.fc_id_programa=programa.id_program AND horarios.hora=$hour 
                           AND horarios.dia=dias.id AND horarios.ficha=ficha.ID_F AND horarios.instructor = instructor.ID 
                           AND horarios.hora = horas.id_h and horarios.id_trim_fch=tb_trimestre.id_T 
                           and horarios.instructor=$id_ins";
                  /* $querys = "SELECT * FROM horarios,ficha,instructor,dias,horas,ambiente,tb_trimestre,programa WHERE horarios.dia=$day AND ficha.fc_id_programa=programa.id_program AND horarios.hora=$hour AND horarios.dia=dias.id AND horarios.ficha=ficha.ID_F AND horarios.instructor = instructor.ID AND horarios.id_ambiente=ambiente.id_A AND horarios.hora = horas.id_h and horarios.id_trim_fch=tb_trimestre.id_T and tb_trimestre.Trimestre='$Trimest' and horarios.instructor=$id_ins"; */
                  $result = mysqli_query($conn, $querys);
                  $row = mysqli_fetch_assoc($result);
                  if (isset($row)) { ?>
                    <ul class="list-unstyled">
                      <li><?php echo "Ficha: " . $row['Nº ficha']; ?></li>
                      <li><?php echo $row['Trimestre']; ?></li>
                      <li><?php echo "Prog: " . $row['Nom_program']; ?></li>
                      <li><?php echo "Amb: " . $row['Nombre_ambiente']; ?></li>
                      <li><?php echo $row['descripcion']; ?></li>
                    </ul>
                  <?php
                  } elseif (!isset($row)) {
                    echo "&nbsp";
                  } ?>
                </td><?php
                    }
                  }
                      ?>
            </tr>
            <?php
            $sumas = "SELECT SUM(horas_instructor) as total FROM horarios,tb_trimestre WHERE horarios.id_trim_fch=tb_trimestre.id_T AND horarios.instructor=$id_ins AND tb_trimestre.estatus_trim_H=0 ";
            $hins = "SELECT SUM(horas_inst) as totalinst FROM instructor WHERE instructor.ID=$id_ins ";
            $resulsuma = mysqli_query($conn, $sumas);
            $resulinstructores = mysqli_query($conn, $hins);
            $rowsum = mysqli_fetch_array($resulsuma);
            $rowin = mysqli_fetch_array($resulinstructores);
            $sum = $rowsum['total'];
            $sumin = $rowin['totalinst'];
            $res = $sumin - $sum;

            ?>
            <tr class="table-bordered table-dark" style="color: black;">
              <th colspan="4">Observaciones:</th>
              <th colspan="3">Instructor: <?php echo $rowins["Nombre"] . " " . $rowins["Apellido"]; ?></th>
            </tr>
            <tr class="table-bordered table-dark" style="color: black;">
              <td colspan="4" rowspan="2"></td>
              <td colspan="2">Horas directas Formación</td>
              <td colspan="1"><?php echo $sum; ?></td>
            </tr>
            <tr class="table-bordered table-dark" style="color: black;">
              <td colspan="2">Horas pendientes de programar</td>
              <td colspan="1"><?php echo $res; ?></td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
</div>
</div>
</tbody>
</div>
<?php
include("pantilla-footer.php");
?>
</div>
</body>

</html>