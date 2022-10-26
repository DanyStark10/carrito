<?php
    error_reporting(0);
    include "conexion.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require './PHPMailer-master/src/Exception.php';
    require './PHPMailer-master/src/PHPMailer.php';
    require './PHPMailer-master/src/SMTP.php';

if($_POST['contrasenya'] != $_POST['ConfirmContrasenya']){
    echo "<script>alert('Las contraseñas no coinciden');</script>";
    echo "<script>setTimeout(history.back(),1000);</script>";

}elseif(isset($_POST['nombre']) && isset($_POST['edad']) && isset($_POST['email']) && isset($_POST['usuario']) && isset($_POST['contrasenya'])){
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $contrasenya = $_POST['contrasenya'];
    $hash = md5($contrasenya);
    //https://castro-allan-301.000webhostapp.com/login_carritov0.2/activarCorreo.php?email=".$email."&hash=".$hash."
    $correo = "
        Bienvenido a OnlyShops!
        Confirma tu correo entrando al siguiente link: 

        http://localhost/car/activarCorreo.php?email=".$email."&hash=".$hash."

        Gracias por unirte :)
        ";


    $sql = "select * from usuario";
    $result = mysqli_query($obj_conexion, $sql);
    $bandera = 1;
   
    while($fila = mysqli_fetch_assoc($result)){
        if($fila['usuario'] == $usuario || $fila['email'] == $email){
            $bandera = 0;
        }
    }

    if($bandera == 1){
      
        $sql = "insert into usuario values(null, '".$nombre."', '".$edad."', '".$email."', '".$usuario."',
                    '".$contrasenya."', '".$hash."', '0')";
        $result = mysqli_query($obj_conexion, $sql);
        echo $result;
        echo $email;
        $mail = new PHPMailer;
            $mail->SMTPDebug=0;
            $mail->isSMTP();
            $mail->Host="smtp.gmail.com";
            $mail->Port=587;
            $mail->SMTPSecure="tls";
            $mail->SMTPAuth="login";
            $mail->Username="danielmessi485@gmail.com";
            $mail->Password=""; 
            $mail->addAddress($email ,$nombre);
            $mail->Subject= "Confirmacion OnlyShops";
            $mail->isHTML();
            $mail->Body= $correo;
            $mail->From="danielmessi485@gmail.com";
            $mail->FromName="Onlyshops";
            
            if($mail->send())
            {
                //echo "Email Has Been Sent Your Email Address";
            }
            else
            {
                //echo "Failed To Sent An Email To Your Email Address";
            }
       
            echo'<h1 style="text-align:center; margin-top: 250px">VERIFICA TU CORREO PARA ACTIVAR TU CUENTA</h1>
            <br> <p>Se ha enviado un enlace de confirmacion a tu correo electronico para realizar la activacion de tu cuenta</p>
             <a href="registro.php" style = "font-size: large; text-decoration: none; color: green;
                 border: 1px solid green; border-radius: 10px; padding:10px; 
                    margin-left:calc(50% - 50px)">INICIAR SESIÓN</a>';
    }else{
        echo'<h1 style="text-align:center; margin-top: 250px">ERROR AL CREAR CUENTA</h1>
                    <br> <p>El usuario o correo ingresado ya se encuentra registrado </p>
                     <a href="registro.php" style = "font-size: large; text-decoration: none; color: green;
                         border: 1px solid green; border-radius: 10px; padding:10px; 
                            margin-left:calc(50% - 50px)">INICIAR SESIÓN</a>';
    }
   

}else{
    header("location:login.php");
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