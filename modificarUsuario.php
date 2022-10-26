<?php
    error_reporting(0);
    session_start();
    include "conexion.php";
    include "upload_photo.php";
    $id = $_GET['id'];
    $sql = "select * from usuario where id = '".$id."'";
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
    <link rel="stylesheet" href= estilos/modificar.css>
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
                <input type="text" name="nombre"  required pattern="[a-zA-Z ]{2,254}" value = "<?php echo $fila['nombre'] ?>"></br>
                <label>Edad</label></br>
                <input type="number" name="edad" min = 18 max = 99 required value = "<?php echo $fila['edad'] ?>"></br>
                <label>Email</label></br>
                <input type="email" name="email" required value = "<?php echo $fila['email'] ?>"></br>
                <label>Usuario</label></br>
                <input type="text" name = "usuario"  required pattern ="[a-zA-Z0-9]{5,100}" value = "<?php echo $fila['usuario'] ?>"></br>
                <label title="La contraseña debe contener de 8 a 18 caracteres, una mayúscula, una minúscula y un caracter especial">Contraseña</label></br>
                <input type="password" name="contrasenya" required value = "<?php echo $fila['contrasenya'] ?>"></br></br>
                <input type="submit" name="" value = "Modificar">
        </form>
        <?php } ?>
    </div>

    <?php

        $idp = $_POST['txtid'];
        $nombre = $_POST['nombre'];
        $edad = $_POST['edad'];
        $email = $_POST['email'];
        $usuario = $_POST['usuario'];
        $pswd = $_POST['contrasenya'];

        $sql = "select * from usuario where id <> '".$id."'";
        $result = mysqli_query($obj_conexion, $sql);
        $bandera = 1;
        while($fila = mysqli_fetch_assoc($result)){
            if($fila['usuario'] == $usuario || $fila['email'] == $email){
                $bandera = 0;
            }
        }


        if($bandera == 1){ 
            if($idp!=null && $nombre!=null && $edad!=null && $email!=null && $usuario!=null && $pswd!=null){
                $sql = "update usuario set nombre='".$nombre."', edad='".$edad."', email='".$email."', 
                            usuario='".$usuario."', password='".$pswd."' where id = '".$idp."';";
                mysqli_query($obj_conexion, $sql);
                echo "<script>alert('Modificación correcta!');</script>";
                echo "<script>window.history.go(-2)</script>"; 
            }
        }else{
            echo "<script>alert('El usuario ya existe o el correo ya fue registrado');</script>";
            echo "<script>window.history.go(-2)</script>";
        }
    
    ?>
</body>
</html>
