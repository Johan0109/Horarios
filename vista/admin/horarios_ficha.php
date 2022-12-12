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
if (isset($_GET['ficha'])) {

  $id_ficha = $_GET['ficha'];
  $_SESSION['fh'] = $id_ficha; // id ficha para eliminar horario
  $title = mysqli_query($conn, "SELECT * FROM ficha WHERE ID_F ='$id_ficha'");
  $titles = mysqli_fetch_assoc($title);
}

if (isset($_GET['trims'])) {
  $_SESSION['trim'] = $_GET['trims'];
}

?>



<?php
$pageTitle = 'Horarios ficha';
include("plantilla.php");
?>
<div class="content-wrapper">
  <div class="container">
    <div>
      <button type="button" class="btn btn-secondary btn-block " data-toggle="collapse" data-target="#col" style="cursor: pointer;">Seleccionar el nivel del programa y el trimestre </button>
    </div>
    <div class="collapse" id="col">
      <div class="container border" style="padding:4%; background-color: #a2a1a5a8;">
        <form method="GET" class="form-horizontal">
          <div class="form-group">
            <select class="form-control" name="nivel_F" required>
              <option value="">Selecione nivel programa </option>
              <option value="Tecnico">Técnico</option>
              <option value="Tecnólogo">Tecnólogo</option>
              <option value="Especialización">Especialización</option>
            </select><br>
            <select class="form-control" name="Trimestre" required>
              <option value="">Seleccione el trimestre </option>
              <option value="I Trimestre">I Trimestre</option>
              <option value="II Trimestre">II Trimestre</option>
              <option value="III Trimestre">III Trimestre</option>
              <option value="IV Trimestre">IV Trimestre</option>
              <option value="V Trimestre">V Trimestre</option>
              <option value="VI Trimestre">VI Trimestre</option>
              <option value="VII Trimestre">VII Trimestre</option>
            </select>
          </div>
          <button type="submit" class="btn btn-dark">Enviar</button>
        </form>
      </div>
    </div>
    <?php
    if (isset($_GET['nivel_F'])) {
      $nil = $_GET['nivel_F'];
      $trim_ = $_GET['Trimestre'];
      $_SESSION['trim'] = $trim_; //variable de trimreste para consulta y registro del horario
      $query = "SELECT * FROM ficha,programa,tb_trimestre WHERE ficha.fc_nivel='$nil' 
      and ficha.fc_id_programa=programa.id_program AND tb_trimestre.id_fch=ficha.ID_F AND tb_trimestre.Trimestre='$trim_'";
      $cont = mysqli_query($conn, $query);
      echo "<center><h3>" . $nil . " " . $trim_ . " </h3></center>";
    ?>
      <div class="container border" style="padding:4%; background-color: #a2a1a5a8;">
        <form id="Formulario" method="GET" class="form-horizontal">
          <select class="form-control" name="ficha"  data-live-search="true"  data-show-subtext="false" required>
            <option value="">Seleccione la ficha </option>
            <?php
            while ($row = mysqli_fetch_assoc($cont)) {
            ?>
              <option value="<?php echo $row['ID_F'] ?>"><?php echo $row['Nº ficha'] . " " . $row['Nom_program']; ?></option>
            <?php
            }
            ?>
          </select> 
         <br>
          <button type="submit" id="Enviar" class="btn btn-dark ">Enviar</button>
        </form>
      </div> 
    <?php
    }
    ?>
  </div>
  <?php
  if (isset($_GET['ficha'])) {
    $trim_f = $_SESSION['trim']; //variable del trimestre para consulta 
    $prueVar = mysqli_query($conn, "SELECT * FROM tb_trimestre WHERE id_fch=$id_ficha and Trimestre='$trim_f'");
    $rowVar = mysqli_fetch_assoc($prueVar);
    if ($rowVar['estatus_trim_H'] == 1) {
  ?>
      <style type="text/css">
        #uso_des {
          background-color: red;
        }
      </style>
    <?php
    } elseif ($rowVar['estatus_trim_H'] == 0) {
      //echo "fechas no iguales";
    ?>
      <style type="text/css">
        #uso_des {
          background-color: #28a745;
        }
      </style>
    <?php
    }
    //Fecha 
    $con_fch = mysqli_query($conn, "SELECT * FROM ficha,programa,tb_trimestre WHERE ID_F='$id_ficha' and ficha.fc_id_programa=programa.id_program AND tb_trimestre.id_fch=ficha.ID_F AND tb_trimestre.Trimestre='$trim_f'");
    $rowfch = mysqli_fetch_array($con_fch); //Consulta y ver informacion ficha parte superior del horario 
    $_SESSION['id_trim'] = $rowfch['id_T']; //variable de trimestre de ficha 
    $trimestre_id = $rowfch['id_T'];
    ?>
    <!--/modales-->
    <?php
    include('crear-horario.php');
    ?>
    <?php
    $est_fch = $rowfch['ID_F'];
    $esta_trim = mysqli_query($conn, "SELECT * FROM ficha,tb_trimestre WHERE ficha.ID_F=tb_trimestre.id_fch and ficha.ID_F=$est_fch and tb_trimestre.estatus_trim_H=0");
    $row_estfch = mysqli_fetch_assoc($esta_trim);
    ?>
    <br>
    <!--div TABLAS-->
    <div class="container">
      <div class="d-flex flex-column align-items-center">
        <h3><?php echo "Ficha " . $rowfch['Nº ficha'] . " " . $rowfch['fc_nivel']; ?></h3>
        <h4><?php echo "Programa " . $rowfch['Nom_program']; ?></h4>
        <?php if (isset($row_estfch['Trimestre'])) { 
          ?><h5>El Trimestre activo de la ficha es <?php echo $row_estfch['Trimestre']; ?></h5><?php
        } else {
          echo "<h2>La ficha no cuenta con un horario activo</h2>";
        }
        ?>
      </div>

      <div class="container">
        <div class="table-responsive-sm">
          <!--div1tabla -->
          <table class="table table-hover table-sm">
            <thead class="bg-orange">
              <tr class="text-white bg-secondary">
                <td colspan="2"><?php echo "Grupo: " . $rowfch['Nº ficha']; ?> </td>
                <td colspan="2">
                  <?php echo $rowfch['Trimestre']; ?>
                </td>
                <td colspan="1">
                  <div class="btn-group" style="display: flex;">
                    <button class="btn btn-success" onclick="window.open('../../controlador/estado.php?est=1&fich=<?php echo $id_ficha ?>','_Self')">Activo</button>
                    <button class="btn btn-danger" onclick="window.open('../../controlador/estado.php?est=2&fich=<?php echo $id_ficha ?>','_Self')">Inactivo</button>
                  </div>
                </td>
                <td id="uso_des" colspan="1">Estado</td>
                <td colspan="2"></td>
              </tr>
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
                      $querys = "SELECT * FROM horarios,ficha,instructor,dias,horas,tb_trimestre
                      WHERE horarios.dia=$day  AND horarios.dia = dias.id AND horarios.hora=$hour 
                      AND horarios.instructor = instructor.ID 
                      AND ficha.ID_F = tb_trimestre.id_fch AND horarios.id_trim_fch='$trimestre_id' 
                      AND horarios.hora = horas.id_h 
                      AND horarios.ficha=$id_ficha";
                      $result = mysqli_query($conn, $querys);
                      $row = mysqli_fetch_assoc($result);
                      if (isset($row)) { ?>
                          <?php echo $row['Nombre'] . " " . $row['Apellido']. "</br>" . $row['descripcion']; ?>
                          <br>
                          <a href="#edit_<?php echo $row['id_hora']; ?>" class="btn btn-outline-dark btn-sm" data-toggle="modal"><i class="bi bi-pencil-square"></i></a>
                          <a href="../../controlador/HorariosController/delete.php?eli=<?php echo $row['id_hora'] ?>">
                          <button type="button" onclick="return eliminarh()" class="btn btn-outline-dark btn-sm"><i class="bi-trash"></i></button></a>
                      <?php
                      } elseif (!isset($row)) {
                        echo "&nbsp";
                      }
                      ?>
                    </td>
                <?php
                   include('editar-horario.php');
                  }
                  echo "</tr>";
                }
                ?>
            </tbody>
          </table>
        </div>
        <!--/div2Tabla -->
      </div>
      <!--/div1Tabla -->
    <?php
  }
    ?>
    </div>
</div>



<script src="js.js"></script>
</body>
<?php
include("pantilla-footer.php");
?>
</html>