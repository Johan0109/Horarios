<?php
$pageTitle = 'Trimestres';
include("parte_superior.php");
?>
<div>
  <div class="row">
    <div class="col-lg-12 mx-auto">
      <div class="container">
        <?php
        $upfech = $_GET['upfech']; //id de la ficha------------------------------------------------------
        $query = mysqli_query($conn, "SELECT * FROM ficha WHERE ID_F=$upfech");
        $row = mysqli_fetch_assoc($query);
        ?>
        <?php
        if (isset($_GET['v'])) {
          if ($_GET['v'] == 1) {
        ?>
            <div class="alert alert-success alert-dismissible fade show mt-4">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
              <strong>El Trimestre se actualizó correctamente</strong>
            </div>
        <?php
          }
        }
        ?>
        <div class="card">
          <div class="card-body">
            <center><h3>Ficha: <?php echo $row['Nº ficha'] ?></h3></center>
            <h5 class="card-text" style="color:#642500;">Instructor Tecnico:</h5><p><?php echo $row['fc_instructor'] ?></p>
            <h5 class="card-text" style="color:#642500;">Fecha de inicio de etapa lectiva:</h5><p><?php echo $row['fic_date_I'] ?></p>
            <h5 class="card-text" style="color:#642500;">Fecha de fin de etapa lectiva:</h5><p> <?php echo $row['fic_date_F'] ?></p>
            <h5 class="card-text" style="color:#642500;">Fecha de inicio de etapa productiva:</h5><p> <?php echo $row['inicio_prod'] ?></p>
            <h5 class="card-text" style="color:#642500;">Fecha de fin de etapa productiva:</h5><p><?php echo $row['fin_prod'] ?></p>
          </div>
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
            <tr>
                <th scope="col">Trimestre</th>
                <th scope="col">Fecha de inicio</th>
                <th scope="col">Fecha Fin</th>
                <th scope="col">Instructor</th>
                <th scope="col">Opciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $query_trimestres = mysqli_query($conn, "SELECT * FROM ficha,tb_trimestre,instructor
              WHERE tb_trimestre.id_fch=ficha.ID_F AND instructor.id= tb_trimestre.instructor_id 
              AND tb_trimestre.id_fch=$upfech");
              while ($rows = mysqli_fetch_assoc($query_trimestres)) {
              ?>
                <form method="post" action="../controlador/trimestreControllers/update.php?id_F=<?php echo $upfech; ?>">
                  <tr>
                    <th><?php echo $rows["Trimestre"]; ?>
                      <input type="number" name="id_fech" style="display:none;" value="<?php echo $rows['id_T']; ?>">
                    </th>
                    <td><input type="date" name="date_Iup" value="<?php echo $rows["Trim_date_Inc"]; ?>"></td>
                    <td><input type="date" name="date_Fup" value="<?php echo $rows["Trim_date_fin"]; ?>"></td>
                    <td><select name="instructor_update" id="">
                        <option value="<?php echo $rows['ID'] ?>"><?php echo $rows['Nombre'] . " " . $rows['Apellido'] ?></option>
                        <?php
                        $instructor = mysqli_query($conn, "SELECT * FROM instructor WHERE instructor.ID > 1 ORDER BY instructor.Nombre ASC");
                        while ($ins = mysqli_fetch_array($instructor)) { ?>
                          <option value="<?php echo $ins["ID"]; ?>"><?php echo $ins['Nombre'] . " " . $ins['Apellido'] ?></option>
                        <?php } ?>
                      </select>
                    </td>
                    <td>
                      <div class="btn-group">
                        <button type="submit" class="btn btn-success">Actualizar</button>
                      </div>
                    </td>
                  </tr>
                </form>
              <?php
              }
              ?>
            </tbody>
          </table>
          <button type="button" class="btn btn-secondary" onclick="window.open('show-ficha.php','_Self')"><i class="bi-arrow-left"></i>Atrás</button>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include("parte_inferior.php");
?>