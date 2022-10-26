<?php
    include "conexion.php";
    error_reporting(0);

    if(isset($_POST['nombreReporte'])){
        $sql = "select * from usuario";
        $result = mysqli_query($obj_conexion, $sql);
        $file = $_POST['nombreReporte'];
    
        if (mysqli_num_rows($result) != 0) {
            $jump = "\r\n";
        $separator = "\t|";
            $fp = fopen($file, 'a');
            $registro = 'id' . $separator . 'nombre' . $separator . 'edad' . $separator . 'email' . $separator .'usuario'. $separator. 'contraseña' . $separator. 'activa' .$jump;
            fwrite($fp, $registro);
            while($row = mysqli_fetch_array($result)) {
                $registro = $row['id'] . $separator . $row['nombre'] . $separator . $row['edad'] . $separator . $row['email'] . $separator . $row['usuario']  . $separator . $row['contrasenya']  . $separator . $row['activa'] . $jump;
                fwrite($fp, $registro);
            }
        }
        fclose($fp);
        chmod($file, 0777);
  
        echo "<script>alert('Se han guardado ".mysqli_num_rows($result)." registros en formato txt con el nombre de reporte.txt');</script>";
        echo "<script>window.history.go(-1)</script>";
    
    }else{
        header("location:principal.php");
    }
    

?>