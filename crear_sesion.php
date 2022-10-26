<?php
    error_reporting(0);
    include "conexion.php";

if(isset($_POST['usuario']) && isset($_POST['contrasenya'])){
    $usuario = $_POST['usuario'];
    $pswd = $_POST['contrasenya'];

    $sql = "select * from carrito.usuario where usuario = '".$usuario."';";
    $result = mysqli_query($obj_conexion, $sql);
    //echo $fila;
    //echo $result;
    while($fila = mysqli_fetch_assoc($result)){
        $contrasenya = $fila['pswd'];
        $activa = $fila['activo'];
        
    }
    echo 'es tal '.$activa;
    if($contrasenya != null){

        if($contrasenya == $pswd){
            
            if($activa == "1"){
                //Creamos la sesion:
                session_start();
                $_SESSION["usuario"] = $usuario;

                header('location: principal.php');
            }else{
                echo'<h1 style="text-align:center; margin-top: 250px;">Su cuenta está inactiva</h1>';
                echo'<p style="text-align:center;">Ingrese a su correo electrónico para activarla</p>';
                echo'<a href="login.php" style = "font-size: large; text-decoration: none; color: green;
                 border: 1px solid green; border-radius: 10px; padding:10px; 
                    margin-left:calc(50% - 50px)"> VOLVER </a>';
            }
            
        }else{
            echo'<h1 style="text-align:center; margin-top: 250px;">No coincide contraseña con usuario</h1>';
            echo'<a href="login.php" style = "font-size: large; text-decoration: none; color: green;
                 border: 1px solid green; border-radius: 10px; padding:10px; 
                    margin-left:calc(50% - 50px)"> VOLVER </a>';
        }
        
    }else{
        echo'<h1 style="text-align:center; margin-top:250px;">Usuario inexistente</h1>';
        echo'<a href="login.php" style = "font-size: large; text-decoration: none; color: green;
             border: 1px solid green; border-radius: 10px; padding:10px; 
                margin-left:calc(50% - 50px)"> Volver </a>';
    }
    
}
else{
    header('location: login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Pattaya&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Registro</title>
</head>
<body style="color:white; font-family: 'Open Sans Condensed', sans-serif; background-color: rgb(20, 20, 20);"> 

</body>
</html>