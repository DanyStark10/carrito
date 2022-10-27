<?php
    error_reporting(0);
    session_start();
    include "conexion.php";
    include "upload_photo.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require './PHPMailer-master/src/Exception.php';
    require './PHPMailer-master/src/PHPMailer.php';
    require './PHPMailer-master/src/SMTP.php';

    $id = $_GET['id'];
   
    $sql = "select * from notificacion where id = '".$id."'";
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
    <title>responder</title>
</head>
<body>
    <div>
        <form method="POST" enctype="multipart/form-data">
                <h3 >Responder</h3>
                <label>Correo</label></br>
                <input type="text" name="correo" readonly  required value = "<?php echo $fila['correo'] ?>"></br>
                <label>Nombre</label></br>
                <input type="text" name="nombre" readonly required value = "<?php echo $fila['nombre'] ?>"></br>
                <label>Mensaje</label></br>
                <textarea  cols="41" rows="10" type="text" name="mensaje" required value = ""></textarea>
                <br><br>
                <input type="submit" name="" value = "Responder">
        </form>
        <?php } ?>
    </div>

    <?php

       
        $nombre = $_POST['nombre'];
        $mensaje = $_POST['mensaje'];
        $correo = $_POST['correo'];


        if($mensaje != null){

            $mail = new PHPMailer;
            $mail->SMTPDebug=0;
            $mail->isSMTP();
            $mail->Host="smtp.gmail.com";
            $mail->Port=587;
            $mail->SMTPSecure="tls";
            $mail->SMTPAuth=true;
            $mail->Username="shoppeinct@gmail.com";
            $mail->Password="ociwerkdpmnibzlb"; 
            $mail->addAddress($email ,$nombre);
            $mail->Subject= "Confirmacion OnlyShops";
            $mail->isHTML();
            $mail->Body= $correo;
            $mail->From="shoppeinct@gmail.com";
            $mail->FromName="Onlyshops";
            if($mail->send())
            {
                //echo "Email Has Been Sent Your Email Address";
            }
            else
            {
                //echo "Failed To Sent An Email To Your Email Address";
            }
        }


    ?>
</body>
</html>



