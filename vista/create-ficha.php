<?php
$pageTitle = 'Registro de fichas';
include("parte_superior.php");
?>
<div> 
  <div class="row" style="display: contents;">
    <div class="col-sm-8 mx-auto">
      <div class="container border" style="padding:5%; background-color: #a2a1a5a8; ">
      <?php
      if (isset($_GET['vl'])) {

        if ($_GET['vl'] == 1) {
      ?>
          <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Ficha registrada</strong>
          </div>
        <?php
        } elseif ($_GET['vl'] == 2) {
        ?>
          <div class="alert alert-warning alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>La ficha ya esta registrada.</strong>
          </div>
      <?php
        }
      }
      ?>
        <form action="../controlador/FichaControllers/create.php" method="POST">
          <div class="form-group">
            <label for="fi">Numero de ficha:</label>
            <input type="number" max="9999999" class="mr-sm-2 form-control" placeholder="Ficha (Maximo 7 caracteres)" name="fich" id="fi" >
          </div>
          <div class="form-group">
            <label for="nop">Cantidad de aprendices:</label>
            <input type="number" class="form-control" placeholder="Cantidad de aprendices" name="can_apren" id="nop" >
          </div>

          <div class="form-group">
              <label for="instructor">Seleccione Instructor Tecnico:</label>
              <select name="instructor" class="form-control">
                    <option value="">Seleccionar</option>
                    <?php
                    $instructor = mysqli_query($conn, "SELECT * FROM instructor WHERE instructor.ID > 1 ORDER BY instructor.Nombre ASC");
                    while ($ins = mysqli_fetch_array($instructor)) { ?>
                      <option value="<?php echo $ins["Nombre"]. " " . $ins['Apellido'] ?>"><?php echo $ins["Nombre"] . " " . $ins['Apellido'] ?></option><?php } ?>
              </select>
          </div>
          <div class="form-group">
            <label for="jor">Seleccione el nivel de la ficha:</label>
            <select class="form-control" id="nivel" name="nivel">
             <option value="">Selecione</option>
              <option value="Tecnico">Técnico</option>
              <option value="Tecnologo">Tecnólogo</option>
              <option value="Especialización">Especialización</option>
            </select>
          </div>
          <div class="form-group">
            <label for="jor">Jornada:</label>
            <select class="form-control" id="jor" name="jornad">
              <option value="">Seleccione</option>
              <option value="Diurna">Diurna </option>
              <option value="Nocturna">Nocturna</option>
              <option value="Mixta">Mixta</option>
            </select>
          </div>
          <div class="form-group">
            <label for="tipf">Tipo de Formacion:</label>
            <select class="form-control" id="tipf" name="tipof">
              <option value="">Seleccione</option>
              <option value="Presencial">Presencial </option>
              <option value="Virtual">Virtual</option>
            </select>
          </div>
          <div class="form-group">
            <?php
            $prog = "SELECT * FROM programa";
            $cons = mysqli_query($conn, $prog);
            ?>
            <label for="progC">Nombre del programa:</label>
            <select class="form-control" id="progC" name="program">
              <option value="">Seleccione</option>
              <?php
              while ($cod_p = mysqli_fetch_assoc($cons)) {
              ?>
                <option value="<?php echo $cod_p['id_program'] ?>"><?php echo $cod_p['Nom_program']?> </option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="f_i">Fecha de inicio de etapa lectiva:</label>
            <input type="date" class="form-control" name="date_i" id="f_i" >
          </div>
          <div class="form-group">
            <label for="f_f">Fecha de fin de etapa lectiva:</label>
            <input type="date" class="form-control" name="date_f" id="f_f" >
          </div>
          <div class="form-group">
            <label for="f_i">Fecha de inicio de etapa productiva:</label>
            <input type="date" class="form-control" name="inicio_prod" id="f_i" >
          </div>
          <div class="form-group">
            <label for="f_f">Fecha de fin de etapa productiva:</label>
            <input type="date" class="form-control" name="fin_prod" id="f_f" >
          </div>
          <button type="submit" class="btn btn-dark">Registrar</button>
        </form>
      </div>
      
    </div>
  </div>
</div>
<?php
include("parte_inferior.php")
?>