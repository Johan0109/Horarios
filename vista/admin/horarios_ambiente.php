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


$id_amb = $_GET['amb'];


?>
<?php
$pageTitle = 'Horarios ambiente';
include("plantilla-horarios.php");
?>
<aside id="lt_aside" class="main-sidebar sidebar-dark-primary" style="position: fixed;">
<a href="../horarios.php" style="color: white;">
    <img src="../../img/logo.png" style="width: 50px;height:50px;margin-left: 10px;margin-top: 5px;">
    <span class="brand-text font-weight-bold">CENIGRAF</span>
  </a>
  <div class="sidebar">
        <div class="user-panel mt-4 pb-4" style="color:white;">
            <i class="nav-icon fas fa-solid fa-user ml-3"></i> 
            <span class="brand-text font-weight-bold"> Admin-<?php echo $inst; ?></span>
        </div>
      </div>
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
        <li class="nav-item">
          <a href="../imprimir/horarios_Amb_Im.php?amb=<?php echo $id_amb; ?>" class="nav-link" style="color:white;">
            <i class="nav-icon fas fa-solid fa-print"></i>
            <p>
              Imprimir | Descargar
            </p>
          </a>
        </li>
  </div>
</aside>
<div class="content-wrapper">
  <?php
  $con_amb = mysqli_query($conn, "SELECT * FROM ambiente WHERE id_A='$id_amb'");
  $rowamb = mysqli_fetch_array($con_amb);
  ?>
  <br>
  <div class="container">
    <h2><?php echo "Ambiente " . $rowamb['Nombre_ambiente'] ?></h2>
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
          $days = array(0, 1, 2, 3, 4, 5, 6,);
          $hours = array(1, 0, 2, 0, 3, 0, 4, 0, 5, 0, 6, 7, 0, 8);
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
                  $querys = "SELECT * FROM horarios,ficha,dias,horas,ambiente,tb_trimestre,programa 
                  WHERE horarios.dia=$day AND horarios.hora=$hour AND horarios.dia=dias.id 
                  AND horarios.ficha=ficha.ID_F AND horarios.id_ambiente=ambiente.id_A 
                  AND horarios.hora = horas.id_h AND horarios.id_trim_fch=tb_trimestre.id_T 
                  AND ficha.fc_id_programa=programa.id_program
                  AND horarios.id_ambiente=$id_amb AND tb_trimestre.estatus_trim_H=0";

                  $result = mysqli_query($conn, $querys);
                  $row = mysqli_fetch_assoc($result);
                  if (isset($row)) { ?>
                    <ul class="list-unstyled">
                      <li><?php echo "Ficha: " . $row['Nº ficha']; ?></li>
                      <li><?php echo $row['Trimestre']; ?></li>
                      <li><?php echo "Prog: " . $row['Nom_program']; ?></li>
                    </ul>
                  <?php
                  } elseif (!isset($row)) {
                    echo "&nbsp";
                  }
                  ?>
                </td>
            <?php
              }
              echo "</tr>";
            }
            ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</div>
<?php
?>
</div>
<?php
include("pantilla-footer.php");
?>
</div>
</body>

</html>