<?php
    session_start();
    error_reporting(0);
    include "conexion.php";
    $usuario = $_SESSION["usuario"];

    if(is_null($usuario)){
        header("location:login.php");
    }

    $tema = $_COOKIE[$usuario . '-mode'];
    $url_estilo = "";

    if($tema == null || $tema == ""){
        $url_estilo = "estilos/estilo_principal.css";
    }
    elseif($tema == "oscuro"){
        $url_estilo = "estilos/oscuros/estilo_principal.css";
    }
    elseif($tema == "claro"){
        $url_estilo = "estilos/claros/estilo_principal.css";
    }
    elseif($tema == "tenue"){
        $url_estilo = "estilos/tenues/estilo_principal.css";
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
    <style> a:link{ text-decoration: none!important; cursor: pointer;}</style>
    <title>Carrito de compras</title>
    <link rel="stylesheet" href= <?php echo $url_estilo ?>>
</head>

<body>

    <?php
        $tipoFecha = $_POST['fecha'];
        $dia = $_POST['dia'];
        $semana = explode("-W",$_POST['semana']);
        $mes = explode("-",$_POST['mes']);
        $rango1 = $_POST['rangoi'];
        $rango2 = $_POST['rangof'];

        switch($tipoFecha){
            case 1:
                $sql = "select * from venta where fecha = '".$dia."'";
                break;
            case 2:
                $sql = "select * from venta where week(fecha) = '".$semana[1]."' and year(fecha) = '".$semana[0]."'";
                break;
            case 3: 
                $sql = "select * from venta where month(fecha) = '".$mes[1]."' and year(fecha) = '".$mes[0]."'";
                break;
            case 4:
                $sql = "select * from venta where fecha between '".$rango1."' and '".$rango2."'";
                break;
            default:
                $sql = "select * from venta";
                break;
        }
        
        
        $result = mysqli_query($obj_conexion, $sql);
    ?>


    <div class = "page_nav">
        <h2><?php  echo $_SESSION['usuario']  ?></h2>
        <a class="log" id="cerrarSesion" href="cerrar_sesion.php">Cerrar sesión</a>
        <h1>OnlyShops</h1>
        <a href="carrito_compras.php">
            <img src="img/carrito.png" alt="">
        </a>
    </div>

    <div class = "menu_container">
        <ul class = "menu">
            <li><a href="principal.php">Inicio</a></li>
            <li><a href="contacto.php">Contacto</a></li>
            <li><a href="configuracion.php">Configuración</a></li>
            <?php
                if($_SESSION['usuario'] == "admin"){
                    echo '<li><a href="productos.php">Productos</a></li>';
                    echo '<li><a href="gestionUsuarios.php">Gestion de Usuarios</a></li>';
                    echo '<li><a href="estadisticas.php">Estadísticas</a></li>';
                    echo '<li><a href="consultaVentas.php">Ventas</a></li>';
                    echo ' <li><a href="notificaciones.php">Notificaciones</a></li>';
                }
            ?>
        </ul>
    </div>

    <div class="clearfix"></div>



    <div style = "font-family: 'Open Sans Condensed', sans-serif; margin:10px; border: 1px solid darkblue; border-radius: 10px; padding: 10px;">
        <h2> CONSULTA DE VENTAS </h2>
        <form method="POST">
                <label>POR DÍA</label>
                <input type="radio" name = "fecha" value="1" checked>
                <input type="date" name = "dia" style = "margin-right:10px" >
            
                <label>POR SEMANA</label>
                <input type="radio" name = "fecha" value="2">
                <input type="week" name = "semana" style = "margin-right:10px" >
            
                <label>POR MES</label>
                <input type="radio" name = "fecha" value="3">
                <input type="month" name = mes style = "margin-right:10px" >

                <label>POR RANGO</label>
                <input type="radio" name = "fecha" value="4">
                <input type="date" name = "rangoi">
                <input type="date" name = "rangof" style = "margin-right:10px" ></br></br>

                <input style="color:white; background:black; padding: 10px"type="submit" value="CONSULTAR">
        </form>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>SUBTOTAL</th>
                <th>TOTAL</th>
                <th>USUARIO</th>
                <th>FECHA</th>
                <th>ACCIÓN</th>
            </tr>
            <tbody>
                <?php
                    while($filas = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td><?php echo $filas['id']?></td>
                    <td>$<?php echo number_format(intval($filas['subtotal']),2)?></td>
                    <td>$<?php echo number_format(intval($filas['total']),2)?></td>
                    <td><?php echo $filas['usuario']?></td>
                    <td><?php echo $filas['fecha']?></td>
                    <td>
                        <a href="resumenVenta.php?id=<?php echo $filas['id']?>">Resumen</a>
                    </td>
                </tr>
            </tbody>

            <?php  } ?>
        </thead>
    </table>

                           

    <footer class="ct blue">© 2022 OnlyShops All Rights Reserved</footer><br><br><br>
    
    
</body>

</html>