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
    <title>Carrito de compras</title>
    <link rel="stylesheet" href= <?php echo $url_estilo ?>>
</head>

<body>

    <?php
        $id = $_GET['id'];
        $sql = "select producto.nombre, resumenVenta.id_producto, producto.precio, resumenVenta.cantidad, 
                             producto.precio * resumenVenta.cantidad as subtotal from producto, 
                                          resumenVenta where producto.id = resumenVenta.id_producto and resumenVenta.id_venta = '".$id."'";
        $result = mysqli_query($obj_conexion, $sql);
    ?>


    <div class = "page_nav">
        <h2>Bienvenido <?php  echo $_SESSION['usuario']  ?></h2>
        <a id="cerrarSesion" href="cerrar_sesion.php">Cerrar sesión</a>
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

    <a href="consultaVentas.php" style="text-decoration: none; color: black; margin: 20px; font-size: large;">VOLVER</a>

    <table>
        <thead>
            <tr>
                <th>NOMBRE</th>
                <th>ID DEL PRODUCTO</th>
                <th>PRECIO</th>
                <th>CANTIDAD</th>
                <th>SUBTOTAL</th>
            </tr>
            <tbody>
                <?php
                    while($filas = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td><?php echo $filas['nombre']?></td>
                    <td><?php echo $filas['id_producto']?></td>
                    <td>$<?php echo number_format(intval($filas['precio']),2)?></td>
                    <td><?php echo $filas['cantidad']?></td>
                    <td>$<?php echo number_format(intval($filas['subtotal']),2)?></td>
                </tr>
            </tbody>

            <?php  } ?>
        </thead>
    </table>

                           

    <footer class="ct blue">© 2022 OnlyShops All Rights Reserved</footer><br><br><br>
    
    
</body>

</html>