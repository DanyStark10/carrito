<?php 

    error_reporting(0);
    include "conexion.php";
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $pswd = $_POST['contrasenya'];
    $hash = md5($usuario);

    $sql = "select * from usuario";
    $result = mysqli_query($obj_conexion, $sql);
    $bandera = 1;
    while($fila = mysqli_fetch_assoc($result)){
        if($fila['usuario'] == $usuario || $fila['email'] == $email){
            $bandera = 0;
        }
    }

    
    if($bandera == 1){
        if($nombre!=null && $edad!=null && $email!=null && $usuario!=null && $pswd != null){
            $sql = "insert into usuario values(null, '".$nombre."', '".$edad."', '".$email."', 
                        '".$usuario."', '".$pswd."', '".$hash."', 0);";
            mysqli_query($obj_conexion, $sql);
            header("location:gestionUsuarios.php");
        }else{
            header("location:principal.php");
        }
    }else{
        echo "<script>alert('El usuario ya existe o el correo ya fue registrado');</script>";
        echo "<script>setTimeout(history.back(),1000);</script>";
    }
   


?>