<?php

    function insertar_datos($resultado,$instructor,$crearresultado){
        global $conn;
        
        $crearresultado = $_GET['create'];

        $sentencia = "INSERT INTO `resultados`(`id`, `resultados`, `instructor_resultados`, `programas_id`) 
        VALUES (null,'$resultado','$instructor','$crearresultado')";

        $ejecutar = mysqli_query($conn,$sentencia);
        return $ejecutar;


}

?>