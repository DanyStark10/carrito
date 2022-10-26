<?php
    error_reporting(0);
    session_start();
    include "conexion.php";
    include "upload_photo.php";
    $id = $_GET['id'];
    $sql = "select * from producto where id = '".$id."'";
    $result = mysqli_query($obj_conexion, $sql);

    if($_SESSION['usuario'] != "admin"){
        header("location:principal.php");
    } 

    while($fila = mysqli_fetch_assoc($result)){
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "estilos/modificar.css">
    <style> a:link{ text-decoration: none!important; cursor: pointer;}</style>
    <title>Document</title>
</head>
<body>
    <div>
        <form method="POST" enctype="multipart/form-data">
                <h3>Modificar objeto con el id: <?php echo $id?></h3>
                <label>Id</label></br>
                <input type="text" name="txtid" readonly required value = "<?php echo $fila['id'] ?>"></br>
                <label>Nombre</label></br>
                <input type="text" name="nombre"  required value = "<?php echo $fila['nombre'] ?>"></br>
                <label>Descripcion</label></br>
                <input type="text" name="descripcion" required value = "<?php echo $fila['descripcion'] ?>"></br>
                <label>Precio</label></br>
                <input type="number" name="precio" min = 1 step = 0.01 required value = "<?php echo $fila['precio'] ?>"></br>
                <label>Cantidad</label></br>
                <input type="number" name = "cantidad" min = 1 required value = "<?php echo $fila['cantidad'] ?>"></br></br>
                <input type="file" name = "picture" accept="image/*"></br></br>
                <input type="submit" name="" value = "Modificar">
        </form>
        <?php } ?>
    </div>

    <?php

        $idp = $_POST['txtid'];
        $nombre = $_POST['nombre'];
        $desc = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $temp = $_FILES['picture']['tmp_name'];

        if($temp != null){
            $nombre_foto=basename($_FILES['picture']['name']);
            subirFoto($nombre_foto, $temp);
            if($nombre!=null || $precio!=null || $desc!=null || $cant!=null){
                $sql2 = 'update producto set nombre = "'.$nombre.'", descripcion = "'
                    .$desc.'", precio = "'.$precio.'", ruta_img = "img/'.$nombre_foto.'", cantidad = "'.$cantidad.'" where id = "'.$idp.'";';
                mysqli_query($obj_conexion, $sql2); 
                echo "<script>alert('Modificación correcta!');</script>";
                echo "<script>window.history.go(-2)</script>";  
            }
        }else{
            if($nombre!=null || $precio!=null || $desc!=null || $cant!=null){
                $sql2 = 'update producto set nombre = "'.$nombre.'", descripcion = "'
                    .$desc.'", precio = "'.$precio.'", cantidad = "'.$cantidad.'" where id = "'.$idp.'";';
                mysqli_query($obj_conexion, $sql2);
                echo "<script>alert('Modificación correcta!');</script>";
                echo "<script>window.history.go(-2)</script>";
            }
        }
    ?>
</body>
</html>



