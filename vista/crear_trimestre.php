<?php
$pageTitle = 'Crear Trimestre';
include("parte_superior.php");
?>


<div>
  <div class="row">
    <div class="col-sm-10 mx-auto">
      <div class="container border" style="padding:3%; background-color: #a2a1a5a8;">
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
      <h4>Seleccione el nivel del programa: </h4><br>
      <a href="tecnico_crear_trim.php"><button type="button" class="btn btn-secondary btn-block" style="cursor: pointer;">Técnico</button></a><br>
      <a href="tecnologo_crear_trim.php"><button type="button" class="btn btn-secondary btn-block" style="cursor: pointer;">Tecnólogo</button></a>
      </div>
    </div>
  </div>
</div>





<?php
include("parte_inferior.php")
?>