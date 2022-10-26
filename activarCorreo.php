<?php
    error_reporting(0);
    include "conexion.php";
    $correo = $_GET['email'];
    $hash = $_GET['hash'];

    $sql1 = "select * from usuario where email = '".$correo."'";
    $result = mysqli_query($obj_conexion, $sql1);
    while($fila = mysqli_fetch_assoc($result)){
        $hashbd = $fila['hash'];
    }

    if(isset($_GET['email']) && isset($_GET['hash'])){

        if($hashbd == $hash){
            $sql = "update usuario set activa = 1 where email = '".$correo."' and hash = '".$hash."';";
            mysqli_query($obj_conexion, $sql);
            echo'<h1 style="text-align:center; margin-top: 250px">TU CUENTA SE HA CONFIRMADO CON ÉXITO</h1>
                     <a href="registro.php" style = "font-size: large; text-decoration: none; color: green;
                         border: 1px solid green; border-radius: 10px; padding:10px; 
                            margin-left:calc(50% - 50px)">INICIAR SESIÓN</a>';
        }else{
            echo'<h1 style="text-align:center; margin-top: 250px">ERROR AL CONFIRMAR CUENTA</h1>
                     <a href="registro.php" style = "font-size: large; text-decoration: none; color: green;
                         border: 1px solid green; border-radius: 10px; padding:10px; 
                            margin-left:calc(50% - 50px)">INICIAR SESIÓN</a>';
        }


    }else{
        header("location:principal.php");
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