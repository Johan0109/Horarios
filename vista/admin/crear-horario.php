<div class="modal" id="myModal" role="dialog">
  <div class="modal-dialog modal-lg"> 
    <div class="modal-content">
      <div class="modal-body">
        <form class="form-horizontal" method="POST" id="formu" action="../../controlador/guardar_ficha.php?f_h=<?php echo $id_ficha; ?>">
          <div class="form-group">
            <label for="ins">Instructor:</label> 
            <select class="form-control" id="ins" name="ins">
              <option value="0">Seleccionar Instructor</option>
              <?php 
              $inst = "SELECT * FROM `instructor` WHERE instructor.ID > 1 ORDER BY instructor.Nombre ASC";
              $contI = mysqli_query($conn, $inst);
              while ($ins = mysqli_fetch_array($contI)) { ?>
                <option value="<?php echo $ins["ID"] ?>"><?php echo $ins["Nombre"] . " " . $ins['Apellido'] ?></option><?php } ?>
            </select>
            <br>
            <div class="container form-check"> 
            <label for="hour">Dia:</label>
              <div class="row justify-content-around">
                <div class="col-4">
                  <input class="form-check-input" type="checkbox" name="checkdia[1]" value="1">Lunes</input><br>
                  <input class="form-check-input" type="checkbox" name="checkdia[2]" value="2">Martes</input><br>
                  <input class="form-check-input" type="checkbox" name="checkdia[3]" value="3">Miercoles</input><br>
                </div>
                <div class="col-4">
                  <input class="form-check-input" type="checkbox" name="checkdia[4]" value="4">Jueves</input><br>
                  <input class="form-check-input" type="checkbox" name="checkdia[5]" value="5">Viernes</input><br>
                  <input class="form-check-input" type="checkbox" name="checkdia[6]" value="6">Sabado</input><br>
                </div>
              </div>
            </div><br>
            <div class="container">
              <label for="hour">Hora:</label><br>
              <div class="row justify-content-around">
                  <div class="col-4">
                    <input class="form-check-input" type="checkbox" name="checkhora[1]" value="1">06:00 - 07:40</input><br>
                    <input class="form-check-input" type="checkbox" name="checkhora[2]" value="2">08:00 - 09:40</input><br>
                    <input class="form-check-input" type="checkbox" name="checkhora[3]" value="3">10:00 - 11:40</input><br>
                    <input class="form-check-input" type="checkbox" name="checkhora[4]" value="4">12:00 - 13:40</input><br>
                  </div>
                  <div class="col-4">
                    <input class="form-check-input" type="checkbox" name="checkhora[5]" value="5">14:20 - 16:00</input><br>
                    <input class="form-check-input" type="checkbox" name="checkhora[6]" value="6">16:20 - 18:00</input><br>
                    <input class="form-check-input" type="checkbox" name="checkhora[7]" value="7">18:15 - 19:45</input><br>
                    <input class="form-check-input" type="checkbox" name="checkhora[8]" value="8">20:00 - 21:40</input>
                  </div>
              </div>
            </div>
            <br>
            <label for="ho">Ambiente:</label>
            <?php
            $amb = "SELECT * FROM ambiente WHERE ambiente.id_A > 1 ORDER BY ambiente.Nombre_ambiente ASC";
            $consulA = mysqli_query($conn, $amb);
            ?>
            <select class="form-control" id="ho" name="idAB">
              <option value="0">Seleccionar Ambiente</option>
              <?php
              while ($ambt = mysqli_fetch_assoc($consulA)) {
              ?>
                <option value="<?php echo $ambt['id_A'] ?>"><?php echo $ambt['Nombre_ambiente'] ?></option>
              <?php
              }
              ?>
            </select>
            <br>
            <label class="control-label" for="descripcion" >Descripción: </label>
            <input type="text" class="form-control" name="descrip" placeholder="Cursos Virtuales"><br>
            <label class="control-label" for="Obse">Observaciones:</label>
            <textarea name="observaciones" id="" cols="3" rows="2" class="form-control"></textarea>
          </div>
      </div>
      <div class="form-group">
        <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="bi-arrow-left"></i>Cancelar</button>
            <button type="submit" class="btn btn-success">Crear</button>
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>