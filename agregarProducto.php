<?php 
    error_reporting(0);
    include "conexion.php";
    include "upload_photo.php";
    
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $desc = $_POST['descripcion'];
    $cant = $_POST['cantidad'];
  
    //Variables para subir foto:
    $nombre_foto=basename($_FILES['foto']['name']);
    $temp = $_FILES['foto']['tmp_name'];

    subirFoto($nombre_foto, $temp);

    if($nombre!=null || $precio!=null || $desc!=null || $cant!=null){
        $sql = 'insert into producto values (null, "'.$nombre.'", "'.$desc.'", "'.$precio.'", "'.$cant.
            '", "img/'.$nombre_foto.'", "1");';
        mysqli_query($obj_conexion, $sql);
        if($nombre = 1){
            header("location:productos.php");
        }
    }else{
        header("location:principal.php");
    }




?>