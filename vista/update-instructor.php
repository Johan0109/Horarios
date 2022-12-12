<?php
$pageTitle = 'Editar instructor';
include("parte_superior.php");
?>
<!--/lateral-->
<div class="content-wrapper">
  <div class="container">
    <br>
    <?php
    $idins = $_GET['ubds']; //id del instructor------------------------------------------------------

    $queryins = "SELECT * FROM `instructor`,`roles` where `instructor`.`rol`=`roles`.`id_rol` and `ID`='$idins'";
    $result = mysqli_query($conn, $queryins);
    $rows = $result->fetch_array();
    ?>
    <div class="row" style="display: contents;">
      <div class="col-sm-8 mx-auto">
        <div class="container border" style="padding:4%; background-color: #a2a1a5a8; ">
          <form action="../controlador/InstructorControllers/update.php?ubd=<?php echo $idins ?>" method="POST">
            <div class="form-group">
              <label for="nom">Nombre:</label>
              <input type="text" class="mr-sm-2 form-control" value="<?php echo $rows["Nombre"] ?>" placeholder="Nombre" name="nombre" id="nom" required="">
            </div>
            <div class="form-group">
              <label for="apel">Apellido:</label>
              <input type="text" class="form-control" value="<?php echo $rows["Apellido"] ?>" placeholder="Digite el Apellido" name="apellido" id="apel" required="">
            </div>
            <div class="form-group">
              <label for="email">Email :</label>
              <input type="email" class="mr-sm-2 form-control " value="<?php echo $rows["email"] ?>" placeholder="Digite el Email" name="correo" id="email" disabled>
            </div>
            <div class="form-group">
              <label for="horasi">Horas instructor:</label>
              <input type="number" class="mr-sm-2 form-control " value="<?php echo $rows["horas_inst"] ?>" name="horas_inst" id="nsemana">
            </div>
            <div class="form-group">
              <label for="roles">Rol del Instructor:</label>
              <select class="form-control" id="roles" name="rol" required="">
                <option value="<?php echo $rows["id_rol"]; ?>"><?php echo $rows["rol"] ?></option>
                <option value="2">Instructor</option>
                <option value="1">ADMIN</option>
              </select>
            </div>
            <div class="btn-group">
              <button type="button" class="btn btn-secondary" onclick="window.open('show-instructor.php','_Self')"><i class="bi-arrow-left"></i>Atrás</button>
              <button type="submit" class="btn btn-success">Actualizar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php
include("parte_inferior.php");
?>
<script src="js.js">
</script>

</body>

</html>