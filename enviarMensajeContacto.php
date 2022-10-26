<?php          
    include "conexion.php";
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require './PHPMailer-master/src/Exception.php';
    require './PHPMailer-master/src/PHPMailer.php';
    require './PHPMailer-master/src/SMTP.php';
    error_reporting(0);
    if(isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['mensaje'])){
        $nombre=$_POST['nombre'];
        $correo=$_POST['email'];
        $mensaje=$_POST['mensaje'];

        $email= ""
            .$nombre." con correo ".$correo." te ha enviado un mensaje a traves de la página de contacto
            ¡Intenta comunicarte de regreso lo antes posible!
            El mensaje del usuario dice lo siguiente: 

            ".$mensaje."


            OnlyShops
        ";

            $mail = new PHPMailer;
            $mail->SMTPDebug=0;
            $mail->isSMTP();
            $mail->Host="smtp.gmail.com";
            $mail->Port=587;
            $mail->SMTPSecure="tls";
            $mail->SMTPAuth=true;
            $mail->Username="YourEmail";
            $mail->Password="YourPassword"; 
            $mail->addAddress("YourEmail" ,$nombre);
            $mail->Subject= "Un usuario te ha enviado un mensaje!";
            $mail->isHTML();
            $mail->Body= $email;
            $mail->From="YourEmail";
            $mail->FromName="Onlyshops";
            
            if($mail->send())
            {
                //echo "Email Has Been Sent Your Email Address";
            }
            else
            {
                //echo "Failed To Sent An Email To Your Email Address";
            }

            $sql = 'insert into notificacion values (null, "'.$nombre.'", "'.$mensaje.'", "'.$correo.'",now());';

            mysqli_query($obj_conexion, $sql);
            

       

        echo "<script>alert('Mensaje enviado con éxito');</script>";
        echo "<script>setTimeout(history.back(),1000);</script>";
    }else{
        header("location:contacto.php");
    }
        
?>