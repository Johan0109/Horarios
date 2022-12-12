<?php
$pageTitle = 'Registro de trimestres';
include("parte_superior.php");
?>


<div>
  <div class="row">
    <div class="col-sm-10 mx-auto">
      <div class="container border" style="padding:3%; background-color: #a2a1a5a8;">
        <?php
        $conFT = mysqli_query($conn, "SELECT * FROM ficha,programa 
        WHERE ficha.fc_id_programa=programa.id_program AND ficha.estatus_trim=0");
        ?>
        <form action="../controlador/trimestreControllers/createtecnologo.php" method="POST" style="padding-left:5%;">
          <div class="form-group">
            <h4>Ficha:</h4>
            <select name="ficha_fecha" class="form-control">
                    <option value="">Seleccionar</option>
                    <?php
                    $ficha = mysqli_query($conn, "SELECT * FROM ficha WHERE fc_nivel LIKE '%Tecnologo';");
                    while ($n_ficha = mysqli_fetch_array($ficha)) { ?>
                      <option value="<?php echo $n_ficha["ID_F"] ?>"><?php echo $n_ficha['Nº ficha'] ?></option><?php } ?>
                  </select>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Trimestre</th>
                <th scope="col">Fecha de inicio</th>
                <th scope="col">Fecha final</th>
                <th scope="col">Instructor</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">I</th>
                <td><input type="date" class="form-control" name="date_i_I" id="f_i_t_I"></td>
                <td><input type="date" class="form-control" name="date_f_I" id="f_f_t_I"></td>
                <td>
                  <select name="instructor_1" class="form-control">
                    <option value="">Seleccionar</option>
                    <?php
                    $instructor = mysqli_query($conn, "SELECT * FROM instructor WHERE instructor.ID > 1  ORDER BY instructor.Nombre ASC");
                    while ($ins = mysqli_fetch_array($instructor)) { ?>
                      <option value="<?php echo $ins["ID"] ?>"><?php echo $ins["Nombre"] . " " . $ins['Apellido'] ?></option><?php } ?>
                  </select>
                </td>
              </tr>

              <tr>
                <th scope="row">II</th>
                <td><input type="date" class="form-control" name="date_i_II" id="f_i_t_II"></td>
                <td><input type="date" class="form-control" name="date_f_II" id="f_f_t_II" ></td>
                <td>
                  <select name="instructor_2" class="form-control">
                    <option value="">Selecionar</option>
                    <?php
                    $instructor = mysqli_query($conn, "SELECT * FROM instructor WHERE instructor.ID > 1  ORDER BY instructor.Nombre ASC");
                    while ($ins = mysqli_fetch_array($instructor)) { ?>
                      <option value="<?php echo $ins["ID"] ?>"><?php echo $ins["Nombre"] . " " . $ins['Apellido'] ?></option><?php } ?>
                  </select>
                </td>
              </tr>

              <tr>
                <th scope="row">III</th>
                <td><input type="date" class="form-control" name="date_i_III" id="f_i_t_III"></td>
                <td><input type="date" class="form-control" name="date_f_III" id="f_f_t_III"></td>
                <td>
                  <select name="instructor_3" class="form-control">
                    <option value="">Selecionar</option>
                    <?php
                    $instructor = mysqli_query($conn, "SELECT * FROM instructor WHERE instructor.ID > 1  ORDER BY instructor.Nombre ASC");
                    while ($ins = mysqli_fetch_array($instructor)) { ?>
                      <option value="<?php echo $ins["ID"] ?>"><?php echo $ins["Nombre"] . " " . $ins['Apellido'] ?></option><?php } ?>
                  </select>
                </td>
              </tr>

              <tr>
                <th scope="row">IV</th>
                <td><input type="date" class="form-control" name="date_i_IV" id="f_i_t_IV"></td>
                <td><input type="date" class="form-control" name="date_f_IV" id="f_f_t_IV"></td>
                <td>
                  <select name="instructor_4" class="form-control">
                    <option value="">Selecionar</option>
                    <?php
                    $instructor = mysqli_query($conn, "SELECT * FROM instructor WHERE instructor.ID > 1  ORDER BY instructor.Nombre ASC");
                    while ($ins = mysqli_fetch_array($instructor)) { ?>
                      <option value="<?php echo $ins["ID"] ?>"><?php echo $ins["Nombre"] . " " . $ins['Apellido'] ?></option><?php } ?>
                  </select>
                </td>
              </tr>

              <tr>
                <th scope="row">V</th>
                <td><input type="date" class="form-control" name="date_i_V" id="f_i_t_V"></td>
                <td><input type="date" class="form-control" name="date_f_V" id="f_f_t_V"></td>
                <td>
                  <select name="instructor_5" class="form-control">
                    <option value="">Selecionar</option>
                    <?php
                    $instructor = mysqli_query($conn, "SELECT * FROM instructor WHERE instructor.ID > 1  ORDER BY instructor.Nombre ASC");
                    while ($ins = mysqli_fetch_array($instructor)) { ?>
                      <option value="<?php echo $ins["ID"] ?>"><?php echo $ins["Nombre"] . " " . $ins['Apellido'] ?></option><?php } ?>
                  </select>
                </td>
              </tr>


              <tr>
                <th scope="row">VI</th>
                <td><input type="date" class="form-control" name="date_i_VI" id="f_i_t_VI"></td>
                <td><input type="date" class="form-control" name="date_f_VI" id="f_f_t_VI"></td>
                <td>
                  <select name="instructor_6" class="form-control">
                    <option value="">Selecionar</option>
                    <?php
                    $instructor = mysqli_query($conn, "SELECT * FROM instructor WHERE instructor.ID > 1  ORDER BY instructor.Nombre ASC");
                    while ($ins = mysqli_fetch_array($instructor)) { ?>
                      <option value="<?php echo $ins["ID"] ?>"><?php echo $ins["Nombre"] . " " . $ins['Apellido'] ?></option><?php } ?>
                  </select>
                </td>
              </tr>

              <tr>
                <th scope="row">VII</th>
                <td><input type="date" class="form-control" name="date_i_VII" id="f_i_t_VII"></td>
                <td><input type="date" class="form-control" name="date_f_VII" id="f_f_t_VII"></td>
                <td>
                  <select name="instructor_7" class="form-control">
                    <option value="">Selecionar</option>
                    <?php
                    $instructor = mysqli_query($conn, "SELECT * FROM instructor WHERE instructor.ID > 1  ORDER BY instructor.Nombre ASC");
                    while ($ins = mysqli_fetch_array($instructor)) { ?>
                      <option value="<?php echo $ins["ID"] ?>"><?php echo $ins["Nombre"] . " " . $ins['Apellido'] ?></option><?php } ?>
                  </select>
                </td>
              </tr>


            </tbody>
          </table>
          <button type="submit" class="btn btn-dark">Registrar</button>
        </form>
        <br><a href="./crear_trimestre.php" style="margin-left:40px ;"><button class="btn btn-dark">Atras</button></a>
      </div>
      <?php
      if (isset($_GET['vtf'])) {

        if ($_GET['vtf'] == 1) {
      ?>
          <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Fechas registradas</strong>
          </div>
      <?php
        }
      }
      ?>
    </div>
  </div>
</div>
</div>

<?php
include("parte_inferior.php")
?>