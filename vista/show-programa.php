<?php
$pageTitle = 'Programas';
include("parte_superior.php");
?>
<div>
  <div class="row">
    <div class="col-lg-12 mx-auto">
      <div class="container">
        <?php
        $contprog= mysqli_query($conn,"SELECT * FROM `programa`");
        ?>
        <div class="card-body">
        <?php
          if (isset($_GET['v'])) {
            if ($_GET['v'] == 1) {
          ?>
              <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>
                <strong>El programa se actualizó correctamente</strong>
              </div>
          <?php
            }
          }
          ?>
          <div class="table-responsive">
            <table id="table" class="table table-bordered table-striped mt-4">
              <thead>
                <tr>
                  <th>Nombre del Programa</th>
                  <th>Nivel de formacion</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($progcon = mysqli_fetch_assoc($contprog)) {
                ?>
                  <tr>
                    <td><?php echo $progcon["Nom_program"]; ?></td>
                    <td><?php echo $progcon["nivel_form"]; ?></td>
                    <td>
                      <div class="btn-group">
                      <a href="competencias-resultados.php?ubP=<?php echo $progcon["id_program"]?>">
                          <button type="submit" class="btn btn-dark btn-sm">Competencias y resultados
                          </button></a>
                        <a href="update-programa.php?ubP=<?php echo $progcon["id_program"] ?>">
                          <button type="submit" class="btn btn-success btn-sm"><i class="bi-pencil-square"></i>
                          </button></a>
                          <a href="../controlador/ProgramaControllers/delete.php?eliP=<?php echo $progcon['id_program'] ?>"><button type="submit" class="btn btn-danger btn-sm" 
                            onclick="return delete_('¿Está seguro de eliminar este programa?','Se eliminó el programa exitosamente.')"><i class="bi-trash"></i></button></a>
                      </div>
                    </td>
                  </tr>
                <?php
                }

                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<script src="js.js"></script>
<?php
include("parte_inferior.php")
?>